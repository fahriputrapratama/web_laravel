<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\HomepageController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/',[HomepageController::class,'index'])->name('home');
Route::get('cart',[HomepageController::class,'cart']);
Route::get('about',[HomepageController::class,'about']);
Route::get('contact',[HomepageController::class,'contact']);
Route::get('product',[HomepageController::class,'product']);

Route::group(['prefix'=>'dashboard'], function(){ 
   Route::get('/',[DashboardController::class,'index'])->name('dashboard'); 

   Route::resource('categories',ProductCategoryController::class);
   Route::resource('products',ProductsController::class);
   
})->middleware(['auth', 'verified']); 
// Route::get('product/{slug}',[HomepageController::class,'product']);

// Route::get('about',function (){
//    $title = "about - toko gue";
   
//    return view('web.about',['title'=>$title]);
// });

// Route::get('cart',function (){
//    return view('web.cart');
// });

// Route::get('contact',function (){
//    return view('web.contact');
// });

// Route::get('product',function (){
//    return view('web.products');

// });

// Route::get('product/{slug}',function ($slug){
//    return view('web.single_product');
// });

Route::get('categories', function(){
   return view('web.categories');
  });

Route::get('category/{slug}', function($slug){
   return view('web.single_category');
  });
  


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
