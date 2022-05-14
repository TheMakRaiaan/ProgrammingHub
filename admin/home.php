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
<h2 class="text-center">Welcome admin panel </h2>

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link active " href="home.php">Post list</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="catlist.php">Category List</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link " href="userlist.php">User List</a>
                    </li>
                    
                  </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title" >Post List</h3>
                        <a href="addpost.php" class="btn btn-success"  >Add Post</a>
                    </div>
                </div>
            </div>
            


            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                            <th widht="5%">No.</th>
                            <th widht="15%">Post Title</th>
                            <th widht="15%">Description</th>
                            <th widht="10%">Category</th>
                                <th widht="10%">Image</th>
                                <th widht="10%">Author</th>
                                <th widht="10%">Tags</th>
                                <th widht="15%">Date</th>
                            <th widht="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
     <?php
	//Category Delete
	if (isset($_GET['delpostid'])){
		$delid= $_GET['delpostid'];
	
        $delquey = mysqli_query( $connect, "DELETE from tbl_post where id='$delid' ")
		or die("Can not execute query");
        
	
		if( $delquey )
				{
				echo "<span class='success'>Post Deleted Successfully </span>";
				}
				else
				{
				echo "<span class='error'>Post Not Deleted  ! </span>";
				}
	}
?>


<?php
	$post = mysqli_query( $connect, "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id  ORDER By tbl_post.title DESC")
		or die("Can not execute query");
if($post){   
			$i=0;
			while ($result = $post->fetch_assoc()) {
			$i++;
?>
<tr >
<td><?php echo $i; ?></td>
<td><?php echo $result['title']; ?></td>
<td><?php echo $result['body']; ?></td>
<td><?php echo $result['name']; ?></td>
<td><img src="<?php echo $result['image']; ?>" height="40px" widht="60px"></td>
	<td><?php echo $result['author']; ?></td>
	<td><?php echo $result['tags']; ?></td>
	<td><?php echo $result['date'];?></td>

<td><a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a> 
||<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> 
|| <a onclick="return confirm('Are you sure to Delete this post?')" href="?delpostid=<?php echo $result['id']; ?>">Delete</a>
</td> 
</tr>

<?php } } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>




</body>
</html>