<!DOCTYPE html>
<html>
<head>
<title>Ticketing - Nexus Portal</title>
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
<h2>Internal Ticketing System</h2>

<div class="card-box mt-4">
<h4>Create Ticket</h4>

<input type="text" id="title" class="form-control mb-2" placeholder="Ticket title">
<textarea id="description" class="form-control mb-2" placeholder="Ticket description"></textarea>

<select id="priority" class="form-control mb-3">
<option>Low</option>
<option>Medium</option>
<option>High</option>
</select>

<button class="btn btn-primary" onclick="createTicket()">Create Ticket</button>
</div>

<div class="card-box">
<h4>Tickets</h4>
<table class="table">
<thead>
<tr>
<th>Title</th>
<th>Description</th>
<th>Priority</th>
<th>Status</th>
</tr>
</thead>
<tbody id="ticketTable">
<tr>
<td>VPN Access Issue</td>
<td>Unable to access internal network</td>
<td>High</td>
<td>Open</td>
</tr>
</tbody>
</table>
</div>

</div>
</div>
</div>

<script>
function createTicket(){
    let title = document.getElementById("title").value;
    let desc = document.getElementById("description").value;
    let priority = document.getElementById("priority").value;

    document.getElementById("ticketTable").innerHTML += `
    <tr>
        <td>${title}</td>
        <td>${desc}</td>
        <td>${priority}</td>
        <td>Open</td>
    </tr>`;
}
</script>

</body>
</html>