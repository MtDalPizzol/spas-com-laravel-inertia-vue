<?php

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

Route::get('/cursos', function () {
  return Inertia::render('CourseIndex', [
    'title' => 'Cursos'
  ]);
})->name('course.index');

Route::post('/cursos', function () {
  request()->validate([
    'title' => ['required', 'string', 'min:3', 'max:255'],
    'description' => ['required', 'string', 'min:3'],
    'cover' => ['nullable', 'file', 'image', 'max:2048']
  ]);

  dd('Validação passou');
})->name('course.store');

Route::get('/cursos/criar', function () {
  return Inertia::render('CourseForm', [
    'title' => 'Novo curso'
  ]);
})->name('course.create');

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard', [
    'title' => 'Dashboard'
  ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/account', function () {
  return Inertia::render('Account', [
    'title' => 'My Account'
  ]);
})->middleware(['auth', 'verified'])->name('account.index');

Route::post('/notify', function () {
  return back()->toast('This notification comes from the server side =)');
});
