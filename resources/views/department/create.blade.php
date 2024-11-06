@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('department.index') }}" class="btn btn-primary">Back</a>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                    <form id="form_department">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name='branch' class="select2-icons form-select branch">
                                            @foreach ($branchs as $branch)
                                                @if(!is_null($department) && $department->branch_id == $branch->id)
                                                    <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                                @else
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <input type="hidden" name="department_id" id="department_id" value="{{ $department->id ?? '' }}" class="form-control" >
                                    <div class="form-group">
                                        <label for="department_name">Department Name</label>
                                        <input type="text" name="department_name" id="department_name" value="{{ $department->department_name ?? '' }}"  class="form-control" placeholder="Branch Name" required>
                                    </div>
                                    <br>
                                    <button type="submit" form="form_department" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#form_department").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("department.store") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire({
                        title: "Save Complate.!",
                        text: "successfuly save complate",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.href = '{{route("department.index")}}';
                }
            },
            error: function(response) {
                Swal.fire({
                    title: "Can not Save.!",
                    text: response.responseJSON.message,
                    icon: "error",
                    allowOutsideClick: false,
                });
                console.log("error");
                console.log(response.responseJSON);
            }
        });
    });

</script>
@endsection
