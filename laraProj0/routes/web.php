<?php

use App\Http\Controllers\PazController;
use App\Http\Controllers\ClinController;
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

/*
Route::get('/login', function () {
    return view('login');
})
->name('login'); */

Route::get('/faq', function () {
    return view('faq');
})
->name('faq');

Route::get('/home_paz', [PazController::class, 'index'])
->name('homePaziente')->middleware('can:isPaziente'); 


Route::get('/home_paz/cambia_pwd', function () {
    return view('cambiaPwdPaziente');
})
->name('cambiaPwdPaziente');

Route::get('/home_paz/nuovo_ep' , function () {
    return view('inserimentoNuovoEvento');
})
->name('inserimentoNuovoEvento');



Route::get('/home_paz/aggiorna_dati' , function () {
    return view('aggiornaDatiPaziente');
})
->name('aggiornaDatiPaziente');

Route::get('/home_paz/cartella' , function () {
    return view('cartellaClinicaPaziente');
})
->name('cartellaClinicaPaziente');

Route::get('/home_admin', function () {
    return view('homeAdmin');
})
->name('homeAdmin')->middleware('can:isAdmin');

Route::get('/home_admin/lista_paz', function () {
    return view('listaPaz');
})
->name('listaPaz');

Route::get('/home_admin/analisi_dati', function () {
    return view('analisiDati');
})
->name('analisiDati');

Route::get('/home_admin/clinici/nuovo_clin', function () {
    return view('nuovoClinico');
})
->name('nuovoClinico');


Route::get('/home_admin/disturbi', function () {
    return view('gestioneDisturbi');
})
->name('gestioneDisturbi');


Route::get('/home_admin/clinici', function () {
    return view('gestioneClinici');
})
->name('gestioneClinici');


Route::get('/home_admin/farmaci_attivita', function () {
    return view('gestioneFarmaciAttivita');
})
->name('gestioneFarmaciAttivita');


Route::get('/home_admin/aggiorna_faq', function () {
    return view('gestioneFaq');
})
->name('gestioneFaq');







// rotte nuove per clinico

Route::get('/home_clin', [ClinController::class, 'index'])
->name('homeClinico')->middleware('can:isClinico');

Route::get('/home_clin/lista_paz', [ClinController::class, 'viewPazienti'])
->name('listaPazienti')->middleware('can:isClinico');

Route::get('/home_clin/lista_paz/cart_clinica/{userPaz}', [ClinController::class, 'showCartClinica'])
->name('cartellaClin2')->middleware('can:isClinico'); 

Route::get('/home_clin/lista_paz/cart_clinica/mod_terapia/{userPaz}', [ClinController::class, 'showModTerapia'])
->name('modificaTerapia')->middleware('can:isClinico');

Route::post('/home_clin/lista_paz/cart_clinica/mod_terapia/{userPaz}', [ClinController::class, 'storeTerapia'])
->name('modificaTerapia.store')->middleware('can:isClinico');

Route::get('/home_clin/nuovo_paz', [ClinController::class, 'addPaziente'])
->name('nuovoPaziente')->middleware('can:isClinico');

Route::post('/home_clin/nuovo_paz', [ClinController::class, 'storePaziente'])
->name('nuovoPaziente.store')->middleware('can:isClinico');

Route::get('home_clin/lista_paz/cart_clinica/mod_diagnosi/{userPaz}', [ClinController::class, 'showModDiagnosi'])
->name('modificaDiagnosi')->middleware('can:isClinico');

Route::post('home_clin/lista_paz/cart_clinica/mod_diagnosi/{userPaz}', [ClinController::class, 'storeDiagnosi'])
->name('modificaDiagnosi.store')->middleware('can:isClinico');

Route::get('/home_clin/aggiorna_clin', [ClinController::class, 'showModClinico'])
->name('aggiornaClinico')->middleware('can:isClinico');

Route::post('/home_clin/aggiorna_clin', [ClinController::class, 'editClinico'])
->name('aggiornaClinico.edit')->middleware('can:isClinico');

require __DIR__.'/auth.php';