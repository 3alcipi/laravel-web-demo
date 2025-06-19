<?php

use App\Http\Controllers\Admin\BrandController;
/* use App\Http\Controllers\admin\PriceController as AdminPriceController; */
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('users/list', [UserController::class, 'list'])->name('users.list');
Route::resource('users', UserController::class)->except(['create','show']);
Route::get('roles/list', [RoleController::class, 'list'])->name('roles.list');
Route::get('roles/{role}/permissions', [RoleController::class, 'getPermissions'])->name('roles.permissions');
Route::resource('roles', RoleController::class)->except(['create','show']);
Route::get('brands/list', [BrandController::class, 'list'])->name('brands.list');
Route::resource('brands', BrandController::class)->except(['create','show','edit']);
Route::get('types/list', [TypeController::class, 'list'])->name('types.list');
Route::resource('types', TypeController::class)->except(['create','show','edit']);
Route::get('vehicles/list', [VehicleController::class, 'list'])->name('vehicles.list');
Route::resource('vehicles', VehicleController::class)->except(['create','show','edit']);
Route::get('prices/list', [PriceController::class, 'list'])->name('prices.list');
Route::resource('prices', PriceController::class)->except(['create','show','edit']);
Route::get('prices/list', [PriceController::class, 'list'])->name('prices.list');
Route::resource('prices', PriceController::class)->except(['create','show','edit']);
Route::get('reservations/list', [ReservationController::class, 'list'])->name('reservations.list');
Route::resource('reservations', ReservationController::class)->except(['create','show','edit']);