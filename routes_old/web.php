<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\Home;
use App\Http\Controllers\Robot;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Openrpa;


// end circle
// master
    use App\Http\Controllers\Master\Client;
    use App\Http\Controllers\Master\User;
// end master

// report
    use App\Http\Controllers\Report\Summary;
    use App\Http\Controllers\Report\Log;
// end report

use Illuminate\Support\Facades\Route;

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

Route::get('/generate', function(){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
 });

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
    
    Route::redirect('/', '/dashboard');
    Route::get('/robot-api/{robot}', [Robot::class, 'api'])->name('robot.api');
    Route::get('/robot-api-log', [Robot::class, 'logDetail'])->name('robot.log-detail');
    Route::get('/robot-api-message', [Robot::class, 'message'])->name('robot.message');
    
    // Route::get('/', '/dashboard');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/open-rpa', Openrpa::class)->name('openrpa');

        Route::get('/sample', SampleController::class)->name('sample');
        Route::get('/sample/{user}', [SampleController::class, 'edit'])->name('sample.edit');
        Route::post('/sample/update/{user}', [SampleController::class, 'update'])->name('sample.update');

        Route::get('/robot', Robot::class)->name('robot');
        Route::get('/robot/add', [Robot::class, 'add'])->name('robot.add');
        Route::post('/robot/save', [Robot::class, 'save'])->name('robot.save');
        Route::get('/robotPlay/{robot}', [Robot::class, 'play'])->name('robot.play');
        Route::get('/robotRun/{robot}', [Robot::class, 'run'])->name('robot.run');
        Route::get('/robotRunCek/{robot}', [Robot::class, 'cek'])->name('robot.run-check');
        Route::get('/robot-log/{robot}', [Robot::class, 'log'])->name('robot.log');
        Route::get('/robot/{robot}', [Robot::class, 'edit'])->name('robot.edit');
        Route::post('/robot/update/{robot}', [Robot::class, 'update'])->name('robot.update');
        Route::get('/robot/delete/{robot}', [Robot::class, 'delete'])->name('robot.delete');


        Route::group(['prefix' => '/master'], function () {
            // Group for Program routes
            Route::group(['prefix' => '/client'], function () {
                Route::get('/', Client::class)->name('master.client');
                Route::get('/add', [Client::class, 'add'])->name('master.client.add');
                Route::post('/save', [Client::class, 'save'])->name('master.client.save');
                Route::get('/{client}', [Client::class, 'edit'])->name('master.client.edit');
                Route::post('/update/{client}', [Client::class, 'update'])->name('master.client.update');
                Route::get('/delete/{client}', [Client::class, 'delete'])->name('master.client.delete');
            });

            Route::get('/user-access/{user}', [User::class, 'access'])->name('master.user.access');

            Route::group(['prefix' => '/user'], function () {
                Route::get('/', User::class)->name('master.user');
                Route::get('/add', [User::class, 'add'])->name('master.user.add');
                Route::post('/save', [User::class, 'save'])->name('master.user.save');
                Route::get('/{user}', [User::class, 'edit'])->name('master.user.edit');
                Route::post('/update/{user}', [User::class, 'update'])->name('master.user.update');
                Route::post('/updateStatus', [User::class, 'updateStatus'])->name('master.user.update-status');
                Route::get('/delete/{user}', [User::class, 'delete'])->name('master.user.delete');
            });
        });

        Route::group(['prefix' => '/report'], function () {
            Route::get('/summary', Summary::class)->name('report.summary');
            Route::get('/log-detail', Log::class)->name('report.log');
        });



        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
