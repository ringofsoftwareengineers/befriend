<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}

if (isset($_POST['update'])) {

    updateUser();
    header("location: createlogin.php");
}
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $result = getUser($user_id);
    $row = mysqli_fetch_array($result);
} else {
    header("location: adminhome.php");
}
?>


<?php include './header.php'; ?>
<div class="clear"></div>
 
<!-- start content-outer -->

        <div id="page-heading"><h1>Edit User</h1></div>
        <form method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Login Name:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input name="user_id" type="hidden" value="<?php echo $row['id'] ?>" />
                        <input required="" name="loginName" type="text"value="<?php echo $row['user_login']; ?>" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Password:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input  name="password" placeholder="new password" type="text" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>First Name:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input required="" name="firstName"  value="<?php echo $row['firstname']; ?>" type="text" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Surname</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input required="" name="surName" type="text" value="<?php echo $row['surname']; ?>" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Gender:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <select name="gender"  class="form-control">
                            <option selected value="<?php echo $row['gender']; ?>" ><?php echo $row['gender']; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Phone #:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input type="text" value="<?php echo $row['ph_no']; ?>" name="phNo" required="" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <input type="email" name="eMail" value="<?php echo $row['email']; ?>" required="" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Date of Birth:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">

                        <input name="dob" type="text" value="<?php echo $row['dob']; ?> " required="" class="form-control">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Address:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <textarea required="" name="address" rows="" cols="" class="form-control"><?php echo $row['address']; ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;">
                        <strong>Picture:</strong>
                    </div>
                    <div class="col-md-6 text-box-gap">
                        <div class="row">
                            <div class="col-md-6 text-box-gap"> <input type="file" name="file" class="form-control"  /></div>
                            <div class="col-md-6 text-box-gap" style="line-height: 44px;"><label>JPEG, GIF 5MB max per image </label><img style="width:50px; height: 50px;" src="<?php echo $row['imageurl']; ?>" /></div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" style="text-align: right;"></div>
                    <div class="col-md-6">
                        <div style="width: 50%; margin-left: auto; margin-right: auto;">
                            <input type="submit" name="update" value="Save" style="width:125px; background-color: green; color: white;" value="" class=" btn btn-default" />
                            <input type="reset" value="Reset" style="width:125px; background-color: red; color: white;" class="btn btn-default"  />
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <!-- start footer -->
<?php include './footer.php'; ?>
        <!-- end footer -->

        </body>
        </html>
