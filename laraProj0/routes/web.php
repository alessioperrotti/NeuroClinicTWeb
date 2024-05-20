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

Route::get('/home_paz',function () {
    return view('homePaziente');
})
->name('homePaziente');

Route::get('/home_paz/cambia_pwd', function () {
    return view('cambiaPwdPaziente');
})
->name('cambiaPwdPaziente');

Route::get('/home_paz/nuovo_ep', function() {
    return view('inserimentoNuovoEvento');
})
->name('inserimentoNuovoEvento');

Route::get('/home_paz/aggiorna_dati', function() {
    return view('aggiornaDatiPaziente');
})
->name('aggiornaDatiPaziente');