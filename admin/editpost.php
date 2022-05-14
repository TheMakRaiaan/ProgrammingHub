<?php
require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	

?>

<?php
if (!isset($_GET['editpostid'])|| $_GET['editpostid'] == NULL) {
    echo "<script>window.location = 'catlist.php';</script>"; 
}else {
    $postid = $_GET['editpostid'];
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


<h2>Update Post</h2>
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
        $updated_row = mysqli_query( $connect, "UPDATE tbl_post SET cat ='$cat',title ='$title',body ='$body',author ='$author',tags ='$tags' where id= '$postid'")
        or die("Can not execute query");
   
          if ($updated_row) {
              echo "<span class='error' >Update Sucessfull! </span>";//2
          }else{
           echo "<span class='success'>Post Not Updated. </span>";
          }

    }        

}
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
                        <input class="form-control" type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label class="">Category</label>
                    </td>
                    <td>
                        <select class="form-control" id="select" name="cat">
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
                            
                            value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                            <?php }} ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                        <div class="col">
                        <label class="">Upload Image</label>

<img class="rounded mx-auto d-block" src="<?php echo $postresult['image']; ?>" height="100px" width="100px"> <br>
<input class="form-control-file" type="file" name="image" />
                        </div>
                    
                        </div>
                   
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label >Content</label>
                    </td>
                    <td>
                        <textarea class=""  name="body" >
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
                        <input class="form-control" type="text" name="tags" value="<?php echo $postresult['tags']; ?>"  />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="">Author</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="author" value="<?php echo $postresult['author']; ?>"  />
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userId']?>" class="medium" />

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-danger" type="submit" name="submit" Value="Save" />
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




