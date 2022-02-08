<?php
include '../partials/_dbconnect.php';
include '_headerAdmin.php'; 
?>

<div class="col-sm-9 mt-5 mx-3">
    <form action="" class="mt-3 form-inline d-print-none">
        <div class="form-group row mr-3">
            <label for="checkid" class="pl-4">Course ID</label>
            <input type="text" class="form-control ml-3" id="checkid" name="checkid" placeholder="Course ID">
        </div>
        <button type="submit" class="btn btn-success">Search</button>
    </form>

    <?php
    $sql ="SELECT course_id FROM course";
    $result = mysqli_query($conn , $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        if(isset($_REQUEST['checkid']) && $_REQUEST['checkid'] == $row['course_id']){

            $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid']}";
            $result = mysqli_query($conn , $sql);
            $row = mysqli_fetch_assoc($result);
            if(($row['course_id']) == $_REQUEST['checkid']){
                $_SESSION['course_id'] = $row['course_id'];
                $_SESSION['course_name'] = $row['course_name'];

               echo '<h3 class="bg-dark text-white py-2 mt-5 pl-2 course-font-size"> Course ID: '; if(isset($row['course_id'])){echo $row['course_id']; } echo' Course Name: ';
               if(isset($row['course_name'])){echo $row['course_name']; } echo'</h3>';

                // Fetch all lesson of particular course ID
               $sql ="SELECT * FROM lesson WHERE lesson_course_id = {$_REQUEST['checkid']}";
                $result = mysqli_query($conn , $sql);

                echo ' <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Lesson ID</th>
                            <th scope="col">Lesson Name</th>
                            <th scope="col">Lesson Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                while($row = mysqli_fetch_assoc($result)){
                echo'<tr>
                    <th scope="row">'.$row['lesson_id'].'</th>
                    <td>'.$row['lesson_name'].'</td>
                    <td>' .$row['lesson_link'].'</td>';
                   echo'<td>
                        <form action="editLesson.php" method="POST" class="d-flex">
                            <input type="hidden" name="editid" value='.$row["lesson_id"].'>
                            <button type="submit" class="btn btn-info mr-3" name="edit" value="edit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <input type="hidden" name="id" value='.$row["lesson_id"].'>
                            <button type="submit" class="btn btn-secondary mr-3" name="delete" value="delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    </tr>';
                }
       echo '</tbody>
        </table>
    </div>';
  
            }else{
                echo '<div class="alert alert-dark mt-4" role="alert">Course NOT Found</div>';
            }
        }
    }

?>
</div>
</div>
<br>
<br>
<!--  For + button -->
<?php if(isset($_SESSION['course_id'])){
   echo '<div>
    <a href="addlesson.php" class="btn btn-success box">
        <i class="fas fa-plus"></i>
    </a>
</div>';
}
?>
<!-- Delete lesson -->
<?php
if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
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