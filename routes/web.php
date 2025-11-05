<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
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


Route::get('/practice', [PracticeController::class, 'sample']);

Route::get('/practice2', [PracticeController::class, 'sample2']);
    
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/admin/movies', [MovieController::class, 'indexAdmin'])->name('admin.movies.index');

Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('admin.movies.create');

Route::post('/admin/movies/store', [MovieController::class, 'store'])->name('admin.movies.store');

Route::get('/admin/movies/{id}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit');

Route::patch('/admin/movies/{id}/update', [MovieController::class, 'update'])->name('admin.movies.update');

Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'destroy'])->name('admin.movies.destroy');

Route::get('/sheets', [SheetController::class, 'index'])->name('sheets.index');

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/admin/movies/{id}', [MovieController::class, 'showAdmin'])->name('admin.movies.show');

Route::get('/admin/schedules', [ScheduleController::class, 'index'])->name('admin.schedules.index');

Route::get('/admin/schedules/{id}', [ScheduleController::class, 'show'])->name('admin.schedules.show');

Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');

Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'store'])->name('admin.schedules.store');

Route::get('/admin/schedules/{scheduleId}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');

Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'update'])->name('admin.schedules.update');

Route::delete('/admin/schedules/{scheduleId}/destroy', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');
