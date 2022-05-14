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
    <title>Post List</title>
</head>
<body>

<ul class="">
                <li ><a href="index.php"><span>Dashboard</span></a> </li>
                <li ><a href="profile.php"><span>User Profile</span></a></li>
				<li ><a href="changepassword.php"><span>Change Password</span></a></li>
                <li ><a href="postlist.php"><span>Visit Website</span></a></li>
                
                    <li ><a href="adduser.php"><span>Add User</span></a></li>
               
                <li ><a href="userlist.php"><span>User List</span></a></li>
            </ul>

<h2>Post List</h2> 
<div class="block">
<table class="data display datatable" id="example">
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
||<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> 
|| <a onclick="return confirm('Are you sure to Delete this post?')" href="?delpostid=<?php echo $result['id']; ?>">Delete</a>
</td> 
</tr>

<?php } } ?>

</tbody>
</table>


    
</body>
</html>


