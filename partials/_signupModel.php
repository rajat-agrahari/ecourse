<?php
    echo '
    <!-- Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">SignUp eCourse Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="reg-form-id">
                  <span id="success-msg"></span>
                    <div class="form-group">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <label for="signupName">Name</label>
                        <small id="status-msg1" class="ml-2"></small>
                        <input type="text" class="form-control" id="signupName" name="signupName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <label for="signupEmail">Email address</label>
                        <small id="status-msg2" class="ml-2"></small>
                        <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label for="signupPassword">Password</label>
                        <small id="status-msg3" class="ml-2"></small>
                        <input type="password" class="form-control" name="signupPassword" id="signupPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label for="signupcPassword">Confirm Password</label>
                        <small id="status-msg4" class="ml-2"></small>
                        <input type="password" class="form-control" name="signupcPassword" id="signupcPassword" placeholder="Password" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary" id="studBtnSignup">SignUp</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
            </form>
        </div>
      </div>
    </div>';
?>