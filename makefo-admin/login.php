<?php
session_start();

include("../db_con.php")

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makefo-login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .card {
            -webkit-box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="card p-5 w-50 mx-auto">
                <h1 class="text-center text-primary">MAKEFO</h1>
                <p class="text-center">Login to start Your Session</p>


            <?php
                if (isset($_POST['makefo_login'])) {
                    $username = $_POST['uname'];
                    $pass = $_POST['password'];

                    if ($username && $pass){
                        $sql = "SELECT * FROM account WHERE username='$username'";
                        $stmt = $conn->query($sql);
                        
                        if($account = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $_username = $account['username'];
                            $_pass = $account['password'];
                            
                            if(password_verify($pass, $_pass)){
                                $_SESSION['id']=$account['username'];
                                header('location:index.php');
                            }else{
                                echo "<p class='text-center alert text-danger'>Wrong Username or Passord</p>";
                            }
                        }else{
                            echo "<p class='text-center alert text-danger'>Wrong Username or Passord</p>";
                        }
                    }else{
                        echo "<p class='text-center alert text-danger'>Wrong Username or Passord</p>";
                    }              

                }
                ?>

                <form action="" method = "POST">
                    <input type="text" name="uname" class="w-100 p-3 my-2" placeholder="Enter Username" required>
                    <input type="password" name="password" class="w-100 p-3 my-2" placeholder="Enter Password" required>
                    <button type="submit" name='makefo_login'
                        class="w-100 p-3 bg-primary my-2 text-white">Login</button>
                </form>
                <a href="reset_password.php" class="text-center nav-link p-2">Forgot Password</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
            / </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
           < script >
           <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
               integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

</body>

</html>