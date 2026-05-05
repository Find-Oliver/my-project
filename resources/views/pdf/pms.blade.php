<!DOCTYPE html>
<html>
<head>
    <title>PMS Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        .section { margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>PREVENTIVE MAINTENANCE REPORT</h2>

<p><strong>Name:</strong> {{ $name }}</p>
<p><strong>Division:</strong> {{ $division }}</p>
<p><strong>Conducted By:</strong> {{ $conducted_by }}</p>
<p><strong>Conforme:</strong> {{ $conforme }}</p>

<hr>

@foreach($responses as $res)
    <div class="section">
        <p><strong>Question ID:</strong> {{ $res->question_id }}</p>
        <p>Status: {{ $res->status == 1 ? 'Yes' : 'No' }}</p>
        <p>Brand: {{ $res->brand }}</p>
        <p>Model: {{ $res->model }}</p>
        <p>Serial Number: {{ $res->serial_number }}</p>
        <p>Remarks: {{ $res->remarks }}</p>
    </div>
@endforeach

</body>
</html>
