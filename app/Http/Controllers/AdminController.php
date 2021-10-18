<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
use App\Models\Date;
use App\Models\KhuVuc;
use App\Models\NganhNghe;
use App\Models\NhaTuyenDung;
use App\Models\UngTuyen;
use App\Models\UngVien;
use App\Models\User;
use App\Models\ViecLam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function admin()
    {
        $tongvieclam = ViecLam::where('trangThai', 1)->get();
        $tongviecchoduyet = ViecLam::where('trangThai', 0)->get();
        $tongtaikhoan = User::all();

        $stt = 1;
        $chiTietViecLam = ViecLam::limit(5)->orderByDesc('id')->get();
        $ListDay = Date::getListdayInMonth();

        $viewData = [
            'chiTietViecLam'           => $chiTietViecLam,
            'tongvieclam'       => $tongvieclam,
            'tongviecchoduyet'  => $tongviecchoduyet,
            'tongtaikhoan'      => $tongtaikhoan,
            'ListDay'           => json_encode($ListDay),
            'stt'               => $stt
        ];


        return response($viewData, 200);
    }

    //quản lý việc làm admin
    public function quanLyViecLamAdmin()
    {
        $nhaTuyenDung = NhaTuyenDung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietViecLam = ViecLam::orderByDesc('id')->paginate(10);
        return compact('nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietViecLam');
    }
    //xem chi tiết việc làm đã đăng admin
    public function xemViecLamAdmin($id)
    {

        $chiTietViecLam = ViecLam::find($id);
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        return view('admin.quanlivieclam.xem', compact('chiTietViecLam', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon'));
    }
    //quản lý user của admin
    public function quanLyUser()
    {
        $user = User::paginate(10);
        return view('admin.quanliuser.index', compact('user'));
    }
    //quản lý user ứng viên
    public function quanLyUngVien($id)
    {
        $ungvien = UngVien::find($id);
        return view('admin.quanliuser.ungvien', compact('ungvien'));
    }
    //quản lý user nhà tuyển dụng
    public function quanLyNhaTuyenDung($id)
    {
        $nhaTuyenDung = Nhatuyendung::find($id);
        return view('admin.quanliuser.nhaTuyenDung', compact('nhaTuyenDung'));
    }
    //xóa user ungvien
    public function xoaUngVien($id)
    {

        $xoa_user = User::find($id);
        $ungTuyen = UngTuyen::find($id);
        $xoa_uv = Ungvien::find($id);
        if ($ungTuyen !=  null) {
            $xoa_uv->delete();
            $xoa_user->delete();
            return redirect()->back()->with('success', 'Đã xóa.');
        } else {
            return redirect()->back()->with('success', 'Không thể xóa tài khoản này.');
        }
    }
    //xóa user nhà tuyen dung
    public function xoaNhaTuyenDung($id)
    {

        $xoa_ntd = Nhatuyendung::find($id);
        $xoa_cti = CongTy::find($id);
        $xoa_user = User::find($id);
        $ungTuyen = Ungtuyen::find($id);
        if ($ungTuyen !=  null) {
            $xoa_ntd->delete();
            $xoa_cti->delete();
            $xoa_user->delete();
            return redirect()->back()->with('success', 'Đã xóa.');
        } else {
            return redirect()->back()->with('success', 'Không thể xóa tài khoản này.');
        }
    }
    //duyệt bài việc làm 
    public function duyetViecLamNhaTuyenDung($id)
    {
        ViecLam::where('id', $id)->update(['trangThai' => 1]);
        return redirect()->back()->with('success', 'Đã duyệt');
    }

    //trang danh sách khu vực
    public function quanLyKhuVuc()
    {

        $toanBoKhuVuc = KhuVuc::paginate(10);

        return view('admin.quanlikhuvuc.index', compact('toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'countkv'));
    }
    //thêm khu vực
    public function themKhuVuc(Request $req)
    {
        $this->validate(
            $req,
            [
                'tenKhuVuc' => 'required|unique:KhuVucs,tenKhuVuc|regex:/(^[\pL0-9 ]+$)/u'
            ],
            [
                'tenKhuVuc.required' => 'Vui lòng nhập tên khu vực',
                'tenKhuVuc.regex' => 'Không được nhập ký tự đặc biệt'
            ]
        );
        $toanBoKhuVuc = new KhuVuc();
        $toanBoKhuVuc->tenKhuVuc = $req->tenKhuVuc;
        $toanBoKhuVuc->save();
        return redirect()->back()->with('success', 'Đã thêm');
    }
    //sửa khu vực
    public function chiTietKhuVuc($id_kv)
    {
        $toanBoKhuVuc = KhuVuc::where('id_kv', $id_kv)->get();
        return view('admin.quanlikhuvuc.sua', compact('toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount'));
    }
    public function suaKhuVuc(Request $req, $id_kv)
    {
        $this->validate(
            $req,
            [
                'tenKhuVuc' => 'required|unique:KhuVucs,tenKhuVuc|regex:/(^[\pL0-9 ]+$)/u'
            ],
            [
                'tenKhuVuc.required' => 'Vui lòng nhập tên khu vực',
                'tenKhuVuc.regex' => 'Không được nhập ký tự đặc biệt.'

            ]
        );
        $toanBoKhuVuc = KhuVuc::where('id_kv', $id_kv)->update(['tenKhuVuc' => $req->tenKhuVuc]);
        return redirect()->back()->with('success', 'Đã cập nhập');
    }
    //xóa khu vực
    public function xoaKhuVuc($id_kv)
    {
        $kvvl = ViecLam::where('id_kv', $id_kv)->get();
        $kvcti = CongTy::where('id_kv', $id_kv)->get();
        $countkvvl = count($kvvl);
        $countkvcti = count($kvcti);
        if ($countkvvl == 0 and $countkvcti == 0) {
            $xoa = KhuVuc::where('id_kv', $id_kv)->delete();
            return redirect()->back()->with('success', 'Đã xóa.');
        } else {
            return redirect()->back()->with('success', 'Không thể xóa khu vực này.');
        }
    }

    //trang danh sách ngành nghề
    public function quanLyNganhNghe()
    {
        $nganhNghe = NganhNghe::paginate(10);
        return view('admin.quanlinganhnghe.index', compact('nganhNghe'));
    }
    //thêm ngành nghề
    public function themNganhNghe(Request $req)
    {
        $this->validate(
            $req,
            [
                'tenNganhNghe' => 'required|unique:NganhNghes,tenNganhNghe|regex:/(^[\pL0-9 ]+$)/u'
            ],
            [
                'tenNganhNghe.required' => 'Vui lòng nhập tên ngành nghề',
                'tenNganhNghe.regex' => 'Không được nhập ký tự đặc biệt.'
            ]
        );
        $nganhNghe = new NganhNghe();
        $nganhNghe->tenNganhNghe = $req->tenNganhNghe;
        $nganhNghe->save();
        return redirect()->back()->with('success', 'Đã thêm');
    }
    public function chiTietNganhNghe($id_nn)
    {
        $nganhNghe = NganhNghe::where('id_nn', $id_nn)->get();
        return view('admin.quanlinganhnghe.sua', compact('nganhNghe'));
    }
    //sửa khu vực
    public function suaNganhNghe(Request $req, $id_nn)
    {
        $this->validate(
            $req,
            [
                'tenNganhNghe' => 'required|unique:NganhNghes,tenNganhNghe|regex:/(^[\pL0-9 ]+$)/u'
            ],
            [
                'tenNganhNghe.required' => 'Vui lòng nhập tên ngành nghề',
                'tenNganhNghe.regex' => 'Không được nhập ký tự đặc biệt.'
            ]
        );
        $nganhNghe = NganhNghe::where('id_nn', $id_nn)->update(['tenNganhNghe' => $req->tenNganhNghe]);
        return redirect()->back()->with('success', 'Đã cập nhập');
    }
    //xóa khu vực
    public function xoaNganhNghe($id_nn)
    {
        $nnvl = ViecLam::where('id_nn', $id_nn)->get();
        $count_nnvl = count($nnvl);
        if ($count_nnvl == 0) {
            $xoa = NganhNghe::where('id_nn', $id_nn)->delete();
            return redirect()->back()->with('success', 'Đã xóa.');
        } else {
            return redirect()->back()->with('success', 'Không thể xóa ngành nghề này.');
        }
    }
}
