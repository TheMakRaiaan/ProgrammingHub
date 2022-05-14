
<?php
 if (!isset($_GET['id']) || $_GET['id'] ==NULL){
	 header("Location:");
 }else{
	 $id = $_GET['id'];
 }
?>
<?php
	require_once('dbconfig.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");	

	$post = mysqli_query( $connect, "SELECT * FROM tbl_post where id= $id")
		or die("Can not execute query");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
<div class="contentsection contemplete clear">
<div class="maincontent clear">
<div class="about">
	<?php
		if($post){
			while($result=$post->fetch_assoc()){

	?>
	<h2><?php echo $result['title']?></h2>
	<h4><?php echo $result['date'];?>, By <a href="#"><?php echo $result['author'];?></a></h4>
	<img src="admin/<?php echo $result['image']?>" alt="post image"/>
	<?php echo $result['body']?>
	
	<div class="relatedpost clear">
		<h2>Related articles</h2>
		<?php
			$catid= $result['cat'];
			$relatedpost= mysqli_query( $connect, "SELECT * FROM tbl_post where cat= '$catid' order by rand() limit 6")
            or die("Can not execute query");
			if($relatedpost){
				while($rresult=$relatedpost->fetch_assoc()){

		?>
		<a href="post.php?id=<?php echo $rresult['id'];?>">
			<img src="admin/<?php echo $rresult['image'];?>">
		</a>
		<?php } }else{
			echo "No related post avaiable right now!";
		}?>
	</div>

	<?php  } } else{
			header('Location:');
		}
	?>
</div>

</div>
</body>
</html>