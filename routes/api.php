<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongTyController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('json')->middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware("auth")->get('/cong-ty', [CongTyController::class, 'index']);
Route::middleware("auth")->get('/cong-ty', [CongTyController::class, 'index']);
Route::get('/cong-ty/{id}', [CongTyController::class, 'show']);
Route::get('/cong-ty/viec-lam/{id}', [CongTyController::class, 'viecLamCongTy']);
// Route::resource('cong-ty', CongTyController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// -- PHẦN NHÀ TUYỂN DỤNG -- //

//--PHẦN ADMIN--//
//duyệt bài việc làm
Route::get('/admin/quan-ly-viec-lam/duyet/{id}', [
    AdminController::class, 'duyetViecLamNhaTuyenDung'
])->middleware('authorization:3');

//trang việc làm admin
Route::get('/admin/quan-ly-viec-lam', [
    AdminController::class, 'quanLyViecLamAdmin'
])->middleware('authorization:3');

//trang xem chi tiết việc làm của admin
Route::get('/admin/quan-ly-viec-lam/chi-tiet/{id_vl}', [
    AdminController::class, 'xemViecLamAdmin'
])->middleware('authorization:3');
//trang user của admin
Route::get('/admin/quan-ly-user', [
    'middleware' => 'authorization',
    'as' => 'quanLyUser',
    'uses' => 'AdminController@quanLyUser'
]);
//trang user ứng viên của admin
Route::get('/admin/quan-ly-user/ung-vien/{id}', [
    'middleware' => 'authorization',
    'as' => 'quanLyUngVien',
    'uses' => 'AdminController@quanLyUngVien'
]);
//trang user nhà tuyển dụng của admin
Route::get('/admin/quan-ly-user/nha-tuyen-dung/{id}', [
    'middleware' => 'authorization',
    'as' => 'quanLyNhaTuyenDung',
    'uses' => 'AdminController@quanLyNhaTuyenDung'
]);
//trang xóa user ứng viên
Route::post('/admin/quan-ly-user/xoa-ung-vien/{id}', [
    'middleware' => 'authorization',
    'as' => 'xoaUngVien',
    'uses' => 'AdminController@xoaUngVien'
]);
//trang xóa user của admin
Route::post('/admin/quan-ly-user/xoa-nha-tuyen-dung/{id}', [
    'middleware' => 'authorization',
    'as' => 'xoaNhaTuyenDung',
    'uses' => 'AdminController@xoaNhaTuyenDung'
]);

//trang danh sách khu vực
Route::get('/admin/quan-ly-khu-vuc/', [
    'middleware' => 'authorization',
    'as' => 'quanLyKhuVuc',
    'uses' => 'AdminController@quanLyKhuVuc'
]);
//trang thêm khu vực
Route::post('/admin/quan-ly-khu-vuc/them', [
    'middleware' => 'authorization',
    'as' => 'themKhuVuc',
    'uses' => 'AdminController@themKhuVuc'
]);
//trang sửa khu vực
Route::get('/admin/quan-ly-khu-vuc/cap-nhap/{id_kv}', [
    'middleware' => 'authorization',
    'as' => 'chiTietKhuVuc',
    'uses' => 'AdminController@chiTietKhuVuc'
]);
Route::post('/admin/quan-ly-khu-vuc/cap-nhap/{id_kv}', [
    'middleware' => 'authorization',
    'as' => 'suaKhuVuc',
    'uses' => 'AdminController@suaKhuVuc'
]);
//xóa khu vực
Route::get('/admin/quan-ly-khu-vuc/xoa/{id_kv}', [
    'middleware' => 'authorization',
    'as' => 'xoaKhuVuc',
    'uses' => 'AdminController@xoaKhuVuc'
]);

//trang danh sách ngành nghề
Route::get('/admin/quan-ly-nganh-nghe/', [
    'middleware' => 'authorization',
    'as' => 'quanLyNganhNghe',
    'uses' => 'AdminController@quanLyNganhNghe'
]);
//trang thêm ngành nghề
Route::post('/admin/quan-ly-nganh-nghe/them', [
    'middleware' => 'authorization',
    'as' => 'themNganhNghe',
    'uses' => 'AdminController@themNganhNghe'
]);
//trang sửa ngành nghề
Route::get('/admin/quan-ly-nganh-nghe/cap-nhap/{id_nn}', [
    'middleware' => 'authorization',
    'as' => 'chiTietNganhNghe',
    'uses' => 'AdminController@chiTietNganhNghe'
]);
Route::post('/admin/quan-ly-nganh-nghe/cap-nhap/{id_nn}', [
    'middleware' => 'authorization',
    'as' => 'suaNganhNghe',
    'uses' => 'AdminController@suaNganhNghe'
]);
//xóa ngành nghề
Route::get('/admin/quan-ly-nganh-nghe/xoa/{id_nn}', [
    'middleware' => 'authorization',
    'as' => 'xoaNganhNghe',
    'uses' => 'AdminController@xoaNganhNghe'
]);
