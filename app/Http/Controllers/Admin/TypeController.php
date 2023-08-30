<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeList=Type::Paginate(15);
        return view('admin.types.index', compact('typeList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newType = Type::create($data);
        $newType->save();

        return redirect()->route('admin.types.index')->with('created', $newType->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = Type::findOrFail($id);
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $type = Type::findOrFail($id);
        $type->update($data);
        return redirect()->route('admin.types.index')->with('updated', $type->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('admin.types.index')->with('deleted', $type->name);
    }
    
    public function binned()
    {
        $typeList = Type::onlyTrashed()->paginate(10);
        return view('admin.types.bin', compact('typeList'));
    }
    
    public function restore($id)
    {
        $type = Type::withTrashed()->findOrFail($id);
        $type->restore();
        return redirect()->route('admin.types.index')->with('restored', $type->name);
    }
    
    public function destroy(string $id)
    {
        $id = Type::onlyTrashed()->findOrFail($id);
        $id->forceDelete();
        return redirect()->route('admin.types.index')->with('destroyed', $id->name);
    }
}
