<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\DownloadFileAction;
use Domain\File\DTO\DownloadFileData;
use Domain\File\Models\File;
use Domain\Folder\Actions\GetFolderAction;
use Domain\Folder\DTO\GetFolderData;
use Domain\Folder\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function __construct(
        private readonly DownloadFileAction $downloadFileAction,
    ) {
    }

    public function __invoke(FormRequest $request, File $file)
    {
        $data = DownloadFileData::fromRequest($request);

        $file_path = ($this->downloadFileAction)($data);

        if (!$file_path) {
            return redirect()->back()->withErrors(['file' => 'File not found']);
        }

        return Response::download(
            Storage::disk('local')->path($file_path),
        );
    }
}
