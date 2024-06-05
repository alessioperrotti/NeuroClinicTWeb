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


Route::get('/faq', function () {
    return view('faq');
})
->name('faq');


// Sezione clinico

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

Route::post('/home_clin/cambia_pwd', [PasswordController::class, 'update_pwd'])
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


//INIZIO VISTA FARMACI_ATTIVITA
Route::get('/home_admin/farmaci_attivita', [AdminController::class, "viewFarmaciAttivita"])
    ->name('gestioneFarmaciAttivita');
//rotte per gestione farmaci
Route::post('/home_admin/farmaci_attivita/farmaco', [AdminController::class, 'storeFarmaco'])
    ->name('gestioneFarmaci.store');

Route::post('/home_admin/farmaci_attivita/farmaco/delete', [AdminController::class, 'deleteFarmaco'])
    ->name('gestioneFarmaci.delete');

Route::post('/home_admin/farmaci_attivita/farmaco/update', [AdminController::class, 'updateFarmaco'])
    ->name('gestioneFarmaci.update');
//rotte per gestione attivita
Route::post('/home_admin/farmaci_attivita/attivita', [AdminController::class, 'storeAttivita'])
    ->name('gestioneAttivita.store');

Route::post('/home_admin/farmaci_attivita/attivita/delete', [AdminController::class, 'deleteAttivita'])
    ->name('gestioneAttivita.delete');

Route::post('/home_admin/farmaci_attivita/attivita/update', [AdminController::class, 'updateAttivita'])
    ->name('gestioneAttivita.update');
//FINE VISTA FARMACI_ATTIVITA

//INIZIO VISTA DISTURBI
Route::get('/home_admin/disturbi', [AdminController::class, 'viewDisturbi'])
    ->name('gestioneDisturbi');

//rotte per gestione disturbi

Route::post('/home_admin/disturbi', [AdminController::class, 'storeDisturbo'])
    ->name('gestioneDisturbi.store');

Route::post('/home_admin/disturbi/delete', [AdminController::class, 'deleteDisturbo'])
    ->name('gestioneDisturbi.delete');

Route::post('/home_admin/disturbi/update', [AdminController::class, 'updateDisturbo'])
    ->name('gestioneDisturbi.update');

//FINE VISTA DISTURBI

// Sezione Paziente

Route::get('/home_paz/cambia_pwd', [PazController::class, 'showPassChange'])
->middleware('auth')->name('cambiaPwdPaziente');

Route::get('/home_paz/aggiorna_dati/{username}' , [PazController::class, 'edit'])
->name('aggiornaDatiPaziente');

Route::post('/home_paz/aggiorna_dati/{username}' , [PazController::class, 'update'])
->name('paziente.update');

Route::get('/home_paz/cartella/{userPaz}' , [PazController::class, 'showCartClinica']) 
->name('cartellaClinicaPaziente')->middleware('can:isPaziente');

Route::post('/cambia_pwd', [PasswordController::class, 'update_pwd'])
->middleware('auth')->name('password.update');

Route::get('/home_paz', [PazController::class, 'index'])
->name('homePaziente')->middleware('can:isPaziente');

Route::get('/home_paz/nuovo_ep' , [PazController::class, 'showNuovoEpisodio'])
->name('inserimentoNuovoEvento');

Route::post('/home_paz/nuovo_ep' , [PazController::class, 'storeEpisodio'])
->name('inserimentoNuovoEvento.store');

Route::post('/home_paz/nuovo_ep/{id}', [PazController::class, 'eliminaDisturbo'])
->name('episodio.elimina')->middleware('can:isPaziente');


require __DIR__.'/auth.php';