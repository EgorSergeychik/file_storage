<?php

namespace Domain\Folder\Controllers;

use App\Http\Controllers\Controller;
use Domain\Folder\Actions\GetFolderAction;
use Domain\Folder\DTO\GetFolderData;
use Domain\Folder\Models\Folder;
use Illuminate\Foundation\Http\FormRequest;

class GetFolderController extends Controller
{
    public function __construct(
        private readonly GetFolderAction $getFolderAction,
    ) {
    }

    public function __invoke(FormRequest $request, Folder $folder = null)
    {
        $data = GetFolderData::fromRequest($request);

        $table_data = ($this->getFolderAction)($data);

        return view('my-drive', $table_data);
    }
}
