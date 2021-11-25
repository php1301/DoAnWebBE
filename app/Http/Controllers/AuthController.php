<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
use App\Models\NhaTuyenDung;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'registerNTD', 'setLogoNTD']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = Auth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'level' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Register a NhaTuyenDung.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerNTD(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'level' => 'required',

            'tenCongTy' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
            'emailCty' => 'required|email',
            'sdtCty' => 'required|regex:/(0)[0-9]{9}/',
            'diaChiCty' => 'required|regex:/(^[\pL0-9 ,]+$)/u|max:255',
            'id_kv' => 'required',
            'id_nn' => 'required',
            'motaCty' => 'required',
            'tenNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
            'chucVuNhaTuyenDung' => 'required|regex:/(^[\pL0-9 ]+$)/u|max:255',
            'sdtNhaTuyenDung' => 'required|regex:/(0)[0-9]{9}/',
            'diachi_ndk' => 'required|regex:/(^[\pL0-9 ,]+$)/u|max:255',
            'tenCty.regex' => 'Không được nhập ký tự đặc biệt.',
            'diaChiCty.regex' => 'Không được nhập ký tự đặc biệt.',
            'tenNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
            'chucVuNhaTuyenDung.regex' => 'Không được nhập ký tự đặc biệt.',
            'diachi_ndk.regex' => 'Không được nhập ký tự đặc biệt.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $cty = new CongTy();
        $cty->id = $user->id;
        $cty->tenCongTy = $request->tenCongTy;
        $cty->email = $request->emailCty;
        $cty->sdt = $request->sdtCty;
        $cty->diaChi = $request->diaChiCty;
        $cty->id_kv = $request->id_kv;
        $cty->logo = '';
        $cty->id_nn = $request->id_nn;
        $cty->mota_cty = $request->mota_cty;
        $cty->save();

        $nhatuyendung = new Nhatuyendung();
        $nhatuyendung->id = $user->id;
        $nhatuyendung->id_user = $user->id;
        $nhatuyendung->id_cty = $user->id;
        $nhatuyendung->tenNhaTuyenDung = $request->tenNhaTuyenDung;
        $nhatuyendung->chucVuNhaTuyenDung = $request->chucVuNhaTuyenDung;
        $nhatuyendung->sdtNhaTuyenDung = $request->sdtNhaTuyenDung;
        $nhatuyendung->diachi_ndk = $request->diachi_ndk;
        $nhatuyendung->save();

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
    public function setLogoNTD(Request $request)
    {
        $logo = '';
        if ($request->hasfile('logoCty')) {
            $this->validate(
                $request,
                //hàm kiểm tra dữ liệu
                [
                    'logoCty' => 'mimes:jpg,png,jpeg,gif|max:2048',
                ],
                [
                    'logoCty.mimes' => ' Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'logoCty.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
                ]
            );

            $file = $request->file('logoCty');
            $logo = $file->getClientOriginalName();
            $destinationPath = public_path('images\logo');
            // $bannerPath = public_path('images\banner');
            $file->move($destinationPath, $logo);
            // $file->move($bannerPath, $logo);
        };
        $cty = CongTy::find($request->congTyId);
        $cty->logo = $logo;
        $cty->banner = $logo;
        $cty->save();
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(Auth::refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(Auth::user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }
}
