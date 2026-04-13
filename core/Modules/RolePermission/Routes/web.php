<?php

use Modules\RolePermission\Http\Controllers\RolePermissionController;


Route::group(['as'=>'admin.','prefix'=>'admin','middleware' => ['auth:admin','setlang']],function(){
    Route::controller(RolePermissionController::class)->group(function () {
        Route::match(['get','post'],'role/all', 'all_role')->name('role.create')->permission('role-list');
        Route::post('role/edit', 'edit_role')->name('role.edit')->permission('role-edit');
        Route::get('role/assign/permission/{id}', 'permission')->name('role.permission')->permission('permission-assign');
        Route::post('role/permission/create/{id}', 'create_permission')->name('role.permission.create')->permission('permission-assign');
        Route::post('role/delete/{id}', 'delete_role')->name('role.delete')->permission('role-delete');
    });
});
