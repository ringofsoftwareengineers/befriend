<?php

session_start();
?>
<?php include './functions.php'; 

if (!is_admin()) {
    header("location: login.php");
}

?>
    <?php include './header.php';?>
    
    
    <body>
        
        <div class="container border">
           
            <div class="row">
      
                    <?php
                            $con = new mysqli(host, user, password, database);
                            $sql = "select * from monthly_report";
                            $result = $con->query($sql);
                            $con->close();
                            if(mysqli_num_rows($result)>0)
                            {   ?> 
                                <table>
                                    <tr>
                                         <th> Befriender Name</th>                                  
                                         <th>Month</th>
                                         <th>Child Name</th>
                                         <th>Report Year</th>
                                    </tr>
                                
                               <?php
                         
                                while($row = mysqli_fetch_array($result))
                                {
     //php tag must be closed here                               ?>
                    
                    <tr>
                   
                        <td><a href="display-monthly-form.php?report_id=<?php echo $row['id']; ?>"><?php echo $row['befriender_name']; ?></a></td>
                        <td><?php echo $row['month']; ?></td>
                        <td><?php echo $row['child_name']; ?></td>
                        <td><?php echo $row['report_year']; ?></td>
                        
                    
                    </tr>
                    <?php
                                }
                                ?>
                                </table>
                <?php
                
               
                            }
                            
                            
                    ?>
                    

                    
                </div>
            </div>
            
         <?php include './footer.php';  ?>

            </div>

    </body>
</html>

