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

Route::get('/home_clin',function () {
    return view('homeClinico');
})
->name('homeClinico');

Route::get('/home_paz/cambia_pwd', function () {
    return view('cambiaPwdPaziente');
})
->name('cambiaPwdPaziente');

Route::get('/home_clin/nuovo_paz',function () {
    return view('nuovoPaziente');
})
->name('nuovoPaziente');

Route::get('/home_clin/aggiorna_clin',function () {
    return view('aggiornaClinico');
})
->name('aggiornaClinico');

Route::get('/home_clin/lista_paz',function () {
    return view('listaPazienti');
})
->name('listaPazienti');