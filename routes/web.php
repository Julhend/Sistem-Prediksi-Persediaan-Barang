<?php

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/', function () {
            return view('auth.login');
        });
        Auth::routes(['register' => false]);
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/dashboard', 'Dashboard\DashboardController@index')->name(
                'dashboard'
            );
            Route::resource('/moderator', 'Dashboard\ModeratorController')->except([
                'show'
            ]);
            Route::get('/moderator/profile', 'Dashboard\ModeratorController@profile')->name(
                'moderator.profile'
            );
            Route::resource('/category', 'Dashboard\CategoryController')->except([
                'show'
            ]);
            Route::resource('/product', 'Dashboard\ProductController')->except([
                'show'
            ]);
            Route::get('/searchsale', ['uses' => 'Dashboard\ProductController@searchsale', 'as' => 'product.searchsale']);
            Route::get('/searchpurchase', ['uses' => 'Dashboard\ProductController@searchpurchase', 'as' => 'product.searchpurchase']);
            Route::get('/addproduct', ['uses' => 'Dashboard\ProductController@addproduct', 'as' => 'product.addproduct']);
            Route::get('/barcode', 'Dashboard\ProductController@barcode');
            Route::put('/updateprice/{id}', 'Dashboard\ProductController@updateprice');

            Route::put('/paymentdue/{id}', 'Dashboard\SaleController@paymentdue');
            Route::put('/paymentduep/{id}', 'Dashboard\purchaseController@paymentduep');
            Route::resource('/sale', 'Dashboard\SaleController');
            Route::resource('/purchase', 'Dashboard\PurchaseController');
            Route::resource('/client', 'Dashboard\ClientController')->except([
                'show'
            ]);
            Route::get('/client/detail/{id}', 'Dashboard\ClientController@saledetail')->name('client.detail');

            // predict------------------------------
            Route::resource('/prediksi', 'Dashboard\PredictionController')->except([
                'show','create'
            ]);
            Route::get('/product-keluar', 'Dashboard\PredictionController@productKeluar')->name('prediksi.productKeluar');
            Route::get('/product-masuk', 'Dashboard\PredictionController@masuk')->name('prediksi.masuk');


            //  Route::get('/max-purchase', ['uses' => 'Dashboard\PredictionController@maxpurchase', 'as' => 'purchase.maxpurchase']);
            // Route::get('/client/detail/{id}', 'Dashboard\ClientController@saledetail')->name('client.detail');
            //------------------------------------------

            Route::resource('/provider', 'Dashboard\ProviderController')->except([
                'show', 
            ]);
            Route::get('/provider/detail/{id}', 'Dashboard\ProviderController@purchasedetail')->name('provider.detail');

            // generale Settings route
            Route::resource('/generalsetting', 'Dashboard\GeneralSettingController')->except([
                'show', 'update', 'destroy', 'create', 'edit'
            ]);
        });
    }
);
