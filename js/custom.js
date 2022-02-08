// For play video in my courses

$(document).ready(function () {
    $(function () {
        $("#playlist li").on("click", function () {
            $("#videoarea").attr({
                src: $(this).attr("movieurl"),
            });
        });
        $("#videoarea").attr({
            src: $("#playlist li").eq(0).attr("movieurl"),
        });
    });
});

// for active class

// // Get the container element
// var liContainer = document.getElementById("myuli");

// // Get all buttons with class="btn" inside the container
// var li = liContainer.getElementsByClassName("li");

// // Loop through the buttons and add the active class to the current/clicked button
// for (var i = 0; i < btns.length; i++) {
//   li[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }
// $('#myuli li a').click(function(e) {
//     $('li a.active').removeClass('active');
//     var $this = $(this);
//     if (!$this.hasClass('active')) {
//         $this.addClass('active');
//     }
//     // e.preventDefault();
// });