<?php

namespace App\Http\Controllers;

use App\Client;
use App\ActivityLog;
use App\ClientProject;
use App\Mail\SendWorkspaceInvitation;
use App\Mail\ShareProjectToClient;
use App\Milestone;
use App\SubTask;
use App\UserWorkspace;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\ProjectFile;
use App\Task;
use App\Comment;
use App\Events\FetchTaskBoard;
use App\TaskFile;
use App\Utility;
use App\User;
use App\UserProject;
use App\Mail\SendInvitation;
use App\Mail\SendLoginDetail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // view project index
    public function index($slug)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $projects = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('user_projects.user_id', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->get();
        return view('projects.index', compact('currentWorkspace', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store($slug, Request $request)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $request->validate([
            'name' => 'required',
        ]);

        $objUser = Auth::user(); // lấy dữ liệu của user đăng ký project

        $post = $request->all();

        $post['workspace'] = $currentWorkspace->id;
        $post['created_by'] = $objUser->id;
        $userList = [];
        if (isset($post['users_list'])) {
            $userList = $post['users_list'];
        }
        $userList[] = $objUser->email;
        $userList = array_filter($userList);
        $objProject = Project::create($post);

        foreach ($userList as $email) {
            $permission = 'Member';
            $registerUsers =  User::where('email', $email)->first();
            if ($registerUsers) {
                if ($registerUsers->id == $objUser->id) {
                    $permission = 'Owner';
                }
                $this->inviteUser($registerUsers, $objProject, $permission);
            } else {
                // tạo use khi không tồn tại name mà chỉ có email được mời từ owner 
                $arrUser = [];
                $arrUser['name'] = 'No Name';
                $arrUser['email'] = $email;
                $password = Str::random(8);
                $arrUser['password'] = Hash::make($password);
                $arrUser['current_workspace'] = $objProject->workspace;
                $registerUsers = User::create($arrUser);
                $registerUsers->password = $password;

                try {
                    Mail::to($email)->send(new SendLoginDetail($registerUsers));
                } catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                $this->inviteUser($registerUsers, $objProject, $permission);
            }
        }

        return redirect()->route('projects.index', $currentWorkspace->slug)
            ->with('success', __('Project Created Successfully!') . ((isset($smtp_error)) ? ' <br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }
    /// mới và đặt quyền user và tạo workspace,project cho user Member cho project 
    public function inviteUser(User $user, Project $project, $permission)
    {

        // assign workspace first
        $is_assigned = false;
        foreach ($user->workspace as $workspace) {
            if ($workspace->id == $project->workspace) {
                $is_assigned = true;
            }
        }

        if (!$is_assigned) {
            UserWorkspace::create(['user_id' => $user->id, 'workspace_id' => $project->workspace, 'permission' => $permission]);
            try {
                Mail::to($user->email)->send(new SendWorkspaceInvitation($user, $project->workspaceData));
            } catch (\Exception $e) {
                echo $e;
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration', $e);
            }
        }

        // assign project
        $arrData = [];
        $arrData['user_id'] = $user->id;
        $arrData['project_id'] = $project->id;
        $is_invited = UserProject::where($arrData)->first();
        if (!$is_invited) {
            UserProject::create($arrData);
            if ($permission != 'Owner') {
                try {
                    Mail::to($user->email)->send(new SendInvitation($user, $project));
                } catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }
            }
        }
    }
    // mời thêm user vào project(đúng vời workspace) theo projectid 
    public function invite($slug, $projectID, Request $request)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = $request->all();
        $userList = $post['users_list'];

        $objProject = Project::find($projectID);

        foreach ($userList as $email) {
            $permission = 'Member';
            $registerUsers =  User::where('email', $email)->first();
            if ($registerUsers) {
                $this->inviteUser($registerUsers, $objProject, $permission);
            }
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'project_id' => $objProject->id,
                'log_type' => 'Invite User',
                'remark' => Auth::user()->name . __(' Invite new User ') . '<b>' . $registerUsers->name . '</b>'
            ]);
        }

        return redirect()->route('projects.index', $currentWorkspace->slug)
            ->with('success', __('Users Invited Successfully!') . ((isset($smtp_error)) ? ' <br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // view project theo project id
    public function show($slug, $projectID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        $chartData = $this->getProjectChart(['project_id' => $projectID, 'duration' => 'week']);
        return view('projects.show', compact('currentWorkspace', 'project', 'chartData'));
    }
    // get dữ liệu chart của project theo task ra UI
    public function getProjectChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {

            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-1 week +1 day");


                for ($i = 0; $i < 7; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('D', $previous_week);
                    $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        //        dd($arrDuration);
        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['done'] = [];
        $arrTask['progress'] = [];
        $arrTask['review'] = [];
        $arrTask['todo'] = [];
        foreach ($arrDuration as $date => $label) {


            $objProject = Task::select('status', DB::raw('count(*) as total'))
                ->whereDate('updated_at', '=', $date)
                ->groupBy('status');

            if (isset($arrParam['project_id'])) {
                $objProject->where('project_id', '=', $arrParam['project_id']);
            }
            if (isset($arrParam['workspace_id'])) {

                $objProject->whereIn('project_id', function ($query) use ($arrParam) {
                    $query->select('id')->from('projects')->where('workspace', '=', $arrParam['workspace_id']);
                });
            }
            $data = $objProject->get();
            $done = 0;
            $progress = 0;
            $review = 0;
            $todo = 0;
            foreach ($data as $item) {
                if ($item->status == 'done')
                    $done = $item->total;
                elseif ($item->status == 'in progress')
                    $progress = $item->total;
                elseif ($item->status == 'review')
                    $review = $item->total;
                elseif ($item->status == 'todo')
                    $todo = $item->total;
            }
            $arrTask['label'][] = __($label);
            $arrTask['done'][] = $done;
            $arrTask['progress'][] = $progress;
            $arrTask['review'][] = $review;
            $arrTask['todo'][] = $todo;
        }
        return $arrTask;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // chỉnh sửa project by id
    public function edit($slug, $projectID)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('user_projects.user_id', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        return view('projects.edit', compact('currentWorkspace', 'project'));
    }
    // view tạo project
    public function create($slug)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('projects.create', compact('currentWorkspace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // bật của số thông báo mời vào project
    public function popup($slug, $projectID)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('user_projects.user_id', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        return view('projects.invite', compact('currentWorkspace', 'project'));
    }
    // bật của số chia sẻ mời vào project
    public function sharePopup($slug, $projectID)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('user_projects.user_id', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        return view('projects.share', compact('currentWorkspace', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // update lại project by id
    public function update(Request $request, $slug, $projectID)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('user_projects.user_id', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        $project->update($request->all());

        return redirect()->back()
            ->with('success', __('Project Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $projectID
     * @return \Illuminate\Http\Response
     */

    // xóa project by id
    public function destroy($slug, $projectID)
    {
        $objUser = Auth::user();
        $project = Project::find($projectID);

        if ($project->created_by == $objUser->id) {
            UserProject::where('project_id', '=', $projectID)->delete();
            $project->delete();
            return redirect()->route('projects.index', $slug)->with('success', __('Project Deleted Successfully!'));
        } else {
            return redirect()->route('projects.index', $slug)->with('error', __('You can\'t Delete Project!'));
        }
    }

    /**
     * Leave the specified resource from storage.
     *
     * @param  Int  $projectID
     * @return \Illuminate\Http\Response
     */
    // thoát project
    public function leave($slug, $projectID)
    {
        $objUser = Auth::user();
        $userProject = Project::find($projectID);
        UserProject::where('project_id', '=', $userProject->id)->where('user_id', '=', $objUser->id)->delete();
        return redirect()->route('projects.index', $slug)->with('success', __('Project Leave Successfully!'));
    }
    // view  các task trong project
    public function taskBoard($slug, $projectID)
    {
        $clientID = "";
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);

        if (!(int) $projectID) {

            if ($arrDec = \Illuminate\Support\Facades\Crypt::decrypt($projectID)) {
                $projectID = $arrDec['project_id'];
                $clientID = $arrDec['client_id'];
                $project = Project::select('projects.*')->join('client_projects', 'projects.id', '=', 'client_projects.project_id')->where('client_projects.client_id', '=', $arrDec['client_id'])->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
            }
        } else {
            $objUser = Auth::user();
            $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        }

        $arrStatus = ['todo', 'in progress', 'review', 'done'];
        $tasks = [];
        $statusClass = [];
        foreach ($arrStatus as $status) {
            $statusClass[] = 'task-list-' . str_replace(' ', '_', $status);
            $task = Task::where('project_id', '=', $projectID);
            $task->orderBy('order');

            $tasks[$status] = $task->where('status', '=', $status)->get();
        }
        if (isset($objUser) && $objUser) {
            return view('projects.taskboard', compact('currentWorkspace', 'project', 'tasks', 'statusClass'));
        }
    }
    public function taskBoardUpdate($slug, $projectID)
    {
        $clientID = "";
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);

        if (!(int) $projectID) {

            if ($arrDec = \Illuminate\Support\Facades\Crypt::decrypt($projectID)) {
                $projectID = $arrDec['project_id'];
                $clientID = $arrDec['client_id'];
                $project = Project::select('projects.*')->join('client_projects', 'projects.id', '=', 'client_projects.project_id')->where('client_projects.client_id', '=', $arrDec['client_id'])->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
            }
        } else {
            $objUser = Auth::user();
            $project = Project::select('projects.*')->join('user_projects', 'projects.id', '=', 'user_projects.project_id')->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        }

        $arrStatus = ['todo', 'in progress', 'review', 'done'];
        $tasks = [];
        $statusClass = [];
        foreach ($arrStatus as $status) {
            $statusClass[] = 'task-list-' . str_replace(' ', '_', $status);
            $task = Task::where('project_id', '=', $projectID);
            $task->orderBy('order');

            $tasks[$status] = $task->where('status', '=', $status)->get();
        }
        if (isset($objUser) && $objUser) {
            return view('projects.tasklist', compact('currentWorkspace', 'project', 'tasks', 'statusClass'));
        }
    }
    // view tạo task theo project id
    public function taskCreate($slug, $projectID)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        $projects = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->get();
        $users = User::select('users.*')->join('user_projects', 'user_projects.user_id', '=', 'users.id')->where('project_id', '=', $projectID)->get();
        return view('projects.taskCreate', compact('currentWorkspace', 'project', 'projects', 'users'));
    }
    // kho task theo project id
    public function taskStore(Request $request, $slug, $projectID)
    {
        $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'assign_to' => 'required',
            'due_date' => 'required',
        ]);
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $request->project_id)->first();

        if ($project) {
            $post = $request->all();
            $task = Task::create($post);
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'project_id' => $projectID,
                'log_type' => 'Create Task',
                'remark' => Auth::user()->name . ' ' . __('Create new Task') . " <b>" . $task->title . "</b>"
            ]);
            event(new FetchTaskBoard());
            return redirect()->route('projects.task.board', [$currentWorkspace->slug, $request->project_id])->with('success', __('Task Create Successfully!'));
        } else {
            event(new FetchTaskBoard());
            return redirect()->route('projects.task.board', [$currentWorkspace->slug, $request->project_id])->with('error', __('You can \'t Add Task!'));
        }
    }
    // update tiến trình của task theo project id
    public function taskOrderUpdate(Request $request, $slug, $projectID)
    {

        if (isset($request->sort)) {
            foreach ($request->sort as $index => $taskID) {
                echo $index . "-" . $taskID;
                $task = Task::find($taskID);
                $task->order = $index;
                $task->save();
            }
        }
        if ($request->new_status != $request->old_status) {
            $task = Task::find($request->id);
            $task->status = $request->new_status;
            $task->save();
            $name = Auth::user()->name;
            $id = Auth::user()->id;

            ActivityLog::create([
                'user_id' => $id,
                'project_id' => $projectID,
                'log_type' => 'Move',
                'remark' => $name . " " . __('Move Task') . " <b>" . $task->title . "</b> " . __('from') . " " . ucwords($request->old_status) . " " . __('to') . " " . ucwords($request->new_status)
            ]);
            event(new FetchTaskBoard());
            return $task->toJson();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // view cập nhật nội dung của task theo project id
    public function taskEdit($slug, $projectID, $taskId)
    {
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $projectID)->first();
        $projects = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->get();
        $users = User::select('users.*')->join('user_projects', 'user_projects.user_id', '=', 'users.id')->where('project_id', '=', $projectID)->get();
        $task = Task::find($taskId);
        return view('projects.taskEdit', compact('currentWorkspace', 'project', 'projects', 'users', 'task'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    // thực hiện cập nhật nội dung của task theo project id
    public function taskUpdate(Request $request, $slug, $projectID, $taskID)
    {
        $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'assign_to' => 'required',
            'due_date' => 'required',
        ]);
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::where('created_by', '=', $objUser->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.id', '=', $request->project_id)->first();

        if ($project) {
            $post = $request->all();
            $task = Task::find($taskID);
            $task->update($post);
            return redirect()->route('projects.task.board', [$currentWorkspace->slug, $request->project_id])->with('success', __('Task Updated Successfully!'));
        } else {
            return redirect()->route('projects.task.board', [$currentWorkspace->slug, $request->project_id])->with('error', __('You can \'t Edit Task!'));
        }
    }
    // xóa task theo project id
    public function taskDestroy($slug, $projectID, $taskID)
    {
        $objUser = Auth::user();
        $task = Task::find($taskID);
        $project = Project::find($task->project_id);
        if ($project->created_by == $objUser->id) {
            $task->delete();
            return redirect()->route('projects.task.board', [$slug, $projectID])->with('success', __('Task Deleted Successfully!'));
        } else {
            return redirect()->route('projects.task.board', [$slug, $projectID])->with('error', __('You can\'t Delete Task!'));
        }
    }
    // hiện task theo project id theo các idUser


    //xóa lưu trữ commnet theo project id theo các idUser
    public function commentDestroy(Request $request, $slug, $projectID, $taskID, $commentID)
    {
        $comment = Comment::find($commentID);
        $comment->delete();
        return "true";
    }

    //xóa lưu trữ commnet dưới dạng file theo project id theo các idUser
    public function commentDestroyFile(Request $request, $slug, $projectID, $taskID, $fileID)
    {
        $commentFile = TaskFile::find($fileID);
        $path = storage_path('tasks/' . $commentFile->file);
        if (file_exists($path)) {
            \File::delete($path);
        }
        $commentFile->delete();
        return "true";
    }
    // search project và task theo đúng workspace của User
    public function getSearchJson($slug, $search)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $objProject = Project::select(['projects.id', 'projects.name'])->join('user_projects', 'user_projects.project_id', '=', 'projects.id')->where('user_projects.user_id', '=', Auth::user()->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('projects.name', 'LIKE', $search . "%")->get();
        $arrProject = [];
        foreach ($objProject as $project) {
            $arrProject[] = ['text' => $project->name, 'link' => route('projects.show', [$currentWorkspace->slug, $project->id])];
        }

        $objTask = Task::select(['tasks.project_id', 'tasks.title'])->join('projects', 'tasks.project_id', '=', 'projects.id')->join('user_projects', 'user_projects.project_id', '=', 'projects.id')->where('user_projects.user_id', '=', Auth::user()->id)->where('projects.workspace', '=', $currentWorkspace->id)->where('tasks.title', 'LIKE', $search . "%")->get();
        $arrTask = [];
        foreach ($objTask as $task) {
            $arrTask[] = ['text' => $task->title, 'link' => route('projects.task.board', [$currentWorkspace->slug, $task->project_id])];
        }

        return json_encode(['Projects' => $arrProject, 'Tasks' => $arrTask]);
    }
    //view các cột mốc của projectID
    public function milestone($slug, $projectID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::find($projectID);
        return view('projects.milestone', compact('currentWorkspace', 'project'));
    }
    //kho lưu trữ dữ liệu các cột mốc của projectID
    public function milestoneStore($slug, $projectID, Request $request)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::find($projectID);
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'cost' => 'required'
        ]);

        $milestone = new Milestone();
        $milestone->project_id = $project->id;
        $milestone->title = $request->title;
        $milestone->status = $request->status;
        $milestone->cost = $request->cost;
        $milestone->summary = $request->summary;
        $milestone->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'log_type' => 'Create Milestone',
            'remark' => Auth::user()->name . " " . __('Create new Milestone') . " <b>" . $milestone->title . "</b>"
        ]);

        return redirect()->back()->with('success', __('Milestone Created Successfully!'));
    }
    //view chỉnh sửa dữ liệu các cột mốc theo milestoneID
    public function milestoneEdit($slug, $milestoneID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $milestone = Milestone::find($milestoneID);
        return view('projects.milestoneEdit', compact('currentWorkspace', 'milestone'));
    }
    //thực hiện chỉnh sửa dữ liệu các cột mốc theo milestoneID
    public function milestoneUpdate($slug, $milestoneID, Request $request)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);

        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'cost' => 'required'
        ]);

        $milestone = Milestone::find($milestoneID);
        $milestone->title = $request->title;
        $milestone->status = $request->status;
        $milestone->cost = $request->cost;
        $milestone->summary = $request->summary;
        $milestone->save();
        return redirect()->back()->with('success', __('Milestone Updated Successfully!'));
    }
    //xóa dữ liệu các cột mốc theo milestoneID
    public function milestoneDestroy($slug, $milestoneID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $milestone = Milestone::find($milestoneID);
        $milestone->delete();
        return redirect()->back()->with('success', __('Milestone deleted Successfully!'));
    }
    //view cột mốc theo milestoneID
    public function milestoneShow($slug, $milestoneID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $milestone = Milestone::find($milestoneID);
        return view('projects.milestoneShow', compact('currentWorkspace', 'milestone'));
    }

    public function fileUpload($slug, $id, Request $request)
    {
        $project = Project::find($id);
        $request->validate(['file' => 'required|mimes:png,jpeg,jpg,pdf,doc,txt|max:2048']);
        $file_name = $request->file->getClientOriginalName();
        $file_path = $project->id . "_" . md5(time()) . "_" . $request->file->getClientOriginalName();
        $request->file->storeAs('project_files', $file_path);

        $file = ProjectFile::create([
            'project_id' => $project->id,
            'file_name' => $file_name,
            'file_path' => $file_path,
        ]);
        $return = [];
        $return['is_success'] = true;
        $return['download'] = route('projects.file.download', [$slug, $project->id, $file->id]);
        $return['delete'] = route('projects.file.delete', [$slug, $project->id, $file->id]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'log_type' => 'Upload File',
            'remark' => Auth::user()->name . ' ' . __('Upload new file') . ' <b>' . $file_name . '</b>'
        ]);

        return response()->json($return);
    }
    // dowloadfle
    public function fileDownload($slug, $id, $file_id)
    {

        $project = Project::find($id);

        $file = ProjectFile::find($file_id);
        if ($file) {
            $file_path = storage_path('project_files/' . $file->file_path);
            $filename = $file->file_name;
            return \Response::download($file_path, $filename, [
                'Content-Length: ' . filesize($file_path)
            ]);
        } else {
            return redirect()->back()->with('error', __('File is not exist.'));
        }
    }

    public function fileDelete($slug, $id, $file_id)
    {
        $project = Project::find($id);

        $file = ProjectFile::find($file_id);
        if ($file) {
            $path = storage_path('project_files/' . $file->file_path);
            if (file_exists($path)) {
                \File::delete($path);
            }
            $file->delete();
            return response()->json(['is_success' => true], 200);
        } else {
            return response()->json(['is_success' => false, 'error' => __('File is not exist.')], 200);
        }
    }
    public function subTaskStore(Request $request, $slug, $projectID, $taskID)
    {
        $post = [];
        $post['task_id'] = $taskID;
        $post['name'] = $request->name;
        $post['due_date'] = $request->due_date;
        $post['status'] = 0;

        $post['created_by'] = Auth::user()->id;
        $post['user_type'] = 'User';
        $subtask = SubTask::create($post);
        if ($subtask->user_type == 'Client') {
            $user = $subtask->client;
        } else {
            $user = $subtask->user;
        }
        $subtask->updateUrl = route('subtask.update', [$slug, $projectID, $subtask->id]);
        $subtask->deleteUrl = route('subtask.destroy', [$slug, $projectID, $subtask->id]);
        return $subtask->toJson();
    }
    public function subTaskUpdate($slug, $projectID, $subtaskID)
    {
        $subtask = SubTask::find($subtaskID);
        if ($subtask->status == 0) {
            $subtask->status = 1;
        } else {
            $subtask->status = 0;
        }
        $subtask->save();
        return $subtask->toJson();
    }
    public function subTaskDestroy($slug, $projectID, $subtaskID)
    {
        $subtask = SubTask::find($subtaskID);
        $subtask->delete();
        return "true";
    }


    public function commentStore(Request $request, $slug, $projectID, $taskID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = [];
        $post['task_id'] = $taskID;
        $post['comment'] = $request->comment;

        $post['created_by'] = Auth::user()->id;
        $post['user_type'] = 'User';

        $comment = Comment::create($post);
        if ($comment->user_type == 'Client') {
            $user = $comment->client;
        } else {
            $user = $comment->user;
        }
        $comment->deleteUrl = route('comment.destroy', [$currentWorkspace->slug, $projectID, $taskID, $comment->id]);

        return $comment->toJson();
    }

    public function commentStoreFile(Request $request, $slug, $projectID, $taskID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $request->validate(
            ['file' => 'required|mimes:jpeg,jpg,png,gif,svg,pdf,txt,doc,docx,zip,rar|max:2048']
        );
        $fileName = $taskID . time() . "_" . $request->file->getClientOriginalName();
        $request->file->storeAs('tasks', $fileName);
        $post['task_id'] = $taskID;
        $post['file'] = $fileName;
        $post['name'] = $request->file->getClientOriginalName();
        $post['extension'] = "." . $request->file->getClientOriginalExtension();
        $post['file_size'] = round(($request->file->getSize() / 1024) / 1024, 2) . ' MB';

        $post['created_by'] = Auth::user()->id;
        $post['user_type'] = 'User';
        $TaskFile = TaskFile::create($post);
        $user = $TaskFile->user;
        $TaskFile->deleteUrl = route('comment.destroy.file', [$currentWorkspace->slug, $projectID, $taskID, $TaskFile->id]);
        return $TaskFile->toJson();
    }
}
