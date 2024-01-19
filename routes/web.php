<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesiginationController;
use App\Http\Controllers\CurriculmController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ManualpdfController;

Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/login-check',[LoginController::class,'auth'])->name('login.check');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/user-list',[UserController::class,'index'])->name('user.list')->middleware(['login']);
Route::get('/user-data',[UserController::class,'list'])->name('user.data.list')->middleware(['login']);
Route::post('/user-save',[UserController::class,'save'])->name('user.save')->middleware(['login']);
Route::get('/get-access',[UserController::class,'getaccess'])->name('user.access')->middleware(['login']);
Route::get('/getcatname',[UserController::class,'getcatname'])->name('user.getcatname')->middleware(['login']);
Route::post('/changepassword',[UserController::class,'changepassword'])->name('user.changepassword')->middleware(['login']);

//Designation
Route::get('/designation',[DesiginationController::class,'index'])->name('designation')->middleware(['login']);
Route::get('/changestatus',[DesiginationController::class,'changestatus'])->name('changestatus')->middleware(['login']);
Route::post('/save-designation',[DesiginationController::class,'save'])->name('save.designation')->middleware(['login']);
Route::get('/delete',[DesiginationController::class,'delete'])->name('delete')->middleware(['login']);


//carcullum
Route::get('/curriculm-list',[CurriculmController::class,'index'])->name('curriculm.list')->middleware(['login']);
Route::get('/curriculm-data',[CurriculmController::class,'getdata'])->middleware(['login']);
Route::get('/curriculm-create',[CurriculmController::class,'create'])->name('curriculm.create')->middleware(['login']);
Route::get('/curriculm-edit/{id?}',[CurriculmController::class,'edit'])->name('curriculm.edit')->middleware(['login']);

Route::get('/getcourse',[CurriculmController::class,'getcourse'])->middleware(['login']);
Route::post('/create-curriculum',[CurriculmController::class,'course_curriculum'])->name('course.curriculm')->middleware(['login']);
Route::post('/update-curriculum',[CurriculmController::class,'update'])->name('curriculm.update')->middleware(['login']);
Route::get('/pdf-download/{categoryid?}/{courseid?}',[CurriculmController::class,'listpdf'])->name('curriculm.pdf')->middleware(['login']);
Route::get('/pdf-view/{categoryid?}/{courseid?}',[CurriculmController::class,'viewpdf'])->name('curriculm.pdf.view')->middleware(['login']);
Route::get('/curriculum-delete/{categoryid?}/{courseid?}',[CurriculmController::class,'curriculum_delete'])->name('curriculm.delete')->middleware(['login']);

Route::get('/getapi',[CurriculmController::class,'getapi'])->name('getapi.delete')->middleware(['login']);

//header
Route::get('/add-header',[HeaderController::class,'index'])->name('add.header')->middleware(['login']);
Route::post('/save-header',[HeaderController::class,'save'])->name('header.save')->middleware(['login']);

Route::get('/headerimage/{id?}',[HeaderController::class,'headerimage'])->name('header.headerimage')->middleware(['login']);
Route::get('/headerimg_delete/{id?}/{img}',[HeaderController::class,'headerimg_delete'])->name('header.headerimg_delete')->middleware(['login']);
//Footer
Route::get('/add-footer',[FooterController::class,'index'])->name('add.footer')->middleware(['login']);
Route::post('/save-footer',[FooterController::class,'save'])->name('footer.save')->middleware(['login']);

Route::get('/footerimage/{id?}',[FooterController::class,'footerimage'])->name('footer.headerimage')->middleware(['login']);
Route::get('/footerimg_delete/{id?}/{img}',[FooterController::class,'footerimg_delete'])->name('footer.headerimg_delete')->middleware(['login']);

//manual pdf
Route::post('save-manual-pdf',[ManualpdfController::class,'index'])->name('manual.pdf')->middleware(['login']);



Route::post('api/lsqdata',[UserController::class,'lsqdata']);
Route::post('api/savedata',[UserController::class,'savedata']);
Route::get('demo',[UserController::class,'demo']);



//api detail for dummy
Route::get('/getcategory',[CurriculmController::class,'getcategory']);
Route::get('/findCourse/{id?}',[CurriculmController::class,'findCourse']);
Route::get('/findcategory/{id?}',[CurriculmController::class,'findcategory']);
Route::get('/feesupdateapi',[CurriculmController::class,'feesupdateapi']);
Route::get('/getCourseName/{id?}',[CurriculmController::class,'getCourseName']);




