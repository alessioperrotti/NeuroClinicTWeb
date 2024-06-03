<?php

use App\Http\Controllers\PazController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordController;

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

Route::get('/home_clin/nuovo_paz',function () {
    return view('nuovoPaziente');
})
->name('nuovoPaziente')->middleware('can:isClinico');

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

Route::get('/home_clin',function () {
    return view('homeClinico');
})
->name('homeClinico');

Route::get('/home_clin/aggiorna_clin',function () {
    return view('aggiornaClinico');
})
->name('aggiornaClinico');

Route::get('/home_clin/lista_paz',function () {
    return view('listaPazienti');
})
->name('listaPazienti');

/*
Route::get('/home_clin/lista_paz/cart_clinica/userPaz/{userPaz}',function () {
    return view('cartellaClin2');
})
->name('cartellaClin2'); */

Route::get('/home_clin/lista_paz/cart_clinica',function () {
    return view('cartellaClin2');
})
->name('cartellaClin2'); // rotta per sviluppo

Route::get('/home_clin/lista_paz/cart_clinica/mod_terapia',function () {
    return view('modificaTerapia');
})
->name('modificaTerapia'); // rotta per sviluppo



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

Route::post('/home_clin/aggiorna_clin', [ClinController::class, 'updateClinico'])
->name('aggiornaClinico.edit')->middleware('can:isClinico');

Route::get('/home_clin/cambia_pwd', [ClinController::class, 'showPassChange'])
->name('cambiaPwdClinico')->middleware('auth');

Route::put('/home_clin/cambia_pwd', [PasswordController::class, 'update_pwd'])
->name('password.update')->middleware('auth');


#--------------------------------------------------------------------#
    #ROTTA ANALISI DEI DATI
    Route::get('/home_admin/analisi_dati',[AdminController::class, 'viewAnalisiDati'])
    ->name('analisiDati')->middleware('can:isAdmin');
#ROTTA ANALISI DEI DATI NUMERO EPISODI PER DISTURBO
Route::get('/episodi-disturbo/{id}', [AdminController::class, 'getEpisodiDisturbo'])
    ->name('episodi.disturbo');
    #--------------------------------------------------------------------#
                    #ROTTE X GESTIONE CLINICI
Route::get('/home_admin/clinici', [AdminController::class, 'viewGestioneClinici'])
    ->name('gestioneClinici')->middleware('can:isAdmin');

Route::post('/clinico/{id}', [AdminController::class, 'eliminaClinico'])
    ->name('clinico.elimina')->middleware('can:isAdmin');

Route::get('/home_admin/clinici/nuovo_clin', [AdminController::class, 'viewNuovoClinico'])
    ->name('nuovoClinico')->middleware('can:isAdmin');

Route::post('/nuovoClinico', [AdminController::class, 'storeClinico'])
    ->name('nuovoClinico.store')->middleware('can:isAdmin');

Route::get('/home_admin/clinici/aggiornaClinico/{userClin}', [AdminController::class, 'viewAggiornaClinico'])
    ->name('aggiornaClinicoAdmin')->middleware('can:isAdmin');

Route::post('/home_admin/clinici/aggiornaClinico/{userClin}', [AdminController::class, 'updateClinico'])
    ->name('aggiornaClinicoAdmin.edit')->middleware('can:isAdmin');
#--------------------------------------------------------------------#
                    #ROTTE GESTIONE FAQ
                    
Route::get('/home_admin/aggiorna_faq', [AdminController::class, 'viewGestioneFaq'])
    ->name('gestioneFaq');

Route::post('/faq/{id}', [AdminController::class, 'eliminaFaq'])
    ->name('faq.elimina');
                    
Route::post('/faq/update/{id}', [AdminController::class, 'updateFaq'])
    ->name('faq.update');

Route::post('/home_admin/aggiorna_faq', [AdminController::class, 'storeFaq'])
    ->name('faq.store');

#--------------------------------------------------------------------#
                    #ROTTE GESTIONE PAZIENTI

Route::get('/home_admin/lista_paz', [AdminController::class, 'mostraPazienti'])
    ->name('listaPaz')->middleware('can:isAdmin'); 
                
Route::post('/home_admin/elimina_paziente/{id}', [AdminController::class, 'eliminaPaziente'])
    ->name('eliminaPaziente')->middleware('can:isAdmin');

require __DIR__.'/auth.php';

require __DIR__.'/auth.php';