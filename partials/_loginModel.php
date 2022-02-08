<?php
    echo '
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1"  aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Student Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="formStu-login">
                <span id="failure-LogMsg" class="my-3"></span>
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <label for="stuLoginEmail">Email address</label>
                        <small id="status-msglog1" class="ml-2"></small>
                        <input type="email" class="form-control" id="stuLoginEmail" name="stuLoginEmail" aria-describedby="emailHelp" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label for="stuLoginPassword">Password</label>
                        <small id="status-msglog2" class="ml-2"></small>
                        <input type="password" class="form-control" name="stuLoginPassword" placeholder="Password" id="stuLoginPassword" required>
                    </div>
                   
                    </div>
                    <div class="modal-footer">
                    <span id="success-spiner"></span>
                    <button type="button" class="btn btn-primary" id="stuLogBtn" >Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
      </div>
    </div>';
?>