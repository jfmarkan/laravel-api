@extends('layouts.app')

@section('title', 'Add New Type')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <form class="col-8 bg-light p-3 rounded" action="{{ route('admin.types.update', $type->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Type Name
                    </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old ('name', $type->name) }}">
                </div>
                <div class="mb-3 col-1">
                    <label for="color" class="form-label">
                        Color
                    </label>
                    <input type="color" class="form-control" id="color" name="color" value="{{ old ('color', $type->color) }}">
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