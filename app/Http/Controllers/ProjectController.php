<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function index()
    {
       $Project = Project::latest()->paginate(5);
  
       return view('index', compact('Project'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
  
    public function create()
    {
        return view('create');
    }
  
  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'responsible' => 'required',
            'sdate' => 'required',
            'edate' => 'required'
            
        ]);
  
        Project::create(array_merge($request->all(), ['status' => 'active']));
  
        $Project = Project::latest()->paginate(5);
  
        return view('index', compact('Project'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->with('sucess', 'Project updated sucessfully!');
    }
  
    public function show($id)
    {
        $Project = Project::find($id);
  
        return view('show', compact('Project'));
    }
  
    public function edit($id)
    {
        $Project = Project::find($id);
        return view('edit', compact('Project', 'id'));
    }
  
    public function update($id, Request $request)
    {
  
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'responsible' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
            'status' => 'required'
        ]);
  
  
        $Project = Project::find($id);
        $Project->title = request('title');
        $Project->text = request('text');
        $Project->responsible = request('responsible');
        $Project->status = request('status');
        $Project->save();
  
         
        $Project = Project::latest()->paginate(5);
        return view('index', compact('Project'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    public function destroy($id)
    {
        $Project = Project::find($id);
        if($Project->status === 'active'){
            $Project->status = 'complete';
        }elseif($Project->status === 'complete'){
            $Project->status = 'deleted';
        }
        else{
            $Project->status = 'active';
        }
        $Project->save();
  
         
        $Project = Project::latest()->paginate(5);
        return view('index', compact('Project'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
  
    }
 
}
