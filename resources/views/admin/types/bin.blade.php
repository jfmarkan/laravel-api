@extends('layouts.app')

@section('title', 'Types Index')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($typeList as $type)
                            <tr>
                                <th scope="row">
                                    {{ $type->id }}
                                </th>
                                <td>
                                    {{ $type->name  }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.types.restore', $type->id) }}" class="d-inline form-restorer" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('admin.types.destroy', $type->id)}}" class="d-inline form-terminator" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
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
        {!! $typeList->links() !!}
    </div>
@endsection

@section('custom-scripts')
    <script>
        const deleteFormElements = document.querySelectorAll('form.form-terminator');
        const restoreFormElements = document.querySelectorAll('form.form-restorer');

        deleteFormElements.forEach(deleteformElement => {
            deleteformElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to permanently delete this Type?');
                if (userConfirm){
                    this.submit();
                }
            });
        });

        restoreFormElements.forEach(restoreformElement => {
            restoreformElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to restore this Type?');
                if (userConfirm){
                    this.submit();
                }
            });
        });
    </script>
@endsection