<div class="roster_card mb-3">
    <input type="hidden" name="rostertemp_detail_id[{{ $numItems }}]" value="{{ $rostertemp_detail->id ?? null }}" class="form-control">
    <div class="row mt-3">
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift"><strong> Day {{ $numItems }}</strong></label>
                <input type="hidden" name="day[{{ $numItems }}]" value="{{ $rostertemp_detail->day ?? $numItems }}" class="form-control">
            </div>
        </div>
    </div>

    {{-- <div class="row mt-3">
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift">Date </label>
                <input type="date" name="workdate[{{ $numItems }}]" value="{{ $rostertemp_detail->workdate ?? null }}" class="form-control">
            </div>
        </div>
    </div> --}}

    <div class="row mt-3">
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift">Morning Shift</label>
                <input type="time" name="morning_shift[{{ $numItems }}]" value="{{ $rostertemp_detail->morning_shift ?? null }}" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift">Morning End</label>
                <input type="time" name="morning_end[{{ $numItems }}]" value="{{ $rostertemp_detail->morning_end ?? null }}" class="form-control">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift">Evening Shift</label>
                <input type="time" name="evening_shift[{{ $numItems }}]" value="{{ $rostertemp_detail->evening_shift ?? null }}" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="morning_shift">Evening End</label>
                <input type="time" name="evening_end[{{ $numItems }}]" value="{{ $rostertemp_detail->evening_end ?? null }}" class="form-control">
            </div>
        </div>
    </div>

</div>
<hr>
