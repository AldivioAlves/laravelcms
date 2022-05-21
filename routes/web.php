<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Site\HomeController as SiteHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Site\PageController as SitePageController;

Route::get('/',[SiteHomeController::class,'index'])->name('home');


Route::prefix('painel')->group(function (){
    Auth::routes();
    Route::get('/',[HomeController::class,'index'])->name('admin');

    Route::resource('users',UserController::class);

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::put('/profilesave',[ProfileController::class,'save'])->name('profile.save');

    Route::get('settings',[SettingsController::class,'index'])->name('settings');
    Route::put('settingssave',[SettingsController::class,'save'])->name('settings.save');


    Route::post('/logout',function (){
        Auth::logout();
        return redirect()->route('home');
    });

    Route::resource('pages',PageController::class);
});

Route::fallback([SitePageController::class,'index']);

