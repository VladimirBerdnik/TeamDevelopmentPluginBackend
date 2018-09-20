<?php

namespace App\Domain\EditedFiles\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Dto;

/**
 * Details of edited file in project under team development.
 *
 * @property-read string $projectName Name of the project under team development where file was edited
 * @property-read string $developerName Name of the author that edited file
 * @property-read string $pathHash Hash of the file path
 * @property-read string $contentHash Hash of the file content
 */
class EditedFileData extends Dto implements Arrayable
{
    public const PROJECT_NAME = 'projectName';

    public const DEVELOPER_NAME = 'developerName';

    public const PATH_HASH = 'pathHash';

    public const CONTENT_HASH = 'contentHash';

    /**
     * Slug of the project under team development where file was edited.
     *
     * @var string
     */
    protected $projectName;

    /**
     * Name of the author that edited file.
     *
     * @var string
     */
    protected $developerName;

    /**
     * Hash of the file path.
     *
     * @var string
     */
    protected $pathHash;

    /**
     * Hash of the file content.
     *
     * @var string
     */
    protected $contentHash;
}
