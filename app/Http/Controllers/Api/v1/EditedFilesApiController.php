<?php

namespace App\Http\Controllers\Api\v1;

use App\Domain\EditedFiles\EditedFilesService;
use App\Http\Requests\StoreEditedFileRevisionRequest;
use Dingo\Api\Http\Response;
use Psr\SimpleCache\InvalidArgumentException;
use Saritasa\LaravelControllers\Api\BaseApiController;

/**
 * Edited files revisions API requests controller.
 * + Returns list of file revisions
 * + Registers new file revision
 */
class EditedFilesApiController extends BaseApiController
{
    /**
     * Edited files revisions service. Can register new revision and return list of file revisions.
     *
     * @var EditedFilesService
     */
    private $editedFilesService;

    /**
     * Edited files revisions API requests controller.
     *
     * @param EditedFilesService $editedFilesService Edited files revisions service
     */
    public function __construct(EditedFilesService $editedFilesService)
    {
        parent::__construct();
        $this->editedFilesService = $editedFilesService;
    }

    /**
     * Registers new revision of edited file.
     *
     * @param StoreEditedFileRevisionRequest $request Request with file revision information
     *
     * @return Response
     *
     * @throws InvalidArgumentException
     */
    public function store(StoreEditedFileRevisionRequest $request): Response
    {
        $revisions = $this->editedFilesService->registerNewRevision($request->getEditedFileData());

        return $this->response->collection($revisions, $this->transformer);
    }
}
