<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
use App\Models\KhuVuc;
use App\Models\ViecLam;
use App\Models\NganhNghe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CongTyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $nganhNghe = NganhNghe::all();
        $khuVucPagination = KhuVuc::paginate(4);
        $nganhNghePagination = NganhNghe::paginate(4);
        $khuVuc = KhuVuc::all();
        $congTy = CongTy::paginate(18);
        $congTyAll = CongTy::all();
        return  compact('congTy', 'congTyAll', 'khuVuc', 'khuVucPagination', 'nganhNghePagination', 'nganhNghe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $congTy = CongTy::find($id);
        $khuVucPagination = KhuVuc::paginate(4);
        $nganhNghePagination = NganhNghe::paginate(4);
        $khuVuc = KhuVuc::all();
        $demViecLam = ViecLam::where('id_cty', $id)->where('trangThai', 1)->get();
        $viecLamPhanTrang = ViecLam::where('id_cty', $id)->where('trangThai', 1)->paginate(6);

        return compact('congTy', 'khuVuc', 'khuVucPagination', 'nganhNghePagination', 'viecLamPhanTrang', 'demViecLam');
    }

    //việc làm công ty
    public function viecLamCongTy($id)
    {
        if (Auth::check()) {
            $khuVucPagination = KhuVuc::paginate(4);
            $nganhNghePagination = NganhNghe::paginate(4);
            $khuVuc = KhuVuc::all();
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
            $chiTietCongTy = CongTy::find($id);
            $viecLamCongTy = ViecLam::where('id_cty', $id)->where('trangThai', 1)->orderByDesc('id')->paginate(10);

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
            $count_viecLamCongTy = ViecLam::where('id_cty', $id)->where('trangThai', 1)->get();
            return compact('chiTietCongTy', 'khuVuc', 'khuVucPagination', 'nganhNghePagination', 'nganhNghe', 'ngayHienTai', 'homQua', 'toanThoiGian', 'banThoiGian', 'lamTheoGio', 'thucTapSinh', 'viecLamCongTy', 'count_ngayHienTai', 'count_homQua', 'count_toanThoiGian', 'count_banThoiGian', 'count_lamTheoGio', 'count_thucTapSinh', 'count_viecLamCongTy');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
