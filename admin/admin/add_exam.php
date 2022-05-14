<?php
	require_once('dbconfig.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");	
        session_start();
	
       // `exam_id`, `exam_title`, `exam_datatime`, `question`, `solution`, `point`
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
        <!--Navigation part starts-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li>
                <a class="navbar-brand" href="#">
                  <img src="../images/pro_logo.png" width="50" height="50" alt="">
                </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="home.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">User Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inbox.php">Inbox</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="postlist.php">Visit Website</a>
                </li>

                <li class="nav-item">
				<?php //if(Session::get('userRole')=='1'){ ?>
                    <a class="nav-link" href="adduser.php">Add User</a>
					<?php //} ?>
				
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="userlist.php">User List</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="panel-title">Add Exam</h3>
                    </div>
                </div>
            </div>
            <?php
  if (isset($_POST['exam_title']) && !empty($_POST['exam_datatime']) && !empty($_POST['question'])&&isset($_POST['solution'])&&isset($_POST['point'])){
    $exam_title=$_POST['exam_title'];
    $exam_datatime=$_POST['exam_datatime'];
    $question=$_POST['question'];
    $solution=$_POST['solution'];
    $point=$_POST['point'];

    if (empty($exam_title)||empty($exam_datatime)||empty($question)||empty($solution)||empty($point)){
            echo "<span class='error'>Field must not be empty ! </span>";//3
    }else{
        $inserted_rows = mysqli_query( $connect, "INSERT INTO exam_table(exam_title, exam_datatime, question, solution, point) VALUES('$exam_title','$exam_datatime','$question','$solution','$point')")
        or die("Can not execute query");
        if ($inserted_rows) {
            echo "<span class='success'>Post Inserted Successfully. </span>";
        }else{
            echo "<span class='success'>Post Not Inserted. </span>";
        }
    }
    
}
            ?>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-10 offset-md-1">


                        <form class="row g-3 form-group" action="" method="POST">
                            <div class="col-md-12">
                                <label for="exam_title" class="form-label">Exam Title</label>
                                <input type="text" name="exam_title" class="form-control" id="exam_title">
                            </div>
                            <div class="col-12">
                                <label for="exam_datatime" class="form-label">Exam Creation Time</label>
                                <input type="date" name="exam_datatime" class="form-control" id="exam_datatime">
                            </div>
                         
                            <div class="col-12">
                                <label for="question" class="form-label">Question </label>
                                <textarea name="question" cols="30" rows="2" class="form-control" id="qsn1"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="solution" class="form-label">Solution </label>
                                <textarea name="solution" cols="30" rows="2" class="form-control" id="solution"></textarea>
                            </div> 
                            <div class="col-12">
                                <label for="point" class="form-label">Points </label>
                                <input name="point"  cols="30" rows="2" class="form-control" id="point"></input>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                          
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>