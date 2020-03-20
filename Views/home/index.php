<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Home</title>
    

</head>
<body>
    <nav class="navbar navbar-light bg-light mb-3">
    <a class="navbar-brand">TaskApp</a>
    <form class="form-inline" >
        <?php if ($_SESSION["status"] != 'logged'): ?>
            <a class="btn btn-outline-success my-2 my-sm-0" href="Login/index">Log In</a>
        <?php else: ?>
            <a class="btn btn-outline-success my-2 my-sm-0" href="Login/logout">Log Out</a>
        <?php endif; ?>
    </form>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form data-toggle="validator" role="form" id="new" method="GET" action="Home/add">
                <div class="form-group">
                    <label for="inputName" class="control-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Cina Saffary" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-error="Bruh, that email address is invalid" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="input-group">
                    <label for="inputName" class="control-label">Text</label>
                    <textarea type="text" class="form-control" name="body" id="body" placeholder="Cina Saffary" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-2 mb-3 ">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create new task
                </button>
            </div>
            <div class="col-md-3 mb-3 ">
                <a href="Home?semail=ASC" class="btn btn-primary" id="ssemail">
                    Email ASC
                </a>
                <a href="Home?semail=DESC" class="btn btn-primary" id="ssemail">
                    Email DESC
                </a>
            </div>
            <div class="col-md-4 mb-3 ">
                <a href="Home?susername=ASC" class="btn btn-primary" id="susername">
                    Username ASC
                </a>
                <a href="Home?susername=DESC" class="btn btn-primary" id="susername">
                    Username DESC
                </a>
            </div>
            <div class="col-md-3 mb-3 ">
                <a href="Home?sstatus=ASC" class="btn btn-primary" id="sstatus">
                    Status ASC
                </a>
                <a href="Home?sstatus=DESC" class="btn btn-primary" id="sstatus">
                    Status DESC
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <?php foreach($this->tasks as $item): ?>
                <div class="card mb-3">
                    <?php if (!$item['status']): ?>
                        <h5 class="card-header">Ne Done <?php if ($item['is_edited']) echo 'Edited' ?></h5>
                        <?php if ($_SESSION["status"] == 'logged'): ?>
                            <a class='btn btn-primary' href=<?php echo "Login/done?id=".$item['id']; ?>>Done <?php if ($item['is_edited']) echo 'Edited' ?></a>
                        <?php endif; ?>
                    <?php else: ?>
                        <h5 class="card-header bg-success">Done</h5>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['username'] ?></h5>
                        <h5 class="card-title"><?php echo $item['email'] ?></h5>
                        <?php if ($_SESSION["status"] == 'logged'): ?>
                        <form class="needs-validation" novalidate>
                            <input type="text" class="form-control mb-3 edit_body" task_id=<?php echo $item['id']; ?> value="<?php echo $item['body'] ?>">
                        </form>
                        <?php else: ?>
                            <p><?php echo $item['body'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($_SESSION["status"] == 'logged'): ?>
            <button class="btn btn-primary mb-3" id='submit_edit'>Change Text</button>
            <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                
                <ul class="pagination">
                    <?php for($i = 1; $i <= $this->tp; $i++): ?>
                        <?php if ($i == $this->page): ?>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">
                                    <?php echo $i ?>
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href=<?php echo "Home?page=".$i ?>><?php echo $i ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
                
            </div>
        </div>
    </div>
    <?php  
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
        else  
            $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
        
        $url_components = parse_url($url); 
    
        // Use parse_str() function to parse the 
        // string passed via URL 
        parse_str($url_components['query'], $params); 
        if (array_key_exists('success', $params)) {
            echo '<script type="text/javascript">';
            echo'alert("Success");';
            echo 'window.location = "http://localhost:8000/Home?page=1";';
            echo '</script>';
        }
    ?>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $("#submit_edit").click(function(e) {
        e.preventDefault();
        res = {}
        console.log(123);
        $('input.edit_body').each(function(){
            res[$(this).attr('task_id')] = $(this).val();
        })
        $.ajax({
            type: "GET",
            url: "/Login/edit",
            data: res,
            success: function(result) {
                console.log(res);
            },
            error: function(result) {
                alert('Error');
            }
        });
    });
</script>
<script>
    $("#new").validate({
        rules: {
            username: {
                required: true
            },
            email:{
                required: true,
            },
            boy: {
                required: true
            }
        }
      });

    $("#submit").click(function(e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "/Home/add",
            data: { 
                username: $("#username").val(),
                email: $("#email").val(),
                body: $("#body").val(),
                access_token: $("#access_token").val() 
            },
            success: function(result) {
                alert('Success');
            },
            error: function(result) {
                alert('Error');
            }
        });
    });

    $("#submit_edit").click(function(e) {
        e.preventDefault();
        res = {}
        console.log(123);
        $('input.edit_body').each(function(){
            res[$(this).attr('task_id')] = $(this).val();
        })
        $.ajax({
            type: "GET",
            url: "/Login/edit",
            data: res,
            success: function(result) {
                console.log(res);
            },
            error: function(result) {
                alert('Error');
            }
        });
    });
</script>
</body>
</html>