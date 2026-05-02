<!DOCTYPE html>
<html>
<head>
<title>Attendance - Nexus Portal</title>
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
<h2>Attendance Monitoring</h2>

<div class="card-box mt-4">
<h4>Scan RFID</h4>

<div class="row">
<div class="col-md-8">
<input type="text" id="uid" class="form-control" placeholder="Enter RFID UID e.g. RFID123">
</div>
<div class="col-md-4">
<button class="btn btn-primary w-100" onclick="scanRFID()">Submit Scan</button>
</div>
</div>

<p id="scanResult" class="mt-3"></p>
</div>

<div class="card-box">
<h4>Detailed Attendance Logs</h4>

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

<script>
async function scanRFID(){
    let uid = document.getElementById("uid").value;

    let res = await fetch("/api/attendance/scan.php", {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({uid:uid})
    });

    let data = await res.json();

    document.getElementById("scanResult").innerHTML =
        data.status === "success"
        ? `✅ ${data.employee} - ${data.attendance_status}`
        : `❌ ${data.message}`;

    loadAttendance();
}

async function loadAttendance(){
    let token = localStorage.getItem("token");
    let res = await fetch('/api/attendance/logs.php', {
    headers:{
        "Authorization": "Bearer " + token
    }});
    let table = document.getElementById("attendanceTable");
    table.innerHTML = "";

    data.logs.forEach(log=>{
        table.innerHTML += `
        <tr>
            <td>${log.name}</td>
            <td>${log.department}</td>
            <td style="color:${log.status==='Checked In'?'lightgreen':'orange'}">${log.status}</td>
            <td>${log.scan_time}</td>
        </tr>`;
    });
}

loadAttendance();
setInterval(loadAttendance,3000);
</script>
<script>
function logout(){
    localStorage.removeItem("token");
    window.location = "login.php";
}
</script>

</body>
</html>