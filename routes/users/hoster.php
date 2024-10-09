<?php

use Illuminate\Support\Facades\Route;

Route::prefix('hoster')->middleware(['auth','is.user'])->name('hoster.')->group(function(){
    Route::get('/',function(){
        return response()->json(['message' => '200 OK']);
    });
});

