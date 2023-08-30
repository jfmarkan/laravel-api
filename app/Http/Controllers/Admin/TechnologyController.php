<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techList = Technology::all();
        return view('admin.technologies.index', compact('techList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $img_path = Storage::put('uploads/technologies/logos', $request['image']);
        $data['image']=$img_path;
        $newTechnology = Technology::create($data);
        $newTechnology->save();

        return redirect()->route('admin.dashboard')->with('createdTech', $newTechnology->title);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $technology = Technology::findOrFail($id);
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $technology = Technology::findOrFail($id);
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('deleted', $technology->name);
    }
    
    public function binned()
    {
        $technologyList = Technology::onlyTrashed()->paginate(10);
        return view('admin.technologies.bin', compact('technologyList'));
    }
    
    public function restore($id)
    {
        $technology = Technology::withTrashed()->findOrFail($id);
        $technology->restore();
        return redirect()->route('admin.technologies.index')->with('restored', $technology->name);
    }
    
    public function destroy(string $id)
    {
        $technology = Technology::onlyTrashed()->findOrFail($id);
        $technology->forceDelete();
        return redirect()->route('admin.technologies.bin')->with('destroyed', $technology->name);
    }
}
