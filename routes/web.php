<?php

use App\Http\Controllers\ProfileController;
use Domain\Folder\Models\Folder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(
    [
        'prefix' => 'folders',
        'as' => 'folders.',
        'middleware' => ['auth', 'verified'],
    ],
    function () {
        Route::get('/{folder?}', \Domain\Folder\Controllers\GetFolderController::class)->name('show')
            ->can('view', [Folder::class, 'folder']);
        Route::delete('/{folder}', \Domain\Folder\Controllers\DeleteFolderController::class)->name('destroy')
            ->can('delete', 'folder');
    }
);

Route::group(
    [
        'prefix' => 'files',
        'as' => 'files.',
        'middleware' => ['auth', 'verified'],
    ],
    function () {
        Route::get('/{file}', function () {})->name('show');
        Route::delete('/{file}', \Domain\File\Controllers\DeleteFileController::class)->name('destroy')
            ->can('delete', 'file');
        Route::post('/files/upload', \Domain\File\Controllers\UploadFileController::class)->name('upload');
        Route::get('/{file}/download', \Domain\File\Controllers\DownloadFileController::class)->name('download')
            ->can('download', 'file');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
