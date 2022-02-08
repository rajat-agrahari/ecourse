<?php
    echo '
    <!-- Modal -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="adminModalLabel">Admin Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form id="formAdmin-login">
              <span id="failure-LogMsg-Admin" class="my-3"></span>
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <label for="adminEmail">Email address</label>
                        <small id="status-msglog1-Admin" class="ml-2"></small>
                        <input type="email" class="form-control" id="adminEmail" name="adminEmail" aria-describedby="emailHelp" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <label for="adminPassword">Password</label>
                        <small id="status-msglog2-Admin" class="ml-2"></small>
                        <input type="password" class="form-control" name="adminPassword" placeholder="Password" id="adminPassword" required>
                    </div>
                   
                    </div>
                    <div class="modal-footer">
                    <span id="success-spiner-Admin"></span>
                    <button type="button" class="btn btn-primary" id="adminLogBtn">Login</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
      </div>
    </div>';
?>