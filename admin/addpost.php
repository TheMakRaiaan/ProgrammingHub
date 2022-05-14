<?php
	require_once('dbconfig.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");	
        session_start();
	
?>
<?php 
//if($_SESSION['userRole']=='1'){ 
  //  echo "<script>window.location='index.php';</script>";
//}
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
                <li class="nav-item active">
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
                    <a class="nav-link" href="{%url 'admin_login'%}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container">
    <br>
<?php
    if (isset($_POST['title']) && !empty($_POST['cat']) && !empty($_POST['tags'])&&isset($_POST['author'])){
        $title=$_POST['title'];
        $cat=$_POST['cat'];
        $body=$_POST['body'];
        $tags=$_POST['tags'];
        $author=$_POST['author'];
        


        if (empty($title)||empty($cat)||empty($body)||empty($tags)||empty($author)){
                echo "<span class='error'>Field must not be empty ! </span>";//3
        }else{
            $inserted_rows = mysqli_query( $connect, "INSERT INTO tbl_post(cat, title, body, author, tags) VALUES('$cat','$title','$body','$author','$tags')")
            or die("Can not execute query");
            if ($inserted_rows) {
                echo "<span class='success'>Post Inserted Successfully. </span>";
            }else{
                echo "<span class='success'>Post Not Inserted. </span>";
            }
        }
        
    }
    ?>

                    <form class="form-group" action="addpost.php" method="post" enctype="multipart/form-data">
            <table class="form-control">
                       <h2>Add Post</h2>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="title" placeholder="Enter Post Title..."  />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select class="form-control" id="select" name="cat">
                                    <option value="">Select Category</option>
                                    <?php 
                                     $category = mysqli_query( $connect, "SELECT * from tbl_category")
                                     or die("Can not execute query");

                                        if($category){
                                            while($result= $category->fetch_assoc()){

                                    ?>
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                     <?php }} ?><!--2 -->
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input class="form-control-file" type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="form-control" name="body" ></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="tags" placeholder="Enter tags..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="author" value="<?php echo $_SESSION['username']?>" class="medium" />
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
</body>
</html>

