<?php

namespace App\Http\Controllers;

use App\Mail\SendLoginDetail;
use App\User;
use App\UserProject;
use App\UserWorkspace;
use App\Utility;
use App\Mail\SendWorkspaceInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Config;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Lấy workspace của user hiện tại
    public function index($slug)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $users = User::select('users.*', 'user_workspaces.permission')->join('user_workspaces', 'user_workspaces.user_id', '=', 'users.id')->where('user_workspaces.workspace_id', '=', $currentWorkspace->id)->get();
        return view('users.index', compact('currentWorkspace', 'users'));
    }

    public function account()
    {
        $user = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug('');
        return view('users.account', compact('currentWorkspace', 'user'));
    }
    public function deleteAvatar()
    {
        $objUser = Auth::user();
        $objUser->avatar = '';
        $objUser->save();
        return redirect()->route('users.my.account')
            ->with('success', 'Avatar deleted successfully');
    }

    public function update($slug = null, $id = null, Request $request)
    {
        if ($id) {
            $objUser = User::find($id);
        } else {
            $objUser = Auth::user();
        }

        $validation = [];
        $validation['name'] = 'required';
        if ($request->avatar) {
            $validation['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($validation);

        $post = $request->all();
        if ($request->avatar) {
            $avatarName = $objUser->id . '_avatar' . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            $post['avatar'] = $avatarName;
        }

        $objUser->update($post);

        return redirect()->back()
            ->with('success', __('User Updated Successfully!'));
    }

    public function updatePassword(Request $request)
    {
        if (Auth::Check()) {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|same:password',
                'password_confirmation' => 'required|same:password',
            ]);
            $objUser = Auth::user();
            $request_data = $request->All();
            $current_password = $objUser->password;

            if (Hash::check($request_data['old_password'], $current_password)) {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();
                return redirect()->route('users.my.account')
                    ->with('success', __('Password Updated Successfully!'));
            } else {
                return redirect()->route('users.my.account')
                    ->with('error', __('Please Enter Correct Current Password!'));
            }
        } else {
            return redirect()->route('users.my.account')
                ->with('error', __('Some Thing Is Wrong!'));
        }
    }

    // lấy dữ liệu email User thành viên dạng JSON
    public function getUserJson()
    {
        $return = [];
        $objdata = User::select('email')->where('id', '!=', auth()->id())->get();
        foreach ($objdata as $data) {
            $return[] = $data->email;
        }
        return response()->json($return);
    }
    //Lấy các user by Project id
    public function getProjectUserJson($projectID)
    {
        return User::select('users.*')->join('user_projects', 'user_projects.user_id', '=', 'users.id')->where('project_id', '=', $projectID)->where('users.id', '!=', auth()->id())->get()->toJSON();
    }
    // view invite
    public function invite($slug)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('users.invite', compact('currentWorkspace'));
    }
    // Mời và gửi mail cho những user(chưa có trong workspace) cần tham gia 
    public function inviteUser($slug, Request $request)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = $request->all();
        $userList = explode(',', $post['users_list']);
        $userList = array_filter($userList);

        foreach ($userList as $email) {
             
            $registerUsers =  User::where('email', $email)->first();
            if (!$registerUsers) {
                $smtp_error = "Email does not exist";
            }
            // assign workspace first
            else {
                $is_assigned = false;
                foreach ($registerUsers->workspace as $workspace) {
                    if ($workspace->id == $currentWorkspace->id) {
                        $is_assigned = true;
                    }
                }
                // nếu chưa tạo workspace sẽ tạo và gửi mail xác nhận tạo.
                if (!$is_assigned) {
                    UserWorkspace::create(['user_id' => $registerUsers->id, 'workspace_id' => $currentWorkspace->id, 'permission' => 'Member']);

                    try {
                        Mail::to($registerUsers->email)->send(new SendWorkspaceInvitation($registerUsers, $currentWorkspace));
                    } catch (\Exception $e) {
                        echo $e;
                        $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                    }
                }
            }
        }

        return redirect()->route('users.index', $currentWorkspace->slug)
            ->with('success', __('Users Invited Successfully!') . ((isset($smtp_error)) ? ' <br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }
    // view chỉnh sửa workspace theo UserId
    public function edit($slug, $id)
    {
        $user = User::find($id);
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('users.edit', compact('currentWorkspace', 'user'));
    }
    // xóa workspace theo id manager workspace
    public function removeUser($slug, $id)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $userWorkspace = UserWorkspace::where('user_id', '=', $id)->where('workspace_id', '=', $currentWorkspace->id)->first();
        if ($userWorkspace) {
            foreach ($currentWorkspace->projects as $project) {
                $userProject = UserProject::where('user_id', '=', $id)->where('project_id', '=', $project->id)->first();
                if ($userProject) {
                    $userProject->delete();
                }
            }
            $userWorkspace->delete();
            return redirect()->route('users.index', $currentWorkspace->slug)->with('success',  __('User Removed Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }
}
