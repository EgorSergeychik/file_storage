<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\DownloadFileAction;
use Domain\File\Actions\ShareFileAction;
use Domain\File\DTO\DownloadFileData;
use Domain\File\DTO\ShareFileData;
use Domain\File\Models\File;
use Domain\File\Requests\ShareFileRequest;
use Domain\Folder\Actions\GetFolderAction;
use Domain\Folder\DTO\GetFolderData;
use Domain\Folder\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ShareFileController extends Controller
{
    public function __construct(
        private readonly ShareFileAction $shareFileAction,
    ) {
    }

    public function __invoke(ShareFileRequest $request, File $file)
    {
        $data = ShareFileData::fromRequest($request);

        $is_shared = ($this->shareFileAction)($data);

        if (!$is_shared) {
            return back()->withErrors(['error' => 'Something went wrong.']);
        }

        return back()->with('success', 'File shared successfully.');
    }
}
