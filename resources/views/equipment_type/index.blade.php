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
         <button class="btn btn-primary mb-3" onclick="addEquipment_Type()"style="background-color:#28a745; color:white; border:none;">Add</button>
        {{-- <h1>Equipment Types</h1> --}}
        <table id="equipment_type-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Sub_Category</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody id="equipment_type_tbody">

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade bs-example-modal-lg" id="Equipment_typeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="equipment_typeForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="equipment_type_id" name="equipment_type_id">
                        <div class="col-md-12">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="col-md-12">
                            <label for="sub_category">Sub Category</label>
                            <input type="text" class="form-control" id="sub_category" name="sub_category" required>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveEquipment_Type()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.onload = function() {
        fetchEquipment_Types();
    }
// add equipment type modal
   function addEquipment_Type() {
        $('#modal-title').text('Add Equipment Type');
        $('#equipment_type_id').val('');
        $('#equipment_typeForm')[0].reset();
        $('#Equipment_typeModal').modal('show');
    }

    function fetchEquipment_Types() {
        $('#equipment_type_tbody').empty();
        $.ajax({
            url: "{{ route('equipment_type.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                $('#equipment_type_tbody').html(response);
                $.each(response, function(index, equipment_type) {
                    $('#equipment_type_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${equipment_type.id}</td>
                            <td>${equipment_type.category}</td>
                            <td>${equipment_type.sub_category}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editEquipment_Type('${equipment_type.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteEquipment_Type('${equipment_type.id}')">Delete</button>
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

    function saveEquipment_Type() {
        var formData = $('#equipment_typeForm').serialize();
        $.ajax({
            url: "{{ route('equipment_type.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#Equipment_typeModal').modal('hide');
                if(response.status == 'true') {
                     toastr.success('Equipment Type saved successfully!', 'Success');
                } else {
                    toastr.error('Failed to save equipment type.', 'Error');
                }
                fetchEquipment_Types(); // Refresh the equipment type list
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function editEquipment_Type(id) {
        $.ajax({
            url: "{{ route('equipment_type.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                equipment_type_id: id
            },
            success: function(response) {
                console.log(response);
                $('#modal-title').text('Edit Equipment_Type');
                $('#equipment_type_id').val(response.id);
                $('#category').val(response.category);
                $('#sub_category').val(response.sub_category);
                $('#Equipment_typeModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function deleteEquipment_Type(id) {

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
                url: "{{ route('equipment_type.delete') }}",
                method: 'POST',
                data: {
                    equipment_type_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchEquipment_Types();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}

//
    // function deleteEquipmentType(id) {
    //     if (confirm('Are you sure you want to delete this equipment type?')) {
    //         $.ajax({
    //             url: "{{ route('equipment_type.delete') }}",
    //             method: 'POST',
    //             data: {
    //                 _token: "{{ csrf_token() }}",
    //                 equipment_type_id: id
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 if(response.status == 'true') {
    //                     toastr.success('Equipment Type deleted successfully!', 'Success');
    //                 } else {
    //                     toastr.error('Failed to delete equipment type.', 'Error');
    //                 }
    //                 fetchEquipmentTypes(); // Refresh the equipment type list
    //             },
    //             error: function(xhr) {
    //                 console.error(xhr.responseText);
    //             }
    //         });
    //     }
    // }


</script>

