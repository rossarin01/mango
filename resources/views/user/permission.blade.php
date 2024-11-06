<input type="hidden" class="form-control" id="pms_user_id" name="pms_user_id" value="{{ $user->id }}">
<div class="row">
    @php
        $header_group = '';
    @endphp
@foreach ($permissions as $permission)
    @php
        $checked = '';
        foreach ($user_permission as $usr_pre){
            if($permission->name == $usr_pre){
                $checked = 'checked';
            }
        }
        $permission_array = explode('.', $permission->name);
        $per = collect($permission_group[$permission_array[0]]);
        $permission_name = $per->where('group', $permission_array[0])->where('action', $permission_array[1])->pluck('name')->first();
    @endphp

    @if($header_group !=  $permission_array[0])
        <hr class="mt-1">
        <div class="col-12 mb-1"><strong>{{ $permission_header[$permission_array[0]] }}</strong></div>
        @php
            $header_group = $permission_array[0];
        @endphp
    @endif

    <div class="col-3 mb-2">
        <input type="checkbox" id="check_{{$permission->id}}" name="check_permission[]" value="{{ $permission->name }}" {{ $checked }}>
        <label for="check_{{$permission->id}}">
            {{ $permission_name }}
        </label>
    </div>
@endforeach
</div>
