<?php



use App\Http\Controllers\PazController;
use App\Http\Controllers\AdminController;
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


Route::get('/home_admin', [AdminController::class, 'index'])
->name('homeAdmin'); 

Route::get('/home_admin/disturbi', [AdminController::class, 'viewDisturbi'])
    ->name('gestioneDisturbi');
    

Route::post('/home_admin/disturbi', [AdminController::class, 'storeDisturbo'])
->name('gestioneDisturbi.store');


#Route::get('/home_admin/lista_paz', function () {
#    return view('listaPaz');
#})
#->name('listaPaz');

Route::get('/home_admin/analisi_dati', function () {
    return view('analisiDati');
})
->name('analisiDati');


Route::get('/home_admin/clinici/nuovo_clin', function () {
    return view('nuovoClinico');
})
->name('nuovoClinico');

Route::get('/home_admin/clinici', [AdminController::class, 'viewGestioneClinici'])
    ->name('gestioneClinici');


Route::get('/home_admin/disturbi', [AdminController::class, 'viewDisturbi'])
    ->name('gestioneDisturbi');
    

Route::post('/home_admin/disturbi', [AdminController::class, 'storeDisturbo'])
->name('gestioneDisturbi.store');



Route::get('/home_admin/farmaci_attivita', function () {
    return view('gestioneFarmaciAttivita');
})
->name('gestioneFarmaciAttivita');




Route::get('/home_admin/aggiorna_faq', [AdminController::class, 'viewGestioneFaq'])
    ->name('gestioneFaq');

Route::delete('/faq/{id}', [AdminController::class, 'eliminaFaq'])
    ->name('faq.elimina');
    
Route::put('/faq/{id}', [AdminController::class, 'updateFaq'])
    ->name('faq.update');

Route::post('/home_admin/aggiorna_faq', [AdminController::class, 'storeFaq'])
    ->name('gestioneFaq.store')->middleware('can:isAdmin');
   
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


Route::get('/home_admin/lista_paz', [AdminController::class, 'mostraPazienti'])
    ->name('listaPaz')->middleware('can:isAdmin'); 


Route::delete('/home_admin/elimina_paziente/{id}', [AdminController::class, 'eliminaPaziente'])
    ->name('eliminaPaziente')->middleware('can:isAdmin');

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

require __DIR__.'/auth.php';