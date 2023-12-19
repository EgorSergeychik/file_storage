<?php

namespace Domain\Folder\Controllers;

use App\Http\Controllers\Controller;
use Domain\Folder\Actions\UpdateFolderAction;
use Domain\Folder\DTO\UpdateFolderData;
use Domain\Folder\Models\Folder;
use Domain\Folder\Requests\UpdateFolderRequest;

class UpdateFolderController extends Controller
{
    public function __construct(
        private readonly UpdateFolderAction $updateFolderAction,
    ) {
    }

    public function __invoke(UpdateFolderRequest $request, Folder $folder)
    {
        $data = UpdateFolderData::fromRequest($request);

        $updated_folder = ($this->updateFolderAction)($data);

        return redirect()->back()->with(['success' => 'Folder updated successfully']);
    }
}
