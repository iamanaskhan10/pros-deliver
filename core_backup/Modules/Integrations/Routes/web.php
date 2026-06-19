<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Modules\Integrations\Http\Controllers\IntegrationsController;
use App\Http\Middleware\Tenant\InitializeTenancyByDomainCustomisedMiddleware;

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

/* ------------------------------------------
     LANDLORD ADMIN ROUTES
-------------------------------------------- */
Route::group(['as'=>'admin.','prefix'=>'admin','middleware' => ['auth:admin','setlang']],function(){
    Route::match(['get','post'],"integrations-manage",[IntegrationsController::class,"store"])->name('integration')->permission('integration-view');
    Route::post("integrations-manage/active",[IntegrationsController::class,"activate"])->name('integration.activation')->permission('integration-edit');
});
