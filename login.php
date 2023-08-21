<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Login</title>
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
                $uname = $_POST['uname'];
                $pass = $_POST['pass'];

                $con = mysqli_connect("localhost", "root", "", "web_solution_firm");
                $q = "SELECT * FROM users WHERE username = '$uname';";

                $res = mysqli_query($con, $q);

                if($row = mysqli_fetch_row($res))
                {
                	
	                if($row[4]==$pass)
	                {
	                	echo "<div class='card-body'>";

		                    echo '<h5 style="font-size: 55px; font-weight: bolder; ">Login Successful.</h5>';
		                    echo '<a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="homepage.php?u_id='.$row[0].'">Proceed to the Homepage</a>';

		                echo "</div>";
	                }
	                else
	                {
	    ?>
	                	<div class="card-body">

		                    <h5 style="font-size: 55px; font-weight: bolder; ">Wrong Password.</h5>
		                    <a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="login.php">Try Again</a>

		                </div>
		<?php
	                }
	                
                }
                else
                {
        ?>
                	<div class="card-body">

                        <h5 style="font-size: 55px; font-weight: bolder; ">This user does not exist.</h5>
                        <a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="registration.php">Create a New Account</a>

                    </div>
        <?php
                }

            }
            else
            {
        ?>
                <div class="card-body">

                    <h5 style="font-size: 55px; font-weight: bolder; ">User Login</h5>
                            
                    <form style="height: 400px; width: 700px;" method="POST" class='form-control bg-transparent'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Username:</h4>
                        <input type='text' class='form-control'placeholder='Enter your username' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" name='uname'>
                        <h4 align="left" style="font-weight: bolder; font-size: 35px margin-top: 20px;">Password:</h4>
                        <input type='password' class='form-control' placeholder='xxxxxxxx' style="font-size: 30px; margin-top: 20px; margin-bottom: 20px;" pattern="[A-Za-z0-9]{8,20}" name='pass'>
                        <input type="submit" class='form-control btn-primary' value='Login' style="font-weight: bolder; font-size: 40px; margin-top: 20px; background: black;" name='sub'>
                    </form>

                </div>
        <?php
            }
        ?>
        
    </div>

</body>

</html>