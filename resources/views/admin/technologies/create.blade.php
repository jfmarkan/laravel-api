@extends('layouts.app')

@section('title', 'Add New Technology')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <form class="col-8 bg-light p-3 rounded" action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="language" class="form-label">
                        Technology Name
                    </label>
                    <input type="text" class="form-control" id="language" name="language">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">
                        Image
                    </label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-check"></i>
                </button>
                <a href="{{ route('admin.types.index')}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </form>
        </div>
    </div>
@endsection