<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="Logi" method="post">
        <h2 class="text-center">Log in</h2>   
        <?php echo ($_SESSION["status"]); ?> 
        <div class="form-group">
            <input type="text" id='username' class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" id='password' class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <button type='submit' id="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php if ($_SESSION["status"] == 'logged') header("Location: http://localhost:8000/Home?page=1"); ?>
<script>
    $("#submit").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/Login/auth",
            data: { 
                username: $("#username").val(),
                password: $("#password").val(),
                access_token: $("#access_token").val() 
            },
            success: function(value) {
                location.reload();
            },
            error: function(value) {
                alert('Error');
            }
        });
    });
</script>
</body>
</html>                                		                            