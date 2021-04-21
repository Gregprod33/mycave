$("#search").on('keyup',() => {
  let userTypeIn = $("#search").val();
  $.ajax({
      type: 'GET',
      url: '../../../src/models/search.php',
      data: 'txt=' + userTypeIn,
      success: function(data){
          $("#show_filter").html(data);
      }
  }) 
})

let span = document.getElementsByClassName("close")[0];
let modalAdmin = document.querySelector('.alert_role_message');

span.addEventListener('click', () => {  
    modalAdmin.style.display = "none";
  })
  
  window.addEventListener ('click', (event) => {
    if (event.target == modalAdmin) {
      modalAdmin.style.display = "none";
    }
})
  