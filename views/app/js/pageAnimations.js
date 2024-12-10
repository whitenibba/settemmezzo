//----------------------------------------------FULLSCREEN-----------------------------------------

var doc = document.documentElement;
var fullScreen = false;

function toggleFullscreen(){
    var gotop = document.getElementById("go-top");
    if(fullScreen){
        gotop.innerHTML='<i class="fa-solid fa-expand"></i>';
        closeFullscreen();
    }else{
        gotop.innerHTML='<i class="fa-solid fa-compress"></i>';
        openFullscreen();
    }
    fullScreen = !fullScreen;
}

/* View in fullscreen */
function openFullscreen() {
  if (doc.requestFullscreen) {
    doc.requestFullscreen();
  } else if (doc.webkitRequestFullscreen) { /* Safari */
    doc.webkitRequestFullscreen();
  } else if (doc.msRequestFullscreen) { /* IE11 */
    doc.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}
//-------------------------------------------------------------------------------------------------

//--------------------------------------------DROPDOWN ELEMENTS----------------------------------------

function activateDropdown(){
    const dropdownElements = document.querySelectorAll(".dropdown");

    dropdownElements.forEach(element => {
        const trigger = element.querySelector(".dropdown-toggle");
        trigger.addEventListener("click", function () {
            toggleDropdown(element);
        });
    });
}
function toggleDropdown(element){
    let trigger = element.children[0];
    let menu=element.children[1];
    if(trigger.className.includes("show")){
        trigger.className=trigger.className.slice(0,trigger.className.length-5);
        trigger.setAttribute("aria-expanded","false");
        menu.className=menu.className.slice(0,menu.className.length-5);
        menu.setAttribute("style","");
        menu.setAttribute("data-popper-placement","");
    }else{  
        trigger.className=trigger.className+" show";
        trigger.setAttribute("aria-expanded","true");
        menu.className=menu.className+" show";
        menu.style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);"
        menu.setAttribute("data-popper-placement","bottom-start");
    }
}

activateDropdown();
//--------------------------------------------DROPDOWN ELEMENTS----------------------------------------

