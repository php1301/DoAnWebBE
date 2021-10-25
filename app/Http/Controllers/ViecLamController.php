<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
use App\Models\KhuVuc;
use App\Models\Luu;
use App\Models\NganhNghe;
use App\Models\UngTuyen;
use App\Models\ViecLam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViecLamController extends Controller
{
    //Tất cả việc làm
    public function index()
    {
        $chiTietViecLam = ViecLam::where('trangThai', 1)->orderByDesc('id')->paginate(10);
        $count_vieclam = ViecLam::where('trangThai', 1)->get();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $khuVucPagination = KhuVuc::paginate(5);
        $nganhNghe = NganhNghe::all();
        $congTyPagination = CongTy::paginate(5);
        //ngày hiện tại
        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $ngayHienTai = ViecLam::whereDate('ngayDang', $ngayHienTai)->where('trangThai', 1)->orderByDesc('id')->paginate(10);
        //ngày hôm qua
        $homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $homQua = ViecLam::whereDate('ngayDang', $homQua)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

        $toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
        $banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
        $lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
        $thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->orderByDesc('id')->paginate(10);

        //count
        $count_ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $count_ngayHienTai = ViecLam::whereDate('ngayDang', $count_ngayHienTai)->where('trangThai', 1)->get();
        //ngày hôm qua
        $count_homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $count_homQua = ViecLam::whereDate('ngayDang', $count_homQua)->where('trangThai', 1)->get();

        $count_toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
        $count_banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
        $count_lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
        $count_thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();

        return view('chiTietViecLam.chiTietViecLam', compact('chiTietViecLam', 'count_vieclam', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'khuVucPagination', 'nganhNghe', 'congTy', 'congTyPagination', 'dt', 'ngayHienTai', 'homQua', 'toanThoiGian', 'banThoiGian', 'lamTheoGio', 'thucTapSinh', 'count_ngayHienTai', 'count_homQua', 'count_toanThoiGian', 'count_banThoiGian', 'count_lamTheoGio', 'count_thucTapSinh'));
    }

    // Chi tiết việc làm
    public function chiTietViecLam($id)
    {

        if (Auth::check()) {

            $id_user = Auth::user();
            $ungTuyen = UngTuyen::where('id_user', $id_user->id)
                ->where('id_vl', $id)
                ->first();
        }
        if (Auth::check()) {

            $id_user = Auth::user();
            $luu = Luu::where('id_user', $id_user->id)
                ->where('id_vl', $id)
                ->first();
        }
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $nganhNghe = NganhNghe::all();
        $chiTietViecLam = ViecLam::find($id);

        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $hethang = ViecLam::where('id', $id)
            ->where('ngayhethang', '<', $ngayHienTai)
            ->first();


        return compact('toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'nganhNghe', 'chiTietViecLam', 'ungTuyen', 'luu', 'hethang');
    }

    //ứng tuyển việc làm
    public function ungTuyenViecLam(Request $req)
    {
        $id_user =  Auth::user()->id;
        $ungTuyen = new UngTuyen();
        $ungTuyen->id_user = $id_user;
        $ungTuyen->id_vl = $req->id_vl;
        $ungTuyen->id_ntd = $req->id_cty;
        $ungTuyen->save();
        return response('Đã ứng tuyển', 200);
    }
    //lưu việc làm
    public function luuViecLam(Request $req)
    {
        $id_user =  Auth::user()->id;
        $luu = new Luu();
        $luu->id_user = $id_user;
        $luu->id_vl = $req->id_vl;
        $luu->save();
        return response('Đã lưu', 200);
    }

      //việc làm ngành nghề
      public function viecLamNganhNghe($id)
      {
          $congTy = CongTy::all();
          $khuVucPaginationCount = KhuVuc::paginate(4);
          $nganhNghePaginationCount = NganhNghe::paginate(4);
          $toanBoKhuVuc = KhuVuc::all();
          $nganhNghe = NganhNghe::all();
          //việc làm ngày hiện tại
          $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
          $ngayHienTai = ViecLam::whereDate('ngayDang', $ngayHienTai)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

          //việc làm ngày hôm qua
          $homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
          $homQua = ViecLam::whereDate('ngayDang', $homQua)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

          $toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
          $banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
          $lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
          $thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->orderByDesc('id')->paginate(10);
          $vlnganhnghe = ViecLam::where('id_nn', $id)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

          $vlkv = ViecLam::where('id_kv', $id)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

          //count
          $count_ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
          $count_ngayHienTai = ViecLam::whereDate('ngayDang', $count_ngayHienTai)->where('trangThai', 1)->get();
          //ngày hôm qua
          $count_homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
          $count_homQua = ViecLam::whereDate('ngayDang', $count_homQua)->where('trangThai', 1)->get();

          $count_toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
          $count_banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
          $count_lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
          $count_thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();
          $count_vlnganhnghe = ViecLam::where('id_nn', $id)->where('trangThai', 1)->get();
          return view('chiTietViecLam.vieclamnganhnghe', compact('chiTietViecLam', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'nganhNghe', 'congTy', 'dt', 'ngayHienTai', 'homQua', 'toanThoiGian', 'banThoiGian', 'lamTheoGio', 'thucTapSinh', 'countcty', 'vlkv', 'id', 'vlnganhnghe', 'nn', 'count_ngayHienTai', 'count_homQua', 'count_toanThoiGian', 'count_banThoiGian', 'count_lamTheoGio', 'count_thucTapSinh', 'count_vlnganhnghe'));
      }
    //tìm kiếm 
    public function timKiemViecLam(Request $req)
    {
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $khuVucPagination = KhuVuc::paginate(5);
        $nganhNghe = NganhNghe::all();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::paginate(5);
        //ngày hiện tại
        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $ngayHienTai = ViecLam::whereDate('ngayDang', $ngayHienTai)->where('trangThai', 1)->get();
        //ngày hôm qua
        $homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $homQua = ViecLam::whereDate('ngayDang', $homQua)->where('trangThai', 1)->get();

        $toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
        $banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
        $lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
        $thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();

        //count
        $count_ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $count_ngayHienTai = ViecLam::whereDate('ngayDang', $count_ngayHienTai)->where('trangThai', 1)->get();
        //ngày hôm qua
        $count_homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $count_homQua = ViecLam::whereDate('ngayDang', $count_homQua)->where('trangThai', 1)->get();

        $count_toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
        $count_banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
        $count_lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
        $count_thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();
        $count_vieclam = ViecLam::orwhere('tenVIecLam', 'like', '%' . $req->tenVIecLam . '%')
            ->where('trangThai', 1)
            ->get();
        $chiTietViecLam = ViecLam::orwhere('tenVIecLam', 'like', '%' . $req->tenVIecLam . '%')
            ->where('trangThai', 1)
            ->paginate(10);

        $loc = ViecLam::where('id_kv', $req->id_kv)
            ->where('id_nn', $req->id_nn)
            ->where('trangThai', 1)
            ->get();
        return compact('loc', 'chiTietViecLam', 'count_vieclam', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'khuVucPagination', 'nganhNghe', 'congTy', 'congTyPagination', 'dt', 'ngayHienTai', 'homQua', 'toanThoiGian', 'banThoiGian', 'lamTheoGio', 'thucTapSinh', 'countcty', 'count_ngayHienTai', 'count_homQua', 'count_toanThoiGian', 'count_banThoiGian', 'count_lamTheoGio', 'count_thucTapSinh');
    }
    //lọc 
    public function locViecLam(Request $req)
    {
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $khuVucPagination = KhuVuc::paginate(5);
        $nganhNghe = NganhNghe::all();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::paginate(5);
        //ngày hiện tại
        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $ngayHienTai = ViecLam::whereDate('ngayDang', $ngayHienTai)->where('trangThai', 1)->get();
        //ngày hôm qua
        $homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $homQua = ViecLam::whereDate('ngayDang', $homQua)->where('trangThai', 1)->get();

        $toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
        $banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
        $lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
        $thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();

        //count
        $count_ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        $count_ngayHienTai = ViecLam::whereDate('ngayDang', $count_ngayHienTai)->where('trangThai', 1)->get();
        //ngày hôm qua
        $count_homQua = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $count_homQua = ViecLam::whereDate('ngayDang', $count_homQua)->where('trangThai', 1)->get();

        $count_toanThoiGian = ViecLam::where('tinhChat', 'Toàn thời gian')->where('trangThai', 1)->get();
        $count_banThoiGian = ViecLam::where('tinhChat', 'Bán thời gian')->where('trangThai', 1)->get();
        $count_lamTheoGio = ViecLam::where('tinhChat', 'Làm theo giờ')->where('trangThai', 1)->get();
        $count_thucTapSinh = ViecLam::where('tinhChat', 'Thực tập sinh')->where('trangThai', 1)->get();
        $chiTietViecLam = ViecLam::orwhere('tenVIecLam', 'like', '%' . $req->tenVIecLam . '%')
            ->where('trangThai', 1)
            ->orderByDesc('id')
            ->paginate(15);

        $loc = ViecLam::where('id_kv', $req->id_kv)
            ->where('id_nn', $req->id_nn)
            ->where('trangThai', 1)
            ->orderByDesc('id')
            ->paginate(15);
        $count_loc = ViecLam::where('id_kv', $req->id_kv)
            ->where('id_nn', $req->id_nn)
            ->where('trangThai', 1)
            ->get();
        return  compact('loc', 'count_loc', 'chiTietViecLam', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'khuVucPagination', 'nganhNghe', 'congTy', 'congTyPagination', 'dt', 'ngayHienTai', 'homQua', 'toanThoiGian', 'banThoiGian', 'lamTheoGio', 'thucTapSinh', 'countcty', 'count_ngayHienTai', 'count_homQua', 'count_toanThoiGian', 'count_banThoiGian', 'count_lamTheoGio', 'count_thucTapSinh');
    }
}
