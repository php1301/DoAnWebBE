<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
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

class NhaTuyenDungController extends Controller
{
    //đăng bài mới của nhà tuyển dụng
    public function dangBaiTuyenDung(Request $req)
    {
        $this->validate(
            $req,
            [
                'tenVIecLam' => 'required|regex:/(^[\pL0-9 ]+$)/u',
                'moTa' => 'required',
                'yeuCau' => 'required',
                'diaChi' => 'required|regex:/(^[\pL0-9 ,]+$)/u',
                'soLuong' => 'required|integer',
                'mucLuong' => 'required|integer',
                'ngayhethang' => 'required|date|after:today',
                'tuoi' => 'required|regex:/[0-9]/',
                'id_kv' => 'required',
                'id_nn' => 'required',
                'tinhChat' => 'required',
                'bangCap' => 'required',
                'chucVu' => 'required',
                'gioiTinh' => 'required',
                'viTri' => 'required',
                'kinhNghiem' => 'required'
            ],
            [
                'tenVIecLam.regex' => 'Tên không được nhập ký tự đặc biệt.',
                'diaChi.regex' => 'Địa chỉ không được nhập ký tự đặc biệt.',
                'tuoi.regex' => 'Định dạng không hợp lệ.',
                'id_kv.required' => 'Vui lòng chọn.',
                'id_nn.required' => 'Vui lòng chọn.',
                'tinhChat.required' => 'Vui lòng chọn.',
                'bangCap.required' => 'Vui lòng chọn.',
                'chucVu.required' => 'Vui lòng chọn.',
                'gioiTinh.required' => 'Vui lòng chọn.',
                'viTri.required' => 'Vui lòng chọn.',
                'kinhNghiem.required' => 'Vui lòng chọn.'
            ]
        );


        $id_cty = Auth::user()->id;

        $chiTietViecLam = new ViecLam();
        $chiTietViecLam->tenVIecLam = $req->input('tenVIecLam');
        $chiTietViecLam->id_cty = $id_cty;
        $chiTietViecLam->id_nn = $req->input('id_nn');
        $chiTietViecLam->id_kv = $req->input('id_kv');
        $chiTietViecLam->ngayhethang = $req->input('ngayhethang');
        $chiTietViecLam->mucLuong = $req->input('mucLuong');
        $chiTietViecLam->tinhChat = $req->input('tinhChat');
        $chiTietViecLam->moTa = $req->input('moTa');
        $chiTietViecLam->yeuCau = $req->input('yeuCau');
        $chiTietViecLam->soLuong = $req->input('soLuong');
        $chiTietViecLam->diaChi = $req->input('diaChi');
        $chiTietViecLam->bangCap = $req->input('bangCap');
        $chiTietViecLam->kinhNghiem = $req->input('kinhNghiem');
        $chiTietViecLam->viTri = $req->input('viTri');
        $chiTietViecLam->chucVu = $req->input('chucVu');
        $chiTietViecLam->gioiTinh = $req->input('gioiTinh');
        $chiTietViecLam->tuoi = $req->input('tuoi');
        $chiTietViecLam->save();
        return redirect()->back()->with('success', 'Đã đăng bài, chờ phê duyệt');
    }

    //trang nhà tuyển dụng khi chưa đăng nhập
    public function nhaTuyenDung()
    {
        $congTy = CongTy::with('KhuVucs:id_kv,tenKhuVuc')->limit(7)->orderByDesc('id')->get();
        return view('/nhaTuyenDung.trangchu', compact('congTy'));
    }

    //trang đăng nhâp của nhà tuyển dụng
    public function trangDangNhapNhaTuyenDung()
    {
        return view('/nhaTuyenDung.dangnhap');
    }
    public function dangNhapNhaTuyenDung(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu tối đa 20 kí tự'
            ]
        );
        $dangnhap = array('email' => $req->email, 'password' => $req->password);
        if (Auth::attempt($dangnhap)) {
            return redirect()->action('QuanlytimvieclamController@indexNTD');
        } else {
            return redirect()->back()->with('success', 'Mật khẩu sai hoặc tài khoản này chưa được chấp thuận !');
        }
    }

    //trang đăng ký của nhà tuyển dụng
    public function trangDangKyNhaTuyenDung()
    {
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $nganhNghe = NganhNghe::all();
        return view('/nhaTuyenDung.dangky', compact('toanBoKhuVuc', 'nganhNghe', 'khuVucPaginationCount', 'nganhNghePaginationCount'));
    }
    public function dangKyNhaTuyenDung(Request $req)
    {
        $this->validate(
            $req,
            [
                'username' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',


                'tenCongTy' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
                'emailCongTy' => 'required|email',
                'sdt_cty' => 'required|regex:/(0)[0-9]{9}/',
                'diachi_cty' => 'required|regex:/(^[\pL0-9 ,]+$)/u|max:255',
                'id_kv' => 'required',
                'id_nn' => 'required',
                'mota_cty' => 'required',
                'logo_cty' => 'required',
                'tenNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
                'chucVuNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
                'sdtNhaTuyenDung' => 'required|regex:/(0)[0-9]{9}/',
                'diachi_ndk' => 'required|regex:/(^[\pL0-9 ,]+$)/u|max:255',
            ],
            [
                'tenCongTy.regex' => 'Không được nhập ký tự đặc biệt.',
                'diachi_cty.regex' => 'Không được nhập ký tự đặc biệt.',
                'tenNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
                'chucVuNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
                'diachi_ndk.regex' => 'Không được nhập ký tự đặc biệt.',
            ]
        );

        $logo = '';
        if ($req->hasfile('logo_cty')) {
            $this->validate(
                $req,
                //hàm kiểm tra dữ liệu
                [
                    'logo_cty' => 'mimes:jpg,png,jpeg,gif|max:2048',
                ],
                [
                    'logo_cty.mimes' => ' Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'logo_cty.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
                ]
            );

            $file = $req->file('logo_cty');
            $logo = $file->getClientOriginalName();
            $destinationPath = public_path('static\assets\images\logo');
            $file->move($destinationPath, $logo);
        };



        $users = new User();
        $users->email = $req->input('username');
        $users->name = $req->tenCongTy;
        $users->password = Hash::make($req->password);
        $users->level = "2";
        $users->save();

        $congTy = new CongTy();
        $congTy->id = $users->id;
        $congTy->tenCongTy = $req->input('tenCongTy');
        $congTy->email = $req->input('emailCongTy');
        $congTy->sdt = $req->input('sdt_cty');
        $congTy->diaChi = $req->input('diachi_cty');
        $congTy->id_kv = $req->input('id_kv');
        $congTy->id_nn = $req->input('id_nn');
        $congTy->mota_cty = $req->input('mota_cty');
        $congTy->logo = $logo;
        $congTy->save();

        $nhaTuyenDung = new Nhatuyendung();
        $nhaTuyenDung->id = $users->id;
        $nhaTuyenDung->id_user = $users->id;
        $nhaTuyenDung->id_cty = $users->id;
        $nhaTuyenDung->tenNhaTuyenDung = $req->input('tenNhaTuyenDung');
        $nhaTuyenDung->chucVuNhaTuyenDung = $req->input('chucVuNhaTuyenDung');
        $nhaTuyenDung->sdtNhaTuyenDung = $req->input('sdtNhaTuyenDung');
        $nhaTuyenDung->diachi_ndk = $req->input('diachi_ndk');
        $nhaTuyenDung->save();

        return redirect()->action('QuanlytimvieclamController@getdangnhapNTD')->with('success', 'Đăng ký thành công');
    }

    //trang của nhà tuyển dụng sau khi đăng nhập
    public function indexNhaTuyenDung()
    {
        $id = Auth::user()->id;
        $nhaTuyenDung = Nhatuyendung::where('id_user', $id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietCongTy = CongTy::find($id);
        $chiTietViecLam = ViecLam::where('id_cty', $id)->get();
        $ungTuyen = Ungtuyen::where('id_ntd', $id)->get();
        return view('nhaTuyenDung.index', compact('nhaTuyenDung', 'congTy', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'congTyPagination', 'chiTietCongTy', 'chiTietViecLam', 'ungTuyen'));
    }
    //cập nhập hồ sơ nhà tuyển dụng
    public function capNhatHoSoNhaTuyenDung(Request $req)
    {
        $this->validate(
            $req,
            [

                'tenCongTy' => 'required|regex:/(^[\pL0-9 , -]+$)/u',
                'emailCongTy' => 'required|email',
                'sdt_cty' => 'required|min:10|max:10',
                'diachi_cty' => 'required|regex:/(^[\pL0-9 ,]+$)/u',
                'id_kv' => 'required',
                'tenNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u',
                'chucVuNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u',
                'sdtNhaTuyenDung' => 'required|min:10|max:10',
                'diachi_ndk' => 'required|regex:/(^[\pL0-9 ,]+$)/u',
            ],
            [
                'tenCongTy.regex' => 'Không được nhập ký tự đặc biệt.',
                'diachi_cty.regex' => 'Không được nhập ký tự đặc biệt.',
                'tenNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
                'chucVuNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
                'diachi_ndk.regex' => 'Không được nhập ký tự đặc biệt.',
                'tenCongTy.required' => 'Vui lòng nhập tên công ty',
                'emailCongTy.required' => 'Vui lòng nhập email công ty',
                'sdt_cty.required' => 'Vui lòng nhập số điện thoại công ty',
                'sdt_cty.min' => 'Số điện thoại không nhỏ hơn :min',
                'sdt_cty.max' => 'Số điện thoại không lớn hơn :max',
                'diachi_cty.required' => 'Vui lòng nhập địa chỉ công ty',
                'id_kv.required' => 'Vui lòng chọn khu vực',
                'tenNhaTuyenDung.required' => 'Vui lòng nhập tên người đăng ký',
                'tenNhaTuyenDung.string' => 'Tên không được nhập số',
                'chucVuNhaTuyenDung.required' => 'Vui lòng nhập chức vụ',
                'sdtNhaTuyenDung.required' => 'Vui lòng nhập số điện thoại cá nhân',
                'sdtNhaTuyenDung.min' => 'Số điện thoại không nhỏ hơn :min',
                'sdtNhaTuyenDung.max' => 'Số điện thoại không lớn hơn :max',
                'diachi_ndk.required' => 'Vui lòng nhập địa chỉ',

                'emailCongTy.email' => 'Không đúng định dạng email',
            ]
        );

        $id_cty = Auth::user()->id;

        $congTy = CongTy::find($id_cty);
        $congTy->tenCongTy = $req->tenCongTy;
        $congTy->email = $req->emailCongTy;
        $congTy->sdt = $req->sdt_cty;
        $congTy->diaChi = $req->diachi_cty;
        $congTy->id_kv = $req->id_kv;
        $congTy->id_nn = $req->id_nn;
        $congTy->mota_cty = $req->mota_cty;
        $congTy->save();

        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $user->name = $congTy->tenCongTy;
        $user->save();

        $id = $id_user;
        $nhaTuyenDung = Nhatuyendung::find($id_user);
        $nhaTuyenDung->tenNhaTuyenDung = $req->tenNhaTuyenDung;
        $nhaTuyenDung->chucVuNhaTuyenDung = $req->chucVuNhaTuyenDung;
        $nhaTuyenDung->sdtNhaTuyenDung = $req->sdtNhaTuyenDung;
        $nhaTuyenDung->diachi_ndk = $req->diachi_ndk;
        $nhaTuyenDung->save();


        return response("Cập nhật hồ sơ nhà tuyển dụng thành công", 200);
    }
    //trang việc làm đã đăng
    public function viecLamDaDangNhaTuyenDung()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
        }
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietViecLam = ViecLam::where('id_cty', $id)->orderByDesc('id')->get();
        $chiTietCongTy = CongTy::find($id);
        return view('nhaTuyenDung.chiTietViecLam.vieclamdadang', compact('nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietViecLam', 'chiTietCongTy'));
    }
    //xem chi tiết việc làm đã đăng
    public function xemChiTietViecLamDaDang($id)
    {

        $chiTietViecLam = ViecLam::find($id);
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietCongTy = CongTy::find(Auth::user()->id);
        return view('nhaTuyenDung.chiTietViecLam.xem', compact('chiTietViecLam', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietCongTy'));
    }
    //sửa việc làm đã đăng
    public function chiTietViecLamNhaTuyenDung($id)
    {

        $chiTietViecLam = ViecLam::find($id);
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietCongTy = CongTy::find(Auth::user()->id);
        return view('nhaTuyenDung.chiTietViecLam.sua', compact('chiTietViecLam', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietCongTy'));
    }
    public function suaViecLamNhaTuyenDung(Request $req, $id)
    {

        $this->validate(
            $req,
            [
                'tenVIecLam' => 'required|regex:/(^[\pL0-9 , ]+$)/u',
                'moTa' => 'required',
                'yeuCau' => 'required',
                'diaChi' => 'required|regex:/(^[\pL0-9 , ]+$)/u',
                'soLuong' => 'required',
                'kinhNghiem' => 'required',
                'mucLuong' => 'required',
                'ngayhethang' => 'required',
                'viTri' => 'required',
                'id_nn' => 'required',
                'tinhChat' => 'required',
                'bangCap' => 'required',
                'chucVu' => 'required',
                'gioiTinh' => 'required',
                'tuoi' => 'required|regex:/[0-9]/',
            ],
            [

                'tenVIecLam.regex' => 'Không được nhập ký tự đặc biệt.',
                'diaChi.regex' => 'Không được nhập ký tự đặc biệt.',
                'tuoi.regex' => 'Định dạng không hợp lệ.',
                'tenVIecLam.required' => 'Vui lòng nhập tiêu đề',
                'moTa.required' => 'Vui lòng nhập mô tả',
                'yeuCau.required' => 'Vui lòng nhập yêu cầu',
                'diaChi.required' => 'Vui lòng nhập địa điểm làm việc',
                'soLuong.required' => 'Vui lòng nhập số lượng',
                'kinhNghiem.required' => 'Vui lòng nhập kinh nghiệm',
                'mucLuong.required' => 'Vui lòng nhập mức lương',
                'ngayhethang.required' => 'Vui lòng nhập ngày hết hạn bài đăng',
                'viTri.required' => 'Vui lòng chọn vị trí công việc',
                'id_nn.required' => 'Vui lòng chọn ngành nghề chuyên môn',
                'tinhChat.required' => 'Vui lòng chọn tính chất công việc',
                'bangCap.required' => 'Vui lòng chọn bằng cấp',
                'chucVu.required' => 'Vui lòng chọn chức vụ công việc',
                'gioiTinh.required' => 'Vui lòng nhập giới tính',
                'tuoi.required' => 'Vui lòng nhập tuổi',

            ]
        );

        $id_cty = Auth::user()->id;

        $chiTietViecLam = ViecLam::find($id);
        $chiTietViecLam->tenVIecLam = $req->tenVIecLam;
        $chiTietViecLam->id_cty = $id_cty;
        $chiTietViecLam->id_nn = $req->id_nn;
        $chiTietViecLam->id_kv = $req->id_kv;
        $chiTietViecLam->ngayhethang = $req->ngayhethang;
        $chiTietViecLam->mucLuong = $req->mucLuong;
        $chiTietViecLam->tinhChat = $req->tinhChat;
        $chiTietViecLam->moTa = $req->moTa;
        $chiTietViecLam->yeuCau = $req->yeuCau;
        $chiTietViecLam->soLuong = $req->soLuong;
        $chiTietViecLam->diaChi = $req->diaChi;
        $chiTietViecLam->bangCap = $req->bangCap;
        $chiTietViecLam->kinhNghiem = $req->kinhNghiem;
        $chiTietViecLam->mucLuong = $req->mucLuong;
        $chiTietViecLam->viTri = $req->viTri;
        $chiTietViecLam->chucVu = $req->chucVu;
        $chiTietViecLam->gioiTinh = $req->gioiTinh;
        $chiTietViecLam->tuoi = $req->tuoi;
        $chiTietViecLam->save();
        return redirect()->route('vieclamdadang')->with('success', 'Đã cập nhập');
    }

    //xóa việc làm
    public function xoaViecLamNhaTuyenDung($id)
    {
        $xoa = ViecLam::find($id);
        $xoa->delete();
        return redirect()->back()->with('success', 'Đã xóa.');
    }

    //thêm hình ảnh
    public function themHinhViecLamPage($id)
    {

        $hinh = CongTy::find($id);
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietCongTy = CongTy::find(Auth::user()->id);
        return view('nhaTuyenDung.themhinh', compact('hinh', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietCongTy'));
    }
    public function themHinhViecLam(Request $req, $id)
    {


        $hinhAnh = '';
        if ($req->hasfile('banner')) {
            $this->validate(
                $req,
                //hàm kiểm tra dữ liệu
                [
                    'banner' => 'mimes:jpg,png,jpeg,gif|max:200048',
                ],
                [
                    'banner.mimes' => ' Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'banner.max' => 'Hình ảnh giới hạn dung lượng không quá 2G',
                ]
            );

            $file = $req->file('banner');
            $hinhAnh = $file->getClientOriginalName();
            $destinationPath = public_path('static\assets\images\banner');
            $file->move($destinationPath, $hinhAnh);
        };
        $hinhanh1 = '';
        if ($req->hasfile('logo')) {
            $this->validate(
                $req,
                //hàm kiểm tra dữ liệu
                [
                    'logo' => 'mimes:jpg,png,jpeg,gif|max:200048',
                ],
                [
                    'logo.mimes' => ' Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'logo.max' => 'Hình ảnh giới hạn dung lượng không quá 2G',
                ]
            );

            $file = $req->file('logo');
            $hinhanh1 = $file->getClientOriginalName();
            $destinationPath = public_path('static\assets\images\logo');
            $file->move($destinationPath, $hinhanh1);
        };

        $congTy = CongTy::find($id);
        if ($hinhAnh == "") {
            $hinhAnh = $congTy->banner;
        }
        $congTy = CongTy::find($id);
        if ($hinhanh1 == "") {
            $hinhanh1 = $congTy->logo;
        }
        $congTy->logo = $hinhanh1;
        $congTy->banner = $hinhAnh;
        $congTy->save();
        return redirect()->route('indexNTD')->with('success', 'Đã cập nhập.');
    }

    //trang hồ sơ ứng viên
    public function hoSoUngVienNhaTuyenDung()
    {
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietViecLam = ViecLam::all();
        $stt = 1;
        $id_ntd = Auth::user()->id;
        $hoso = Ungtuyen::where('id_ntd', $id_ntd)->get();
        $chiTietCongTy = CongTy::find(Auth::user()->id);
        return view('nhaTuyenDung.chiTietViecLam.hosoungvien', compact('stt', 'hoso', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietViecLam', 'chiTietCongTy'));
    }

    //duyệt hồ sơ ứng viên
    public function duyetHoSoUngVien($id)
    {
        Ungtuyen::where('id', $id)->update(['trangThai' => 1]);
        return redirect()->back()->with('success', 'Đã duyệt');
    }

    public function chiTietHoSoUngVien($id)
    {
        $nhaTuyenDung = Nhatuyendung::where('id_user', Auth::user()->id)->get();
        $congTy = CongTy::all();
        $congTyPagination = CongTy::all();
        $khuVucPaginationCount = KhuVuc::paginate(4);
        $nganhNghePaginationCount = NganhNghe::paginate(4);
        $toanBoKhuVuc = KhuVuc::all();
        $chuyenMon = NganhNghe::all();
        $chiTietViecLam = ViecLam::all();
        $chiTietCongTy = CongTy::find(Auth::user()->id);
        $chitiet = Ungvien::find($id);
        return view('nhaTuyenDung.chiTietViecLam.chitiethosoungvien', compact('chitiet', 'nhaTuyenDung', 'congTy', 'congTyPagination', 'toanBoKhuVuc', 'khuVucPaginationCount', 'nganhNghePaginationCount', 'chuyenMon', 'chiTietViecLam', 'chiTietCongTy'));
    }
}
