<!DOCTYPE html>
<html>
<head>
<title>Reports - Nexus Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#0f172a;color:white;font-family:Arial;}
.sidebar{height:100vh;background:#111827;padding:20px;}
.logo{font-size:26px;font-weight:bold;margin-bottom:40px;}
.card-box{background:rgba(255,255,255,0.08);border-radius:20px;padding:20px;margin-bottom:20px;}
.table{color:white;}
</style>
</head>

<body>
<div class="container-fluid">
<div class="row">

<?php include "sidebar.php"; ?>

<div class="col-md-10 p-4">
<h2>Monthly Reports</h2>

<div class="card-box mt-4">
<h4>Generate Report</h4>
<p>Select report type and generate monthly workforce summary.</p>

<select class="form-control mb-3">
<option>Attendance Report</option>
<option>Employee Productivity Report</option>
<option>Ticket Resolution Report</option>
</select>

<button class="btn btn-primary" onclick="generateReport()">Generate Report</button>

<p id="reportMsg" class="mt-3"></p>
</div>

<div class="card-box">
<h4>Available Reports</h4>
<table class="table">
<tr><th>Report Name</th><th>Month</th><th>Status</th></tr>
<tr><td>Attendance Summary</td><td>April 2026</td><td>Generated</td></tr>
<tr><td>AI Workforce Analytics</td><td>April 2026</td><td>Generated</td></tr>
</table>
</div>

</div>
</div>
</div>
<table class="table">
<thead>
<tr>
<th>Report Name</th>
<th>Type</th>
<th>Status</th>
<th>Generated At</th>
</tr>
</thead>
<tbody id="reportsTable"></tbody>
</table>
<script>
async function generateReport(){
    let reportType = document.querySelector("select").value;

    let res = await fetch("/api/reports/generate.php", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({report_type: reportType})
    });

    let data = await res.json();

    document.getElementById("reportMsg").innerHTML =
    "✅ " + data.message;

    loadReports();
}

async function loadReports(){
    let res = await fetch("/api/reports/list.php");
    let data = await res.json();

    let table = document.getElementById("reportsTable");
    table.innerHTML = "";

    data.reports.forEach(r => {
        table.innerHTML += `
        <tr>
            <td>${r.report_name}</td>
            <td>${r.report_type}</td>
            <td>${r.status}</td>
            <td>${r.created_at}</td>
        </tr>`;
    });
}

loadReports();
</script>
</body>
</html>