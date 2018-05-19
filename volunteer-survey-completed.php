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

    
    $result = get_all_completed_surveys();
    
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("BefriendAChildUK")
            ->setLastModifiedBy("BefriendAChildUK")
            ->setTitle("Volunteers List")
            ->setSubject("Volunteers List")
            ->setDescription("Volunteers List List")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Completed Survey List");
    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    
    $rowcount = 1;

    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowcount, "Sr. No");
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowcount, "Year");
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowcount, "Month");
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowcount, "Volunteer Name");
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowcount, "Survey");
   
    $rowcount++;

    while ($row = mysqli_fetch_array($result)) {
        $user_name = get_user_name_by_id($row['volunteer_id']);
        $month=$row['month'];
        $year=$row['year'];
        $survey_title = get_survey_name_by_id($row['survey_id']);
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowcount, $rowcount - 1);
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowcount, $year);
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowcount, $month);
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowcount, $user_name);
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowcount, $survey_title);
        $rowcount++;
    }
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$rowcount)
    ->getAlignment()->setWrapText(true); 
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$rowcount)
    ->getAlignment()->setVertical("center");
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$rowcount)
    ->getAlignment()->setHorizontal("center");


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="completed-surveys.xlsx"');
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


        <div id="page-heading"><h1>Completed surveys <a href="?download_list" class="btn btn-default" style="color: white; background-color: blue; float: right; width: 200px;">Download List</a></h1></div>



        <div class="clear">&nbsp;</div>

        <div style="display: block;">
           
                            <table id="mydatatable" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                                        <th>Sr. No</th> <th>Volunteer</th><th>Month</th> <th>Survey</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $result2 = get_all_completed_surveys();
                                    while ($row = mysqli_fetch_array($result2)) {
                                        $survey_title = get_survey_name_by_id($row['survey_id']);

                                        $user_name = get_user_name_by_id($row['volunteer_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $counter;
                                    $counter++;
                                        ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            <td><?php echo $row['month']." ".$row['year']; ?></td>
                                            <td><?php echo $survey_title; ?></td>
                                            
                                        </tr>
                                        <?php
                                    }
                                    ?>  
                                </tbody>
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
