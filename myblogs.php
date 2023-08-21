<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blogs</title>
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

        <?php
            if(isset($_GET['u_id']))
            {
                $u_id = $_GET['u_id'];

                $con = mysqli_connect("localhost", "root", "", "web_solution_firm");
            }
        ?>

        <a href="homepage.php?u_id=<?php echo $u_id; ?>"><img src='Resources/blogger.png' height='150' width='150' align="center"></a>


        <div class="form-control" align="center">

            <nav class="navbar navbar-expand-sm">

                <div class="container-fluid">

                    <form class="d-flex" method="POST">
                        <input class="form-control" style="font-weight: bolder;" type="text" name="keyword" placeholder="Search Blogs">
                        <button class="btn btn-secondary" style="background: black; font-weight: bolder;" type="submit" name="search" value="yes">Search</button>
                    </form>

                    <div style="position: absolute; left: 793px;"><h2 style="font-size: 55px; font-weight: bolder;">Online Web Blog</h2></div>

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <img src="Resources/profile.png" width="40px" height="40px">
                            <a class="nav-link active" href="profile.php" style="margin-left:20px; margin-right:20px; color: black; font-weight: bolder;">Profile</a>
                        </li>

                        <li class="nav-item">
                            <img src="Resources/newblog.png" width="40px" height="40px">
                            <a class="nav-link active" href="newblog.php?u_id=<?php echo $u_id; ?>" style="margin-left:20px; margin-right:20px; color: black; font-weight: bolder;">New Blog</a>
                        </li>

                        <li class="nav-item">
                            <img src="Resources/blogs.png" width="40px" height="40px">
                            <a class="nav-link active" href="myblogs.php?u_id=<?php echo $u_id; ?>" style="margin-left:20px; margin-right:20px; color: black; font-weight: bolder;">My Blogs</a>
                        </li>

                        <li class="nav-item">
                            <img src="Resources/logout.png" width="40px" height="40px">
                            <a class="nav-link active" href="login.php" style="margin-left:20px; margin-right:20px; color: black; font-weight: bolder;">Logout</a>
                        </li>

                    </ul>

                </div>

            </nav>

        </div>
        
    </div>


    <?php
        if(isset($_POST['search']))
        {
            $search = $_POST['keyword'];
            $con = mysqli_connect("localhost", "root", "", "web_solution_firm");

            $q = "SELECT * FROM blogs WHERE content LIKE '%$search%' OR title LIKE '%$search%' ORDER BY date DESC;";

            $res = mysqli_query($con, $q);
            while($row = mysqli_fetch_row($res))
            {
                if(strlen($row[3])>1000)
                {
                    $s = substr($row[3], 0, 1000);
                }
                else
                {
                    $s = $row[3];
                }
                echo "<div align='center'>";
                    echo "<div class='form-control' style='width: 1700px;'>";
                        echo "<a href='homepage.php?u_id=$u_id&b_id=$row[0]' style='color: black;' align='left'><h2 style='font-weight: bolder;'>$row[2]<h2></a>";
                        $authorq = "SELECT name FROM users WHERE u_id = $row[1];";
                        $authorname = mysqli_query($con, $authorq);

                        while($authorrow = mysqli_fetch_row($authorname))
                            $aname = $authorrow[0];

                        echo "<h6 style='font-weight: bolder;' align='left'>Written by: $aname<br>Posted On: $row[4]</h6>";
                        echo "<h5 align='left'>$s...<a style='font-weight: bolder' href='homepage.php?u_id=$u_id&b_id=$row[0]'>Continue Reading</a></h5>";
                    echo "</div>";
                echo "</div>";
            }
        }
        elseif(isset($_GET['deleteid']))
        {
            $deleteid = $_GET['deleteid'];

            $q = "DELETE FROM blogs WHERE b_id = $deleteid";

            $res = mysqli_query($con, $q);

            echo "<div class='card-body' align='center' style='margin-top: 100px;'>";

                echo '<h5 style="font-size: 55px; font-weight: bolder; ">Blog post deleted.</h5>';
                echo '<a class="btn btn-success m-2" style="font-size:40px; font-weight: bolder; background: black;" href="myblogs.php?u_id='.$u_id.'">Proceed to your blogs.</a>';

            echo "</div>";
        }
        elseif(isset($_GET['u_id']))
        {
            $u_id = $_GET['u_id'];

            $con = mysqli_connect("localhost", "root", "", "web_solution_firm");

            $q = "SELECT * FROM blogs WHERE u_id = $u_id ORDER BY date DESC;";

            $res = mysqli_query($con, $q);
            while($row = mysqli_fetch_row($res))
            {
                if(strlen($row[3])>1000)
                {
                    $s = substr($row[3], 0, 1000);
                }
                else
                {
                    $s = $row[3];
                }
                echo "<div align='center'>";
                    echo "<div class='form-control' style='width: 1700px;'>";
                        echo "<a href='homepage.php?u_id=$u_id&b_id=$row[0]' style='color: black;' align='left'><h2 style='font-weight: bolder;'>$row[2]<h2></a>";
                        echo "<h6 style='font-weight: bolder;' align='left'>Posted On: $row[4]</h6>";
                        echo "<h5 align='left'>$s...<a style='font-weight: bolder' href='homepage.php?u_id=$u_id&b_id=$row[0]'>Continue Reading</a></h5>";
                        echo "<div align='left'><a class='btn btn-success' style='font-size:20px; font-weight: bolder; background: black; margin: 5px;' href='myblogs.php?u_id=$u_id&deleteid=$row[0]'>Delete Post</a><a class='btn btn-success' style='font-size:20px; font-weight: bolder; background: black; margin: 5px;' href='editblog.php?u_id=$u_id&edit=$row[0]'>Edit</a></div>";
                    echo "</div>";
                echo "</div>";
            }
        }
        
    ?>

</body>

</html>