<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\WelcomeController;
use App\Models\Lesson;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

Route::get('/',[WelcomeController::class,'index']);
Route::get('courses',[CourseController::class,'index'])->name('courses.index');
Route::get('courses/{course}',[CourseController::class,'show'])->name('courses.show');



