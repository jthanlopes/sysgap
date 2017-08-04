$(document).ready(function(){
  var data = sessionStorage.getItem('job');
    // Get the snackbar DIV
    var x = document.getElementsByClassName("snackbar")[0];  

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    $(".btn-salvar-job").click(function(event){    
      sessionStorage.setItem('job', '1');
    });
  })

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
  console.log("teste2");
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