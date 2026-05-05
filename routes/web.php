<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\QuestionaireController;
use App\Http\Controllers\EquipmentTypeController;
use App\Http\Controllers\CustodianInfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Conducted_byController;
use Illuminate\Container\Attributes\Auth;

// sub_category routes
Route::get('/sub_category', [SubCategoryController::class, 'index'])->name('sub_category.index'); //initial load of page
Route::post('/sub_category/fetch', [SubCategoryController::class, 'fetch'])->name('sub_category.fetch'); //fetching data for datatable
Route::post('/sub_category/save', [SubCategoryController::class, 'save'])->name('sub_category.save'); //saving new sub_category
Route::post('/sub_category/info', [SubCategoryController::class, 'info'])->name('sub_category.info'); //fetching sub_category info for editing
Route::post('/sub_category/delete', [SubCategoryController::class, 'delete'])->name('sub_category.delete'); //deleting sub_category
// response routes
Route::get('/response', [ResponseController::class, 'index'])->name('response.index'); //initial load of page
Route::post('/response/fetch', [ResponseController::class, 'fetch'])->name('response.fetch'); //fetching data for datatable
Route::post('/response/save', [ResponseController::class, 'save'])->name('response.save'); //saving new response
Route::post('/response/info', [ResponseController::class, 'info'])->name('response.info'); //fetching response info for editing
Route::post('/response/delete', [ResponseController::class, 'delete'])->name('response.delete'); //deleting response
Route::post('/response/fetch_pms', [ResponseController::class, 'fetch_pms'])->name('response.fetch_pms'); //fetching pms for` response
Route::post('/response/fetch_employee', [ResponseController::class, 'fetch_employee'])->name('response.fetch_employee'); //fetching employee data for response
Route::post('/response/download-pdf', [ResponseController::class, 'downloadPdf'])->name('response.downloadPdf');//downloading response as pdf
// questionaire routes
Route::get('/questionaire', [QuestionaireController::class, 'index'])->name('questionaire.index'); //initial load of page
Route::post('/questionaire/fetch', [QuestionaireController::class, 'fetch'])->name('questionaire.fetch'); //fetching data for datatable
Route::post('/questionaire/save', [QuestionaireController::class, 'save'])->name('questionaire.save'); //saving new questionaire
Route::post('/questionaire/info', [QuestionaireController::class, 'info'])->name('questionaire.info'); //fetching questionaire info for editing
Route::post('/questionaire/delete', [QuestionaireController::class, 'delete'])->name('questionaire.delete'); //deleting questionaire
Route::post('/questionaire/fetch_qms', [QuestionaireController::class, 'fetch_qms'])->name('questionaire.fetch_qms'); //fetching qms for` response
// equipment type routes
Route::get('/equipment_type', [EquipmentTypeController::class, 'index'])->name('equipment_type.index'); //initial load of page
Route::post('/equipment_type/fetch', [EquipmentTypeController::class, 'fetch'])->name('equipment_type.fetch'); //fetching data for datatable
Route::post('/equipment_type/save', [EquipmentTypeController::class, 'save'])->name('equipment_type.save'); //saving new equipment type
Route::post('/equipment_type/info', [EquipmentTypeController::class, 'info'])->name('equipment_type.info'); //fetching equipment type info for editing
Route::post('/equipment_type/delete', [EquipmentTypeController::class, 'delete'])->name('equipment_type.delete'); //deleting equipment type
// custodian info routes
Route::get('/custodian-info', [CustodianInfoController::class, 'index'])->name('custodian-info.index'); //initial load of page
Route::post('/custodian-info/fetch', [CustodianInfoController::class, 'fetch'])->name('custodian-info.fetch'); //fetching data for datatable
Route::post('/custodian-info/save', [CustodianInfoController::class, 'save'])->name('custodian-info.save'); //saving new custodian info
Route::post('/custodian-info/info', [CustodianInfoController::class, 'info'])->name('custodian-info.info'); //fetching custodian info for editing
Route::post('/custodian-info/delete', [CustodianInfoController::class, 'delete'])->name('custodian-info.delete'); //de
// category routes
Route::get('/category', [CategoryController::class, 'index'])->name('categories.index'); //initial load of page
Route::post('/category/fetch', [CategoryController::class, 'fetch'])->name('category.fetch'); //fetching data for datatable
Route::post('/category/save', [CategoryController::class, 'save'])->name('category.save'); //saving new category
Route::post('/category/info', [CategoryController::class, 'info'])->name('category.info'); //fetching category info for editing
Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete'); //deleting category
// conducted_by routes
Route::get('/conducted_by', [Conducted_byController::class, 'index'])->name('conducted_by.index');
Route::post('/conducted_by/fetch', [Conducted_byController::class, 'fetch'])->name('conducted_by.fetch');
Route::post('/conducted_by/save', [Conducted_byController::class, 'save'])->name('conducted_by.save');
Route::post('/conducted_by/info', [Conducted_byController::class, 'info'])->name('conducted_by.info');
Route::post('/conducted_by/delete', [Conducted_byController::class, 'delete'])->name('conducted_by.delete');
