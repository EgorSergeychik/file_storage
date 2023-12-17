<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\DeleteFileAction;
use Domain\File\DTO\DeleteFileData;
use Domain\File\Models\File;
use Illuminate\Foundation\Http\FormRequest;

class UploadFileController extends Controller
{
    public function __construct(
        private readonly DeleteFileAction $deleteFileAction,
    ) {
    }

    public function __invoke(FormRequest $request, File $file)
    {
        $data = DeleteFileData::fromRequest($request);

        $is_deleted = ($this->deleteFileAction)($data);

        if (!$is_deleted) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }

        return redirect()->back()->with(['success' => 'File deleted successfully']);
    }
}
