$(document).ready(function(){
  var data = sessionStorage.getItem('job');
  if (data) {
    // Get the snackbar DIV
    var x = document.getElementsByClassName("snackbar")[0];
    // Add the "show" class to DIV
    x.className = "snackbar" + " show-snackbar";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show-snackbar", ""); }, 3000);
    sessionStorage.removeItem('job');
  }

  $(".btn-salvar-job").click(function(event){
    sessionStorage.setItem('job', '1');
  });
})

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}