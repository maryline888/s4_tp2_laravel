<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\EtudiantsController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use PhpParser\Comment\Doc;

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

Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/index', [EtudiantsController::class, 'index'])->name('etudiants.index');
Route::get('/etudiant/{etudiants}', [EtudiantsController::class, 'show'])->name('etudiants.show');

Route::get('/etudiant-ajout', [EtudiantsController::class, 'create'])->name('etudiants.create');
Route::post('/etudiant-ajout', [EtudiantsController::class, 'store']);


Route::get('/etudiant-edit/{etudiants}', [EtudiantsController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiant-edit/{etudiants}', [EtudiantsController::class, 'update']);

Route::delete('/etudiant/{etudiants}', [EtudiantsController::class, 'destroy'])->name('etudiants.destroy');

// blog 
Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show')->middleware('auth');

Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('blog-create', [BlogPostController::class, 'store'])->middleware('auth');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->middleware('auth');
Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy'])->middleware('auth');

Route::get('query', [BlogPostController::class, 'query']);

Route::get('blog-page', [BlogPostController::class, 'pages']);

Route::get('registration', [CustomAuthController::class, 'create'])->name('registration');

Route::post('registration', [CustomAuthController::class, 'store']);

Route::get('user-list', [CustomAuthController::class, 'usersList'])->name('user.list')->middleware('auth')->can('list-user');

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

Route::get('forgot-password', [CustomAuthController::class, 'forgtoPassword'])->name('forgot.password');
Route::post('forgot-password', [CustomAuthController::class, 'tempPassword']);
Route::get('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'newPassword'])->name('new.password');
Route::put('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'storeNewPassword']);

//documents

Route::get('/doc', [DocumentsController::class, 'index'])->name('doc.index');
Route::get('doc-create', [DocumentsController::class, 'create'])->name('doc.create');
Route::post('doc-create', [DocumentsController::class, 'store'])->name('doc.store');
Route::get('doc-edit/{document}', [DocumentsController::class, 'edit'])->name('doc.edit');
Route::put('doc-edit/{document}', [DocumentsController::class, 'update']);
Route::delete('doc/{document}', [DocumentsController::class, 'destroy'])->name('doc.destroy');
