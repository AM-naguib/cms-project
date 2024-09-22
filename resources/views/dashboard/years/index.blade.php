@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Years</h1>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary" onclick="showModal('create')">Create Year</button>
                        <table id="datatables-reponsive" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($years as $year)
                                    <tr id="it_{{ $year->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $year->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal"
                                                onclick="showModal('edit',{{ $year->id }})">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <button class="btn btn-danger" onclick="deleteItem({{ $year->id }})"><i
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
    <div class="modal fade" id="centeredModalPrimary" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#datatables-reponsive").DataTable({
                destroy: true,
                responsive: true
            });
        });

        function deleteItem(id) {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('dashboard.years.destroy', ':id') }}".replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function(result) {
                    $("#it_" + id).remove();
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



        function showModal(type, id = null) {
            if (type === 'create') {
                $('#centeredModalPrimary .modal-title').text('Create Year');

                let route = "{{ route('dashboard.years.store') }}";

                $('#centeredModalPrimary .modal-body').html(modalHtml(route, 'post'));

                $('#centeredModalPrimary').modal('show');

            } else if (type === 'edit') {
                getItem(id).then(function(result) {

                    $('#centeredModalPrimary .modal-title').text('Edit Year');

                    let route = "{{ route('dashboard.years.update', ':id') }}".replace(':id', id);

                    $('#centeredModalPrimary .modal-body').html(modalHtml(route, 'put', result));

                    $('#centeredModalPrimary').modal('show');
                }).catch(function(error) {
                    console.log("Error fetching item:", error);
                });
            }
        }


        function modalHtml(route, method, data = "") {


            return `
        <form action="${route}" id="ajaxForm" method="${method}" onsubmit="formSubmit(event, this)">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" class="form-control" name="name" value="${data.name ? data.name : ''}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>`;
        }

        function formSubmit(e, form) {
            e.preventDefault();

            $.ajax({
                url: $(form).attr('action'),
                type: $(form).attr('method'),
                data: $(form).serialize(),

                success: function(result) {
                    Toast.fire({
                        icon: "success",
                        title: result
                    });
                    $('#centeredModalPrimary').modal('hide');
                    $("#ajaxForm")[0].reset();
                    $("#tbody").load(" #tbody > *");

                },
                error: function(xhr, status, error) {
                    let errorMessage = JSON.parse(xhr.responseText);
                    Toast.fire({
                        icon: "error",
                        title: "Something went wrong"
                    });
                }
            });
        }



        function getItem(id) {
            return $.ajax({
                url: "{{ route('dashboard.years.show', ':id') }}".replace(':id', id),
                type: 'GET'
            }).done(function(result) {
                return result.responseJSON;
            }).fail(function(x) {
                console.log("fe");
            });
        }
    </script>
@endsection
