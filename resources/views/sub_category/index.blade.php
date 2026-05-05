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
         <button class="btn btn-primary mb-3" onclick="addSub_Category()"style="background-color:#28a745; color:white; border:none;">Add</button>
        {{-- <h1>Responses</h1> --}}
        <table id="question-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category_id</th>
                    <th>Description</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody id="sub_category_tbody">

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade bs-example-modal-lg" id="Sub_CategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Add Custodian Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="sub_categoryForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                    <div class="row">
                        <input type="hidden" id="sub_category_id" name="sub_category_id" value="">
                        <div class="col-md-12">
                            <label for="category_id">Category ID</label>
                            <select type="text" class="form-control" id="category_id" name="category_id" required="">
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required="">
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveSub_Category()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.onload = function() {
        fetchSub_Category();
    }
// add sub category modal
   function addSub_Category() {
        $('#modal-title').text('Add Sub Category');
        $.ajax({
            url:"{{route('category.fetch')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function(categories){
                $('#category_id').empty();
                console.log(categories);
                $('#category_id').append(`<option value="">Select one..</option>`);
                $.each(categories, function(index, category){
                    $('#category_id').append(`<option value="${category.id}">${category.description}</option>`);
                });
            }
        });
        $('#sub_category_id').val('');
        $('#sub_categoryForm')[0].reset();
        $('#Sub_CategoryModal').modal('show');
    }

    function fetchSub_Category() {
        $('#sub_category_tbody').empty();
        $.ajax({
            url: "{{ route('sub_category.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                $('#sub_category_tbody').html(response);
                $.each(response, function(index, sub_category) {
                    $('#sub_category_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${sub_category.category.description}</td>
                            <td>${sub_category.description}</td>

                            <td>
                                <button class="btn btn-sm btn-info" onclick="editSub_Category('${sub_category.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteSub_Category('${sub_category.id}')">Delete</button>
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

    function saveSub_Category() {
        var formData = $('#sub_categoryForm').serialize();
        $.ajax({
            url: "{{ route('sub_category.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#SubCategoryModal').modal('hide');
                if(response.status == 'true') {
                $('#Sub_CategoryModal').modal('hide');
                     toastr.success('Sub Category saved successfully!', 'Success');
                } else {
                    toastr.error('Failed to save sub category.', 'Error');
                }
                fetchSub_Category(); // Refresh the sub category list
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function editSub_Category(id) {
        $.ajax({
            url: "{{ route('sub_category.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                sub_category_id: id
            },
            success: function(response) {
                console.log(response);
                $('#modal-title').text('Edit Sub Category');
                $('#sub_category_id').val(response.id);
                $('#description').val(response.description);
                $('#Sub_CategoryModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

     function deleteSub_Category(id) {

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
                url: "{{ route('sub_category.delete') }}",
                method: 'POST',
                data: {
                    sub_category_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchSub_Category();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}


</script>

