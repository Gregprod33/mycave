let modal = document.getElementById("myModal");

// Get the button that opens the modal

let btn = document.getElementsByClassName("myBtn");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal

let domain = document.getElementById("btn");
let dataDomain;
let dataId;
let message = document.getElementById("message");
let anchor = document.getElementById('anchor');






for (let i = 0; i < btn.length; i++) {
    btn[i].onclick = function() {
        modal.style.display = "block";
         dataDomain = btn[i].getAttribute('data-domain');
         dataId = btn[i].getAttribute('data-id');
         const content = `../src/controllers/delete_wine.php?id=${dataId}`;
         message.innerHTML = `Do you really want to delete ${dataDomain} ?`;
         anchor.innerHTML =`<a class="confirm-modal" href=${content}>Confirm</a>`;  
      }
}
    


    



// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}