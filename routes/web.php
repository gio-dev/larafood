<?php

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

use \App\Http\Controllers\Admin\PlanController;
use \App\Http\Controllers\Admin\DetailPlanController;
use \App\Http\Controllers\Admin\ProfileController;
use \App\Http\Controllers\Admin\PermissionController;
use \App\Http\Controllers\Admin\ProfilePermissionController;
use \App\Http\Controllers\Admin\ProfilePlanController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\CategoryProductController;
use \App\Http\Controllers\Admin\TableController;
use \App\Http\Controllers\Admin\TenantController;
use \App\Http\Controllers\Admin\RoleController;
use \App\Http\Controllers\Admin\PermissionRoleController;
use \App\Http\Controllers\Admin\RoleUserController;
use \App\Http\Controllers\Site\SiteController;

Route::get('teste',function (){
    $client = \App\Models\Client::first();
    $token = $client->createToken('tokenteste');
    dd($token->plainTextToken,$token);
});

Route::prefix('admin')->namespace('Admin')
    ->middleware('auth')
    ->group(function (){

        /**
         * Roles x User Routes
         */
        Route::any('roles/{id}/users/create', [RoleUserController::class, 'usersAvaliable'])->name('roles.users.avaliable');
        Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users.index');
        Route::post('roles/{id}/users/attach', [RoleUserController::class, 'attachUsersRole'])->name('roles.users.attach');
        Route::get('roles/{id}/users/{idUser}/detach', [RoleUserController::class, 'detachUsersRole'])->name('roles.users.detach');
        Route::get('users/{id}/roles', [RoleUserController::class, 'usersProf'])->name('users.role.index');

        /**
         * Profiles x Permissions Routes
         */
        Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvaliable'])->name('roles.permissions.avaliable');
        Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions.index');
        Route::post('roles/{id}/permissions/attach', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');
        Route::get('roles/{id}/permissions/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionsRole'])->name('roles.permissions.detach');
        Route::get('permissions/{id}/roles', [PermissionRoleController::class, 'profiles'])->name('permissions.roles.index');

        /**
         * Table Routes
         */
        Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');
        Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');


        /**
         * Tenant Routes
         */
        Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');
        Route::resource('tenants', '\App\Http\Controllers\Admin\TenantController');

        /**
         * Table Routes
         */
        Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');
        Route::resource('tables', '\App\Http\Controllers\Admin\TableController');

        /**
         * Product Routes
         */
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', '\App\Http\Controllers\Admin\ProductController');

        /**
         * Category Routes
         */
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::resource('categories', '\App\Http\Controllers\Admin\CategoryController');


        /**
         * Product x Category Routes
         */
        Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvaliable'])->name('products.categories.avaliable');
        Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories.index');
        Route::post('products/{id}/categories/attach', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
        Route::get('products/{id}/categories/{idCategory}/detach', [CategoryProductController::class, 'detachCategoriesProduct'])->name('products.categories.detach');
        Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.product.index');

    /**
     * Profiles Routes
     */
//    Route::any('users/search', [ProfileController::class, 'search'])->name('users.search');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
//    Route::any('users/search', [ProfileController::class, 'search'])->name('users.search');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

    /**
     * Details Plans Routes
     */

    Route::get('plans/{url}/details/{idDetail}/show', [DetailPlanController::class, 'show'])->name('detail.plan.show');
    Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('detail.plan.edit');
    Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('detail.plan.destroy');
    Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
    Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('detail.plan.update');

    /**
     * Plans Routes
     */
//Route::get('admin/plans', '\App\Http\Controllers\Admin\PlanController@index')->name('plans');
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
    /**
     * Dashboard Routes
     */
    Route::get('/', [PlanController::class, 'index'])->name('dashboard.index');

    /**
     * Permissions Routes
     */
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::get('permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');

    /**
     * Profiles Routes
     */
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::post('profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::get('profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::delete('profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
    Route::get('profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

    /**
     * Profiles x Permissions Routes
     */
    Route::any('profiles/{id}/permissions/create', [ProfilePermissionController::class, 'permissionsAvaliable'])->name('profiles.permissions.avaliable');
    Route::get('profiles/{id}/permissions', [ProfilePermissionController::class, 'permissions'])->name('profiles.permissions.index');
    Route::post('profiles/{id}/permissions/attach', [ProfilePermissionController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::get('profiles/{id}/permissions/{idPermission}/detach', [ProfilePermissionController::class, 'detachPermissionsProfile'])->name('profiles.permissions.detach');
//    Route::any('profiles/{id}/permissions/search', [ProfilePermissionController::class, 'searchPermissionsProfile'])->name('profiles.permissions.search');
    Route::get('permissions/{id}/profiles', [ProfilePermissionController::class, 'profiles'])->name('permissions.profile.index');


    /**
     * Plans x Permissions Routes
     */
    Route::any('profiles/{id}/plans/create', [ProfilePlanController::class, 'plansAvaliable'])->name('profiles.plans.avaliable');
    Route::get('profiles/{id}/plans', [ProfilePlanController::class, 'plans'])->name('profiles.plans.index');
    Route::post('profiles/{id}/plans/attach', [ProfilePlanController::class, 'attachPlansProfile'])->name('profiles.plans.attach');
    Route::get('profiles/{id}/plans/{idPLan}/detach', [ProfilePlanController::class, 'detachPlansProfile'])->name('profiles.plans.detach');
    Route::get('plans/{id}/profiles', [ProfilePlanController::class, 'plansProf'])->name('plans.profile.index');

});

Route::namespace('Site')
    ->group(function (){
        Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
        Route::get('/', [SiteController::class, 'index'])->name('site.home');
});


//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

//    Auth::routes([
//        'register' => false
//    ]);

