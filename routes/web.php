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



//Route::get('/{name?}', 'HomeController@index');


//use App\Models\Album;

Route::group(['middleware' => 'auth',
              'prefix' => 'dashboard'], function(){

    Route::get('/albums', 'AlbumController@index')->name("albums");
    Route::get('/albums/{album}/delete', 'AlbumController@delete')->name("albums.delete");

    Route::get('/albums/{id}/edit', 'AlbumController@edit')->name("albums.edit");
    Route::PATCH('/albums/{id}', 'AlbumController@store')->name("albums.store");

    Route::get('/albums/create', 'AlbumController@create')->name("create_album");

    Route::get('/usersnoalbums', function(){
        /* */
        $usersnoalbums = DB::table('users as u')
            ->leftJoin('albums as a', 'u.id', 'a.user_id')
            ->select('u.id', 'email', 'name', 'album_name')
            ->whereNull('album_name')
            ->get();
        dd($usersnoalbums);
    }  );
    Route::post('/albums', 'AlbumController@save')->name("album_save");

    Route::get('/albums/{album}/images', 'AlbumController@getImages')->name("albums_images");

//images
    Route::resource('photos', 'PhotosController');
    Route::get('/', 'AlbumController@index')->name("albums");
    Route::resource('categories', 'AlbumCategoryController');
} );



//gallery
Route::group([
                 'prefix' => 'gallery'], function(){

    Route::get('albums/category/{category}', 'GalleryController@showAlbumByCategory')->name('gallery.album.category');
    Route::get('/albums', 'GalleryController@index')->name("gallery");
    Route::get('/', 'GalleryController@index')->name("gallery");
	 Route::get('album/{album}/images', 'GalleryController@showAlbumImages')->name("gallery.images");

                 });



				 
		Auth::routes();
		//Route::get('logout', 'AuthController@getLogout')->name('logout');






Route::get('/home', 'HomeController@index')->name('home');

