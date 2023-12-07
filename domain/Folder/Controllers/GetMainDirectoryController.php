<?php

namespace Domain\Folder\Controllers;

use App\Http\Controllers\Controller;

class GetMainDirectoryController extends Controller
{
    public function __invoke()
    {
        $files = auth()->user()->files()->whereNull('folder_id')->get();
        $files->load(['file_type', 'tags']);
        $folders = auth()->user()->folders()->whereNull('parent_id')->get();

        return view('my-drive', compact('files', 'folders'));
    }
}
