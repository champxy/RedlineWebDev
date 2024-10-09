<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customer')->middleware(['auth','is.user'])->name('customer.')->group(function(){
    Route::get('/',function(){
        return response()->json(['message' => '200 OK'])->name('index');
    });
});


