@extends('dashboard.layout.app')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-8  col-12 mx-auto">
                <div class="card p-3">
                    <h1>Edit Category</h1>
                    <form action="{{route("dashboard.categories.update",$category->id)}}" method="post">
                        @csrf
                        @method("put")
                        <div class="mb-3">
                            <label for="category" class="form-label required">Name</label>
                            <input type="text" id="category" class="form-control" name="name" required value="{{$category->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label required">Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" required readonly value="{{$category->slug}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")

<script>
    let category = $("#category");
    category.on("keyup", function() {
        let value = $(this).val();
        value = value.replace(/\s+/g, "-");
        value = value.replace(/^-+|-+$/g, "");
        $("#slug").val(value);
    });
</script>


@endsection
