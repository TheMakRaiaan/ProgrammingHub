<?php
    session_start();

require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	
    #print_r($_SESSION);

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
    <br>
        <div class="card text-center">
               <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link  " href="home.php">Post list</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="catlist.php">Category List</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link " href="userlist.php">User List</a>
                    </li>
                    
                  </ul>
                  </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title" >Category List</h3>
                        <a href="addcat.php" class="btn btn-danger"  >Add Category</a>
                    </div>
                </div>
            </div>
            
            <?php
	
    //Category Delete
    if (isset($_GET['delcat'])){
        $delid= $_GET['delcat'];
        $delquey = "delete from tbl_category where id='$delid' ";
        $deldata = mysqli_query( $connect, $delquey)
		or die("Can not execute query");
        if( $deldata )
             {
                echo "<span class='success'>Catergory Deleted Successfully </span>";
             }
             else
             {
                echo "<span class='error'>Catergory Not Deleted  ! </span>";
             }
    }
    ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
                        <?php
                        $query = "select * from tbl_category order by id desc";
                        $category = mysqli_query( $connect, $query)
                        or die("Can not execute query");
                        if ($category)
                        {
                            $i=0 ;
                            while ($result= $category->fetch_assoc())
                            {
                             $i++; 
                           ?>
						<tr >
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a>||<a onclick="return confirm ('Do you really want to delete!'); "href="?delcat=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
                        <?php }} ?>
                        </thead>                            
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>




</body>
</html>