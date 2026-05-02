<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#0f172a;color:white;">

<div class="container mt-5">

<h2>Login</h2>

<input id="email" class="form-control mb-2" placeholder="Email">
<input id="password" type="password" class="form-control mb-2" placeholder="Password">

<button class="btn btn-primary" onclick="login()">Login</button>

<p id="msg"></p>

</div>

<script>
async function login(){

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    let res = await fetch("/api/auth/login.php",{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({email,password})
    });

    let data = await res.json();

    if(data.status==="success"){
    localStorage.setItem("token", data.token);
    window.location = "index.php";
    }else{
        document.getElementById("msg").innerHTML = data.message;
    }
}
</script>

</body>
</html>