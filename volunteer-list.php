<?php
session_start();
include './functions.php';
include './PHPExcel/Classes/PHPExcel.php';
include './PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

if (!is_admin()) {
    header("location: login.php");
}

if (isset($_GET['volunteer_id'])) {
    $_SESSION['volunteer_id'] = $_GET['volunteer_id'];
    header("location: surveys.php");
}//end statement

if ((isset($_GET['download_list']))) {
    exportToExcel();
    //header("location:volunteer-list.php");
    die(" file downloaded");
}
function exportToExcel() {

    $sql = "select * from users";
    $con = mysqli_connect(host, user, password, database);
    $result = mysqli_query($con, $sql);

    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("BefriendAChildUK")
            ->setLastModifiedBy("BefriendAChildUK")
            ->setTitle("Volunteers List")
            ->setSubject("Volunteers List")
            ->setDescription("Volunteers List List")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Volunteers List");
    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    // $objPHPExcel->getActiveSheet()->getColumnDimension("I");

    $rowcount = 1;

    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowcount, "Sr. No");
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowcount, "User Login");
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowcount, "First Name");
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowcount, "Surname");
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowcount, "Ph. #");
    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowcount, "Email");
    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowcount, "Gender");
    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowcount, "Date of Birth");
    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowcount, "Address");
    $rowcount++;

    while ($row = mysqli_fetch_array($result)) {
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowcount, $rowcount - 1);
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowcount, $row['user_login']);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowcount, $row['firstname']);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowcount, $row['surname']);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowcount, $row['ph_no']);
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowcount, $row['email']);
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowcount, $row['gender']);
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowcount, $row['dob']);
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowcount, $row['address']);

        $rowcount++;
    }
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:I'.$rowcount)
    ->getAlignment()->setWrapText(true); 
    $objPHPExcel->getActiveSheet()->getStyle('A1:I'.$rowcount)
    ->getAlignment()->setVertical("center");
    $objPHPExcel->getActiveSheet()->getStyle('A1:I'.$rowcount)
    ->getAlignment()->setHorizontal("center");


//    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);    
//    $objWriter->save(str_replace('.php', '.xlsx', __FILE__));




    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="volunteerslist.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');
    exit();
}
//end function
?>

<?php include './header.php'; ?>
<div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">


        <div id="page-heading"><h1>Volunteer List <a href="?download_list" class="btn btn-default" style="color: white; background-color: blue; float: right; width: 200px;">Download List</a></h1></div>



        <div class="clear">&nbsp;</div>

        <div style="display: block;">
            <table id="mydatatable"  class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                        <th >Sr. #</th><th>Login Name</th><th >First Name</th><th >Surname</th><th>Ph #</th><th>Email</th><th >Gender</th><th >DOB</th><th>Address</th><th>Image</th><th >Action</th>
                    </tr>
                </thead>
<?php
$result = getAllRegisteredUsers();

if (mysqli_num_rows($result) > 0) {
    $row_style = "data1-style";
    $counter = 0;
    while ($row = mysqli_fetch_array($result)) {
        $counter++;
        if ($counter % 2 == 0) {
            $row_style = "data1-style";
        } else {
            $row_style = "data2-style";
        }
        ?>
                        <tr>
                            <td ><?php echo $counter; ?></td>
                            <td ><?php echo $row['user_login']; ?></td>
                            <td ><?php echo $row['firstname']; ?></td>
                            <td ><?php echo $row['surname']; ?></td>
                            <td ><?php echo $row['ph_no']; ?></td>
                            <td ><?php echo $row['email']; ?></td>
                            <td ><?php echo $row['gender']; ?></td>
                            <td ><?php echo $row['dob']; ?></td>
                            <td ><?php echo $row['address']; ?></td>
                            <td ><img src="<?php echo $row['imageurl']; ?>" style="width: 50px; height: 50px;" /></td>
                            <td >
                                <a class="btn btn-default" href="?volunteer_id=<?php echo $row['id']; ?>" style="color:white; background-color: green;">View Surveys</a>

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
