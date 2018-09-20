<?php

namespace App\Domain\EditedFiles;

use App\Domain\EditedFiles\Dto\EditedFileData;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Log;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Edited files revisions service. Can register new revision and return list of file revisions.
 */
class EditedFilesService
{
    /**
     * Cache storage.
     *
     * @var Repository
     */
    private $repository;

    /**
     * Edited files revisions service. Can register new revision and return list of file revisions.
     *
     * @param Repository $repository Cache storage
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Hydrate raw attributes into object instance.
     *
     * @param mixed[] $attributes Attributes to hydrate
     *
     * @return EditedFileData
     */
    private function hydrate(array $attributes): EditedFileData
    {
        return new EditedFileData($attributes);
    }

    /**
     * Hydrates list of raw attributes into collection of object instances.
     *
     * @param mixed[][] $items List of items attributes to hydrate
     *
     * @return Collection|EditedFileData[]
     */
    private function hydrateCollection(array $items): Collection
    {
        $result = new Collection([]);
        foreach ($items as $item) {
            $editedFileData = $this->hydrate($item);
            $result->push($editedFileData);
        }

        return $result;
    }

    /**
     * Returns cache key for file revision.
     *
     * @param EditedFileData $editedFileData File revision to retrieve key for
     *
     * @return string
     */
    private function getFileKey(EditedFileData $editedFileData): string
    {
        return Str::snake("{$editedFileData->projectName} {$editedFileData->pathHash}");
    }

    /**
     * Returns all registered revisions of given file.
     *
     * @param EditedFileData $editedFileData File data to return revisions for
     *
     * @return Collection
     */
    public function getRevisions(EditedFileData $editedFileData): Collection
    {
        $fileKey = $this->getFileKey($editedFileData);
        $editedFileVersions = $this->repository->get($fileKey) ?? [];

        return $this->hydrateCollection($editedFileVersions);
    }

    /**
     * Sets new list of file revisions.
     *
     * @param EditedFileData $editedFileData Edited file to set revisions for
     * @param Collection $revisions New list of file revisions
     *
     * @throws InvalidArgumentException
     */
    public function setRevisions(EditedFileData $editedFileData, Collection $revisions): void
    {
        $fileKey = $this->getFileKey($editedFileData);

        $this->repository->set(
            $fileKey,
            $revisions->toArray(),
            Carbon::SECONDS_PER_MINUTE * Carbon::MINUTES_PER_HOUR
        );
    }

    /**
     * Registers new revision of edited file. If revision with same author already exists it will be replaced.
     *
     * @param EditedFileData $editedFileData New edited file version to register
     *
     * @return Collection|EditedFileData[] List of new file revisions
     *
     * @throws InvalidArgumentException
     */
    public function registerNewRevision(EditedFileData $editedFileData): Collection
    {
        Log::debug('New revision register attempt', $editedFileData->toArray());
        $editedFileVersions = $this->getRevisions($editedFileData)
            ->keyBy(function (EditedFileData $editedFileData) {
                return $editedFileData->developerName;
            })
            ->except($editedFileData->developerName)
            ->values()
            ->push($editedFileData);

        $this->setRevisions($editedFileData, $editedFileVersions);

        return $editedFileVersions;
    }
}
