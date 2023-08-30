@extends('layouts.app')

@section('title', 'Technologies Index')

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
            @elseif ( session('hardDeleted'))
                <div class="col-12">
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('destroyed') }}</strong> has been permanently deleted.
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="text-center bg-dark text-light">Id</th>
                            <th class="bg-dark text-light">Language</th>
                            <th class="text-center bg-dark text-light">Logo</th>
                            <th class="text-center bg-dark text-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($techList as $tech)
                            <tr>
                                <th scope="row" class="col-1 text-center">
                                    {{ $tech->id }}
                                </th>
                                <td>
                                    {{ $tech->language  }}
                                </td>
                                <td class=" col-1 text-center">
                                    <img src="{{asset('storage/' . $tech->image)}}" alt="{{$tech->language}} logo" id="language-logo">
                                </td>
                                <td class="col-1 text-center">
                                    <a class="btn btn-sm btn-success me-2"
                                        href="{{ route('admin.technologies.edit', $tech->id) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.technologies.delete', $tech->id) }}" class="d-inline form-terminator" method="POST">
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
    </div>
@endsection

@section('custom-scripts')
    <script>
        const deleteFormElements = document.querySelectorAll('form.form-terminator');
        deleteFormElements.forEach(formElement => {
            formElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to delete this Technology?');
                if (userConfirm){
                    this.submit();
                }
            });
        });
    </script>
@endsection