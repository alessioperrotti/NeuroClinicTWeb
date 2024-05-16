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

Route::get('/home_admin', function () {
    return view('home_admin');
})
->name('home_admin');


Route::get('/home_admin/lista_paz', function () {
    return view('lista_paz');
})
->name('lista_paz');


Route::get('/home_admin/analisi_dati', function () {
    return view('analisi_dati');
})
->name('analisi_dati');



