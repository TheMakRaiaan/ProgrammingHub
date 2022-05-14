<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                
                <?php
                //Category Delete
                if (isset($_GET['deluser'])){
                    $deluser= $_GET['deluser'];
                    $delquey = "delete from tbl_user where id='$deluser' ";
                    $deldata = $db->delete($delquey);
                    if( $deldata )
                         {
                            echo "<span class='success'>User Deleted Successfully </span>";
                         }
                         else
                         {
                            echo "<span class='error'>User Not Deleted  ! </span>";
                         }
                }
                ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                        $query = "select * from tbl_user order by id desc";
                        $allusers = $db->select($query);
                        if ($allusers)
                        {
                            $i=0 ;
                            while ($result= $allusers->fetch_assoc())
                            {
                             $i++; 
                           ?>
						<tr class="odd gradeX" >
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['details'],30); ?></td>
							<td><?php
                                    if($result['role']=='1'){
                                        echo "Admin";
                                    }elseif($result['role']=='2'){
                                        echo "Author";
                                    }elseif($result['role']=='3'){
                                        echo "Editor";
                                    }
                            
                            
                            ?></td>
							<td><a href="viewUser.php?userid=<?php echo $result['id']; ?>">View</a>
                            <?php if(Session::get('userRole')=='1'){ ?>

                            ||<a onclick="return confirm ('Do you really want to delete!'); "href="?deluser=<?php echo $result['id'];?>">Delete</a></td>
                            <?php } ?>
                        </tr>
                        <?php }} ?>
                       
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <script type= "text/javascript">
        $(document).ready(function()
        {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
        </script>
<?php include 'inc/footer.php';?>
    