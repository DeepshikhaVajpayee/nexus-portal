<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nexus Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background:#0f172a;
    color:white;
    font-family:Arial;
}

.sidebar{
    height:100vh;
    background:#111827;
    padding:20px;
}

.card-box{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(10px);
    border-radius:20px;
    padding:20px;
    margin-bottom:20px;
}

.table{
    color:white;
}

.logo{
    font-size:26px;
    font-weight:bold;
    margin-bottom:40px;
}

</style>

</head>

<body>

<div class="container-fluid">

<div class="row">

<!-- Sidebar -->
<?php include "sidebar.php"; ?>

<!-- Main Content -->
<div class="col-md-10 p-4">

<h2 class="mb-4">
Enterprise Workforce Intelligence Dashboard
</h2>

<!-- Top Cards -->
<div class="row">

<div class="col-md-3">
<div class="card-box">
<h5>Total Employees</h5>
<h2>248</h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h5>Present Today</h5>
<h2>221</h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h5>Open Tickets</h5>
<h2>12</h2>
</div>
</div>

<div class="col-md-3">
<div class="card-box">
<h5>AI Alerts</h5>
<h2>4</h2>
</div>
</div>

</div>

<!-- Charts + AI -->
<div class="row mt-4">

<div class="col-md-8">

<div class="card-box">

<h4 class="mb-3">Attendance Analytics</h4>

<canvas id="attendanceChart"></canvas>

</div>

</div>

<div class="col-md-4">

<div class="card-box">

<h4>AI Insights</h4>

<hr>

<p>
Predicted absenteeism risk increased by 8% in Operations.
</p>

<p>
Employee productivity stable across Engineering teams.
</p>

</div>

</div>

</div>

<!-- Attendance Table -->
<div class="row mt-4">

<div class="col-md-12">

<div class="card-box">

<h4 class="mb-3">Live Attendance Logs</h4>

<table class="table">

<thead>
<tr>
<th>Employee</th>
<th>Department</th>
<th>Status</th>
<th>Time</th>
</tr>
</thead>

<tbody id="attendanceTable"></tbody>

</table>

</div>

</div>

</div>

</div>
</div>
</div>

<!-- JS -->
<script>

// Load attendance logs
async function loadAttendance(){

    let res = await fetch('/api/attendance/logs.php');
    let data = await res.json();

    let table = document.getElementById('attendanceTable');

    table.innerHTML = "";

    data.logs.forEach(log => {

        let time = new Date(log.scan_time).toLocaleTimeString();

        table.innerHTML += `
        <tr>
            <td>${log.name}</td>
            <td>${log.department}</td>
            <td style="color:${log.status==='Checked In'?'lightgreen':'orange'}">
                ${log.status}
            </td>
            <td>${time}</td>
        </tr>
        `;
    });
}

// auto refresh every 3 sec
setInterval(loadAttendance, 3000);

// initial load
loadAttendance();

// Chart
const ctx = document.getElementById('attendanceChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri'],
        datasets: [{
            label: 'Attendance',
            data: [210,220,215,225,221]
        }]
    }
});

</script>

</body>
</html>