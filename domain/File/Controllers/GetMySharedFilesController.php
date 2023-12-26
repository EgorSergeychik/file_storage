<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\GetMySharedFilesAction;
use Illuminate\Foundation\Http\FormRequest;

class GetMySharedFilesController extends Controller
{
    public function __construct(
        private readonly GetMySharedFilesAction $getMySharedFilesAction,
    ) {
    }

    public function __invoke(FormRequest $request)
    {
        $sharing_with_data = $this->getMySharedFilesAction->__invoke();

        return $sharing_with_data;
    }
}
