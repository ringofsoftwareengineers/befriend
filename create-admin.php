<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}
if (isset($_POST['submit'])) {
    
    $email_id= $_POST['email_id'];
    $password = $_POST['password'];
    $full_name= $_POST['full_name'];
    save_admin($email_id, $password, $full_name);
}elseif(isset ($_POST['update_admin_user']))
{
    $email_id= $_POST['email_id'];
    $password = $_POST['password'];
    $full_name= $_POST['full_name'];
    $id=$_POST['admin_user_id'];
    update_admin($email_id, $password, $full_name, $id);
     header("location: create-admin.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];    
    deleteAdminUser($id);
    header("location: create-admin.php");
}
?>



<?php include './header.php'; ?>
<div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">


        <div id="page-heading"><h1>Create Admin User</h1></div>

        
        <?php
        
        if(isset($_GET['update_id']))
        {
            include './update-admin-form.php';
        }else
        {
            include './create-admin-form.php';
        }
        
        ?>
        
        
        

<div class="clear">&nbsp;</div>

<div style="display: block;">
    <table id="mydatatable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                <th >Sr. #</th><th >Email</th><th >Full Name</th><th >Action</th>
        </tr>
        </thead>
            <?php
        $result = getAllAdminUsers();

        if (mysqli_num_rows($result) > 0) {

            $counter = 0;
            while ($row = mysqli_fetch_array($result)) {
                $counter++;
                ?>
                <tr>
                    <td ><?php echo $counter; ?></td>
                    <td ><?php echo $row['email_id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    
                    <td >
                        <a class="btn btn-default" href="?update_id=<?php echo $row['id']; ?>" style="color:white; background-color: green;">Edit</a>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-danger" onclick="return window.confirm('Are you sure to delete?')" href="?id=<?php echo $row['id']; ?>" style="color:white;">Delete</a>
                    </td>

                </tr>
                <?php
            }//end of for loop
        }//end if statement 
        ?>

    </table>

</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->



<div class="clear">&nbsp;</div>

<!-- start footer -->
<?php include './footer.php'; ?>
<!-- end footer -->

</body>
</html>