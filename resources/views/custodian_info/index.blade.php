@extends('layouts.main')
@section('content')


<style>
    .table th {
        vertical-align: middle;
        background-color: #343a40;
        color: #fff;
    }
    .addcustodian_info {
        margin-bottom: 15px;
        color: #28a745
    }
    .btn btn-sm btn-info {
        background-color: #007bff;
        color: #fff;
        border: none;
    }
    .btn btn-sm btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }
</style>

<div class="card">
    <div class="card-body">
         <button class="btn btn-primary mb-3" onclick="addCustodianInfo()" style="background-color:#28a745; color:white; border:none;">Add</button>
        {{-- <h1>Custodian Checklist</h1> --}}
        <table id="custodian_info-table" class="table table-bordered">
            <thead>
                <tr style="background-color: #c9c5c5;">
                    <th>No</th>
                    <th>User_Id</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Serial No</th>
                    <th>Mac Address</th>
                    <th>IP Address</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody id="custodian_info_tbody">

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade bs-example-modal-lg" id="Custodian-infoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="custodian-infoForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="custodian-info_id" name="custodian-info_id">
                        <div class="col-md-12">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" required>
                        </div>
                        <div class="col-md-12">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="col-md-12">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" name="model" required>
                        </div>
                        <div class="col-md-12">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                        <div class="col-md-12">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required>
                        </div>
                        <div class="col-md-12">
                            <label for="mac_address">MAC Address</label>
                            <input type="text" class="form-control" id="mac_address" name="mac_address" required>
                        </div>
                        <div class="col-md-12">
                            <label for="ip_address">IP Address</label>
                            <input type="text" class="form-control" id="ip_address" name="ip_address" required>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveCustodianInfo()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.onload = function() {
        fetchCustodianInfo();
    }
// add custodian info modal
   function addCustodianInfo() {
        $('#modal-title').text('Add Custodian Info');
        $('#custodian-info_id').val('');
        $('#custodian-infoForm')[0].reset();
        $('#Custodian-infoModal').modal('show');
    }

    function fetchCustodianInfo() {
        $('#custodian_info_tbody').empty();
        $.ajax({
            url: "{{ route('custodian-info.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                $('#custodian_info_tbody').html(response);
                $.each(response, function(index, custodian_info) {
                    $('#custodian_info_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${custodian_info.user_id}</td>
                            <td>${custodian_info.brand}</td>
                            <td>${custodian_info.model}</td>
                            <td>${custodian_info.type}</td>
                            <td>${custodian_info.serial_number}</td>
                            <td>${custodian_info.mac_address}</td>
                            <td>${custodian_info.ip_address}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editCustodianInfo('${custodian_info.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteCustodianInfo('${custodian_info.id}')">Delete</button>
                            </td>
                        </tr>`
                    );
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function saveCustodianInfo() {
        var formData = $('#custodian-infoForm').serialize();
        $.ajax({
            url: "{{ route('custodian-info.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#Custodian-infoModal').modal('hide');
                if(response.status == 'true') {
                     toastr.success('Custodian Info saved successfully!', 'Success');
                } else {
                    toastr.error('Failed to save custodian info.', 'Error');
                }
                fetchCustodianInfo(); // Refresh the custodian info list
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function editCustodianInfo(id) {
        $.ajax({
            url: "{{ route('custodian-info.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                custodian_info_id: id
            },
            success: function(response) {
                console.log(response);
                $('#modal-title').text('Edit Custodian Info');
                $('#custodian-info_id').val(response.id);
                $('#user_id').val(response.user_id);
                $('#brand').val(response.brand);
                $('#model').val(response.model);
                $('#type').val(response.type);
                $('#serial_number').val(response.serial_number);
                $('#mac_address').val(response.mac_address);
                $('#ip_address').val(response.ip_address);
                $('#Custodian-infoModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function deleteCustodianInfo(id) {

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
                url: "{{ route('custodian-info.delete') }}",
                method: 'POST',
                data: {
                    custodian_info_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchCustodianInfo();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}

//
     function deleteCustodianInfo(id) {

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
                url: "{{ route('custodian-info.delete') }}",
                method: 'POST',
                data: {
                    custodian_info_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchCustodianInfo();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}

</script>

