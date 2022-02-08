$(document).ready(function () {
    // to check name
    $('#signupName').on('keypress blur',()=>{
        var stu_name =document.getElementById('signupName').value;
        if(stu_name.length > 2){
            document.getElementById('status-msg1').innerHTML = `<small class="text-success"> <i class="fa fa-check" aria-hidden="true"></i></small>`;
        }
        else{
            document.getElementById('status-msg1').innerHTML = `<small class="text-danger">  <i class="fa fa-times" aria-hidden="true"></i> Atlest three character</small>`;
        }
    });

    // To match password before submit form
    $('#signupcPassword').on('keypress blur',()=>{
        var signupPass =document.getElementById('signupPassword').value;
        var signupcPass =document.getElementById('signupcPassword').value;
        if((signupcPass == signupPass) && (signupcPass != "")){
            document.getElementById('status-msg4').innerHTML = `<small class="text-success"> <i class="fa fa-check" aria-hidden="true"></i> Password match</small>`;
        }
        else{
            document.getElementById('status-msg4').innerHTML = `<small class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Password Do NOT match</small>`;
        }
    })

    // Ajax call form Already Exist Email verfication
    $('#signupEmail').on('keypress blur', () => {
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var stu_email = document.getElementById('signupEmail').value;
        $.ajax({
            url: "Student/signupHandle.php",
            method: "POST",
            dataType: "json",
            data: {
                cheackEmail: "checkEmail",
                signupEmail: stu_email,
            },
            success:function(data){
                // console.log(data);
                if(data != 0 ){
                    document.getElementById('status-msg2').innerHTML = `<small class="text-danger">  <i class="fa fa-times" aria-hidden="true"></i>
                    Email Already Used</small>`;
                    $("#studBtnSignup").attr("disabled", true);
                }
                else if(data == 0 && reg.test(stu_email)){
                    document.getElementById('status-msg2').innerHTML = `<small class="text-success">  <i class="fa fa-check" aria-hidden="true"></i>
                      Valid Email </small>`;
                      $("#studBtnSignup").attr("disabled", false);
                }
                else if(!reg.test(stu_email)){
                    document.getElementById('status-msg2').innerHTML = `<small class="text-danger">  <i class="fa fa-times" aria-hidden="true"></i>
                    Please Enter Valid Email</small>`;
                    $("#studBtnSignup").attr("disabled", true);
                }
            },
        });
    })
});


// Grab SignUp btn and click event fired
var studBtnSignup = document.getElementById('studBtnSignup');
studBtnSignup.addEventListener('click', () => {
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

    var signupName = document.getElementById('signupName').value;
    var signupEmail = document.getElementById('signupEmail').value;
    var signupPassword = document.getElementById('signupPassword').value;
    var signupcPassword = document.getElementById('signupcPassword').value;

    // checking input field on submition
    if (signupName.trim() == "") {
        document.getElementById('status-msg1').innerHTML = `<small class="text-danger"> Please Enter Name</small>`;

        document.getElementById('signupName').focus();
        return false;

    } else if (signupEmail.trim() == "" && !reg.test(signupEmail)) {
        document.getElementById('status-msg2').innerHTML = `<small class="text-danger"> Please Enter Valid Email</small>`;
        document.getElementById('signupEmail').focus();
        return false;

    } else if (signupPassword.trim() == "") {
        document.getElementById('status-msg3').innerHTML = `<small class="text-danger"> Please Enter Password</small>`;
        document.getElementById('signupPassword').focus();
        return false;

    } else if (signupPassword != signupcPassword) {
        document.getElementById('status-msg4').innerHTML = `<small class="text-danger"> Password Do NOT match</small>`;
        document.getElementById('signupcPassword').focus();
        return false;

    } else {
        $.ajax({
            url: "Student/signupHandle.php",
            method: "POST",
            dataType: "json",
            data: {
                cheackSignup: "checksignup",
                signupName: signupName,
                signupEmail: signupEmail,
                signupPassword: signupPassword,
            },
            success: function (data) {
                // console.log(data);
                if (data == "ok") {
                    document.getElementById('success-msg').innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong> Registration Success!</strong > You can login.
                    <button type = "button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span>
                    </button >
                    </div >`;
                    clearRegField();
                } else if (data == "failed") {
                    document.getElementById('success-msg').innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Something went wrong !</strong > Unable to register.
                   <button type = "button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span>
                   </button >
                   </div >`;
                }
            },
        });
    }

})
// Empty all field
function clearRegField() {
    $("#reg-form-id").trigger("reset");
    document.getElementById('status-msg1').innerHTML = '';
    document.getElementById('status-msg2').innerHTML = '';
    document.getElementById('status-msg3').innerHTML = '';
    document.getElementById('status-msg4').innerHTML = '';
}

//  Ajax call for student Login verfication

var stuLogBtn = document.getElementById('stuLogBtn');
stuLogBtn.addEventListener('click',  ()=>{
    var stuLoginPassword = document.getElementById('stuLoginPassword').value;
    var stuLoginEmail = document.getElementById('stuLoginEmail').value;

    // checking input field on submition
    if (stuLoginEmail.trim() == "") {
        document.getElementById('status-msglog1').innerHTML = `<small class="text-danger"> Please Enter Email</small>`;

        document.getElementById('stuLoginEmail').focus();
        return false;

    } else if (stuLoginPassword.trim() == "" ) {
        document.getElementById('status-msglog2').innerHTML = `<small class="text-danger"> Please Enter Password</small>`;
        document.getElementById('stuLoginPassword').focus();
        return false;

    } else {
        $.ajax({
            url: "Student/stuLogHandle.php",
            method: "POST",
            dataType: "json",
            data: {
                cheackLog: "checkLog",
                stuLoginEmail: stuLoginEmail,
                stuLoginPassword: stuLoginPassword,
            },
            success: function (data) {
                // console.log(data);
                if (data == "valid email password") {
                    clearStuLogField();
                    document.getElementById('success-spiner').innerHTML = `<div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>`;
                  setTimeout(() => {
                      window.location.href = "index.php";
                  }, 800);
                } else if (data == "password do not match") {
                    document.getElementById('failure-LogMsg').innerHTML = `<div class="alert alert-danger py-1" role="alert">Incorrect Password</div>`;
                } else if(data == "Invalid email"){  
                    document.getElementById('failure-LogMsg').innerHTML = `<div class="alert alert-danger" role="alert"> Please Enter Valid Email</div>`;
                }
            },
        });
    }
})

function clearStuLogField()    {
    $("#formStu-login").trigger("reset");
    document.getElementById('status-msglog1').innerHTML = '';
    document.getElementById('status-msglog2').innerHTML = '';   
}





