<?php

namespace Domain\Folder\Controllers;

use App\Http\Controllers\Controller;
use Domain\Folder\Actions\DeleteFolderAction;
use Domain\Folder\DTO\DeleteFolderData;
use Domain\Folder\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;

class DeleteFolderController extends Controller
{
    public function __construct(
        private readonly DeleteFolderAction $deleteFolderAction,
    ) {
    }

    public function __invoke(FormRequest $request, Folder $folder)
    {
        $data = DeleteFolderData::fromRequest($request);

        $is_deleted = ($this->deleteFolderAction)($data);

        if (!$is_deleted) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }

        return redirect()->back()->with(['success' => 'Folder deleted successfully']);
    }
}
