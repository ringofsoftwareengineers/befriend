<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}
if (isset($_POST['submit'])) {
    save_user();
    header("location: createlogin.php");
}
if (isset($_GET['user_login'])) {
    $login_name = $_GET['user_login'];

    $result = getUser($login_name);
    $row = mysqli_fetch_array($result);
    $imageurl = $row['imageurl'];
    if (file_exists($imageurl)) {

        unlink($imageurl);
    }
    deleteUser($login_name);
    header("location: createlogin.php");
}
?>



<?php include './header.php'; ?>
<div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">


        <div id="page-heading"><h1>Create User Login</h1></div>

        <form method="post" enctype="multipart/form-data">

    <div class="container">
        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Login Name:</strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <input  required="" name="loginName" type="text" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Password:</strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <input required="" name="password" type="text" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>First Name:</strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <input required="" name="firstName" type="text" class="form-control" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Surname</strong> 
            </div>
            <div class="col-md-6 text-box-gap">
                <input required="" name="surName" type="text" class="form-control" /> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Gender: </strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <select name="gender"  class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>

                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Phone #:  </strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <input type="text" name="phNo" required="" class="form-control">  
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong> Email:</strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <input type="text" name="eMail" required="" class="form-control">  
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Date of Birth: </strong>  
            </div>
            <div class="col-md-6">

                <table border="0" cellpadding="0" cellspacing="0">
                    <tr  valign="top">
                        <td>                                                          

                            <select name="dob_day" id="d" class="styledselect-day text-box-gap">                                                                            
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </td>
                        <td>
                            <select name="dob_month" id="m" class="styledselect-month text-box-gap">                                                                           
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </td>
                        <td>
                            <select name="dob_year" id="y"  class="styledselect-year text-box-gap">
                                <?php
                                for ($i = 1950; $i < 2000; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>

                            </select>


                        </td>
                        <td></td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Address: </strong> 
            </div>
            <div class="col-md-6 text-box-gap">
                <textarea required="" name="address" rows="" cols="" class="form-control"></textarea>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap" style="text-align: right;">
                <strong>Picture:  </strong>
            </div>
            <div class="col-md-6 text-box-gap">
                <div class="row">
                    <div class="col-md-6 text-box-gap"> <input type="file" name="file" class="form-control"  /></div>
                    <div class="col-md-6 text-box-gap" style="line-height: 44px;"><label>JPEG, GIF 5MB max per image </label></div>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-box-gap"></div>
            <div class="col-md-6 text-box-gap">
                <div style="width: 50%; margin-left: auto; margin-right: auto;">
                    <input type="submit" name="submit" value="Save" style="width:125px; background-color: green; color: white;" value="" class=" btn btn-default" />
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
                <th >Sr. #</th><th >Login Name</th><th >First Name</th><th >Surname</th><th>Ph #</th><th>Email</th><th>Gender</th><th >DOB</th><th>Address</th><th >Image</th><th >Action</th>
        </tr>
        </thead>
            <?php
        $result = getAllRegisteredUsers();

        if (mysqli_num_rows($result) > 0) {

            $counter = 0;
            while ($row = mysqli_fetch_array($result)) {
                $counter++;
                ?>
                <tr>
                    <td ><?php echo $counter; ?></td>
                    <td ><?php echo $row['user_login']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td ><?php echo $row['surname']; ?></td>
                    <td ><?php echo $row['ph_no']; ?></td>
                    <td ><?php echo $row['email']; ?></td>
                    <td ><?php echo $row['gender']; ?></td>
                    <td ><?php echo $row['dob']; ?></td>
                    <td ><?php echo $row['address']; ?></td>
                    <td ><img src="<?php echo $row['imageurl']; ?>" style="width: 50px; height: 50px;" /></td>
                    <td >
                        <a class="btn btn-default" href="edit-user.php?user_id=<?php echo $row['id']; ?>" style="color:white; background-color: green;">Edit</a>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-danger" onclick="return window.confirm('Are you sure to delete?')" href="?user_login=<?php echo $row['user_login']; ?>" style="color:white;">Delete</a>
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