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

Route::get('/lang/{locale}', ['as' => 'site.lang', 'uses' => 'LangController@postIndex']);
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', ['as' => 'site.home', 'uses' => 'HomeController@getIndex']);
    Route::get('/about', ['as' => 'site.about', 'uses' => 'HomeController@getAbout']);
    Route::get('/category/{id}', ['as' => 'site.category', 'uses' => 'AboutController@getIndex']);
    Route::get('/camps', ['as' => 'site.camps', 'uses' => 'ServicesController@getService']);
    Route::get('/contact', ['as' => 'site.contact', 'uses' => 'HomeController@getContact']);
    Route::post('/send', ['as' => 'site.message', 'uses' => 'HomeController@message']);
    Route::get('/cruises', ['as' => 'site.cruises', 'uses' => 'ProjectsController@getIndex']);
    Route::get('/destinations', ['as' => 'site.destinations', 'uses' => 'ProjectsController@getProject']);
    Route::get('/destination/{id}', ['as' => 'site.destination', 'uses' => 'ProjectsController@getProject']);
    Route::get('/hotels', ['as' => 'site.hotels', 'uses' => 'ServicesController@getService']);
    Route::get('/hotel/{id}', ['as' => 'site.hotel', 'uses' => 'AboutController@getIndex']);
    Route::get('/recommendations', ['as' => 'site.recommendations', 'uses' => 'ContactController@getIndex']);
    Route::get('/team', ['as' => 'site.team', 'uses' => 'ContactController@getIndex']);
    Route::get('/trips', ['as' => 'site.trips', 'uses' => 'TripsController@getIndex']);
    Route::get('/trip/{id}', ['as' => 'site.trip', 'uses' => 'TripsController@getTrip']);
    Route::get('/subscribe', ['as' => 'site.subscribe', 'uses' => 'HomeController@getSubscribe']);
    Route::post('/subscribe', ['as' => 'site.subscribe.post', 'uses' => 'HomeController@subscribe']);
    
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::post('/login', 'AuthController@postLogin')->name('admin.login');
        Route::get('/logout', 'AuthController@getLogout')->name('admin.logout');
    });

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/home', ['as' => 'admin.home', 'uses' => 'HomeController@getIndex']);
        Route::get('/about', ['as' => 'admin.about', 'uses' => 'AboutController@getAbout']);
        Route::post('/about', ['as' => 'admin.about.post', 'uses' => 'AboutController@updateAbout']);
        Route::get('/contacts', ['as' => 'admin.contacts', 'uses' => 'ContactsController@getContacts']);
        Route::post('/contacts', ['as' => 'admin.contacts.update', 'uses' => 'ContactsController@updateContacts']);
        Route::get('/data', ['as' => 'admin.data', 'uses' => 'DataController@getData']);
        Route::post('/data', ['as' => 'admin.data.update', 'uses' => 'DataController@updateData']);
        Route::get('/slider', ['as' => 'admin.slider', 'uses' => 'SliderController@get']);
        Route::post('/slider', ['as' => 'admin.slider.update', 'uses' => 'SliderController@update']);

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', ['as' => 'admin.categories', 'uses' => 'CategoriesController@getIndex']);
            Route::get('/add', ['as' => 'admin.category.add', 'uses' => 'CategoriesController@getAdd']);
            Route::post('/add', ['as' => 'admin.category.add', 'uses' => 'CategoriesController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'CategoriesController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'CategoriesController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.category.delete', 'uses' => 'CategoriesController@delete']);
        });
        Route::group(['prefix' => 'destinations'], function () {
            Route::get('/', ['as' => 'admin.destinations', 'uses' => 'DestinationController@getIndex']);
            Route::get('/add', ['as' => 'admin.destination.add', 'uses' => 'DestinationController@getAdd']);
            Route::post('/add', ['as' => 'admin.destination.add', 'uses' => 'DestinationController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.destination.edit', 'uses' => 'DestinationController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.destination.edit', 'uses' => 'DestinationController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.destination.delete', 'uses' => 'DestinationController@delete']);
        });
        Route::group(['prefix' => 'cruises'], function () {
            Route::get('/', ['as' => 'admin.cruises', 'uses' => 'CruisesController@getIndex']);
            Route::get('/add', ['as' => 'admin.cruise.add', 'uses' => 'CruisesController@getAdd']);
            Route::post('/add', ['as' => 'admin.cruise.add', 'uses' => 'CruisesController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.cruise.edit', 'uses' => 'CruisesController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.cruise.edit', 'uses' => 'CruisesController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.cruise.delete', 'uses' => 'CruisesController@delete']);
        });
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', ['as' => 'admin.cities', 'uses' => 'CitiesController@getIndex']);
            Route::post('/add', ['as' => 'admin.city.add', 'uses' => 'CitiesController@insert']);
            Route::post('/edit', ['as' => 'admin.city.edit', 'uses' => 'CitiesController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.city.delete', 'uses' => 'CitiesController@delete']);
        });
        
        Route::group(['prefix' => 'facts'], function () {
            Route::get('/', ['as' => 'admin.facts', 'uses' => 'FactsController@getIndex']);
            Route::post('/add', ['as' => 'admin.fact.add', 'uses' => 'FactsController@insert']);
            Route::post('/edit', ['as' => 'admin.fact.edit', 'uses' => 'FactsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.fact.delete', 'uses' => 'FactsController@delete']);
        });

        Route::group(['prefix' => 'trips'], function () {
            Route::get('/', ['as' => 'admin.trips', 'uses' => 'TripsController@getIndex']);
            Route::get('/add', ['as' => 'admin.trip.add', 'uses' => 'TripsController@getAdd']);
            Route::post('/add', ['as' => 'admin.trip.add', 'uses' => 'TripsController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.trip.edit', 'uses' => 'TripsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.trip.edit', 'uses' => 'TripsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.trip.delete', 'uses' => 'TripsController@delete']);
        });

        Route::group(['prefix' => 'hotels'], function () {
            Route::get('/', ['as' => 'admin.hotels', 'uses' => 'HotelsController@getIndex']);
            Route::get('/add', ['as' => 'admin.hotel.add', 'uses' => 'HotelsController@getAdd']);
            Route::post('/add', ['as' => 'admin.hotel.add', 'uses' => 'HotelsController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.hotel.edit', 'uses' => 'HotelsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.hotel.edit', 'uses' => 'HotelsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.hotel.delete', 'uses' => 'HotelsController@delete']);
            Route::get('/gallery', ['as' => 'admin.hotel.gallery', 'uses' => 'HotelsController@getGallery']);
            Route::post('/gallery', ['as' => 'admin.hotel.images', 'uses' => 'HotelsController@getPostImages']);
            Route::post('/addImages', ['as' => 'admin.hotel.addImages', 'uses' => 'HotelsController@addImages']);
            Route::get('/deleteImg/{id}', ['as' => 'admin.hotel.deleteImg', 'uses' => 'HotelsController@deleteImage']);
        });

        Route::group(['prefix' => 'programmes'], function () {
            Route::get('/', ['as' => 'admin.programmes', 'uses' => 'ProgrammesController@getIndex']);
            Route::get('/add', ['as' => 'admin.program.add', 'uses' => 'ProgrammesController@getAdd']);
            Route::post('/add', ['as' => 'admin.program.add', 'uses' => 'ProgrammesController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.program.edit', 'uses' => 'ProgrammesController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.program.edit', 'uses' => 'ProgrammesController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.program.delete', 'uses' => 'ProgrammesController@delete']);
            Route::get('/gallery', ['as' => 'admin.program.gallery', 'uses' => 'ProgrammesController@getGallery']);
            Route::post('/gallery', ['as' => 'admin.program.images', 'uses' => 'ProgrammesController@getPostImages']);
            Route::post('/addImages', ['as' => 'admin.program.addImages', 'uses' => 'ProgrammesController@addImages']);
            Route::get('/deleteImg/{id}', ['as' => 'admin.program.deleteImg', 'uses' => 'ProgrammesController@deleteImage']);
        });

        Route::group(['prefix' => 'accomidations'], function () {
            Route::get('/', ['as' => 'admin.accomidations', 'uses' => 'AccomidationsController@getIndex']);
            Route::post('/add', ['as' => 'admin.accomidation.add', 'uses' => 'AccomidationsController@insert']);
            Route::post('/edit', ['as' => 'admin.accomidation.edit', 'uses' => 'AccomidationsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.accomidation.delete', 'uses' => 'AccomidationsController@delete']);
        });

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', ['as' => 'admin.posts', 'uses' => 'PostsController@getIndex']);
            Route::get('/add', ['as' => 'admin.post.add', 'uses' => 'PostsController@getAdd']);
            Route::post('/add', ['as' => 'admin.post.add', 'uses' => 'PostsController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.post.delete', 'uses' => 'PostsController@delete']);
        });

        Route::group(['prefix' => 'recommendations'], function () {
            Route::get('/', ['as' => 'admin.recommendations', 'uses' => 'RecommendationsController@getIndex']);
            Route::get('/add', ['as' => 'admin.recommendation.add', 'uses' => 'RecommendationsController@getAdd']);
            Route::post('/add', ['as' => 'admin.recommendation.add', 'uses' => 'RecommendationsController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'admin.recommendation.edit', 'uses' => 'RecommendationsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.recommendation.edit', 'uses' => 'RecommendationsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.recommendation.delete', 'uses' => 'RecommendationsController@delete']);
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', ['as' => 'admin.orders', 'uses' => 'OrdersController@getIndex']);
            Route::get('/delete/{id}', ['as' => 'admin.order.delete', 'uses' => 'OrdersController@delete']);
        });

        Route::group(['prefix' => 'camps'], function () {
            Route::get('/', ['as' => 'admin.camps', 'uses' => 'CampsController@getIndex']);
            Route::get('/add', ['as' => 'admin.camp.add', 'uses' => 'CampsController@getAdd']);
            Route::post('/add', ['as' => 'admin.camp.add', 'uses' => 'CampsController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'admin.camp.edit', 'uses' => 'CampsController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.camp.edit', 'uses' => 'CampsController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.camp.delete', 'uses' => 'CampsController@delete']);
        });

        Route::group(['prefix' => 'teams'], function () {
            Route::get('/', ['as' => 'admin.teams', 'uses' => 'TeamController@getIndex']);
            Route::get('/add', ['as' => 'admin.team.add', 'uses' => 'TeamController@getAdd']);
            Route::post('/add', ['as' => 'admin.team.add', 'uses' => 'TeamController@insert']);
            Route::get('/edit/{id}', ['as' => 'admin.team.edit', 'uses' => 'TeamController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'admin.team.edit', 'uses' => 'TeamController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.team.delete', 'uses' => 'TeamController@delete']);
        });

        Route::group(['prefix' => 'prices'], function () {
            Route::get('/', ['as' => 'admin.prices', 'uses' => 'PricesController@getIndex']);
            Route::post('/add', ['as' => 'admin.price.add', 'uses' => 'PricesController@insert']);
            Route::post('/edit', ['as' => 'admin.price.edit', 'uses' => 'PricesController@postEdit']);
            Route::get('/delete/{id}', ['as' => 'admin.price.delete', 'uses' => 'PricesController@delete']);

            Route::get('/calendar', ['as' => 'admin.prices.calendar', 'uses' => 'PricesController@getC']);
        });

        Route::group(['prefix' => 'subscribers'], function () {
            Route::get('/index', ['as' => 'admin.subscribers', 'uses' => 'SubscribersController@getIndex']);
            Route::get('/send/{id}', ['as' => 'admin.subscriber.send', 'uses' => 'SubscribersController@getEmail']);
            Route::post('/sendMail', ['as' => 'sendMail', 'uses' => 'SubscribersController@sendEmail']);
            Route::get('/sendAll', ['as' => 'admin.subscriber.sendAll', 'uses' => 'SubscribersController@getAll']);
            Route::post('/sendAll', ['as' => 'admin.subscriber.sendAll', 'uses' => 'SubscribersController@sendAll']);
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', ['as' => 'admin.users', 'uses' => 'UsersController@getIndex']);
            Route::get('/add', ['as' => 'admin.user.add', 'uses' => 'UsersController@getAdd']);
            Route::post('/add', ['as' => 'admin.user.add', 'uses' => 'UsersController@insertUser']);
            Route::get('/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UsersController@getUser']);
            Route::post('/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UsersController@updateUser']);
            Route::get('/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'UsersController@deleteU']);
        });
        Route::get('/message', ['as' => 'admin.message', 'uses' => 'MessageController@getIndex']);
        Route::get('/reservation', ['as' => 'admin.reservation', 'uses' => 'ReservationController@getIndex']);
        Route::post('/upload', ['as' => 'admin.upload.post', 'uses' => 'UploadController@getPost']);
        Route::post('/uploads', 'DataController@dropzoneStore')->name('admin.dropzoneStore');
        Route::post('/upload/images', ['as' => 'admin.upload.images', 'uses' => 'ProgrammesController@getPostImages']);
    });
});