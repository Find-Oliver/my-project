@extends('layouts.main')
@section('content')

<!-- ✅ JQUERY FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ✅ SELECT2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>

/* 🌑 GLOBAL BACKGROUND */
body {
    background: #333a44;
}

.modal-body {
    max-height: 75vh;
    overflow-y: auto;
}
.pm-header-info,
.pm-footer-info {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.pm-field {
    flex: 1;
    min-width: 200px;
}


/* HEADER */
.prev {
    text-align: center;
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

/* LOGO */
.img {
    display: block;
    margin: 0 auto;
    width: 65px;
    height: auto;
}

/* 📦 MAIN FORM */
#appendHere {
    background: #eef2f6;
    padding: 20px;
    border-radius: 12px;
}

/* 🧾 SECTION CARD */
.section-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.06);
}

/* 📌 TITLE */
.section-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #3b5bdb;
}

/* 🧩 QUESTION BLOCK */
.sub-group {
    background: #f4f6f9;
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 12px;
    border: 1px solid #e1e5eb;
}

/* 🔤 LABEL NG TANONG */
.sub-title {
    font-size: 13px;
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
}

/* 🔘 YES / NO */
.radio-group {
    display: flex;
    gap: 20px;
    margin-bottom: 6px;
}

.radio-group label {
    font-size: 13px;
    cursor: pointer;
}

/* 🔲 INLINE INPUTS */
.inline-fields {
    display: flex;
    gap: 10px;
    margin-top: 6px;
    flex-wrap: wrap;
}

.inline-fields input {
    flex: 1;
    min-width: 120px;
}

/* ✏️ INPUT */
.clean-input,
.form-control,
.form-control-sm {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 13px;
    height: 32px;
    padding: 5px 10px;
}

/* ✨ FOCUS */
.clean-input:focus,
.form-control:focus,
.form-control-sm:focus {
    border-color: #5c7cfa;
    box-shadow: 0 0 0 1px rgba(92,124,250,0.2);
}

/* 📝 REMARKS */
.remarks-box {
    background: #eef2f7;
    border: 1px solid #d6dee8;
    padding: 8px;
    border-radius: 6px;
    margin-top: 6px;
}

/* ➕ BUTTON */
.add-btn {
    margin-top: 6px;
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 6px;
    background: #1eb61e;
    color: #fff;
    border: none;
}

.add-btn:hover {
    background: #4338ca;
}

/* 📊 TABLE */
.table th {
    background-color: #374151;
    color: #fff;
}

/* ❌ REMOVE ROW DESIGN CONFLICT */
.row {
    background: transparent !important;
    padding: 0 !important;
    margin: 2px 0 !important;
}

/* 📋 APPLICATION HEADER */
.app-header {
    display: flex;
    gap: 10px;
    font-weight: 600;
    font-size: 13px;
    background: #e9edf5;
    padding: 6px 10px;
    border-radius: 6px;
    margin-top: 8px;
}

/* 🏷 CATEGORY */
.category-header {
    background: linear-gradient(90deg, #5c7cfa, #748ffc);
    color: white;
    padding: 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 10px;
}
 .select2-container {
    width: 100% !important;
}

.form-control,
.select2-container {
    width: 100% !important;
}
/* 🔥 QUESTION TEXT ONLY DESIGN */
.form-group > label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
    padding-left: 10px;
    position: relative;
}

/* LEFT ACCENT LINE */
.form-group > label::before {
    content: "";
    position: absolute;
    left: 0;
    top: 4px;
    height: 14px;
    width: 4px;
    border-radius: 2px;
}

/* OPTIONAL: spacing per question */
.form-group {
    margin-bottom: 16px;
}

/* ================= PREVIEW BUTTON CUSTOM COLOR ================= */
/* ================= GREEN PREVIEW BUTTON ================= */
.preview-btn {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: #fff;
    border: none;
    font-weight: 600;
    border-radius: 6px;
    padding: 6px 14px;
    transition: 0.3s ease;
}

.preview-btn:hover {
    background: linear-gradient(135deg, #15803d, #16a34a);
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}


/* ================= PREVIEW DESIGN ================= */

.preview-wrapper{
    background:#f8fafc;
    padding:20px;
    border-radius:12px;
}

/* HEADER */
.preview-header{
    text-align:center;
    margin-bottom:25px;
}

.preview-header h2{
    margin:0;
    color:#1e293b;
    font-size:24px;
    font-weight:700;
}

.preview-header hr{
    margin-top:12px;
}

/* BASIC INFO */
.preview-info{
    background:#ffffff;
    border:1px solid #dbe2ea;
    border-radius:10px;
    padding:15px;
    margin-bottom:20px;
    line-height:1.8;
}

/* SECTION */
.preview-section{
    margin-top:25px;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    border:1px solid #dbe2ea;
}

/* SECTION TITLE */
.preview-section-title{
    background:linear-gradient(135deg,#16a34a,#22c55e);
    color:#fff;
    padding:12px 15px;
    font-size:15px;
    font-weight:700;
}

/* SECTION BODY */
.preview-section-body{
    padding:18px;
}

/* EACH BLOCK */
.preview-block{
    background:#f8fafc;
    border:1px solid #dbe2ea;
    border-radius:8px;
    padding:14px;
    margin-bottom:15px;
    line-height:1.8;
}

/* LABELS */
.preview-block b{
    color:#0f172a;
}

/* DIVIDER */
.preview-divider{
    border-top:2px dashed #cbd5e1;
    margin:15px 0;
}

/* REMARKS */
.preview-remarks{
    background:#fef2f2;
    border-left:4px solid #ef4444;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
}

/* APPLICATION BOX */
.preview-app{
    background:#eff6ff;
    border-left:4px solid #3b82f6;
    padding:10px;
    border-radius:6px;
    margin-bottom:12px;
}

/* HARDWARE BOX */
.preview-hardware{
    background:#f0fdf4;
    border-left:4px solid #22c55e;
    padding:10px;
    border-radius:6px;
    margin-bottom:12px;
}

/* NETWORK BOX */
.preview-network{
    background:#fff7ed;
    border-left:4px solid #f97316;
    padding:10px;
    border-radius:6px;
    margin-bottom:12px;
}

/* PERIPHERAL BOX */
.preview-peripheral{
    background:#faf5ff;
    border-left:4px solid #9333ea;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}
</style>


<div class="card-container">

    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3 conduct-btn" onclick="addResponse()">
                Conduct PMS
            </button>
        </div>
    </div>
<!-- PDF DOWNLOAD BUTTON -->
    {{-- <button id="downloadBtn" class="btn btn-success" style="display:none;">
    Download PDF
</button> --}}





</div>

        <table id="pms_record-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Division</th>
                    <th>Conducted By</th>
                    <th>Conforme</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody id="pms_records_tbody">

            </tbody>
        </table>

@endsection

<div class="modal fade bs-example-modal-lg" id="ResponseModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <img class="img" src="{{ asset('PMLogo.png') }}" alt="Logo"><br>
             <h1 class="prev">PREVENTIVE MAINTENANCE</h1>

            <div class="modal-header">

       <h4 class="modal-title" id="modal-title"></h4>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> --}}
            </div>
            <div class="modal-body">

                <form id="responseForm">
                    <div class="pm-header-info">
    <div class="pm-field">
        <label>Name:</label>
        <select type="text" name="name" id="staffs" class="form-control form-control-sm">
            <option value="">Select Employee</option>
        </select>
    </div>

    <div class="pm-field">
        <label>Division:</label>
        <input type="text" name="division" class="form-control form-control-sm">
    </div>
</div> <br>
                    @csrf


                    <input type="hidden" id="response_id" name="response_id">
                    <div id="appendHere" class="row"></div>
                    <div class="pm-footer-info">
    <div class="pm-field">
        <label>Conducted By:</label>
        <select  name="conducted_by" id="conducted_by" class="form-control form-control-sm">
            <option value=""> Select Staff </option>
        </select>

    </div>

    <div class="pm-field">
        <label>Conforme:</label>
        <select name="conforme" id="conforme" class="form-control form-control-sm">
            <option value="">Select Conforme</option>
        </select>
    </div>
</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="previewResponse()">Preview</button>
                <button type="button" class="btn btn-primary waves-effect text-left" onclick="saveResponse()">Save</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="PreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Review Before Print</h4>
            </div>

            <div class="modal-body" id="previewBody">
                <!-- lalabas dito ang summary -->
            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-success" onclick="printFromPreview()">
                    Print
                </button>

            </div>

        </div>
    </div>
</div>


<script>
    window.onload = function() {
        fetchResponse();
    }

    function highlightTitle(text){
    return `<span style="font-weight:700; color:#5c7cfa;">${text}</span>`;
}

function fetchConductedBy() {
    $('#conducted_by').empty();
    $('#conducted_by').append(`<option value=""> Select Staff </option>`);

    $.ajax({
        url: "{{ route('conducted_by.fetch') }}", // change if different route
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {

            $.each(response, function(index, item) {

                $('#conducted_by').append(`
                    <option value="${item.user_id}">
                        ${item.staff ? item.staff.first_name + ' ' + item.staff.last_name : 'No Staff'}
                    </option>
                `);

            });

        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

// add response modal
   function addResponse() {
    $('#modal-title').text('Add Response');
    $('#pms-form').empty();

    fetchCategory();
    fetchStaff();
    fetchConductedBy(); // ✅ ADD THIS

    $('#response_id').val('');
    $('#responseForm')[0].reset();
    $('#ResponseModal').modal('show');
}

    function fetchStaff() {
        $('#staffs').empty();
        $('#conforme').empty();

        $.ajax({
            url: "{{ route('response.fetch_employee') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                $.each(response, function(index, staff) {
                    $('#staffs').append(
                        `<option value="${staff.user_id}">${staff.name}</option>`
                    );
                    $('#conforme').append(
                        `<option value="${staff.user_id}">${staff.name}</option>`
                    );
                });

                // 👉 INIT AFTER DATA IS LOADED
                $('#staffs').select2({
                    dropdownParent: $('#ResponseModal'),
                    placeholder: "Select Staff",
                    allowClear: true,
                    width: '100%'
                });

                $('#conforme').select2({
                    dropdownParent: $('#ResponseModal'),
                    placeholder: "Select Conforme",
                    allowClear: true,
                    width: '100%'
                });
            },
        });
    }


    function fetchCategory() {
        var html = '';
        $('#appendHere').empty();
        $.ajax({
            url: "{{ route('category.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
                success: function(response) {
                    $.each(response, function(index, category) {

                        html+=`
                        <div class="container-fluid">
                        <div class="category-header"> ${category.description}</div>
`;


                        // html+=`<div class="container-fluid"><h6 class="mb-3">${category.description}</h6 >`;

                            $.each(category.questionaire, function(index, quest) {

                            html+=`<div class="col-md-12"> <div class="form-group"><label>${quest.question}</label>`;
                if(quest.input_type == 'text') {
                            html+=`<input type="text" class="form-control" name="response[${quest.id}]">`;
                        }




else if(quest.input_type == 'applicant') {
    html += `

<div class="section-card">



    <div class="sub-group">

        <div class="radio-group">
            <label><input type="radio" name="${quest.id}[response]" value="1"
                onclick="handleRadioClick(this)"> Yes</label>

            <label><input type="radio" name="${quest.id}[response]" value="0"
                onclick="handleRadioClick(this)"> No</label>
        </div>

        <div class="remarks-container-${quest.id} remarks-box"></div>

        <div class="inline-fields">
                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][brand]"
                        class="form-control form-control-sm"
                        placeholder="Brand / Model">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][serial]"
                        class="form-control form-control-sm"
                        placeholder="Serial No.">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][year]"
                        class="form-control form-control-sm"
                        placeholder="Year Acquired">
                </div>
            </div>




        <div class="sub-title">Applications</div>

        <button type="button" class="add-btn"
            onclick="addApplicant(${quest.id})">+ Add</button>


 <!--- INLINE FIELDS (Name, Expiration) -->
    <!--    <div class="app-header">
            <div class="app-col">Name</div>
            <div class="app-col">Expiration</div>
        </div>
     -->

        <div class="textbox-container-${quest.id}"></div>

        </div>

    </div>



`;
}


else if(quest.input_type == 'ram') {
    html += `
    <div class="section-card">



        <div class="sub-group">



            <div class="radio-group">
                <label>
                    <input type="radio" name="${quest.id}[response]" value="1"
                    onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio" name="${quest.id}[response]" value="0"
                    onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <div class="remarks-container-${quest.id} remarks-box"></div>

            <div class="flex-3">
                <input type="text" class="clean-input"
                    placeholder="RAM"
                    name="${quest.id}[response_array][0][ram]">

                <input type="text" class="clean-input"
                    placeholder="Storage"
                    name="${quest.id}[response_array][0][storage]">

                <input type="text" class="clean-input"
                    placeholder="CPU"
                    name="${quest.id}[response_array][0][cpu]">
            </div>

        </div>

    </div>
    `;
}
else if(quest.input_type == 'cmos') {
   html += `
<div class="section-card">



    <div class="sub-group">

        <div class="radio-group">
            <label><input type="radio" name="${quest.id}[response]" value="1"
                onclick="handleRadioClick(this)"> Yes</label>

            <label><input type="radio" name="${quest.id}[response]" value="0"
                onclick="handleRadioClick(this)"> No</label>
        </div>

        <div class="remarks-container-${quest.id} remarks-box"></div>

    </div>

</div>
`;
}

else if(quest.input_type == 'connection') {
   html += `
<div class="section-card">



    <div class="sub-group">

        <div class="radio-group">
            <label><input type="radio" name="${quest.id}[response]" value="1"
                onclick="handleRadioClick(this)"> Yes</label>

            <label><input type="radio" name="${quest.id}[response]" value="0"
                onclick="handleRadioClick(this)"> No</label>
        </div>

        <div class="remarks-container-${quest.id} remarks-box"></div>

        <div class="flex-3">
            <input type="text" class="clean-input"
                placeholder="MAC Address"
                name="mac_${quest.id}">

            <input type="text" class="clean-input"
                placeholder="IP Address"
                name="ip_${quest.id}">
        </div>

    </div>

</div>
`;
}

else if(quest.input_type == 'delete') {
    html += `
    <div class="section-card">



        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>

        </div>

    </div>
    `;
}

else if(quest.input_type == 'clean') {
    html += `
    <div class="section-card">


        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>

        </div>

    </div>
    `;
}

else if(quest.input_type == 'cleanliness') {
    html += `
    <div class="section-card">


        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>

        </div>

    </div>
    `;
}

else if(quest.input_type == 'create') {
    html += `
    <div class="section-card">

        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>



    `;
}

else if(quest.input_type == 'restore') {
    html += `
    <div class="section-card">

        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        data-type="restore"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        data-type="restore"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>


    `;
}


else if(quest.input_type == 'wallpaper') {
    html += `
    <div class="section-card">

        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>


    `;
}



else if(quest.input_type == 'monitor') {
    html += `
    <div class="section-card">



        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                                onclick="handleRadioClick(this)"> No
                                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>

            <!-- INLINE FIELDS -->

            <div class="inline-fields">
                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][brand]"
                        class="form-control form-control-sm"
                        placeholder="Brand / Model">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][serial]"
                        class="form-control form-control-sm"
                        placeholder="Serial No.">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][year]"
                        class="form-control form-control-sm"
                        placeholder="Year Acquired">
                </div>
            </div>

        </div>

    </div>
    `;
}

else if(quest.input_type == 'peripheral') {
   html += `
<div class="section-card">



    <div class="sub-group">

        <button type="button" class="add-btn"
            onclick="addPeripheral(${quest.id})">+ Add</button>

        <div class="textbox-container-${quest.id}"></div>

    </div>

</div>
`;
}

else if(quest.input_type == 'printer') {
    html += `
    <div class="section-card">


        <div class="sub-group">

            <!-- YES / NO -->
            <div class="radio-group">
                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="1"
                        onclick="handleRadioClick(this)"> Yes
                </label>

                <label>
                    <input type="radio"
                        name="${quest.id}[response]"
                        value="0"
                        onclick="handleRadioClick(this)"> No
                </label>
            </div>

            <!-- REMARKS -->
            <div class="remarks-container-${quest.id} remarks-box"></div>

            <!-- INLINE FIELDS -->

            <div class="inline-fields">
                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][brand]"
                        class="form-control form-control-sm"
                        placeholder="Brand / Model">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][serial]"
                        class="form-control form-control-sm"
                        placeholder="Serial No.">
                </div>

                <div class="field">
                    <input type="text"
                        name="${quest.id}[response_array][0][year]"
                        class="form-control form-control-sm"
                        placeholder="Year Acquired">
                </div>
            </div>

        </div>

    </div>
    `;
}






else if(quest.input_type == 'select') {
    html+=`
        <div style="margin-top:8px;">
        <div style="display:flex; align-items:center; margin-bottom:8px;">
            <div style="margin-right:30px;">
                <input type="radio"
                       name="${quest.id}"
                       value="1"
                       id="yes_${quest.id}"
                       onclick="handleRadioClick(this)">
                <label for="yes_${quest.id}">Yes</label>
            </div>

            <div>
                <input type="radio"
                       name="${quest.id}"
                       value="0"
                       id="no_${quest.id}"
                       onclick="handleRadioClick(this)">
                <label for="no_${quest.id}">No</label>
            </div>
         </div>

           <div class="remarks-container-${quest.id}"></div>
    </div>

    `;
}




                                    html+=`</div></div></div>`;
                            });
});
                    $('#appendHere').append(html);
},



            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }



function addTextbox(id){

    let container = document.querySelector('.textbox-container-' + id);

    let row = document.createElement("div");
    row.style.display = "flex";
    row.style.gap = "5px";
    row.style.marginBottom = "5px";
    row.style.alignItems = "center";

    // NAME
    let nameInput = document.createElement("input");
    nameInput.type = "text";
    nameInput.name = "applicant_name_" + id + "[]";
    nameInput.className = "form-control";
    nameInput.placeholder = "Name";

    // EXPIRATION
    let expInput = document.createElement("input");
    expInput.type = "text";
    expInput.name = "applicant_exp_" + id + "[]";
    expInput.className = "form-control";

    // REMOVE BUTTON
    let removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.innerHTML = "-";
    removeBtn.className = "btn btn-danger btn-sm";

    removeBtn.onclick = function(){
        row.remove();
    };

    row.appendChild(nameInput);
    row.appendChild(expInput);
    row.appendChild(removeBtn);

    container.appendChild(row);
}
//    function toggleRemarks(el, id){

//     if(el.value == "0"){
//         $(`#remarks-${id}`).html(`
//             <textarea class="form-control mt-2"
//             name="remarks[${id}]"
//             placeholder="Please specify remarks"></textarea>
//         `);
//     }
//     else{
//         $(`#remarks-${id}`).html('');
//     }


// }
function handleRadioClick(el) {
    let name = el.name;

    // check kung same radio ang pinindot ulit
    if (el.dataset.checked === "true") {
        el.checked = false;
        el.dataset.checked = "false";

        // remove remarks
        let quest = name.match(/\d+/)[0];
        $('.remarks-container-' + quest).empty();
    } else {
        // reset all radios in same group
        document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
            r.dataset.checked = "false";
        });

        el.dataset.checked = "true";

        // tawagin remarks logic mo
        toggleRemarks(el);
    }
}

function toggleRemarks(select){

    let quest = select.name.match(/\d+/)[0];
    let container = $('.remarks-container-' + quest);
    let type = select.dataset.type; // 👈 kunin kung restore ba

    // 🔵 CASE 1: RESTORE → BOTH YES & NO may remarks
    if(type === "restore"){
        container.html(`
            <textarea class="form-control mt-2"
            name="remarks[${quest}]"
            placeholder="Please specify remarks"></textarea>
        `);
    }

    // 🔴 CASE 2: OTHER TYPES → NO lang may remarks
    else{
        if(select.value == "0"){
            container.html(`
                <textarea class="form-control mt-2"
                name="remarks[${quest}]"
                placeholder="Please specify remarks"></textarea>
            `);
        }else{
            container.empty();
        }
    }

}

    function fetchResponse() {
        $('#pms_records_tbody').empty();
        $.ajax({
            url: "{{ route('response.fetch') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },


            success: function(response) {
                $.each(response, function(index, response) {
                    $('#pms_records_tbody').append(
                        `<tr>
                            <td>${index + 1}</td>
                            <td>${response.owner_name ?? 'N/A'}</td>
                            <td>${response.division ?? 'N/A'}</td>
                            <td>${response.conducted_by_name ?? 'N/A'}</td>
                            <td>${response.conforme_name ?? 'N/A'}</td>
                            <td>
                           <!-- <button class="btn btn-sm btn-success" onclick="print('${response.id}')">Print</button> -->
                                <button class="btn btn-sm btn-info" onclick="editResponse('${response.id}')">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteResponse('${response.id}')">Delete</button>
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


  function saveResponse() {

    // =========================================
    // BASIC REQUIRED FIELDS
    // =========================================
    let staff = $('#staffs').val();
    let division = $('input[name="division"]').val().trim();
    let conducted = $('#conducted_by').val();
    let conforme = $('#conforme').val();

    if (staff == '') {
        toastr.error('Please select employee');
        return;
    }

    if (division == '') {
        toastr.error('Division is required');
        return;
    }

    if (conducted == '') {
        toastr.error('Please select conducted by');
        return;
    }

    if (conforme == '') {
        toastr.error('Please select conforme');
        return;
    }

    // =========================================
    // CHECK ALL RADIO QUESTIONS
    // =========================================
    let radioError = false;

    $('.radio-group').each(function () {

        let checked = $(this).find('input[type="radio"]:checked').length;

        if (checked == 0) {

            toastr.error('Please answer all Yes/No questions');

            radioError = true;

            return false;
        }
    });

    if (radioError) {
        return;
    }

    // =========================================
    // REMARKS REQUIRED WHEN NO
    // =========================================
    let remarksError = false;

    $('input[type="radio"][value="0"]:checked').each(function () {

        let name = $(this).attr('name');

        let quest = name.match(/\d+/)[0];

        let remarks = $(`textarea[name="remarks[${quest}]"]`).val();

        if (!remarks || remarks.trim() == '') {

            toastr.error('Remarks are required for NO answer');

            remarksError = true;

            return false;
        }

    });

    if (remarksError) {
        return;
    }

    // =========================================
    // CHECK EMPTY INPUTS
    // =========================================
    let emptyField = false;

    $('#responseForm')
    .find('input[type="text"], textarea')
    .each(function () {

        // skip hidden remarks container
        if ($(this).is(':hidden')) {
            return true;
        }

        // skip optional remarks
        if ($(this).attr('name') &&
            $(this).attr('name').includes('remarks')) {
            return true;
        }

        if ($(this).val().trim() == '') {

            toastr.error('Please fill in all fields');

            $(this).focus();

            emptyField = true;

            return false;
        }

    });

    if (emptyField) {
        return;
    }

    // =========================================
    // SAVE AJAX
    // =========================================
    let formData = new FormData($('#responseForm')[0]);

    $.ajax({
        url: "{{ route('response.save') }}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {

            $('.btn-primary')
            .prop('disabled', true)
            .text('Saving...');
        },

        success: function(response) {

            $('.btn-primary')
            .prop('disabled', false)
            .text('Save');

            if(response.status === true){

                toastr.success('Saved successfully');

                $('#ResponseModal').modal('hide');

                $('#responseForm')[0].reset();

                fetchResponse();

            }else{

                toastr.error('Save failed');

            }
        },

        error: function(xhr) {

            $('.btn-primary')
            .prop('disabled', false)
            .text('Save');

            console.log(xhr.responseText);

            toastr.error('Something went wrong');
        }
    });
}



   function editResponse(id) {

    $.ajax({
        url: "{{ route('response.info') }}",
        method: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            response_id: id
        },

        success: function(response) {

            $('#modal-title').text('Edit Response');

            // ✅ IMPORTANT
            $('#response_id').val(response.id);

            // =====================================================
            // LOAD FORM FIRST
            // =====================================================
            fetchCategory();
            fetchConductedBy(response.conducted_by); // ✅ AUTO SELECT CONDUCTED BY
            fetchStaff();

            // =====================================================
            // WAIT FOR FORM TO LOAD
            // =====================================================
            setTimeout(() => {

                // =================================================
                // MAIN PMS INFO
                // =================================================
                $('#staffs')
                    .val(response.name)
                    .trigger('change');

                $('#conducted_by')
                    .val(response.conducted_by)
                    .trigger('change');

                $('#conforme')
                    .val(response.conforme)
                    .trigger('change');

                $('input[name="division"]')
                    .val(response.division);

                // =================================================
                // QUESTION RESPONSES
                // =================================================
                if(response.responses){

                    response.responses.forEach(res => {

                        // =========================================
                        // RADIO BUTTON
                        // =========================================
                        let radio = $(
                            `input[name="${res.question_id}[response]"][value="${res.status}"]`
                        );

                        radio.prop('checked', true);

                        // =========================================
                        // REMARKS
                        // =========================================
                        if(res.remarks){

                            let remarks = JSON.parse(res.remarks);

                            if(remarks){

                                $('.remarks-container-' + res.question_id)
                                .html(`
                                    <textarea
                                        class="form-control mt-2"
                                        name="remarks[${res.question_id}]"
                                    >${remarks}</textarea>
                                `);
                            }
                        }

                    });
                }

            }, 1000);

            $('#ResponseModal').modal('show');
        },

        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}


//
     function deleteResponse(id) {

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
                url: "{{ route('response.delete') }}",
                method: 'POST',
                data: {
                    response_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    if(response.status == 'true') {
                        toastr.success('Deleted successfully!', 'Success');
                    } else {
                        toastr.error('Delete failed.', 'Error');
                    }

                    fetchResponse();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        }

    });
}


let applicantCounters = {}; // store counter per id

function addApplicant(id) {

    // initialize kung wala pa
    if (!applicantCounters[id]) {
        applicantCounters[id] = 1; // start from 1 since 0 is already in the HTML
    }

    let count = applicantCounters[id]++;

    let html = `
    <div class="row align-items-center mb-3 applicant-row">
        <div class="col-md-5">
            <input type="text"
                   name="${id}[response_array][${count}][application_name]"
                   class="form-control form-control-sm"
                   placeholder="Enter Name">
        </div>

        <div class="col-md-5">
            <input type="text"
                   name="${id}[response_array][${count}][application_exp]"
                   class="form-control form-control-sm"
                   placeholder="Enter Expiration">
        </div>

        <div class="col-md-2 text-center">
            <button type="button"
                    class="btn btn-danger btn-sm"
                    onclick="removeRow(this)">
                -
            </button>
        </div>
    </div>
    `;

    $(`.textbox-container-${id}`).append(html);
}

let peripheralCounters = {}; // store counter per id

function addPeripheral(id) {

    if (!peripheralCounters[id]) {
        peripheralCounters[id] = 0;
    }

    let count = peripheralCounters[id]++;

    let html = `
    <div class="row align-items-center mb-3 peripheral-row">

        <div class="col-md-2">
            <input type="text"
                   name="${id}[response_array][${count}][peripheral]"
                   class="form-control form-control-sm"
                   placeholder="Peripheral">
        </div>

        <div class="col-md-2">
            <input type="text"
                   name="${id}[response_array][${count}][brand]"
                   class="form-control form-control-sm"
                   placeholder="Brand">
        </div>

        <div class="col-md-2">
            <input type="text"
                   name="${id}[response_array][${count}][serial]"
                   class="form-control form-control-sm"
                   placeholder="Serial">
        </div>

        <div class="col-md-2">
            <input type="text"
                   name="${id}[response_array][${count}][year]"
                   class="form-control form-control-sm"
                   placeholder="Year">
        </div>

        <div class="col-md-3">
            <input type="text"
                   name="${id}[response_array][${count}][remarks]"
                   class="form-control form-control-sm"
                   placeholder="Remarks">
        </div>

        <div class="col-md-1 text-center">
            <button type="button"
                    class="btn btn-danger btn-sm w-100"
                    onclick="removeRow(this)">
                -
            </button>
        </div>

    </div>
    `;

    $(`.textbox-container-${id}`).append(html);
}

function removeRow(btn){
    $(btn).closest('.row').remove();
}


function previewResponse() {

    let html = '';

    // ================= BASIC INFO =================
    let employeeName = $('#staffs option:selected').text();
    let division = $('input[name="division"]').val();
    let conducted = $('#conducted_by option:selected').text();
    let conforme = $('#conforme option:selected').text();

    let today = new Date();
    let dateConducted = today.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    html += `
        <div style="margin-bottom:25px;">
            <h3 style="text-align:center;">PREVENTIVE MAINTENANCE</h3>
            <hr>

            <p><b>Name:</b> ${employeeName}</p>
            <p><b>Division:</b> ${division}</p>
            <p><b>Conducted By:</b> ${conducted}</p>
            <p><b>Conforme:</b> ${conforme}</p>
            <p><b>Date Conducted:</b> ${dateConducted}</p>
        </div>
    `;

    // ================= SECTION TEMPLATE =================
    function addSection(title, content) {

        if (content.trim() !== '') {

            html += `
                <div style="margin-top:25px;">

                    <div style="
                        background:#16a34a;
                        color:#fff;
                        padding:10px;
                        font-weight:bold;
                        border-radius:6px 6px 0 0;
                    ">
                        ${title}
                    </div>

                    <div style="
                        border:1px solid #ccc;
                        padding:15px;
                        border-top:none;
                        line-height:1.8;
                    ">
                        ${content}
                    </div>

                </div>
            `;
        }
    }

    // ================= SEPARATOR =================
    function separator() {
        return `
            <div style="
                border-top:1px dashed #999;
                margin:15px 0;
            "></div>
        `;
    }

    // ================= DATA HOLDERS =================
    let computer = '';
    let monitor = '';
    let peripherals = '';
    let printer = '';

    // ================= LOOP FORM =================
    $('#responseForm').serializeArray().forEach(field => {

        let name = field.name;
        let value = field.value;

        if (!value || name.includes('_token')) return;

        // =====================================================
        // COMPUTER SECTION
        // =====================================================
        if (name.includes('1773722903985536')) {

            if (name.includes('[brand]')) {

                if (computer !== '') {
                    computer += separator();
                }

                computer += `<p><b>Brand / Model:</b> ${value}</p>`;
            }

            else if (name.includes('[serial]')) {
                computer += `<p><b>Serial No:</b> ${value}</p>`;
            }

            else if (name.includes('[year]')) {
                computer += `<p><b>Year Acquired:</b> ${value}</p>`;
                computer += separator();
            }

            else if (name.includes('[application_name]')) {
                computer += `<p><b>Application:</b> ${value}</p>`;
            }

            else if (name.includes('[application_exp]')) {
                computer += `<p><b>Expiration:</b> ${value}</p>`;
            }

            else if (name.includes('[remarks]')) {
                computer += `<p><b>Remarks:</b> ${value}</p>`;
            }
        }

        else if (name.includes('[ram]')) {
            computer += separator();
            computer += `<p><b>RAM:</b> ${value}</p>`;
        }

        else if (name.includes('[storage]')) {
            computer += `<p><b>Storage:</b> ${value}</p>`;
        }

        else if (name.includes('[cpu]')) {
            computer += `<p><b>CPU:</b> ${value}</p>`;
            computer += separator();
        }

        else if (name.includes('mac_')) {
            computer += `<p><b>MAC Address:</b> ${value}</p>`;
        }

        else if (name.includes('ip_')) {
            computer += `<p><b>IP Address:</b> ${value}</p>`;
        }

        // =====================================================
        // MONITOR SECTION
        // =====================================================
        else if (name.includes('1774487238297100')) {

            if (name.includes('[brand]')) {

                if (monitor !== '') {
                    monitor += separator();
                }

                monitor += `<p><b>Brand / Model:</b> ${value}</p>`;
            }

            else if (name.includes('[serial]')) {
                monitor += `<p><b>Serial No:</b> ${value}</p>`;
            }

            else if (name.includes('[year]')) {
                monitor += `<p><b>Year Acquired:</b> ${value}</p>`;
            }

            else if (name.includes('[remarks]')) {
                monitor += `<p><b>Remarks:</b> ${value}</p>`;
            }
        }

        // =====================================================
        // PERIPHERALS SECTION
        // =====================================================
        else if (name.includes('1773794463802942')) {

            if (name.includes('[peripheral]')) {

                if (peripherals !== '') {
                    peripherals += separator();
                }

                peripherals += `<p><b>Peripheral:</b> ${value}</p>`;
            }

            else if (name.includes('[brand]')) {
                peripherals += `<p><b>Brand:</b> ${value}</p>`;
            }

            else if (name.includes('[serial]')) {
                peripherals += `<p><b>Serial:</b> ${value}</p>`;
            }

            else if (name.includes('[year]')) {
                peripherals += `<p><b>Year:</b> ${value}</p>`;
            }

            else if (name.includes('[remarks]')) {
                peripherals += `<p><b>Remarks:</b> ${value}</p>`;
            }
        }

        // =====================================================
        // PRINTER SECTION
        // =====================================================
        else if (name.includes('1774939854621235')) {

            if (name.includes('[brand]')) {

                if (printer !== '') {
                    printer += separator();
                }

                printer += `<p><b>Brand / Model:</b> ${value}</p>`;
            }

            else if (name.includes('[serial]')) {
                printer += `<p><b>Serial No:</b> ${value}</p>`;
            }

            else if (name.includes('[year]')) {
                printer += `<p><b>Year Acquired:</b> ${value}</p>`;
            }

            else if (name.includes('[remarks]')) {
                printer += `<p><b>Remarks:</b> ${value}</p>`;
            }
        }
    });

    // ================= RENDER =================
    addSection('🖥 COMPUTER (Desktop, All-in-One, Laptop)', computer);
    addSection('🖥 MONITOR', monitor);
    addSection('⌨ PERIPHERALS', peripherals);
    addSection('🖨 PRINTER', printer);

    $('#previewBody').html(html);
    $('#PreviewModal').modal('show');
}

function printFromPreview() {

    let content = document.getElementById('previewBody').innerHTML;

    let win = window.open('', '', 'width=900,height=700');

    win.document.write(`
        <html>
        <head>
            <title>Print Preview</title>

            <style>
                body{
                    font-family: Arial, sans-serif;
                    padding:20px;
                    line-height:1.7;
                }

                p{
                    margin:4px 0;
                }

                hr{
                    margin:15px 0;
                }
            </style>

        </head>

        <body>
            ${content}
        </body>

        </html>
    `);

    win.document.close();
    win.print();
}
// // ✅ RADIO UNSELECT (DOUBLE CLICK)
// $(document).on('mousedown', 'input[type="radio"]', function () {
//     $(this).data('waschecked', this.checked);
// });

// $(document).on('click', 'input[type="radio"]', function () {
//     if ($(this).data('waschecked')) {
//         $(this).prop('checked', false);

//         // remove remarks
//         let quest = this.name.match(/\d+/)[0];
//         $('.remarks-container-' + quest).empty();
//     }
// });

$(document).on('input', 'input[name*="[year]"]', function () {

    this.value = this.value.replace(/[^0-9]/g, '');

    if (this.value.length > 4) {
        this.value = this.value.slice(0, 4);
    }

});

$(document).on('blur', 'input[name^="ip_"]', function () {

    let ip = $(this).val();

    let pattern =
        /^(25[0-5]|2[0-4][0-9]|1?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|1?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|1?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|1?[0-9][0-9]?)$/;

    if (ip != '' && !pattern.test(ip)) {

        toastr.error('Invalid IP Address');

        $(this).focus();

    }

});
</script>



