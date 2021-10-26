<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongTyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NhaTuyenDungController;
use App\Http\Controllers\ViecLamController;
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

// -- Frontend -- //
//trang việc làm
Route::get('/viec-lam',[
	'as'=>'vieclam',
	'uses'=>'QuanlytimvieclamController@vieclam'
]);

//trang chi tiết việc làm
Route::get('/viec-lam/chi-tiet/{id}',[
	'as'=>'chitietvieclam',
	'uses'=>'QuanlytimvieclamController@chitietvieclam'
]);
// trang các công ty
Route::get('/cong-ty', [CongTyController::class, 'index']);
// trang chi tiết công ty
Route::get('/cong-ty/{id}', [CongTyController::class, 'show']);
//trang việc làm công ty
Route::get('/cong-ty/viec-lam/{id}', [CongTyController::class, 'viecLamCongTy']);
//trang việc làm ngành nghề
Route::get('/viec-lam/viec-lam-nganh-nghe/{id}',[
	ViecLamController::class, 'viecLamNganhNghe'
]);

//ứng tuyển việc làm

Route::post('/viec-lam/chi-tiet-viec-lam/ung-tuyen',[
		ViecLamController::class, 'ungTuyenViecLam'
]);// Ứng tuyển bị lỗi biến $id_user

//lưu việc làm

Route::post('/viec-lam/chi-tiet-viec-lam/luu',[
	ViecLamController::class, 'luuViecLam'
]);//Lưu việc làm bị lỗi biến $id_user



// -- PHẦN ỨNG VIÊN --  //
//cập nhập hồ sơ ứng viên// chưa có controller
Route::post('/ho-so-cua-toi/cap-nhap-ho-so',[
	'middleware'=>'uvcheckout',
	'as'=>'capnhaphosoungvien',
	'uses'=>'QuanlytimvieclamController@capnhaphosoungvien'
]);
//trang việc làm đã ứng tuyển
Route::get('/ho-so-cua-toi/viec-lam-da-ung-tuyen',[
	'middleware'=>'uvcheckout',
	'as'=>'vieclamdaungtuyen',
	'uses'=>'QuanlytimvieclamController@vieclamdaungtuyen'
]);
//trang việc làm đã lưu
Route::get('/ho-so-cua-toi/viec-lam-da-luu',[
	'middleware'=>'uvcheckout',
	'as'=>'vieclamdaluu',
	'uses'=>'QuanlytimvieclamController@vieclamdaluu'
]);
//xóa việc đã ứng tuyển
Route::post('/ho-so-cua-toi/viec-lam-da-ung-tuyen/xoa/{id}',[
	'middleware'=>'uvcheckout',
	'as'=>'XoaViecUngTuyen',
	'uses'=>'QuanlytimvieclamController@XoaViecUngTuyen'
]);
//xóa việc đã lưu
Route::post('/ho-so-cua-toi/viec-lam-da-luu/xoa/{id}',[
	'middleware'=>'uvcheckout',
	'as'=>'XoaViecLuu',
	'uses'=>'QuanlytimvieclamController@XoaViecLuu'
]);



// -- PHẦN NHÀ TUYỂN DỤNG -- //


//cập nhập hồ sơ nhà tuyển dụng
Route::post('/nha-tuyen-dung/cap-nhap-ho-so',[
	NhaTuyenDungController::class, 'capNhatHoSoNhaTuyenDung'
])->middleware('authorization:2');
//đăng bài mới của nhà tuyển dụng
Route::post('/nha-tuyen-dung/dang-bai-moi',[
	NhaTuyenDungController::class, 'dangBaiTuyenDung'
])->middleware('authorization:2');
//trang việc làm đã đăng của nhà tuyển dụng
Route::get('/nha-tuyen-dung/viec-lam-da-dang',[
	NhaTuyenDungController::class, 'viecLamDaDangNhaTuyenDung'
])->middleware('authorization:2');
//trang xem chi tiết việc làm đã đăng của nhà tuyển dụng
Route::get('/nha-tuyen-dung/viec-lam-da-dang/chi-tiet/{id_vl}',[
	NhaTuyenDungController::class, 'xemChiTietViecLamDaDang'
])->middleware('authorization:2');
//trang sửa việc làm đã đăng của nhà tuyển dụng 
Route::post('/nha-tuyen-dung/viec-lam-da-dang/cap-nhap/{id_vl}',[
	NhaTuyenDungController::class, 'suaViecLamNhaTuyenDung'
])->middleware('authorization:2');
//trang xóa việc làm đã đăng của nhà tuyển dụng
Route::post('/nha-tuyen-dung/viec-lam-da-dang/xoa/{id_vl}',[
	NhaTuyenDungController::class, 'xoaViecLamNhaTuyenDung'
])->middleware('authorization:2');
//thêm hình ảnh
Route::post('/nha-tuyen-dung/them-hinh/{id}',[
	NhaTuyenDungController::class, 'themHinhViecLamPage'
])->middleware('authorization:2');
//trang hồ sơ ứng viên
Route::get('/nha-tuyen-dung/ho-so-ung-vien',[
	NhaTuyenDungController::class, 'hoSoUngVienNhaTuyenDung'
])->middleware('authorization:2');
//duyệt hồ sơ ứng viên
Route::get('/nha-tuyen-dung/ho-so-ung-vien/duyet/{id}',[
	NhaTuyenDungController::class, 'duyetHoSoUngVien'
])->middleware('authorization:2');
//chi tiết hồ chơ ứng viên
Route::get('/nha-tuyen-dung/ho-so-ung-vien/chi-tiet/{id}',[
	NhaTuyenDungController::class, 'chiTietHoSoUngVien'
])->middleware('authorization:2');

// -- PHẦN ADMIN -- //
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
