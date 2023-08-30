<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectList=Project::Paginate(15);
        return view('admin.projects.index', compact('projectList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeList = Type::all();
        $techList = Technology::all();
        return view('admin.projects.create', compact('typeList', 'techList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $img_path = Storage::put('uploads', $request['image']);
        $data['image']=$img_path;
        $newProject = Project::create($data);
        $newProject->save();

        if ($request->has('technologies')){
            $newProject->technologies()->sync( $request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('created', $newProject->title);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $typeList = Type::all();
        $techList = Technology::all();
        return view('admin.projects.edit', compact('project','typeList', 'techList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        

        $project = Project::findOrFail($id);
        
        if ($request->hasFile('image')){
            Storage::delete($project->image);
            $img_path = Storage::put('uploads/posts', $request['image']);
            $data['image'] = $img_path;
        }
        
        $img_path = Storage::put('uploads', $request['image']);
        $data['image'] = $img_path;
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('updated', $project->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', $project->name);
    }
    
    public function binned()
    {
        $projectList = Project::onlyTrashed()->paginate(10);
        return view('admin.projects.bin', compact('projectList'));
    }
    
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('admin.projects.index')->with('restored', $project->name);
    }
    
    public function destroy(string $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        Storage::delete($project->image);
        $project->technologies()->detach();
        $project->forceDelete();
        return redirect()->route('admin.projects.bin')->with('destroyed', $project->name);
    }
}
