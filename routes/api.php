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
    AdminController::class, 'quanLyUser'
])->middleware('authorization:3');
//trang user ứng viên của admin
Route::get('/admin/quan-ly-user/ung-vien/{id}', [
    AdminController::class, 'quanLyUngVien'
])->middleware('authorization:3');
//trang user nhà tuyển dụng của admin
Route::get('/admin/quan-ly-user/nha-tuyen-dung/{id}', [
    AdminController::class, 'quanLyNhaTuyenDung'
])->middleware('authorization:3');
//trang xóa user ứng viên
Route::post('/admin/quan-ly-user/xoa-ung-vien/{id}', [
    AdminController::class, 'xoaUngVien'
])->middleware('authorization:3');
//trang xóa user của admin
Route::post('/admin/quan-ly-user/xoa-nha-tuyen-dung/{id}', [
    AdminController::class, 'xoaNhaTuyenDung'
])->middleware('authorization:3');

//trang danh sách khu vực
Route::get('/admin/quan-ly-khu-vuc/', [
    AdminController::class, 'quanLyKhuVuc'
])->middleware('authorization:3');
//trang thêm khu vực
Route::post('/admin/quan-ly-khu-vuc/them', [
    AdminController::class, 'themKhuVuc'
])->middleware('authorization:3');
//trang sửa khu vực
Route::get('/admin/quan-ly-khu-vuc/cap-nhap/{id_kv}', [
    AdminController::class, 'chiTietKhuVuc'
])->middleware('authorization:3');
Route::post('/admin/quan-ly-khu-vuc/cap-nhap/{id_kv}', [
    AdminController::class, 'suaKhuVuc'
])->middleware('authorization:3');
//xóa khu vực
Route::get('/admin/quan-ly-khu-vuc/xoa/{id_kv}', [
    AdminController::class, 'xoaKhuVuc'
])->middleware('authorization:3');

//trang danh sách ngành nghề----
Route::get('/admin/quan-ly-nganh-nghe/', [
    AdminController::class, 'quanLyNganhNghe'
])->middleware('authorization:3');
//trang thêm   ngành nghề
Route::post('/admin/quan-ly-nganh-nghe/them', [
    AdminController::class, 'themNganhNghe'
])->middleware('authorization:3');
//trang sửa ngành nghề
Route::get('/admin/quan-ly-nganh-nghe/cap-nhap/{id_nn}', [
    AdminController::class, 'chiTietNganhNghe'
])->middleware('authorization:3');
Route::post('/admin/quan-ly-nganh-nghe/cap-nhap/{id_nn}', [
    AdminController::class, 'suaNganhNghe'
])->middleware('authorization:3');
//xóa ngành nghề
Route::get('/admin/quan-ly-nganh-nghe/xoa/{id_nn}', [
    AdminController::class, 'xoaNganhNghe'
])->middleware('authorization:3');
