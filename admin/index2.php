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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Programmers Hub</title>
</head>
<body>
	  <!--Navigation part starts-->
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
					<a href="index.php"><span>Dashboard</span></a> 
                </li>
                <li class="nav-item">
				<a href="profile.php"><span>User Profile</span></a>
                </li>
                <li class="nav-item">
					<a href="inbox.php"><span>Inbox</span></a>
                </li>
                <li class="nav-item">
					<a href="postlist.php"><span>Visit Website</span></a>
                </li>

                <li class="nav-item">
				<?php //if(Session::get('userRole')=='1'){ ?>
                    <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
                <?php //} ?>
                </li>
                <li class="nav-item">
					<a href="userlist.php"><span>User List</span></a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Navigation part ends-->
    
	
		<div class=" ">
		
			<?php

if($post){
	while($result=$post->fetch_assoc()){
				

			?>


	<div class=" ">
		<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
		<h4><?php $result['date'];?>, By <a href="#"><?php echo $result['author'];?></a></h4>
			<a href="#"><img src="admin/<?php echo $result['image']?>" alt="post image"/></a>
			<?php echo $result['body'];?>
		<div class="">
		<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
		</div>
	</div>
		<?php } ?> <!--END WHILE LOOP-->

		<!--Pagination-->
		<?php 
		
		$result= mysqli_query( $connect, "SELECT * FROM tbl_post" )
		or die("Can not execute query");
		$total_rows= mysqli_num_rows($result);
		$total_pages=ceil($total_rows/$per_page);
		echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";
		for($i=1;$i<=$total_pages;$i++){
			echo"<a href='index.php?page=".$i."'>".$i."</a>";
		}
		echo"<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>"?>
		<!--Pagination-->

		<?php 
}
		?>
</body>
</html>