<?php
	require_once('dbconfig.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");	

	

			$per_page = 3;
			if(isset($_GET["page"])){
				$page = $_GET["page"];
			}else{
				$page=1;
			}
			$start_from=($page-1) * $per_page;
		

	$post = mysqli_query( $connect, "SELECT * FROM tbl_post limit $start_from,$per_page" )
		or die("Can not execute query");
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
                  <img src="images/pro_logo.png" width="50" height="50" alt="">
                </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Dashboard</a>
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



    <br>
    <br>
    <br>




    <div class="container">
	
	<?php
	if($post){
	while($result=$post->fetch_assoc()){
	?>

	<div class=" ">

	<div class="card text-center">
  <div class="card-header">
  <h5 class="card-title"><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h5>
  <p class="card-title">By <?php echo $result['author'];?></a></p>
  </div>
  <div class="card-body">
  <img class="card-img-top" src="admin/<?php echo $result['image']?>" alt="Card image cap">
    <p class="card-text"><?php echo $result['body'];?></p>
    <a href="post.php?id=<?php echo $result['id'];?>" class="btn btn-primary">Read More</a>
  </div>
  <div class="card-footer text-muted">
    <p><?php $result['date'];?></p>
  </div>
</div>
<br>
<br>
	
		<?php } ?> <!--END WHILE LOOP-->

		<!--Pagination-->
		<?php 
		
		$result= mysqli_query( $connect, "SELECT * FROM tbl_post" )
		or die("Can not execute query");
		$total_rows= mysqli_num_rows($result);
		$total_pages=ceil($total_rows/$per_page);
		?>
		

		<nav aria-label="Page navigation example">
 		 <ul class="pagination justify-content-center">
    	<li class="page-item ">
			<?php
			echo "<span class='page-link'><a href='index.php?page=1'>".'First Page'."</a>";
			?>	

    		</li>
		<?php	for($i=1;$i<=$total_pages;$i++){
			echo "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a> </li>" ;
		}?>
			<?php echo "<li class='page-item'><a class='page-link'  href='index.php?page=$total_pages'>".'Last Page'."</a> </li>" ; ?>
		
		</ul>
		</nav>

		<?php 
}
		?>
    

	</div>



</body>

</html>