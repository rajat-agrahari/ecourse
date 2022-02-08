<?php include '_headerAdmin.php'; ?>
<?php include '../partials/_dbconnect.php'; ?>

<div class="col-sm-9 mt-5">
    <form action="" method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <input type="date" name="startdate" id="startdate" class="form-control">
            </div>
            <span class="mt-2"> to </span>
            <div class="form-group col-md-2">
                <input type="date" name="enddate" id="enddate" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Search" name="searchSubmit" class="btn btn-success">
            </div>
        </div>
    </form>

    <?php
    if(isset($_REQUEST['searchSubmit'])){
        $startdate = $_REQUEST['startdate'];
        $enddate = $_REQUEST['enddate'];

        $sql= "SELECT * FROM courseorder WHERE order_date BETWEEN '$startdate' AND '$enddate'";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows >0){      
           echo '<div class="container bg-dark text-white mt-4 table-responsive">
            <h3 class="text-center py-2"> Sell Courses list  </h3>
           </div>';
           echo '<div class="table-responsive">
           <table class="table table-hover">
           <thead>
               <tr>
                   <th scope="col">Order ID</th>
                   <th scope="col">Course ID</th>
                   <th scope="col">Student Email</th>
                   <th scope="col">Payment Status</th>
                   <th scope="col">Order Date</th>
                   <th scope="col">Amount</th>
               </tr>
           </thead>
           <tbody>';
           while($row = mysqli_fetch_assoc($result)){
               echo'<tr>
                   <th scope="row">'.$row['order_id'].'</th>
                   <td>'.$row['course_id'].'</td>
                   <td>' .$row['stu_email'].'</td>
                   <td>' .$row['status'].'</td>
                   <td>' .$row['order_date'].'</td>
                   <td>₹ ' .$row['amount'].'</td> 
                   </tr>';
               }
               echo '<tr>
               <td>
                   <form action="" class="d-print-none">
                       <input type="submit" value="Print" class="btn btn-success" onclick="window.print();">
                   </form>
               </td>
           </tr>';
            echo '</tbody>
            </table>
            </div>';
        }
        else
        echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">NO Record Found </div>';
    }

    ?>
</div>




<?php include '_footerAdmin.php'; ?>