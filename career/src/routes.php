<?php

Route::group(array('before' => 'isAdmin', 'prefix'=>'career'), function(){

//pengaturan Eselon Jabatan    
Route::get('jabatan', 'Meniqa\\Career\\Controllers\\PengaturanjabatanController@Jabatan');
Route::get('jabatan/tambah', 'Meniqa\\Career\\Controllers\\PengaturanjabatanController@TambahJabatan');
Route::post('proses', 'Meniqa\\Career\\Controllers\\PengaturanjabatanController@Proses');
//Route::get('Proses','PengaturanjabatanController@Proses');
Route::get('jabatan/ubah/{id}','Meniqa\\Career\\Controllers\\PengaturanjabatanController@Ambil');
Route::post('jabatan','Meniqa\\Career\\Controllers\\PengaturanjabatanController@Cari');
Route::post('update', 'Meniqa\\Career\\Controllers\\PengaturanjabatanController@Ubah');
Route::get('jabatan/delete/{id}', 'Meniqa\\Career\\Controllers\\PengaturanjabatanController@Hapus');

//Pengaturan prasyarat
Route::get('prasyarat', 'Meniqa\\Career\\Controllers\\PrasyaratController@Prasyarat');
//menambah daftar prasyarat
Route::get('prasyarat/tambah/{id}', 'Meniqa\\Career\\Controllers\\PrasyaratController@TambahPrasyarat');
//mencari daftar prasyarat
Route::post('prasyarat', 'Meniqa\\Career\\Controllers\\PrasyaratController@Cari');
//tambah prasyarat
Route::post('kirim', 'Meniqa\\Career\\Controllers\\PrasyaratController@Kirim');
//kandidatPromote
Route::get('kandidat/promosi', 'Meniqa\\Career\\Controllers\\KandidatPromosiController@KandidatPromote');
//cari kandidat berdasarkan jabatan
Route::post('kandidat/promosi', 'Meniqa\\Career\\Controllers\\KandidatPromosiController@KandidatPromote');
//hapus prasyarat
Route::get('prasyarat/delete/{id}', 'Meniqa\\Career\\Controllers\\PrasyaratController@ProsesHapus');
//preview Prasyarat
Route::get('prasyarat/preview/{id}', 'Meniqa\\Career\\Controllers\\PrasyaratController@Preview');

//Kandidat Ke jadwal Jadwal
//kirim jadwal Asesment
Route::get('kandidat/tambahkan/kandidat/{id}', 'Meniqa\\Career\\Controllers\\KandidatPromosiController@ProsesJadwal');
//tambahkan Promosi Jabatan
//Route::post('kandidat/tambahkan/kandidat', 'Meniqa\\Career\\Controllers\\KandidatPromosiController@ProsesJadwal');
Route::post('jadwal/asessment', 'Meniqa\\Career\\Controllers\\KandidatPromosiController@TambahJadwal');
//index jadwal asesment
Route::get('jadwal/lihat/asessment','Meniqa\\Career\\Controllers\\JadwalAsessmentController@Index');
//menampilkan dafar karyawan berdasarkan tahun
Route::post('jadwal/lihat/asessment','Meniqa\\Career\\Controllers\\JadwalAsessmentController@Cari');
//hapus jadwal asesment
Route::get('jadwal/proses/hapus/{id}','Meniqa\\Career\\Controllers\\JadwalAsessmentController@HapusJadwal');

//TalentPOOL
//talentpool
Route::get('talentpool', 'Meniqa\\Career\\Controllers\\TalentPoolController@Talent');
//caritalentpool
Route::post('talentpool', 'Meniqa\\Career\\Controllers\\TalentPoolController@Cari');
//jadwal asessment

});