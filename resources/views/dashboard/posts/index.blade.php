@extends('dashboard.layout.app')
@section('content')
    <h1 class="h3 mb-3">Posts</h1>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 col-xl-4 mb-2 mb-md-0">
                    <div class="input-group input-group-search">
                        <input type="text" class="form-control" id="datatables-posts-search"
                            placeholder="Search Posts" />
                        <button class="btn" type="button">
                            <i class="align-middle" data-lucide="search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-xl-8">
                    <div class="text-sm-end">

                        <a href="{{route('dashboard.posts.create')}}" class="btn btn-primary btn-lg">
                            <i data-lucide="plus"></i> New Post
                        </a>
                    </div>
                </div>
            </div>
            <table id="datatables-posts" class="table w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Episode Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="p_tbody">
                        @forelse ($posts as $post)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img src="{{$post->image()}}" width="50px" height="50px" alt="Post image"></td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{$post->episode_number}}</td>
                            <td>@if ($post->status == 1)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-danger">Unpublished</span>
                            @endif</td>
                            <td>
                                <a href="{{route('dashboard.posts.edit', $post->id)}}" class="btn btn-sm btn-warning rounded">Edit</a>

                                <a onclick="deletePost({{$post->id}})" class="btn btn-sm btn-danger rounded">Delete</a>
                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
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
            $("#datatables-posts").DataTable({
          destroy: true,
          responsive: true,
          order: [[1, "asc"]],
          pageLength: 6,
          columnDefs: [
            {
              targets: 0,
              orderable: false,
              width: "18px",
            },
            {
              targets: 6,
              orderable: false,
            },
          ],
          layout: {
            topStart: null,
            topEnd: null,
            bottomStart: "info",
            bottomEnd: "paging",
          },
        });
        $("#datatables-posts-check-all").click(function () {
          if ($(this).prop("checked")) {
            $("input[type='checkbox']").prop("checked", true);
          } else {
            $("input[type='checkbox']").prop("checked", false);
          }
        });
        $("#datatables-posts-search").keyup(function () {
          $("#datatables-posts").DataTable().search($(this).val()).draw();
        });
        });

        function deletePost(id) {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('dashboard.posts.destroy', ':id') }}".replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function(result) {
                    Toast.fire({
                        icon: "success",
                        title: result
                    });
                    $("#p_tbody").load(window.location.href + " #p_tbody > *");

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
