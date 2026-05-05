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
         <button class="btn btn-primary mb-3" onclick="addQuestionaire()"style="background-color:#28a745; color:white; border:none;">Add</button>
        {{-- <h1>Questioner</h1> --}}
        <table id="questionaire-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>is_required</th>
                    <th>input_type</th>
                    <th>Sorting</th>
                    <th>Action</th>



                </tr>
            </thead>
            <tbody id="questionaire_tbody">

            </tbody>
        </table>
    </div>
</div>
@endsection

<div class="modal fade bs-example-modal-lg" id="QuestionaireModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="queForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="questionaire_id" name="questionaire_id">
                        <div class="col-md-12">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                            </select>
                        </div>
                            <div class="col-md-12">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" required>
                            </div>

                            <div class="col-md-12">
                                <label for="input_type">Input Type</label>
                                <select class="form-control" id="input_type" name="input_type" required>
                                <option value="text">Text</option>
                                <option value="select">Select</option>
                                <option value="brand">Brand/Model</option>
                                <option value="applicant">Applicant</option>
                                <option value="ram">Hardware RAM</option>
                                <option value="cmos">CMOS</option>
                                <option value="connection">Connection</option>
                                <option value="delete">Delete</option>
                                <option value="clean">Clean</option>
                                <option value="cleanliness">Cleanliness</option>
                                <option value="create">Create</option>
                                <option value="restore">Restore</option>
                                <option value="wallpaper">Wallpaper</option>
                                <option value="monitor">Monitor</option>
                                <option value="printer">Printer</option>
                                <option value="peripherals">Peripherals</option>
                                </select>
                            </div>
                             <div class="col-md-12">
                                <label for="is_required">Is Required</label>
                                <select class="form-control" id="is_required" name="is_required" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                        <div class="col-md-12">
                            <label for="sorting">Sorting</label>
                            <input type="integer" class="form-control" id="sorting" name="sorting" required>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveQuestionaire()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.onload = function() {
        fetchQuestionaire();
    }
// add questionaire modal
   function addQuestionaire() {
        $('#modal-title').text('Add Questionaire');
        fetchCategory();
        $('#questionaire_id').val('');
        $('#queForm')[0].reset();
        $('#QuestionaireModal').modal('show');
    }
    function fetchCategory() {
        $.ajax({
            url: "{{ route('category.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#category_id').empty();
                $.each(response, function(index, category) {
                    $('#category_id').append(
                        `<option value="${category.id}">${category.description}</option>`
                    );
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function fetchQuestionaire() {
        $('#questionaire_tbody').empty();
        $.ajax({
            url: "{{ route('questionaire.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                // $('#questionaire_tbody').html(response);
                $.each(response, function(index, questionaire) {
                   $('#questionaire_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${questionaire.category['description']}</td>
                            <td>${questionaire.question}</td>
                            <td>${questionaire.is_required == 1 ? 'Yes' : 'No'}</td>
                            <td>${questionaire.input_type}</td>
                            <td>${questionaire.sorting}</td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="editQuestionaire('${questionaire.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteQuestionaire('${questionaire.id}')">Delete</button>
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

    function saveQuestionaire() {
            let category_id = $('#category_id').val();
            let question_id = $('#question_id').val();
            let sorting = $('#sorting').val();

        var formData = $('#queForm').serialize();
        $.ajax({
            url: "{{ route('questionaire.save') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#QuestionaireModal').modal('hide');
                if(response.status == 'true') {
                     toastr.success('Questionaire saved successfully!', 'Success');
                } else {
                    toastr.error('Failed to save questionaire.', 'Error');
                }
                fetchQuestionaire(); // Refresh the questionaire list
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function editQuestionaire(id) {
        $.ajax({
            url: "{{ route('questionaire.info') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                questionaire_id: id
            },
            success: function(response) {
                console.log(response);
                fetchCategory();
                $('#modal-title').text('Edit Questionaire');
                $('#questionaire_id').val(response.id);
                $('#category_id').prop('value', response.category_id);
                $('#question').val(response.question);
                $('#sorting').val(response.sorting);
                $('#QuestionaireModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }


   function deleteQuestionaire(id) {

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
                url: "{{ route('questionaire.delete') }}",
                method: 'POST',
                data: {
                    questionaire_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchQuestionaire();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}

</script>

