@extends('layouts.main')
@section('content')

<style>
    .table th {
        vertical-align: middle;
        background-color: #343a40;
        color: #fff;
    }
    .addcategory {
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
       <button class="btn mb-3" onclick="addCategory()"style="background-color:#28a745; color:white; border:none;">Add</button>

        {{-- <h1><i class="fa-duotone fa-thin fa-layer"></i> Equipment</h1> --}}
        <table id="categories-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="category_tbody">

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade bs-example-modal-lg" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="category_id" name="category_id">
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveCategory()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.onload = function() {
        fetchCategories();
    }

// Add Category Modal
    function addCategory() {
        $('#modal-title').text('Add Category');
        $('#category_id').val('');
        $('#categoryForm')[0].reset();
        $('#categoryModal').modal('show');
    }

    function fetchCategories() {
        $('#category_tbody').empty();
        $.ajax({
            url: "{{ route('category.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                $('#category_tbody').html(response);
                $.each(response, function(index, category) {
                    $('#category_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${category.description}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editCategory('${category.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteCategory('${category.id}')">Delete</button>
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

    function saveCategory() {
        var formData = $('#categoryForm').serialize();
        $.ajax({
            url: "{{ route('category.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#categoryModal').modal('hide');
                if(response.status == 'true') {
                     toastr.success('Category saved successfully!', 'Success');
                } else {
                    toastr.error('Failed to save category.', 'Error');
                }
                fetchCategories(); // Refresh the category list
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function editCategory(id) {
        $.ajax({
            url: "{{ route('category.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                category_id: id
            },
            success: function(response) {
                console.log(response);
                $('#modal-title').text('Edit Category');
                $('#category_id').val(response.id);
                $('#name').val(response.description);
                $('#categoryModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
    function deleteCategory(id) {

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
                url: "{{ route('category.delete') }}",
                method: 'POST',
                data: {
                    category_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchCategories();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}





</script>
