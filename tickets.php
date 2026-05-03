<!DOCTYPE html>
<html>
<head>
<title>Ticketing - Nexus Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
.logo{
    font-size:26px;
    font-weight:bold;
    margin-bottom:40px;
}
.card-box{
    background:rgba(255,255,255,0.08);
    border-radius:20px;
    padding:20px;
    margin-bottom:20px;
}
.table{
    color:white;
}
</style>
</head>

<body>

<script>
if(!localStorage.getItem("token")){
    window.location = "login.php";
}
</script>

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
    <option value="Low">Low</option>
    <option value="Medium">Medium</option>
    <option value="High">High</option>
</select>

<button class="btn btn-primary" onclick="createTicket()">Create Ticket</button>

<p id="ticketMsg" class="mt-3"></p>

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

<tbody id="ticketTable"></tbody>

</table>

</div>

</div>
</div>
</div>

<script>

async function createTicket(){

    let title = document.getElementById("title").value;
    let description = document.getElementById("description").value;
    let priority = document.getElementById("priority").value;

    let res = await fetch("/api/tickets/create.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            title: title,
            description: description,
            priority: priority
        })
    });

    let data = await res.json();

    document.getElementById("ticketMsg").innerHTML =
        data.status === "success"
        ? "✅ " + data.message
        : "❌ " + data.message;

    document.getElementById("title").value = "";
    document.getElementById("description").value = "";
    document.getElementById("priority").value = "Low";

    loadTickets();
}

async function loadTickets(){

let res = await fetch("/api/tickets/list.php");
let data = await res.json();

console.log(data);

let table = document.getElementById("ticketTable");
table.innerHTML = "";

if(data.status !== "success"){
    table.innerHTML = `<tr><td colspan="4">${data.message}</td></tr>`;
    return;
}

if(data.tickets.length === 0){
    table.innerHTML = `<tr><td colspan="4">No tickets found</td></tr>`;
    return;
}

data.tickets.forEach(ticket => {
    table.innerHTML += `
    <tr>
        <td>${ticket.title}</td>
        <td>${ticket.description}</td>
        <td>${ticket.priority}</td>
        <td>${ticket.status}</td>
    </tr>`;
});
}
function logout(){
    localStorage.removeItem("token");
    window.location = "login.php";
}

loadTickets();

</script>

</body>
</html>