<?php
require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	

?>




<?php
require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	

?>
<?php
if (!isset($_GET['viewpostid'])|| $_GET['viewpostid'] == NULL) {
    echo "<script>window.location = 'postlist.php';</script>"; 
}else {
    $postid = $_GET['viewpostid'];
}?>

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


<h2>View Post</h2>
    <?php
    $getpost = mysqli_query( $connect, "select * from tbl_post where id='$postid' order by id desc")
            or die("Can not execute query");
             while($postresult= $getpost->fetch_assoc()){
            ?>              
        <form class="form-group"action="" method="post" enctype="multipart/form-data">
            <table class="form-control">
            
                <tr>
                    <td>
                        <label class="">Title</label>
                    </td>
                    <td>
                        <input class="form-control" readonly type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label readonly class="">Category</label>
                    </td>
                    <td>
                        <select readonly class="form-control" id="select" name="cat">
                            <option class="from-control" >Select Category</option>
                            <?php 
                                     $category = mysqli_query( $connect, "SELECT * from tbl_category")
                                     or die("Can not execute query");

                                        if($category){
                                            while($result= $category->fetch_assoc()){

                                    ?>
                            <option 
                            <?php
                                if($postresult['cat']==$result['id']){ ?>
                            selected="selected"
                            <?php    }
                            ?>
                             readonly
                            value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                            <?php }} ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                        <div class="col">
                        <label class="">Image</label>

<img class="rounded mx-auto d-block" src="<?php echo $postresult['image']; ?>" height="100px" width="100px"> <br>
                        </div>
                    
                        </div>
                   
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label >Content</label>
                    </td>
                    <td>
                 
                        <textarea class="" readonly >
                            <?php echo $postresult['body']; ?>
                        </textarea>
                    </td>
                </tr>

                <td>
                <tr>
                    <td>
                        <label class="">Tags</label>
                    </td>
                    <td>
                        <input readonly class="form-control" type="text" name="tags" value="<?php echo $postresult['tags']; ?>"  />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label readonly class="">Author</label>
                    </td>
                    <td>
                        <input readonly class="form-control" type="text" name="author" value="<?php echo $postresult['author']; ?>"  />
                        <input  readonly type="hidden" name="userid" value="<?php echo $_SESSION['userId']?>" class="medium" />

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <a class="btn btn-danger" href="home.php" Value="" > Okay</a>
                    </td>
                </tr>
            </table>
            </form>
            <?php } ?>

            <form>
                

</form>
</div>
</body>
</html>




