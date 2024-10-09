<?php

use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminHosterController;
use App\Http\Controllers\AdminSetting;
use App\Http\Controllers\AdminRegionController;
use App\Http\Controllers\TrainstationController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard',function(){
        return response()->json(['message' => '200 OK']);
    })->name('dashboard');
    
    Route::get('overview',[AdminSetting::class,'admin_overview']);
    //setting
    Route::resource('adminSetting', AdminSetting::class,['name'=>'adminSetting']);

    Route::post('admin/setting/fac/update',[AdminSetting::class,'update_fac'])->name('setting.update.fac'); // new facility
    Route::post('admin/setting/station/update',[AdminSetting::class,'update_station'])->name('setting.update.station'); // new namestation
    Route::get('admin/setting/station/mainstation/{id}',[TrainstationController::class,'mainstation_update'])->name('setting.update.mainstation');
    Route::get('admin/setting/station/doors/update/{exdor_id}/{station_id}',[TrainstationController::class,'edit_door'])->name('setting.edit.door');
    Route::post('admin/setting/station/doors/update/trans/{exdor_id}/{station_id}',[TrainstationController::class,'update_door'])->name('setting.update.door');
    Route::get('admin/setting/station/doors/create/trans/{station_id}',[TrainstationController::class,'create_door'])->name('setting.create.door');
    Route::post('admin/setting/station/doors/store/trans/{newexdorId}/{station_id}',[TrainstationController::class,'store_door'])->name('setting.store.door');
    Route::get('admin/setting/station/doors/delete/trans/{exdor_id}/{station_id}',[TrainstationController::class,'delete_door'])->name('setting.destroy.door');
    Route::post('login/user',[LoginController::class,'findUserByEmail'])->name('login.user');
    Route::get('usermanagement',[AdminSetting::class,'user_management'])->name('management.user');
    Route::get('trainmanagement',[AdminSetting::class,'train_management'])->name('management_train');
    Route::get('active_user/{id}',[AdminSetting::class,'active_user'])->name('active.user');
    Route::get('block_user/{id}',[AdminSetting::class,'block_user'])->name('block.user');
    Route::post('admin/setting/station/store',[TrainstationController::class,'store_station'])->name('setting.store.station');
    Route::delete('admin/setting/station/delete/{station_id}',[TrainstationController::class,'destroy_station'])->name('setting.destroy.station');
    Route::get('admin/setting/fac/destroy/{fac_id}',[AdminSetting::class,'destroy_fac'])->name('setting.destroy.facility');

    Route::resource('adminStation',TrainstationController::class,['name'=>'adminStation']);
});



