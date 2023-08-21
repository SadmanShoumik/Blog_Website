<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Registration</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="icon" href="Resources/blogger.ico" type="image/x-icon"/>


</head>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
        body
        {
            font-family: 'Oswald', 'sans-serif';
            background-image: url("background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
</style>

<body>

    <div align="center">

        <a href="index.php"><img src='Resources/blogger.png' height='300' width='300' align="center"></a>

        <?php
            if(isset($_POST['sub']))
            {
                $name = $_POST['name'];
                $uname = $_POST['uname'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];

                $con = mysqli_connect("localhost", "root", "", "web_solution_firm");

                $checkval = "SELECT * FROM users WHERE username = '$uname';";
                $resval = mysqli_query($con, $checkval);

                if($row = mysqli_fetch_row($resval))
                {
        ?>
                    <div class="card-body">

                        <h5 style="font-size: 55px; font-weight: bolder; ">This username is taken. Try another one.</h5>
                        <a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="registration.php">Register Again</a>

                    </div>
        <?php
                }
                else
                {
                    $q = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$uname', '$email', '$pass');";

                    $res = mysqli_query($con, $q);
        ?>

                    <div class="card-body">

                        <h5 style="font-size: 55px; font-weight: bolder; ">Registration Completed.</h5>
                        <a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="login.php">Go to the Login Page</a>

                    </div>
        <?php
                }

            }
            else
            {
        ?>
                <div class="card-body">

                    <h5 style="font-size: 55px; font-weight: bolder; ">Registration Form</h5>
                            
                    <form style="height: 650px; width: 700px;" method="POST" class='form-control bg-transparent'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Name:</h4>
                        <input type="text" class='form-control'placeholder='Name' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" name='name'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Username:</h4>
                        <input type='text' class='form-control'placeholder='Create an username' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" name='uname'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Email:</h4>
                        <input type='email' class='form-control' placeholder='Example@gmail.com' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" name='email'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Password:</h4>
                        <input type='password' class='form-control' placeholder='Password (minimum 8 characters)' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" pattern="[A-Za-z0-9]{8,20}" name='pass'>
                        <input type="submit" class='form-control btn-primary' value='Register' style="font-weight: bolder; font-size: 40px; margin-top: 20px; background: black;" name='sub'>
                    </form>

                </div>
        <?php
            }
        ?>
        
    </div>

</body>

</html>