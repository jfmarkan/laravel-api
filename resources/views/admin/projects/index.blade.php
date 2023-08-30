@extends('layouts.app')

@section('title', 'Projects Index')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if (session('deleted'))
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-xmark"></i> <strong>{{ session('deleted') }}</strong> has been succesfully deleted.
                    </div>
                </div>
            @elseif ( session('created'))
                <div class="col-12">
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('created') }}</strong> has been succesfully created.
                    </div>
                </div>
            @elseif ( session('updated'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('updated') }}</strong> has been succesfully updated.
                    </div>
                </div>
            @elseif ( session('restored'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('restored') }}</strong> has been succesfully restored.
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-dark text-light">Id</th>
                            <th scope="col" class="bg-dark text-light">Title</th>
                            <th scope="col" class="bg-dark text-light">Repository name</th>
                            <th class="text-center bg-dark text-light">Languages</th>
                            <th class="text-center bg-dark text-light">Type</th>
                            <th class="text-center bg-dark text-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectList as $project)
                            <tr>
                                <th scope="row">
                                    {{ $project->id }}
                                </th>
                                <td>
                                    {{ $project->title }}
                                </td>
                                <td>
                                    {{ $project->repo }}
                                </td>
                                <td class="text-center">
                                    @if (count ($project->technologies) > 0)
                                        @foreach ($project->technologies as $technology)
                                            <img src="{{ asset('storage/' . $technology->image) }}" alt="{{$technology->name}}'s Logo" id="language-logo">
                                        @endforeach
                                     @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{$project->type->color}}">{{ $project->type->name }}</span>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary me-2"
                                        href="{{ route('admin.projects.show', $project->id) }}">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <a class="btn btn-sm btn-success me-2"
                                        href="{{ route('admin.projects.edit', $project->id) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.delete', $project->id) }}" class="d-inline form-terminator" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {!! $projectList->links() !!}
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