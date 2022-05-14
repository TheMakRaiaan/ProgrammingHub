<?php
require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	

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
                    <a class="nav-link" href="home.php">Visit Website</a>
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
                      <a class="nav-link " href="catlist.php">Category List</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link active" href="userlist.php">User List</a>
                    </li>
                    
                  </ul>
            </div>
        

                <h2 class="text-center">User List</h2>
                
                <?php
                //Category Delete
                if (isset($_GET['deluser'])){
                    $deluser= $_GET['deluser'];
                    $delquey = mysqli_query( $connect, "DELETE from tbl_user where id='$deluser' ")
		or die("Can not execute query");
                
                    if( $delquey )
                         {
                            echo "<span class='text-center'>User Deleted Successfully </span>";
                         }
                         else
                         {
                            echo "<span class='text-center'>User Not Deleted  ! </span>";
                         }
                }
                ?>

<div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
							<th >Serial No.</th>
							<th >Name</th>
							<th >Username</th>
							<th >Email</th>
							<th >Details</th>
							<th >Role</th>
							<th >Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	
	$post = mysqli_query( $connect, "SELECT * from tbl_user order by id desc")
		or die("Can not execute query");
if($post){   
			$i=0;
			while ($result = $post->fetch_assoc()) {
			$i++;
?>


						<tr class="odd gradeX" >
							<td ><?php echo $i; ?></td>
							<td ><?php echo $result['name']; ?></td>
							<td ><?php echo $result['username']; ?></td>
							<td ><?php echo $result['email']; ?></td>
							<td ><?php echo $result['details']; ?></td>
							<td ><?php
                                    if($result['role']=='1'){
                                        echo "Admin";
                                    }elseif($result['role']=='2'){
                                        echo "Author";
                                    }elseif($result['role']=='3'){
                                        echo "Editor";
                                    }
                            
                            
                            ?></td>
							<td ><a href="viewUser.php?userid=<?php echo $result['id']; ?>">View</a>
                            

                            ||<a onclick="return confirm ('Do you really want to delete!'); "href="?deluser=<?php echo $result['id'];?>">Delete</a></td>
                        </tr>
                        <?php }} ?>
                       
					</tbody>
				</table>

                </div>
                </div>
           
    
</body>
</html>


