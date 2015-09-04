<?php

/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/3/14
 * Time: 12:24 PM
 *
 * Applications/AMPPS/www/kemenpan-ihcms
 */
//test CLI
//Route::get('tes', 'Meniqa\\Competency\\Controllers\\TestController@index');
Route::group(array('before' => 'auth', 'prefix' => 'competency'), function() {
    //profile
    Route::controller('profile', 'Meniqa\\Competency\\Controllers\\ProfileController');

    //Dictionary by unit
    Route::get('dictionary/unit/', 'Meniqa\\Competency\\Controllers\\DictionaryController@listUnit');
    Route::get('dictionary/unit/download/{idUnit}', 'Meniqa\\Competency\\Controllers\\DictionaryController@downloadUnit');

    //Profile
    Route::get('profile/user', 'Meniqa\\Competency\\Controllers\\UserProfileController@index');
    Route::post('profile/user', 'Meniqa\\Competency\\Controllers\\UserProfileController@getProfile');

    //test inv
    Route::controller('test/inv', 'Meniqa\\Competency\\Controllers\\TestInvController');

    //test prs
    Route::controller('test/prs', 'Meniqa\\Competency\\Controllers\\TestPrsController');

    Route::get('dictionary/detail/{idDictionary}', 'Meniqa\\Competency\\Controllers\\DictionaryController@detail');

    //progress CLI
    Route::controller('progress', 'Meniqa\\Competency\\Controllers\\ProgressController');

    //result
    Route::controller('result', 'Meniqa\\Competency\\Controllers\\ResultController');
});


Route::group(array('before' => 'isAdmin', 'prefix' => 'admin/competency'), function() {


    //tipe kompetensi
    Route::controller('type', 'Meniqa\\Competency\\Controllers\\AdminTypeController');

    //kamus kompetensi
    Route::controller('dictionary', 'Meniqa\\Competency\\Controllers\\AdminDictionaryController');

    //level kompetensi
    Route::controller('level', 'Meniqa\\Competency\\Controllers\\AdminLevelController');

    //profile kompetensi
    Route::controller('schedule', 'Meniqa\\Competency\\Controllers\\AdminScheduleController');

    //jadwal kompetensi
    Route::controller('profile', 'Meniqa\\Competency\\Controllers\\AdminProfileController');

    //rekap dan hasil kompetensi
    Route::controller('recap', 'Meniqa\\Competency\\Controllers\\AdminRecapController');

    //kolega dan bawahan kompetensi
    Route::controller('peers', 'Meniqa\\Competency\\Controllers\\AdminPeersController');

    //profil kompetensi
    //Route::controller('profile', 'Meniqa\\Competency\\Controllers\\AdminProfileController')
    //    Route::get('profile/import', 'Meniqa\\Competency\\Controllers\\ProfileController@import');
//    Route::post('profile/doImport', 'Meniqa\\Competency\\Controllers\\ProfileController@doImport');
});

Route::group(array('before' => 'isAdmin', 'prefix' => 'api/competency'), function() {
    Route::get('peers/detail/{id}', 'Meniqa\\Competency\\Controllers\\AdminPeersController@apiDetail');
});


Route::group(array('before' => 'isAdmin', 'prefix' => 'admin/diklat'), function() {
    //perencanaan diklat
    Route::get('perencanaan', 'Meniqa\\Competency\\Controllers\\AdminPerencanaanController@index');
    Route::post('perencanaan', 'Meniqa\\Competency\\Controllers\\AdminPerencanaanController@index');
    //diklat
    Route::get('diklat/rencana/{id}', 'Meniqa\\Competency\\Controllers\\DiklatController@perencanaan');
    Route::get('diklat/kompetensi/{id}/{idi}', 'Meniqa\\Competency\\Controllers\\DiklatController@kompetensi');
    Route::get('diklat/diklat/{id}', 'Meniqa\\Competency\\Controllers\\DiklatController@diklat');
    Route::get('diklat/datepicker', 'Meniqa\\Competency\\Controllers\\DatepickerController@coba');
    Route::get('diklat/tambah', 'Meniqa\\Competency\\Controllers\\DiklatController@tambah');
    Route::post('diklat/proses', 'Meniqa\\Competency\\Controllers\\DiklatController@proses');
    Route::get('diklat/hapus/{id}', 'Meniqa\\Competency\\Controllers\\DiklatController@hapus');
    Route::get('diklat/preview/{id}', 'Meniqa\\Competency\\Controllers\\DiklatController@preview');
    
    //pemantauan diklat
    Route::get('pemantaoan', 'Meniqa\\Competency\\Controllers\\AdminPemantaoandiklatController@index');
    Route::get('pemantaoan/setujui/{id}', 'Meniqa\\Competency\\Controllers\\AdminPemantaoandiklatController@setujui');
    Route::post('pemantaoan/setujui/proses', 'Meniqa\\Competency\\Controllers\\AdminPemantaoandiklatController@proses');
   
});
