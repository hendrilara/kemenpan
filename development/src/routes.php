<?php
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 10/20/14
 * Time: 10:23 PM
 */

Route::group(array('before' => 'auth', 'prefix' => 'development'), function()
{
    //identifikasi
    Route::controller('identification', 'Meniqa\\Development\\Controllers\\UserIdentificationController');
    Route::controller('evaluation', 'Meniqa\\Development\\Controllers\\UserEvaluationController');
    Route::controller('diklat', 'Meniqa\\Development\\Controllers\\DiklatController');
    Route::get('realisasi', 'Meniqa\\Development\\Controllers\\UserRealisasidiklatController@getIndex');
    Route::get('coba', 'Meniqa\\Development\\Controllers\\CobaController@index');
});