<?php

namespace Domain\File\Controllers;

use App\Http\Controllers\Controller;
use Domain\File\Actions\GetMySharedFilesAction;
use Domain\File\Actions\GetSharedFilesAction;
use Illuminate\Foundation\Http\FormRequest;

class GetSharedFilesController extends Controller
{
    public function __construct(
        private readonly GetSharedFilesAction $getSharedFilesAction,
    ) {
    }

    public function __invoke(FormRequest $request)
    {
        $shared_data = $this->getSharedFilesAction->__invoke();

        return $shared_data;
    }
}
