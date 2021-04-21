$(() => {

    $("#search_admin").on('keyup',() => {
        let userTypeInAdmin = $("#search_admin").val();
        $.ajax({
            type: 'GET',
            url: '../../../src/models/search_admin.php',
            data: 'txt=' + userTypeInAdmin,
            success: function(data){
                $("#show_admin_filter").html(data); 
                //je rappelle ma fonction refreshTrash car l'Ajax passe avant de filtre 
                refreshTrash();
            }
        }) 
    })


})



