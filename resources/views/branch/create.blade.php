@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('branch.index') }}" class="btn btn-primary">Back</a>
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
                        <form id="form_branch">
                            @csrf
                                <div class="container">
                                    <div class="col-md-6">
                                        <input type="hidden" name="branch_id" id="branch_id" value="{{ $branch->id ?? '' }}" class="form-control" >
                                        <div class="form-group">
                                            <label for="branch_name">Branch Name</label>
                                            <input type="text" name="branch_name" id="branch_name" value="{{ $branch->branch_name ?? '' }}"  class="form-control" placeholder="Branch Name" required>
                                        </div>
                                        <br>
                                        <button type="submit" form="form_branch" class="btn btn-primary">Save</button>
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
    $("#form_branch").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("branch.store") }}',
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
                    window.location.href = '{{route("branch.index")}}';
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
