<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Models\planning;
use Illuminate\Support\Facades\Route;
use Vonage\Application\Webhook;
use App\Events\appNotifSend;

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
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('welcome/showPlans/{sp}', [App\Http\Controllers\welcomeController::class,'showPlans'])->name('welcome.showPlans');
Route::get('welcome/showPlansTimes/{date}', [App\Http\Controllers\welcomeController::class,'showPlansTimes'])->name('welcome.showPlansTimes');
Route::put('welcome/AppointmentSave', [App\Http\Controllers\welcomeController::class,'AppointmentSave']);
Route::get('welcome/send', [App\Http\Controllers\HomeController::class,'sendMsg']);
Route::get('welcome/webhook', [App\Http\Controllers\HomeController::class,'webhook']);
Route::get('welcome/sendSms', [App\Http\Controllers\NotificationController::class,'sendSms']);
Route::get('welcome/receiveSms', [App\Http\Controllers\NotificationController::class,'receiveSms']);




Auth::routes();

Route::get('dashboard/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('patientPDF/{id}', [App\Http\Controllers\HomeController::class, 'patientPDF'])->name('patientPDF');
Route::get('patientInfos/{id}', [App\Http\Controllers\HomeController::class, 'patientInfos'])->name('patientInfos');
Route::put('patientDesc/{id}', [App\Http\Controllers\HomeController::class, 'patientDesc'])->name('patientDesc');


Route::get('dashboard/appointment', [App\Http\Controllers\HomeController::class,'appointment'])->name('appointment');
Route::get('/appointment/appsShow/{id}/{date}/{time}', [App\Http\Controllers\HomeController::class,'appsShow'])->name('appointment.appsShow');
Route::put('appointment/AppSave', [App\Http\Controllers\HomeController::class,'AppSave']);
Route::put('appointment/appDelete', [App\Http\Controllers\HomeController::class,'appDelete'])->name('appDelete');



Route::get('dashboard/planning', [App\Http\Controllers\HomeController::class,'planning'])->name('planning');

Route::post('dashboard/add', [App\Http\Controllers\planningController::class,'store'])->name('planning.store');

Route::get('dashboard/edit/{id}', [App\Http\Controllers\planningController::class,'edit'])->name('planning.edit');
Route::put('dashboard/update', [App\Http\Controllers\planningController::class,'update'])->name('planning.update');

Route::delete('dashboard/destroy/{id}', [App\Http\Controllers\planningController::class,'destroy'])->name('planning.destroy');





Route::get('doctors.show', [App\Http\Controllers\DoctorsController::class,'show'])->name('doctors.show');

Route::post('dashboard/addSpeciality', [App\Http\Controllers\specialitiesController::class,'create'])->name('planning.addSpeciality');




Route::get('dashboard/medecin', [App\Http\Controllers\HomeController::class,'medecin'])->name('medecin');
Route::post('dashboard/addDoc', [App\Http\Controllers\DoctorsController::class,'create'])->name('doctors.addDoc');
Route::get('dashboard/editDoc/{id}', [App\Http\Controllers\DoctorsController::class,'edit'])->name('doctors.editDoc');
Route::put('dashboard/updateDoc', [App\Http\Controllers\DoctorsController::class,'update'])->name('doctors.updateDoc');
Route::delete('dashboard/deleteDoc/{id}', [App\Http\Controllers\DoctorsController::class,'destroy'])->name('doctors.deleteDoc');


Route::get('dashboard/facture', [App\Http\Controllers\HomeController::class,'facture'])->name('facture');
Route::post('dashboard/payeFacture', [App\Http\Controllers\paymentFacture::class,'create'])->name('payerFacture');
Route::get('factureInfos/{id}', [App\Http\Controllers\HomeController::class, 'factureInfos'])->name('factureInfos');
Route::get('PdfFac/{id}', [App\Http\Controllers\HomeController::class, 'PdfFac'])->name('PdfFac');




Route::get('dashboard/settings', [App\Http\Controllers\HomeController::class,'settings'])->name('settings');
Route::post('settings/addUser', [App\Http\Controllers\HomeController::class,'addUser'])->name('settings.addUser');



Route::get('dashboard/showNotif', [App\Http\Controllers\NotificationController::class,'showNotif'])->name('showNotif');
Route::get('app/delete/{id}', [App\Http\Controllers\NotificationController::class,'appDelete'])->name('app.delete');
Route::get('notif/delete/{id}', [App\Http\Controllers\NotificationController::class,'notifDelete'])->name('notif.delete');













