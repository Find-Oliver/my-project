@extends('layouts.main')

@section('content')

<style>
    .table {
    width: 100%;
    table-layout: fixed; /* ✅ important */
    border-collapse: collapse;
}

.table th,
.table td {
    text-align: center;
    vertical-align: middle;
    padding: 10px;
}

/* Header */
.table th {
    background-color: #343a40;
    color: #fff;
}

/* ✅ EXACT 4 COLUMN CONTROL */
.table th:nth-child(1),
.table td:nth-child(1) {
    width: 10%; /* No */
}

.table th:nth-child(2),
.table td:nth-child(2) {
    width: 20%; /* ID */
}

.table th:nth-child(3),
.table td:nth-child(3) {
    width: 40%; /* User ID */
    overflow: hidden;
    text-overflow: ellipsis;
}

.table th:nth-child(4),
.table td:nth-child(4) {
    width: 30%; /* Actions */
    white-space: nowrap;
}

/* Buttons inside Actions */
.table td:last-child .btn {
    padding: 4px 8px;
    font-size: 12px;
    margin: 2px;
}

/* Responsive */
.table-responsive {
    overflow-x: auto;
}
    .table th {
        vertical-align: middle;
        background-color: #343a40;
        color: #fff;
    }
    .addcategory {
        margin-bottom: 15px;
        color: #28a745
    }
</style>

<div class="card">
    <div class="card-body">

        <!-- ✅ ADD BUTTON -->
        <button class="btn mb-3" onclick="addConducted_by()" style="background-color:#28a745; color:white;">
            Add
        </button>

        <!-- ✅ TABLE -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="conducted_by_tbody"></tbody>
        </table>

    </div>
</div>

<!-- ✅ MODAL -->
<div class="modal fade" id="conducted_byModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 id="modal-title">Title</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <form id="conducted_byForm">
                    @csrf
                    <input type="hidden" id="conducted_by_id" name="conducted_by_id">


                    <div class="form-group">
                        <label>User ID</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">Select User</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveConducted_by()">Save</button>
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ✅ SCRIPT INSIDE SECTION -->
<script>
    // LOAD DATA
    window.onload = function () {
        fetchConducted_by();
    };

    // ✅ OPEN ADD MODAL
     function addConducted_by() {
        $('#modal-title').text('Add Conducted_By');
        $('#conducted_by_id').val('');
        $('#conducted_byForm')[0].reset();
        fetchStaff();
        $('#conducted_byModal').modal('show');
    }
    function fetchStaff() {
        $('#user_id').empty();

        $.ajax({
            url: "{{ route('response.fetch_employee') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                $.each(response, function(index, staff) {
                    $('#user_id').append(
                        `<option value="${staff.user_id}">${staff.name}</option>`
                    );

                });

                // 👉 INIT AFTER DATA IS LOADED
                $('#user_id').select2({
                    dropdownParent: $('#conducted_byModal'),
                    placeholder: "Select Staff",
                    allowClear: true,
                    width: '100%'
                });


            },
        });
    }

    // ✅ FETCH DATA
    function fetchConducted_by() {
        $.ajax({
            url: "{{ route('conducted_by.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                $('#conducted_by_tbody').empty();

                $.each(response, function(index, conducted_by) {
                    $('#conducted_by_tbody').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${conducted_by.staff.first_name} ${conducted_by.staff.last_name}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editConducted_by(${conducted_by.user_id})">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteConducted_by(${conducted_by.user_id})">Delete</button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // ✅ SAVE
    function saveConducted_by() {
        let formData = $('#conducted_byForm').serialize();

        $.ajax({
            url: "{{ route('conducted_by.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {

                $('#conducted_byModal').modal('hide');

                if (response.status === true) {
                        toastr.success('Saved successfully!');
                    } else {
                        toastr.error('Save failed.');
                    }

                fetchConducted_by();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // ✅ EDIT
    function editConducted_by(id) {
        $.ajax({
            url: "{{ route('conducted_by.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                conducted_by_id: id
            },
            success: function(response) {

                $('#modal-title').text('Edit Conducted_By');
                $('#conducted_by_id').val(response.id);
                fetchStaff();
                $('#user_id').val(response.user_id);
                $('#conducted_byModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // ✅ DELETE
    function deleteConducted_by(id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "This record will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('conducted_by.delete') }}",
                method: 'POST',
                data: {
                    conducted_by_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchConducted_by();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}
</script>

@endsection
