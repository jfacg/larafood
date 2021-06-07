<?php

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function(){


    


      /**
    * Routes  Tables
    */
    Route::resource('tables', 'TableController')->middleware('can:tables');
    Route::any('tables/search', 'TableController@search')->name('tables.search');


    /**
    * Routes Permissions Profile
    */
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products.index');
    Route::any('categories/{id}/product/create', 'CategoryProductController@productsAvailable')->name('categories.products.available');
    Route::post('categories/{id}/products', 'CategoryProductController@attachProductsCategory')->name('categories.products.attach');
    Route::get('categories/{id}/product/{idProduct}/detach', 'CategoryProductController@detachProductsCategory')->name('categories.products.detach');
    
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories.index');
    // Route::any('products/{id}/category/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    // Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    // Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoriesProduct')->name('products.categories.detach');

    /**
    * Routes  Products
    */
    Route::resource('products', 'ProductController');
    Route::any('products/search', 'ProductController@search')->name('products.search');

    /**
    * Routes  Categories
    */
    Route::resource('categories', 'CategoryController');
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');

    /**
    * Routes  Users
    */
    Route::resource('users', 'UserController');
    Route::get('users/search', 'UserController@search')->name('users.search');
    

     /**
    * Routes Plan Profile
    */
    Route::get('profiles/{idProfile}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
    Route::any('profiles/{idProfile}/plans/create', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
    Route::post('profiles/{idProfile}/plans', 'ACL\PlanProfileController@attachPlansProfile')->name('profiles.plans.attach');
    Route::get('profiles/{idProfile}/plan/{idPlan}/detach', 'ACL\PlanProfileController@detachPlansProfile')->name('profiles.plans.detach');
    // Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');


    /**
    * Routes Permissions Profile
    */
    Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

     /**
     * Routes permissions
     */

     Route::get('permissions', 'PermissionController@index')->name('permissions.index');
     Route::get('permissions/create', 'PermissionController@create')->name('permissions.create');
     Route::post('permissions', 'PermissionController@store')->name('permissions.store');
     Route::get('permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit');
     Route::put('permissions/{id}', 'PermissionController@update')->name('permissions.update');
     Route::get('permissions/{id}', 'PermissionController@show')->name('permissions.show');
     Route::delete('permissions/{id}', 'PermissionController@destroy')->name('permissions.destroy');
     Route::any('permissions/search', 'PermissionController@search')->name('permissions.search');

    /**
     * Routes Profiles
     */

     Route::get('profiles', 'ProfileController@index')->name('profiles.index');
     Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
     Route::post('profiles', 'ProfileController@store')->name('profiles.store');
     Route::get('profiles/{id}/edit', 'ProfileController@edit')->name('profiles.edit');
     Route::put('profiles/{id}', 'ProfileController@update')->name('profiles.update');
     Route::get('profiles/{id}', 'ProfileController@show')->name('profiles.show');
     Route::delete('profiles/{id}', 'ProfileController@destroy')->name('profiles.destroy');
     Route::any('profiles/search', 'ProfileController@search')->name('profiles.search');

    /**
     * Routes Details Plans
     */
     
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plans.index');
    
    /**
     * Routes Plans
     */

    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');

    /**
     * Routes Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');
});



Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

Auth::routes();