<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\UpdateFileAction;
use Domain\File\DTO\UpdateFileData;
use Domain\File\Models\File;
use Domain\File\Requests\UpdateFileRequest;

class UpdateFileController extends Controller
{
    public function __construct(
        private readonly UpdateFileAction $updateFileAction,
    ) {
    }

    public function __invoke(UpdateFileRequest $request, File $file)
    {
        $data = UpdateFileData::fromRequest($request);

        try {
            $updated_file = ($this->updateFileAction)($data);

            return redirect()->back()->with(['success' => 'File updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
