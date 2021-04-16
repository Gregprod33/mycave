$(()=> {

	//////// evenement click affichage des infos description sur index.html/////////
// $(document).on('click', ".wine-btn", function(e) {
// 	e.preventDefault();
// 	$(this).next('.more-infos').slideToggle();
// })


/////////affichage modale sur admin.html début/////////
let modal = document.getElementById("myModal");
let btn = document.getElementsByClassName("myBtn");
let span = document.getElementsByClassName("close")[0];

let dataDomain;
let dataId;
let message = document.getElementById("message");
let anchor = document.getElementById('anchor');


//je boucle sur tous les boutons de class MyBtn et récupère les variables PHP id et domain
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
    

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

/////////affichage modale sur admin.html FIN/////////













})