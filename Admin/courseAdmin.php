<?php include '_headerAdmin.php'; 
      include '../partials/_dbconnect.php';

      if(isset($_REQUEST['delete'])){
          $deleteId = $_REQUEST['id'];
          $sql = "DELETE FROM `course` WHERE course_id = $deleteId";
          $result = mysqli_query($conn , $sql);

          if($result == TRUE){
              echo '<meta http-equiv="refresh" content="0;URL=?deletd"/>';
          }
          else{
            echo "Unable to delete";
          }
      }

?>

<div class="content-admin col-md-8" style=" min-height: 620px;">
    <div class="container bg-dark text-white mt-3">
        <h3 class="text-center"> List of Courses </h3>
    </div>
    <div class="container table-responsive">
        <?php
            $sql ="SELECT * FROM `course`";
            $result = mysqli_query($conn , $sql);
            $numRows = mysqli_num_rows($result);
            if($numRows >0){      
        
       echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            while($row = mysqli_fetch_assoc($result)){
                echo'<tr>
                    <th scope="row">'.$row['course_id'].'</th>
                    <td>'.$row['course_name'].'</td>
                    <td>' .$row['course_author'].'</td>';
                   echo'<td>
                        <form action="editCourse.php" method="POST" class="d-flex">
                            <input type="hidden" name="editid" value='.$row["course_id"].'>
                            <button type="submit" class="btn btn-info mr-3" name="edit" value="edit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <input type="hidden" name="id" value='.$row["course_id"].'>
                            <button type="submit" class="btn btn-secondary mr-sm-3" name="delete" value="delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    </tr>';
                }
       echo '</tbody>
        </table>';

        }else{
        echo '<div> 0 Result</div>';
        }
        ?>
    </div>
</div>

</div>

<div>
    <a href="addCourse.php" class="btn btn-success box">
        <i class="fas fa-plus"></i>
    </a>
</div>



<?php include '_footerAdmin.php'; ?>