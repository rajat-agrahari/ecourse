<?php
    include '../partials/_dbconnect.php';
 include '_headerAdmin.php'; 

 $sql= "SELECT * FROM course";
 $result = mysqli_query($conn , $sql);
 $totalcourse = mysqli_num_rows($result);

 $sql= "SELECT * FROM student";
 $result = mysqli_query($conn , $sql);
 $totalstudent = mysqli_num_rows($result);

 $sql= "SELECT * FROM courseorder";
 $result = mysqli_query($conn , $sql);
 $totalsold = mysqli_num_rows($result);


?>
<div class="col-sm-9 mt-3">
    <div class="row mx-5 text-center">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Courses</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalcourse ?></h5>
                    <a href="courseAdmin.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalstudent ?></h5>
                    <a href="student.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Sold</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $totalsold ?></h5>
                    <a href="sellReport.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-dark text-white mt-3">
        <h4 class="text-center py-1"> Course Ordered</h4>
    </div>
    <div class="container table-responsive">
        <?php
            $sql = "SELECT * FROM courseorder";
            $result = mysqli_query($conn , $sql);
            $numRows = mysqli_num_rows($result);
            if($numRows >0){      
               echo '<table class="table table-hover">
               <thead>
                   <tr>
                       <th scope="col">Order ID</th>
                       <th scope="col">Course ID</th>
                       <th scope="col">Student Email</th>
                       <th scope="col">Payment Status</th>
                       <th scope="col">Order Date</th>
                       <th scope="col">Amount</th>
                       <th scope="col">Action</th>
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
                       <td>₹ ' .$row['amount'].'</td>'; 
                       echo '<td>
                       <form method="POST" class="d-inline">
                           <input type="hidden" name="id" value='.$row["co_id"].'>
                           <button type="submit" class="btn btn-secondary" name="delete" value="delete">
                               <i class="fas fa-trash-alt"></i>
                           </button>
                       </form>
                   </td>
                       </tr>';
                   }
                   
                echo '</tbody>
                </table>';
            }
            ?>
    </div>
</div>
</div>
<br>
<br>
<hr>


<?php
    if(isset($_REQUEST['delete'])){
        $sql = "DELETE FROM courseorder WHERE co_id={$_REQUEST['id']}";
        $result = mysqli_query($conn , $sql);
        if($result == TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?deletd"/>';
        }
        else{
          echo "Unable to delete";
        }
    }
?>

<?php include '_footerAdmin.php'; ?>