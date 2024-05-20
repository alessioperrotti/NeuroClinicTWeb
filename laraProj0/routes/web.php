<?php

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
    return view('home');
})
->name('home');

Route::get('/login', function () {
    return view('login');
})
->name('login');

Route::get('/faq', function () {
    return view('faq');
})
->name('faq');

Route::get('/home_admin/clinici/nuovo_clin', function () {
    return view('new_clinico');
})
->name('Nuovo clinico');


Route::get('/home_admin/disturbi', function () {
    return view('gestione_disturbi');
})
->name('Gestione disturbi');


Route::get('/home_admin/clinici', function () {
    return view('gestione_clinici');
})
->name('Gestione clinici');


Route::get('/home_admin/farmaci_attivita', function () {
    return view('gestione_farmaci_attivita');
})
->name('Gestione farmaci e attività');


Route::get('/home_admin/aggiorna_faq', function () {
    return view('gestione_faq');
})
->name('Gestione Faq');

