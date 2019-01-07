function myFunction() {
    document.getElementById("navTest").innerHTML = "Paragraph changed.";
 }

 /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
} 
 /*function taskOnce(obj) {
    if($(obj).is(":checked")){
        var x = document.getElementById("dueDate");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }else{
      alert("Not checked"); //when not checked
    }
    
  }*/