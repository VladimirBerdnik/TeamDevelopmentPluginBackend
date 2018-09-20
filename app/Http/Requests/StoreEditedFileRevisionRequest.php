<?php

namespace App\Http\Requests;

use App\Domain\EditedFiles\Dto\EditedFileData;
use Saritasa\Laravel\Validation\Rule;

/**
 * Request of storing new information about edited file revision.
 */
class StoreEditedFileRevisionRequest extends Request
{
    /**
     * Validation rules that should be applied to request.
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            EditedFileData::PROJECT_NAME => Rule::string()->required(),
            EditedFileData::DEVELOPER_NAME => Rule::string()->required(),
            EditedFileData::PATH_HASH => Rule::string()->required(),
            EditedFileData::CONTENT_HASH => Rule::string()->required(),
        ];
    }

    /**
     * Returns edited file revision details from request.
     *
     * @return EditedFileData
     */
    public function getEditedFileData(): EditedFileData
    {
        return new EditedFileData($this->all());
    }
}
