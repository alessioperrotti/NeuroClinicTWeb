<?php

use App\Http\Controllers\PazController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PublicController;



// Sezione pubblica

Route::get('/', [PublicController::class, 'index'])
->name('home');

Route::get('/faq', [PublicController::class, 'showFaq'])
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

Route::get('/home_clin/messaggi', [ClinController::class, 'showMessaggi'])
->name('messaggiClinico')->middleware('can:isClinico');

Route::post('/home_clin/messaggi', [ClinController::class, 'sendMessaggio'])
->name('messaggioClinico.send')->middleware('can:isClinico');

Route::post('/home_clin/messaggi_del/{msgId}', [ClinController::class, 'deleteMessaggio'])
->name('messaggioClinico.delete')->middleware('can:isClinico');

Route::post('/home_clin/cambia_pwd', [PasswordController::class, 'update_pwd'])
->name('password.update')->middleware('auth');




// Sezione amministratore

Route::get('/home_admin/analisi_dati',[AdminController::class, 'viewAnalisiDati'])
->name('analisiDati')->middleware('can:isAdmin');

Route::get('/episodi-disturbo/{id}', [AdminController::class, 'getEpisodiDisturbo'])
->name('episodi.disturbo')->middleware('can:isAdmin');

Route::get('/home_admin/clinici', [AdminController::class, 'viewGestioneClinici'])
->name('gestioneClinici')->middleware('can:isAdmin');

Route::post('/clinico/{userClin}', [AdminController::class, 'eliminaClinico'])
->name('clinico.elimina')->middleware('can:isAdmin');

Route::get('home_admin/clinici/nuove_associazioni/{userClin}', [AdminController::class, 'viewNuoveAssociazioni'])
->name('nuoveAssociazioni')->middleware('can:isAdmin');

Route::get('/home_admin/clinici/nuovo_clin', [AdminController::class, 'viewNuovoClinico'])
->name('nuovoClinico')->middleware('can:isAdmin');

Route::post('/nuovoClinico', [AdminController::class, 'storeClinico'])
->name('nuovoClinico.store')->middleware('can:isAdmin');

Route::get('/home_admin/clinici/aggiornaClinico/{userClin}', [AdminController::class, 'viewAggiornaClinico'])
->name('aggiornaClinicoAdmin')->middleware('can:isAdmin');

Route::post('/home_admin/clinici/aggiornaClinico/{userClin}', [AdminController::class, 'updateClinico'])
->name('aggiornaClinicoAdmin.edit')->middleware('can:isAdmin');
                    
Route::get('/home_admin/aggiorna_faq', [AdminController::class, 'viewGestioneFaq'])
->name('gestioneFaq')->middleware('can:isAdmin');

Route::post('/faq/{id}', [AdminController::class, 'eliminaFaq'])
->name('faq.elimina')->middleware('can:isAdmin');
                    
Route::post('/faq/update/{id}', [AdminController::class, 'updateFaq'])
->name('faq.update')->middleware('can:isAdmin');

Route::post('/home_admin/aggiorna_faq', [AdminController::class, 'storeFaq'])
->name('faq.store')->middleware('can:isAdmin');

Route::get('/home_admin/lista_paz', [AdminController::class, 'mostraPazienti'])
->name('listaPaz')->middleware('can:isAdmin'); 
                
Route::post('/home_admin/elimina_paziente/{id}', [AdminController::class, 'eliminaPaziente'])
->name('eliminaPaziente')->middleware('can:isAdmin');

Route::get('/home_admin', [AdminController::class, 'index'])
->name('homeAdmin')->middleware('can:isAdmin');

Route::get('/home_admin/farmaci_attivita', [AdminController::class, "viewFarmaciAttivita"])
->name('gestioneFarmaciAttivita')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/farmaco', [AdminController::class, 'storeFarmaco'])
->name('gestioneFarmaci.store')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/farmaco/delete/{farmId}', [AdminController::class, 'deleteFarmaco'])
->name('gestioneFarmaci.delete')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/farmaco/update', [AdminController::class, 'updateFarmaco'])
->name('gestioneFarmaci.update')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/attivita', [AdminController::class, 'storeAttivita'])
->name('gestioneAttivita.store')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/attivita/delete/{attId}', [AdminController::class, 'deleteAttivita'])
->name('gestioneAttivita.delete')->middleware('can:isAdmin');

Route::post('/home_admin/farmaci_attivita/attivita/update', [AdminController::class, 'updateAttivita'])
->name('gestioneAttivita.update')->middleware('can:isAdmin');

Route::get('/home_admin/disturbi', [AdminController::class, 'viewDisturbi'])
->name('gestioneDisturbi')->middleware('can:isAdmin');

Route::post('/home_admin/disturbi', [AdminController::class, 'storeDisturbo'])
->name('gestioneDisturbi.store')->middleware('can:isAdmin');

Route::post('/home_admin/disturbi/delete', [AdminController::class, 'deleteDisturbo'])
->name('gestioneDisturbi.delete')->middleware('can:isAdmin');

Route::post('/home_admin/disturbi/update', [AdminController::class, 'updateDisturbo'])
->name('gestioneDisturbi.update')->middleware('can:isAdmin');



// Sezione Paziente

Route::get('/home_paz', [PazController::class, 'index'])
->name('homePaziente')->middleware('can:isPaziente');

Route::get('/home_paz/cambia_pwd', [PazController::class, 'showPassChange'])
->name('cambiaPwdPaziente')->middleware('auth');

Route::get('/home_paz/aggiorna_dati/{username}' , [PazController::class, 'edit'])
->name('aggiornaDatiPaziente')->middleware('can:isPaziente');

Route::post('/home_paz/aggiorna_dati/{username}' , [PazController::class, 'update'])
->name('paziente.update')->middleware('can:isPaziente');

Route::get('/home_paz/cartella' , [PazController::class, 'showCartClinica']) 
->name('cartellaClinicaPaziente')->middleware('can:isPaziente');

Route::post('/cambia_pwd', [PasswordController::class, 'update_pwd'])
->name('password.update')->middleware('auth');

Route::get('/home_paz/nuovo_ep' , [PazController::class, 'showNuovoEpisodio'])
->name('inserimentoNuovoEvento')->middleware('can:isPaziente');

Route::post('/home_paz/nuovo_ep' , [PazController::class, 'storeEpisodio'])
->name('inserimentoNuovoEvento.store');

Route::post('/home_paz/nuovo_ep/{id}', [PazController::class, 'eliminaDisturbo'])
->name('episodio.elimina')->middleware('can:isPaziente');

Route::get('/home_paz/messaggi', [PazController::class, 'showMessaggi'])
->name('messaggiPaziente')->middleware('can:isPaziente');

Route::post('/home_paz/messaggi', [PazController::class, 'sendMessaggio'])
->name('messaggioPaziente.send')->middleware('can:isPaziente');

Route::get('/home_paz/cartella/ter_passate' , [PazController::class, 'showTerPassate']) 
->name('terapiePassate')->middleware('can:isPaziente');

Route::post('/home_paz/messaggi_del/{msgId}', [PazController::class, 'deleteMessaggio'])
->name('messaggioPaziente.delete')->middleware('can:isPaziente');





require __DIR__.'/auth.php';