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
                            <a class="nav-link active" href="profile.php?u_id=<?php echo $u_id; ?>" style="margin-left:20px; margin-right:20px; color: black; font-weight: bolder;">Profile</a>
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
                echo "<div class='form-control'>";
                    echo "<a href='homepage.php?u_id=$u_id&b_id=$row[0]' style='color: black;'><h2 style='font-weight: bolder;'>$row[2]<h2></a>";
                    echo "<h6 style='font-weight: bolder;'>$row[4]</h6>";
                    echo "<h5>$s...<a href='homepage.php?u_id=$u_id&b_id=$row[0]'>Continue Reading</a></h5>";
                echo "</div>";
            }
        }
        elseif(isset($_POST['edited']))
        {
            $con = mysqli_connect("localhost", "root", "", "web_solution_firm");

            $u_id = $_GET['u_id'];

            $edit_b_id = $_GET['edit'];

            $title = $_POST['title'];

            $content = $_POST['content'];

            $date = date('Y-m-d H:i:s');

            $q = "UPDATE blogs SET title = '$title', content = '$content', date = '$date'  WHERE b_id = $edit_b_id";

            $res = mysqli_query($con, $q);

            echo "<div class='card-body' align='center'>";

                echo "<h5 style='font-size: 55px; font-weight: bolder;'>Blog post was edited properly.</h5>";
                echo "<a class='btn btn-success m-2' style='font-size:40px; font-weight: bolder; background: black;' href='myblogs.php?u_id=$u_id'>Go back to your blogs.</a>";

            echo "</div>";

        }
        elseif(isset($_GET['edit']))
        {
            $edit_b_id = $_GET['edit'];

            $q = "SELECT * FROM blogs WHERE b_id = $edit_b_id";

            $res = mysqli_query($con, $q);

            while($row = mysqli_fetch_row($res))
            {
                echo "<div class='card-body' align='center'>";

                    echo "<h5 style='font-size: 55px; font-weight: bolder;'>Edit Blog Post</h5>";

                    echo "<form style='height: 950px; width: 1500px;' method='POST' class='form-control bg-transparent'>";
                        echo "<h4 align='left' style='font-weight: bolder; font-size: 35px margin-top: 20px;'>Title:</h4>";
                        echo "<input type='text' class='form-control' style='width:1470px; font-size: 30px; margin-top: 20px; margin-bottom: 20px;'' name='title' value='$row[2]'>";
                        echo "<h4 align='left' style='font-weight: bolder; font-size: 35px margin-top: 20px;'>Post:</h4>";
                        echo "<textarea style='height:580px; width:1470px; font-size: 20px; margin-top: 20px; margin-bottom: 20px;' name='content'>$row[3]</textarea>";
                        echo "<input type='submit' class='form-control btn-primary' value='Edit' style='font-weight: bolder; font-size: 40px; margin-top: 20px; background: black;' name='edited'>";
                    echo "</form>";

                echo "</div>";
            }
        }
        
    ?>

</body>

</html>