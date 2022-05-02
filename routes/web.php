<?php

use App\Http\Controllers\CourseController;
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

Route::controller(CourseController::class)
    ->group(function () {
        Route::get('/cursos/{course}/editar', 'edit')->name('course.edit');

        Route::put('/cursos/{course}', 'update')->name('course.update');

        Route::delete('/cursos/{course}', 'destroy')->name('course.destroy');

        Route::get('/cursos/criar', 'create')->name('course.create');

        Route::get('/cursos', 'index')->name('course.index');

        Route::post('/cursos', 'store')->name('course.store');
    });

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
