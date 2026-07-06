<!DOCTYPE html>
<html>
<head>

<title>Workflow Login</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<h3>Login</h3>

<input
type="text"
id="username"
class="form-control mb-3"
placeholder="Username">

<input
type="password"
id="password"
class="form-control mb-3"
placeholder="Password">

<button
class="btn btn-primary w-100"
onclick="login()">

Login

</button>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

function login(){

    $.ajax({

        url:'ajax/login.php',

        type:'POST',

        data:{

            username:$("#username").val(),

            password:$("#password").val()

        },

        success:function(response){

            let data=JSON.parse(response);

            if(data.status){

                window.location='dashboard.php';

            }

            else{

                alert(data.message);

            }

        }

    });

}

</script>

</body>

</html>
