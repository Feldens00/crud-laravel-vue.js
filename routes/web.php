<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MultipictureController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Multipicture;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipicture::all();
    // return view('welcome');
    return view('home',compact('brands','abouts','images'));
});

Route::get('/about', function () {
    return view('about');
});

// Exemplo de middleware (filtros)
// Route::get('/about', function () {
//     return view('about');
// })->middleware('check');

// Category Controller
Route::get('/category/all',[CategoryController::class, 'All_Category'])->name('all.category');
Route::post('/category/add',[CategoryController::class, 'Add_Category'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class, 'Edit_Category']);
Route::post('/category/update/{id}',[CategoryController::class, 'Update_Category']);
Route::get('/category/soft-delete/{id}',[CategoryController::class, 'Soft_Delete_Category']);
Route::get('/category/restore/{id}',[CategoryController::class, 'Restore_Category']);
Route::get('/category/permanent-delete/{id}',[CategoryController::class, 'Permanent_Delete_Category']);

// Brand Controller
Route::get('/brand/all',[BrandController::class, 'All_Brand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class, 'Add_Brand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class, 'Edit_Brand']);
Route::post('/brand/update/{id}',[BrandController::class, 'Update_Brand']);
Route::get('/brand/delete/{id}',[BrandController::class, 'Delete_Brand']);

// Multi Image Controller
Route::get('/multi/image',[MultipictureController::class, 'All_Multi'])->name('all.multi');
Route::post('/multi/add',[MultipictureController::class, 'Add_Multi'])->name('store.multi');

// Exemplo de armazenamento de rota em uma variavel
Route::get('/contact-url-extensa',[ContactController::class, 'index'])->name('contact');

//Rota jetstream
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();
    // $users = DB::table('users')->get();

    return view('admin.index');
})->name('dashboard');

//Rota User
Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');

//Rota Slide
Route::get('/slide/home',[HomeController::class, 'Home_Slide'])->name('home.slider');
Route::get('/slide/add',[HomeController::class, 'Add_Slide'])->name('add.slider');
Route::post('/slide/store',[HomeController::class, 'Store_Slide'])->name('store.slider');


//Rota Home About
Route::get('/about/home',[AboutController::class, 'Home_About'])->name('home.about');
Route::get('/about/add',[AboutController::class, 'Add_About'])->name('add.about');
Route::post('/about/store',[AboutController::class, 'Store_About'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class, 'Edit_About']);
Route::post('/about/update/{id}',[AboutController::class, 'Update_About']);
Route::get('/about/delete/{id}',[AboutController::class, 'Delete_About']);

// Rota do Portfolio page
Route::get('/portfolio',[AboutController::class, 'Portfolio'])->name('portfolio');

// Rota do Admin Contact Page
Route::get('/admin/contact',[ContactController::class, 'Admin_Contact'])->name('admin.contact');
Route::get('/admin/contact/add',[ContactController::class, 'Admin_Add_Contact'])->name('add.contact');
Route::post('/admin/contact/store',[ContactController::class, 'Admin_Store_Contact'])->name('store.contact');
Route::get('/admin/message',[ContactController::class, 'Admin_Message'])->name('admin.message');
//Roda da Home Contact Page
Route::get('/contact',[ContactController::class, 'Contact'])->name('contact');

//Roda da Home Contact Form
Route::post('/contact/form',[ContactController::class, 'Contact_Form'])->name('contact.form');

// Rota User profile 
Route::get('/user/password',[ProfileController::class, 'Change_Password'])->name('change.password');
Route::post('/user/update/password',[ProfileController::class, 'Update_Password'])->name('update.password');