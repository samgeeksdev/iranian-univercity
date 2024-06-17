<?php

use App\Http\Controllers\Auth\ChangePassword;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ClassRoom;
use App\Http\Controllers\Location;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\EducationalGroup;
use App\Http\Controllers\Entry;
use App\Http\Controllers\Lesson;
use App\Http\Controllers\PresenceAndAbsence;
use App\Http\Controllers\Professor;
use App\Http\Controllers\Schedule;
use App\Http\Controllers\Term;
use App\Http\Controllers\TimePeriod;
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
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [Register::class, 'index'])->name('register');
    Route::post('/register', [Register::class, 'register']);
    Route::get('/login', [Login::class, 'index'])->name('login');
    Route::post('/login', [Login::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::resource('/users', \App\Http\Controllers\UserController::class);
        Route::get('/change-password', [ChangePassword::class, 'index'])->name('change-password');
        Route::put('/change-password', [ChangePassword::class, 'changePassword']);
    });

    Route::middleware('educational_supervisor')->group(function () {
        Route::resource('/collage', \App\Http\Controllers\CollageController::class);
        Route::resource('/terms', Term::class)->except('show');
        Route::get('terms/set-term/{term}', [Term::class, 'setTerm'])->name('terms.set-term');
        Route::resource('/time-periods', TimePeriod::class)->except('show');
        Route::resource('/educational-groups', EducationalGroup::class)->except('show');
        Route::resource('/entries', Entry::class)->except('show');
        Route::resource('roles', \App\Http\Controllers\RoleController::class);
        Route::get('current_term', function () {
            echo session('current_term_id');
        });

        Route::middleware('faculty_head')->group(function () {
            Route::resource('/lessons', Lesson::class)->except('show');
            Route::resource('/professors', Professor::class)->except('show');
            Route::resource('/classrooms', ClassRoom::class)->except('show', 'edit', 'update');
            Route::put('/classrooms/update', [ClassRoom::class, 'update'])->name('classrooms.update');
            Route::post('/classrooms/filter', [ClassRoom::class, 'filter'])->name('classrooms.filter');
            Route::resource('/locations', Location::class)->except('show');
            Route::get('/locations/determine', [Location::class, 'determine'])->name('locations.determine');
            Route::post('/locations/determine/set', [Location::class, 'setLocations'])->name('locations.set');
            Route::get('/presence-and-absence/history/preview', [presenceAndAbsence::class, 'preview'])->name('p-a.history.preview');
            Route::get('/presence-and-absence/history/download', [presenceAndAbsence::class, 'download'])->name('p-a.history.download');
            Route::get('/schedule', [Schedule::class, 'index'])->name('schedule.index');
            Route::post('/schedule/filter', [Schedule::class, 'filter'])->name('schedule.filter');
            Route::get('/schedule/preview', [Schedule::class, 'preview'])->name('schedule.preview');
            Route::get('/schedule/download', [Schedule::class, 'download'])->name('schedule.download');
            Route::get('/schedule/download/word', [Schedule::class, 'Prepare_word'])->name('schedule.download.word');
            Route::get('/presence-and-absence', [presenceAndAbsence::class, 'index'])->name('p-a.index');
            Route::post('/presence-and-absence/determine', [presenceAndAbsence::class, 'determine'])->name('p-a.determine');
            Route::get('/presence-and-absence/history', [presenceAndAbsence::class, 'history'])->name('p-a.history');
        });
    });

    Route::middleware('professor')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
        Route::resource('/lessons', Lesson::class)->only('index');
        Route::resource('/professors', Professor::class)->only('index');
    });
});