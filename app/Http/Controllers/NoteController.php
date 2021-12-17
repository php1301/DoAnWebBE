<?php

namespace App\Http\Controllers;

use App\Note;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// view note index
    public function index($slug)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::select(['id', 'title', 'text', 'color'])->where('workspace', '=', $currentWorkspace->id)->get();
        return view('notes.index', compact('currentWorkspace', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // view tạo note
    public function create($slug)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('notes.create', compact('currentWorkspace'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // tạo kho note của workspace 
    public function store($slug, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'color' => 'required',
        ]);
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $objUser = Auth::user();
        $post = $request->all();
        $post['workspace'] = $currentWorkspace->id;
        $post['created_by'] = $objUser->id;
        Note::create($post);
        return redirect()->route('notes.index', $currentWorkspace->slug)
            ->with('success', 'Note   created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    // view note edit
    public function edit($slug, $noteID)
    {
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::where('workspace', '=', $currentWorkspace->id)->where('created_by', '=', Auth::user()->id)->where('id', '=', $noteID)->first();
        return view('notes.edit', compact('currentWorkspace', 'notes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    // edit note by idnote
    public function update(Request $request, $slug, $noteID)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'color' => 'required',
        ]);
        $objUser = Auth::user();
        $currentWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::where('workspace', '=', $currentWorkspace->id)->where('created_by', '=', Auth::user()->id)->where('id', '=', $noteID)->first();
        $notes->update($request->all());
        return redirect()->route('notes.index', $slug)
            ->with('success', __('Note Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    // xóa note by idnode
    public function destroy($slug, $noteID)
    {
        $objUser = Auth::user();
        $note = Note::find($noteID);
        if ($note->created_by == $objUser->id) {
            $note->delete();
            return redirect()->route('notes.index', $slug)->with('success', __('Note Deleted Successfully!'));
        } else {
            return redirect()->route('notes.index', $slug)->with('error', __('You can\'t delete Note!'));
        }
    }
}
