@extends('./layout/master')

@section('head')

@endsection

@section('content')
<div class="full-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Checkin-Checkout</h1>
                    <div class="col-2">
                        <input type="month" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        @foreach ($checkin_checkouts as $checkin )
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            {{ $checkin->workdate }}
                        </div>
                        <div class="col-10">
                            <button type="button" class="btn btn-warning btn_edit" data-checkin_id="{{ $checkin->id }}">Edit</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <div>Checkin</div>
                            <span>{{ date('H:i', strtotime($checkin->morning_shift)) }}</span>
                        </div>
                        <div class="col-3">
                            <div>Checkout</div>
                            <span>{{ date('H:i', strtotime($checkin->morning_end)) }}</span>
                        </div>
                        <div class="col-3">
                            <div>Checkin</div>
                            <span>{{ date('H:i', strtotime($checkin->evening_shift)) }}</span>
                        </div>
                        <div class="col-3">
                            <div>Checkout</div>
                            <span>{{ date('H:i', strtotime($checkin->evening_end)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edittimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request Change Time</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="morning_shift">Workdate</label>
                    <input type="date" class="form-control" id="workdate" name="workdate" readonly>
                  </div>
                <div class="form-group mt-3">
                  <label for="morning_shift">Checkin morning</label>
                  <input type="time" class="form-control" id="morning_shift" name="morning_shift">
                </div>
                <div class="form-group mt-3">
                    <label for="morning_end">Checkout morning</label>
                    <input type="time" class="form-control" id="morning_end" name="morning_end">
                </div>
                <div class="form-group mt-3">
                    <label for="evening_shift">Checkin evening</label>
                    <input type="time" class="form-control" id="evening_shift" name="morning_shift">
                  </div>
                  <div class="form-group mt-3">
                      <label for="evening_end">Checkout evening</label>
                      <input type="time" class="form-control" id="evening_end" name="evening_end">
                  </div>
                  <div class="form-group mt-3">
                    <label for="detail" class="form-label">Detail</label>
                    <textarea class="form-control" id="detail" rows="3" required></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="close btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
<script>
    $(document).on('click', '.btn_edit', function(e){
        e.preventDefault();
        let checkin_id = $(this).data('checkin_id');
        $('#edittimeModal').modal('show');
    });

    $(document).on('click', '.close', function(e){
        $('#edittimeModal').modal('hide');
    });
</script>
@endsection
