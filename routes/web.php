<?php

use Illuminate\Support\Facades\Route;
use  App\Livewire\FirstForm;
use App\Livewire\RepairOrderDetailForm;
use App\Livewire\RepairOrderList;

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
});
require __DIR__.'/auth.php';
