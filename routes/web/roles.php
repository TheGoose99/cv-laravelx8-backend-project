<?php

Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');

Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');

Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');

Route::put('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');

Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach_permission'])->name('role.permission.attach');

Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach_permission'])->name('role.permission.detach');

