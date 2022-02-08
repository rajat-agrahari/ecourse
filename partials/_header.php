<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include 'Student/stuLogHandle.php';
    include 'Admin/_adminModel.php';    
    echo '<nav class="navbar navbar-expand-lg  navbar-dark" style="background-color: #313840;">
    <a class="navbar-brand ml-5 pb-0 mt-0" href="/ecourse">
        <h3>eCourse</h3>
    </a>
    <em class="text-light mx-sm-3">a Perfect Learn</em>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-5">';
        if(isset($_SESSION['is_login']) && $_SESSION['is_login'] ==true){
            echo '<li class="nav-item active mr-2">
            <a class="nav-link" href="./Student/studentProfile.php"><i class="fas fa-home"></i> My Profile <span class="sr-only">(current)</span></a>
            </li>';
        }
           echo '<li class="nav-item active mr-2">
                <a class="nav-link" href="/ecourse">Home <span class="sr-only">(current)</span></a>
            </li>  
          <li class="nav-item mr-2">
                <a class="nav-link" href="course.php">Courses</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="paymentstatus.php">Payment Status</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="#">feedback</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link" href="#contact">Contact</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0 mr-5">';
            if(isset($_SESSION['is_login']) && $_SESSION['is_login'] ==true){
                 echo  '<a href="partials/_logout.php" class="btn btn-primary" ><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Logout</a>';
                }else{
                    echo  '<button class="btn btn-primary my-2 my-sm-0" data-toggle="modal" data-target="#loginModal" type="button"><i class="fas fa-sign-in-alt"></i> Login</button>
                    <button class="btn btn-primary my-2 my-sm-0 ml-2 mr-5" data-toggle="modal" data-target="#signupModal"  type="button">SignUp</button>
                    <button class="btn btn-primary my-2 my-sm-0 mr-2" data-toggle="modal" data-target="#adminModal" type="button">Admin Login</button>';
                }
       echo '</form>
    </div>
</nav>';
    
    include '_signupModel.php';
    include '_loginModel.php';
    include 'Student/signupHandle.php';
    
?>