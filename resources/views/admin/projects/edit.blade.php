@extends('layouts.app')

@section('title', 'Edit Project Info')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <form class="col-8 bg-light p-3 rounded" action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Title
                    </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old ('title', $project->title) }}">
                </div>
                <div class="mb-3">
                    <label for="repo" class="form-label">
                        Repository name
                    </label>
                    <input type="text" class="form-control" id="repo" name="repo" value="{{ old ('repo', $project->repo) }}">
                </div>
                <div class="mb-3">
                    <div>
                        <label for="language" class="form-label">
                            Technologies
                        </label>
                    </div>
                    <div class="self-align-center">
                        @foreach ($techList as $tech)
                            <input class="form-check-input" type="checkbox" name="technologies[]" id="technologies" value="{{$tech->id}}"
                                @if($project->technologies->contains($tech->id)) checked @endif>
                            <label for="technologies" class="form-check-label me-2"> {{$tech->language}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <div class=" col mb-3">
                        <label for="image" class="form-label">
                            Image
                        </label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ old('image', '') }}">
                    </div>
                    <div class="col mb-3">
                        <label for="type_id" class="form-label">
                            Type
                        </label>
                        <select class="form-select" aria-label="Default select example" id="type_id" name="type_id" value="{{ old ('type', $project->type_id) }}">
                            <option selected>Select a project type</option>
                            @foreach ($typeList as $type)
                                <option value="{{$type->id}}" {{old('type_id', $project->type_id) == $type->id ? 'selected' : ''}}>    
                                    {{$type->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">
                            Date
                        </label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $project->date) }}">
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <a href="{{ route('admin.projects.index')}}" class="btn btn-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
                
            </form>
        </div>
    </div>
@endsection