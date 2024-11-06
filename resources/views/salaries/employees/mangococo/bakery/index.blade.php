@extends('./layout/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <a href="{{ route('salaries.employees.mangococo.bakery.create') }}" class="btn btn-primary">Add</a>
                        <!-- ปุ่มลบหลายรายการ -->
                        <form id="bulk-delete-form" action="{{ route('salaries.employees.mangococo.bakery.bulkDelete') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete employees?')">Delete</button>
                        </form>
                        <!-- ปุ่ม Edit (แก้ไขพนักงานที่เลือก) -->
                        <a href="#" class="btn btn-secondary" id="edit-selected" onclick="editSelected()">Edit</a>

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                    </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <!-- Checkbox สำหรับเลือกทั้งหมด -->
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Payment
                                                <div>Method</div></th>
                                            <th>Payment
                                                <div>Type</div></th>
                                            <th>Bank</th>
                                            <th>Account
                                                <div>Number</div></th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salaries as $salary)
                                            <tr>
                                                <!-- Checkbox สำหรับเลือกพนักงาน -->
                                                <td><input type="checkbox" name="employee_ids[]" value="{{ $salary->id }}"></td>
                                                <td>{{ $salary->employees_id }}</td>
                                                <td>{{ $salary->name }}</td>
                                                <td>{{ $salary->department }}</td>
                                                <td>{{ $salary->payment_method }}</td>
                                                <td>{{ $salary->payment_type }}</td>
                                                <td>{{ $salary->bank }}</td>
                                                <td>{{ $salary->account_number }}</td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <label class="btn btn-label-success" for="btnradio1">
                                                        <a href="{{ route('salaries.employees.mangococo.bakery.edit', $salary->id) }}"></a>
                                                        <i class="tf-icons ti ti-pencil"></i>
                                                    </label>
                                                    <label class="btn btn-label-danger" for="btnradio2">
                                                        <form action="{{ route('salaries.employees.mangococo.bakery.destroy', $salary->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"onclick="return confirm('Are you sure you want to delete this employee?')"></button>
                                                            <i class="tf-icons ti ti-trash"></i>
                                                        </form>
                                                    </label>
                                                </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript สำหรับจัดการ Edit และ Delete Selected -->
<script>
    // ฟังก์ชัน Edit Selected
    function editSelected() {
        var selectedEmployees = [];
        document.querySelectorAll('input[name="select-employee"]:checked').forEach(function(checkbox) {
            selectedEmployees.push(checkbox.value);
        });

        if (selectedEmployees.length === 1) {
            var editUrl = "{{ route('salaries.employees.mangococo.bakery.edit', ':id') }}";
            editUrl = editUrl.replace(':id', selectedEmployees[0]);
            window.location.href = editUrl;
        } else if (selectedEmployees.length === 0) {
            alert('Please select an employee to edit');
        } else {
            alert('Please select only one employee for editing');
        }
    }

    // เลือก/ยกเลิกเลือกทุกแถว
    document.getElementById('select-all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="select-employee"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('select-all').checked;
        });
    });
</script>
@endsection
