@extends('layouts.app')

@section('title', 'Edit Project Info')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <form class="col-8 bg-light p-3 rounded" action="{{ route('admin.technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="language" class="form-label">
                        Language
                    </label>
                    <input type="text" class="form-control" id="language" name="language" value="{{ old ('language', $technology->language) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">
                        Logo
                    </label>
                    <input type="file" class="form-control" id="image" name="image" value="{{ old ('image', $technology->image) }}">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-check"></i>
                </button>
                <a href="{{ route('admin.technologies.index')}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </form>
        </div>
    </div>
@endsection