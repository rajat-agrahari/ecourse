<?php
include '../partials/_dbconnect.php';
include '_headerAdmin.php'; 

if(isset($_REQUEST['delete'])){
    $deleteId = $_REQUEST['id'];
    $sql = "DELETE FROM `feedback` WHERE feedback_id = $deleteId";
    $result = mysqli_query($conn , $sql);

    if($result == TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deletd"/>';
    }
    else{
      echo "Unable to delete";
    }
}
?>



<div class="content-admin col-md-8">
    <div class="container bg-dark text-white mt-3">
        <h3 class="text-center"> List of Feedbacks  </h3>
    </div>
    <div class="container">
        <?php
            $sql ="SELECT * FROM `feedback`";
            $result = mysqli_query($conn , $sql);
            $numRows = mysqli_num_rows($result);
            if($numRows >0){      
        
       echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Feedback ID</th>
                    <th scope="col">Content</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            while($row = mysqli_fetch_assoc($result)){
                echo'<tr>
                    <th scope="row">'.$row['feedback_id'].'</th>
                    <td>'.$row['feedback_content'].'</td>
                    <td>' .$row['f_stu_id'].'</td>';
                   echo'<td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value='.$row["feedback_id"].'>
                            <button type="submit" class="btn btn-secondary mr-3" name="delete" value="delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    </tr>';
                }
       echo '</tbody>
        </table>';

        }else{
        echo '<div class="alert  alert-dark my-3 py-2" role="alert"> 0 Result</div>';
        }
        ?>
    </div>
</div>

</div>




<?php include '_footerAdmin.php'; ?>