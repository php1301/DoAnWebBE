<?php

namespace App\Http\Controllers;

use App\Models\KhuVuc;
use App\Models\Luu;
use App\Models\NganhNghe;
use App\Models\UngTuyen;
use App\Models\UngVien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UngVienController extends Controller
{

    //!--Trang tổng quan ứng viên
    public function index()
    {


        $ungvien = UngVien::where('id_user', Auth::user()->id)->get();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $vl_ut = UngTuyen::where('id_user', Auth::user()->id)->get();
        $luu = Luu::where('id_user', Auth::user()->id)->get();

        return compact('ungvien', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'vl_ut', 'luu');
    }
    public function capNhatHoSoUngVien(Request $req)
    { 
        $this->validate(
            $req,
            [
                'name' => 'required|regex:/(^[\pL0-9 ]+$)/u',
                'ngaySinh' => 'required|date|before:today',
                'gioiTinh' => 'required',
                'sdt' => 'required|/(0)[0-9]{9}/|digits:10',

                'diaChi' => 'required|regex:/(^[\pL0-9 ]+$)/u',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'name.regex' => 'Tên không được nhập ký tự đặc biệt.',
                'ngaySinh.required' => 'Vui lòng nhập ngày sinh',
                'ngaySinh.date' => 'Ngày sinh kh được lớn hơn ngày hiện tại',
                'gioiTinh.required' => 'Vui lòng nhập giới tính',
                'sdt.required' => 'Vui lòng nhập số điện thoại',
                'sdt.regex' => 'Định dạng số điện thoại không hợp lệ.',
                'sdt.digits' => 'Số điện thoại phải là :digits số.',
                'diaChi.required' => 'Vui lòng nhập địa chỉ',
                'diaChi.regex' => 'Không được nhập ký tự đặc biệt.'
            ]
        );


        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $user->name = $req->name;
        $user->save();

        $id = $id_user;
        $ungvien = Ungvien::find($id_user);
        $ungvien->gioiTinh = $req->gioiTinh;
        $ungvien->ngaySinh = $req->ngaySinh;
        $ungvien->sdt = $req->sdt;
        $ungvien->diaChi = $req->diaChi;
        $ungvien->kinhNghiem = $req->kinhNghiem;
        $ungvien->luonghientai = $req->luonghientai;
        $ungvien->luongmongmuon = $req->luongmongmuon;
        $ungvien->viTri = $req->viTri;
        $ungvien->loaihinh = $req->loaihinh;
        $ungvien->bangCap = $req->bangCap;
        $ungvien->toanBoKhuVuc = $req->toanBoKhuVuc;
        $ungvien->ghichu = $req->ghichu;
        $ungvien->save();
        return response('Đã cập nhập hồ sơ',200);
    }

    //trang việc làm đã ứng tuyển của ứng viên
    public function viecLamDaUngTUyen()
    {
        $stt = 1;
        $ungvien = Ungvien::where('id_user', Auth::user()->id)->get();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $id_uv = Auth::user()->id;
        $daungtuyen = Ungtuyen::where('id_user', $id_uv)->get();
        return  compact('stt', 'daungtuyen', 'ungvien', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount');
    }

    //trang việc làm đã lưu
    public function viecLamDaLuu()
    {
        $stt = 1;
        $ungvien = Ungvien::where('id_user', Auth::user()->id)->get();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $id_uv = Auth::user()->id;
        $daluu = Luu::where('id_user', $id_uv)->get();
        return compact('stt', 'daluu', 'ungvien', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount');
    }
    // xóa việc đã ứng tuyển
    public function xoaViecDaUngTuyen($id)
    {
        $xoa = Ungtuyen::find($id);
        if($xoa)
        {
               $xoa->delete();
               return response('Đã xóa.',200);
        }
     
        return response('Không thể xóa.',400);
    }
    // xóa việc đã lưu
    public function xoaViecDaLuu($id)
    {
        $xoa = Luu::find($id);
        if($xoa)
        {
               $xoa->delete();
               return response('Đã xóa.',200);
        }
     
        return response('Không thể xóa.',400);
    }
}
