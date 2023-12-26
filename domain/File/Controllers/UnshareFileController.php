<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\UnshareFileAction;
use Domain\File\DTO\UnshareFileData;
use Domain\File\Requests\UnshareFileRequest;
use Domain\SharedFile\Models\SharedFile;

class UnshareFileController extends Controller
{
    public function __construct(
        private readonly UnshareFileAction $unshareFileAction,
    ) {
    }

    public function __invoke(UnshareFileRequest $request, SharedFile $shared_file)
    {
        $data = UnshareFileData::fromRequest($request);

        $is_unshared = ($this->unshareFileAction)($data);

        if (!$is_unshared) {
            return back()->withErrors(['error' => 'Something went wrong.']);
        }

        return back()->with('success', 'File unshared successfully.');
    }
}
