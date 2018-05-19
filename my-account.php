<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}
if (isset($_POST['update_admin_user'])) {
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $id = $_POST['admin_user_id'];
    update_admin($email_id, $password, $full_name, $id);
    header("location: my-account.php");
}
?>



<?php include './header.php'; ?>
<div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">


        <div id="page-heading"><h1>My Account</h1></div>


<?php
$admin_result = getAdminUser($_GET['update_id']);
$row = mysqli_fetch_array($admin_result);
?>
        <form method="post">
            <input name="admin_user_id" type="hidden" value="<?php echo $_GET['update_id']; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-box-gap" style="text-align: right;">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input  required="" name="email_id" value="<?php echo $row['email_id']; ?>" type="email" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-box-gap" style="text-align: right;">
                        <strong>Password:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input required="" name="password" placeholder="New Password" type="text" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 text-box-gap" style="text-align: right;">
                        <strong>Full Name:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input required="" name="full_name" value="<?php echo $row['full_name']; ?>" type="text" class="form-control" />
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-2 text-box-gap"></div>
                    <div class="col-md-6 text-box-gap">
                        <div style="width: 50%; margin-left: auto; margin-right: auto;">
                            <input type="submit" name="update_admin_user" value="Update" style="width:125px; background-color: green; color: white;" value="" class=" btn btn-default" />
                            <input type="reset" value="Reset" style="width:125px; background-color: red; color: white;" class="btn btn-default"  />  
                        </div>
                    </div>

                </div>

            </div>

        </form>




        <div class="clear">&nbsp;</div>

        <div style="display: block;">
            <table id="mydatatable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                        <th >Sr. #</th><th >Email</th><th >Full Name</th>
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