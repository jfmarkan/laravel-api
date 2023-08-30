@extends('layouts.app')

@section('title', 'View Project Detail')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-around">
        <article class="card p-0 m-2 position-relative">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $project->id }} - {{ $project->title }}
                </h5>
                <div class="d-flex gap-3">
                    <h6>
                        Type: <span class="badge bg-{{$project->type->color}}">{{$project->type->name}}</span>
                    </h6>
                </div>
                <img src="{{ asset('storage/' . $project->image)}}" alt="{{ $project->title }}'s Image">
                <p class="card-text">
                    Development date: {{ $project->date }}
                </p>
                <p>
                    <span class="fw-bold">Languages: </span>
                    @if (count ($project->technologies) > 0)
                        @foreach ($project->technologies as $technology)
                            <img src="{{ asset('storage/' . $technology->image) }}" alt="{{$technology->name}}'s Logo" id="language-logo">
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="position-absolute mt-2 top-0 end-0">
                <a class="btn btn-sm btn-success me-2" href="{{ route('admin.projects.edit', $project->id) }}">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <form action="{{ route('admin.projects.delete', $project->id) }}" class="d-inline form-terminator me-2" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </article>
    </div>
</div>
@endsection

@section('custom-scripts')
    <script>
        const deleteFormElements = document.querySelectorAll('form.form-terminator');
        deleteFormElements.forEach(formElement => {
            formElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to delete this Project?');
                if (userConfirm){
                    this.submit();
                }
            });
        });
    </script>
@endsection