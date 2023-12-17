<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\UploadFileAction;
use Domain\File\DTO\UploadFileData;
use Domain\File\Requests\UploadFileRequest;

class UploadFileController extends Controller
{
    public function __construct(
        private readonly UploadFileAction $uploadFileAction,
    ) {
    }

    public function __invoke(UploadFileRequest $request)
    {
        $data = UploadFileData::fromRequest($request);

        $is_uploaded = ($this->uploadFileAction)($data);

        if (!$is_uploaded) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }

        return redirect()->back()->with(['success' => 'File uploaded successfully']);
    }
}
