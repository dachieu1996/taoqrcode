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


Route::group(['prefix'=>'admin'],function (){
    Route::get('/',function(){
        return redirect('admin/danhsach');
    });
    Route::get('danhsach','TaoQRCodeController@getDanhSach');
    Route::get('taoma/{MaLo}/{MaSP}','TaoQRCodeController@getTaoMa');
    Route::get('chitiet/{MaLo}/{MaSP}','TaoQRCodeController@getChiTiet');
    Route::get('inma/{MaLo}/{MaSP}/{MaDL}','TaoQRCodeController@getInMa');
    Route::get('inma/stt/{MaLo}/{MaSP}/{MaDL}/{STT}.png','TaoQRCodeController@getInMaSTT');

});

Route::get('reset', function () {
    DB::update("UPDATE stt_losx SET trangthai = NULL ");
    return redirect('admin/danhsach');
});


