<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function logged(){
        return view('home');
    }

    public function dashboard(){
        $projectList = Project::Paginate(14, ['*'], 'projects');
        $typeList = Type::Paginate(5, ['*'], 'types');
        $techList = Technology::Paginate(5, ['*'], 'techs');
        return view('admin.dashboard', compact('projectList', 'typeList', 'techList'));
    }
}
