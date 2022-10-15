<?php

use App\Http\Controllers\SalesTeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SalesTeamController::class, 'index'])->name('sales_team');
Route::get('/add-new-member', [SalesTeamController::class, 'add_new_member'])->name('add-new-member');
Route::post('/submit-member-details', [SalesTeamController::class, 'submit_member_details'])->name('submit-member-details');
Route::post('/update-member-details', [SalesTeamController::class, 'update_member_details'])->name('update-member-details');
Route::get('/view-member/{id}', [SalesTeamController::class, 'view_member'])->name('view-member');
Route::get('/edit-member/{id}', [SalesTeamController::class, 'edit_member'])->name('edit-member');
Route::get('/delete-member/{id}', [SalesTeamController::class, 'delete_member'])->name('delete-member');


