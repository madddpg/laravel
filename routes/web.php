<?php


use Illuminate\Support\Facades\Route;
use App\Models\Jobs;

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






Route::get('/', function () {
    return view('home');
});



Route::get('/trabaho', function () {
    return view('trabaho', [
        'trabahos' => Jobs::all()
    ]);
});


Route::get('/job/{id}', function ($id) {
 $job = Jobs::hanap_trabaho($id);


    return view('job', [
        'job' => $job
    ]);
});

Route::get('/projects', function () {
    return view('projects');
});
