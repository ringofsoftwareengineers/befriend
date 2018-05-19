<?php
session_start();
?>
<?php
include './functions.php';

if (!is_admin()) {
    header("location: login.php");
}
if (isset($_GET['report_id'])) {
    $report_id = $_GET['report_id'];
} else {
    header("location: display-report-list.php");
}
?>

<?php include './header.php'; ?>


<body>

    <div class="container border" style="padding-top: 30px; margin-bottom: 30px;">



<?php
$con = new mysqli(host, user,password, database);
$sql = "select * from monthly_report where id='$report_id'";
$result = $con->query($sql);
$con->close();
if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_array($result);
    ?>
        <h1 style="text-align:center; color:blue;">MONTHLY REPORT</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        

                    <div class="row" style=" margin-top:10px;">
                        <div class="col-md-6" >                          
                            <label> Befriender Name: </label>     
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['befriender_name']; ?></p>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="col-md-6">
                            <label> Month: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['month']; ?></p>
                        </div>
                    </div>

                    <div class = "row ">
                        <div class="col-md-6">
                            <label> Child Name: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['child_name']; ?></p>
                        </div>          
                    </div>
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Report Year: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['report_year']; ?></p>
                        </div>   
                    </div>

                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Is child seen: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['is_child_seen']; ?></p>
                        </div>
                    </div>


                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> How many times: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['how_many_times']; ?></p>
                        </div>
                    </div>

                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Reason for not seen: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['reason_for_not_seen']; ?></p>
                        </div>
                    </div>


                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Have concerns: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['have_concerns']; ?></p>
                        </div>   
                    </div>

                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Concerns: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['concerns']; ?></p>
                        </div>
                    </div>

                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> No. of Hours spent: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['no_of_hours_spent']; ?></p>
                        </div>   
                    </div>

                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> What did you do this month: </label>
                        </div>

                        <div class="col-md-6">
                            <p><?php echo $row['what_did_this_month']; ?></p>
                        </div>
                    </div>
                        
                        
                 

                    </div>

                </div>
            </div> 

        <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                           <div class = "row ">
                        <div class="col-md-6" >
                            <label> First out going date: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['first_outing_date']; ?></p>
                        </div>

                    </div>
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> First outgoing activity: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['first_outing_activity']; ?></p>
                        </div>

                    </div>
                    
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Did child enjoy: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['is_child_enjoyed1']; ?></p>
                        </div>

                    </div>
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> Reason for child enjoyed: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['reason_for_child_enjoyed_1']; ?></p>
                        </div>

                    </div>
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label>Comments on the mood, confidence, physical and emotional well being: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['mood1']; ?></p>
                        </div>

                    </div>
                    <div class = "row ">
                        <div class="col-md-6" >
                            <label> 2nd outgoing date: </label>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo $row['second_outing_date']; ?></p>
                        </div>

                    </div>
                        
                         <div class = "row ">
                <div class="col-md-6" >
                    <label> 2nd outgoing activity:</label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['second_outing_activity']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6">
                    <label> Reason for child enjoyed: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['reason_for_child_enjoyed_2']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6">
                    <label> Did child enjoy: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['is_child_enjoyed_2']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> Comments on the mood, confidence, physical and emotional well being: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['mood2']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> Referrer contact details: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['referrer_contact_detail']; ?></p>
                </div>

            </div>
                        
                    </div>
                    
                </div>
        </div>
        
            </div>
      
		<h1 style="text-align:center; color:blue;">MONTHLY EXPENSE CLAIM</h1>
        <div class="row">
            
        
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                                
           
            <div class = "row">
                <div class="col-md-6" >
                    <label> Ref: Vol: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['ref_vol']; ?></p>
                </div>

            </div>
            <div class = "row">
                <div class="col-md-6" >
                    <label> 1st outing cost detail </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['first_outing_cost_detail']; ?></p>
                </div>

            </div>
            <div class = "row">
                <div class="col-md-6" >
                    <label> 1st outgoing total: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['first_outing_total']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> 2nd outgoing cost detail: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['second_outing_cost_detail']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> 2nd outgoing total: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['second_outing_total']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> Gift detail cost: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['gift_detail_cost']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> Total claim: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['total_claim']; ?></p>
                </div>

            </div>
             


                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                   
                            
            <div class = "row ">
                
                <div class="col-md-6" >
                    <label> First Travelling Expense: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['first_travel_expense']; ?></p>
                </div>

            </div>
            <div class = "row ">
                <div class="col-md-6" >
                    <label> Second Travelling Expense: </label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $row['second_travel_expense']; ?></p>
                </div>

            </div>
           
                    
                    
                </div> 
            </div>


            
        </div>
            <hr>


    <?php
}
?>



    </div>

        <?php include './footer.php'; ?>



</body>
</html>

