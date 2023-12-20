<?php

namespace Domain\Folder\Controllers;

use App\Http\Controllers\Controller;
use Domain\Folder\Actions\CreateFolderAction;
use Domain\Folder\Actions\GetFolderAction;
use Domain\Folder\DTO\CreateFolderData;
use Domain\Folder\DTO\GetFolderData;
use Domain\Folder\Models\Folder;
use Domain\Folder\Requests\CreateFolderRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateFolderController extends Controller
{
    public function __construct(
        private readonly CreateFolderAction $createFolderAction,
    ) {
    }

    public function __invoke(CreateFolderRequest $request)
    {
        $data = CreateFolderData::fromRequest($request);

        $folder = ($this->createFolderAction)($data);

        return redirect()->back()->with('success', 'Folder created successfully');
    }
}
