<?php
require_once('dbconfig.php');
$connect = mysqli_connect( HOST, USER, PASS, DB )
    or die("Can not connect");	
    session_start();	

?>
<?php
     if(!isset($_GET['search'])|| $_GET['search']==NULL){
         header("Location: 404.php");
     }else{
         $search=$_GET['search'];
     }
?>

<?php
    
    $post = mysqli_query( $connect, "SELECT * FROM tbl_post where title LIKE '%$search%' OR body LIKE '%$search%'")
    or die("Can not execute query");
    
    if($post){
        while($result=$post->fetch_assoc()){
    ?>
     <div>
		 <h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
		 <h4><?php echo ($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
		 	<a href="#"><img src="admin/upload/<?php echo $result['image']?>" alt="post image"/></a>
			<?php echo ($result['body']);?>
		 <div>
		 <a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
		 </div>

	 </div>
     <?php } }else{ ?>
			 <p>Your Search query is not found. </p>
	 	<?php } ?>
</div>
