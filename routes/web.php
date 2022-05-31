<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Models\Course;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('cursos/{course}/secoes/criar', [SectionController::class, 'create'])->name('course.section.create');
Route::get('cursos/{course}/secoes/{section}', [SectionController::class, 'edit'])->name('course.section.edit');
Route::put('cursos/{course}/secoes/{section}', [SectionController::class, 'update'])->name('course.section.update');
Route::delete('cursos/{course}/secoes/{section}', [SectionController::class, 'destroy'])->name('course.section.destroy');
Route::post('cursos/{course}/secoes', [SectionController::class, 'store'])->name('course.section.store');
Route::get('cursos/{course}/secoes', [SectionController::class, 'index'])->name('course.section.index');

Route::resource('cursos', CourseController::class)->names('course')->parameters(['cursos' => 'course']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'title' => 'Dashboard'
    ]);
})->name('dashboard');

Route::get('/account', function () {
    return Inertia::render('Account', [
        'title' => 'My Account'
    ]);
})->name('account.index');

Route::post('/notify', function () {
    return back()->toast('This notification comes from the server side =)');
});
