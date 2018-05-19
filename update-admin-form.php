<?php 
$admin_result= getAdminUser($_GET['update_id']);
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
                <input required="" name="password" placeholder="New password" type="password" class="form-control" />
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
