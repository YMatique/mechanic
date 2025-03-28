<?php

use Illuminate\Support\Facades\Route;
use  App\Livewire\FirstForm;
use App\Livewire\RepairOrderDetailForm;
use App\Livewire\RepairOrderList;
use App\Livewire\RepairOrderDetailList;
use App\Livewire\RepairOrderInvoiceForm;
use App\Livewire\RepairOrderInvoiceList;
use App\Livewire\RepairOrderSubmissionForm;
use App\Livewire\RepairOrderSubmissionList;
use App\Livewire\RepairOrderActivityForm;
use App\Livewire\RepairOrderActivityList;
Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::group(['prefix'=>'dashboard', 'middleware'=>['auth', 'verified'],], function () {
    Route::get('/primeiro-formulario', FirstForm::class)->name('form1');
    Route::get('/ordens-de-reparacao', RepairOrderList::class)->name('repair-order-list');
    Route::get('/segundo-formulario', RepairOrderDetailForm::class)->name('repair-order.create');
    Route::get('/ordem-de-reparacao-detalhes', RepairOrderDetailList::class)->name('repair-order.details');
    Route::get('/repair-order-invoices', RepairOrderInvoiceForm::class)->name('repair-order-invoices.create');
Route::get('/repair-order-invoices/list', RepairOrderInvoiceList::class)->name('repair-order-invoices.index');
Route::get('/repair-order-submissions', RepairOrderSubmissionForm::class)->name('repair-order-submissions.create');
Route::get('/repair-order-submissions/list', RepairOrderSubmissionList::class)->name('repair-order-submissions.index');
Route::get('/repair-order-activities', RepairOrderActivityForm::class)->name('repair-order-activities.create');
Route::get('/repair-order-activities/list', RepairOrderActivityList::class)->name('repair-order-activities.index');
});
require __DIR__.'/auth.php';
