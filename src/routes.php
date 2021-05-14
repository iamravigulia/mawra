<?php
use Illuminate\Support\Facades\Route;



Route::post('fmt/mawra/store', 'EdgeWizz\Mawra\Controllers\MawraController@store')->name('fmt.mawra.store');

Route::post('fmt/mawra/update/{id}', 'EdgeWizz\Mawra\Controllers\MawraController@update')->name('fmt.mawra.update');

Route::post('fmt/mawra/csv_upload', 'EdgeWizz\Mawra\Controllers\MawraController@csv_upload')->name('fmt.mawra.csv_upload');

Route::any('fmt/mawra/inactive/{id}',  'EdgeWizz\Mawra\Controllers\MawraController@inactive')->name('fmt.mawra.inactive');

Route::any('fmt/mawra/active/{id}',  'EdgeWizz\Mawra\Controllers\MawraController@active')->name('fmt.mawra.active');