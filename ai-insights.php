<!DOCTYPE html>
<html>
<head>
<title>AI Insights - Nexus Portal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#0f172a;color:white;font-family:Arial;}
.sidebar{height:100vh;background:#111827;padding:20px;}
.logo{font-size:26px;font-weight:bold;margin-bottom:40px;}
.card-box{background:rgba(255,255,255,0.08);border-radius:20px;padding:20px;margin-bottom:20px;}
</style>
</head>

<body>
<div class="container-fluid">
<div class="row">

<?php include "sidebar.php"; ?>

<div class="col-md-10 p-4">
<h2>AI Workforce Insights</h2>

<div class="row mt-4">
<div class="col-md-4">
<div class="card-box">
<h5>Absenteeism Risk</h5>
<h2>8%</h2>
<p>Operations department shows slight increase.</p>
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<h5>Productivity Trend</h5>
<h2>Stable</h2>
<p>Engineering team performance is consistent.</p>
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<h5>AI Alerts</h5>
<h2>4</h2>
<p>Generated from attendance and task trends.</p>
</div>
</div>
</div>

<div class="card-box">
<h4>HR Assistant</h4>
<input type="text" id="question" class="form-control" placeholder="Ask HR assistant...">
<button class="btn btn-primary mt-3" onclick="askAI()">Ask AI</button>
<p id="answer" class="mt-3">AI response will appear here.</p>
</div>

</div>
</div>
</div>

<script>
function askAI(){
    let q = document.getElementById("question").value;
    document.getElementById("answer").innerHTML =
    "AI Insight: Based on workforce trends, attendance is stable but monitoring is recommended for repeated late check-ins.";
}
</script>

</body>
</html>