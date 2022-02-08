//  Ajax call for Admin Login verfication

var adminLogBtn = document.getElementById('adminLogBtn');
adminLogBtn.addEventListener('click',  ()=>{
    var adminEmail = document.getElementById('adminEmail').value;
    var adminPassword = document.getElementById('adminPassword').value;
    // checking input field on submition
    if (adminEmail.trim() == "") {
        document.getElementById('status-msglog1-Admin').innerHTML = `<small class="text-danger"> Please Enter Email</small>`;

        document.getElementById('adminEmail').focus();
        return false;

    } else if (adminPassword.trim() == "" ) {
        document.getElementById('status-msglog2-Admin').innerHTML = `<small class="text-danger"> Please Enter Password</small>`;
        document.getElementById('adminPassword').focus();
        return false;

    } else {
        $.ajax({
            url: "Admin/_adminHandle.php",
            method: "POST",
            dataType: "json",
            data: {
                cheackLog: "checkLog",
                adminEmail: adminEmail,
                adminPassword: adminPassword,
            },
            success: function (data) {
                console.log(data);
                if (data == "valid email password") {
                    clearStuLogField();
                    document.getElementById('success-spiner-Admin').innerHTML = `<div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`;
                  setTimeout(() => {
                      window.location.href = "Admin/adminDashboard.php";
                  }, 800);
                } else if (data == "password do not match") {
                    document.getElementById('failure-LogMsg-Admin').innerHTML = `<div class="alert alert-danger py-1" role="alert">Incorrect Password</div>`;
                } else if(data == "Invalid email"){  
                    document.getElementById('failure-LogMsg-Admin').innerHTML = `<div class="alert alert-danger" role="alert"> Please Enter Valid Email</div>`;
                }
            },
        });
    }
})

function clearStuLogField()    {
    $("#formStu-login").trigger("reset");
    document.getElementById('status-msglog1-Admin').innerHTML = '';
    document.getElementById('status-msglog2-Admin').innerHTML = '';   
}
