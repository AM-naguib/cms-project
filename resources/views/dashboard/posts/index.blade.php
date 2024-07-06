@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Categories</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Create Category</a>
                        <table id="datatables-reponsive" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr id="ca_{{ $category->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }})"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                destroy: true,
                responsive: true
            });
        });

        function deleteCategory(id) {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('dashboard.categories.destroy', ':id') }}".replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function(result) {
                    Toast.fire({
                        icon: "success",
                        title: result
                    });
                },
                error: function(x) {

                    Toast.fire({
                        icon: "error",
                        title: "Something went wrong"
                    });
                }
            })
        }
    </script>
@endsection
