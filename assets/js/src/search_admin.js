$(() => {

    $("#search_admin").on('keyup',() => {
        let userTypeIn = $("#search_admin").val();
        $.ajax({
            type: 'GET',
            url: '../../../src/models/search_admin.php',
            data: 'txt=' + userTypeIn,
            success: function(data){
                $("#show_admin_filter").html(data);
            }
        }) 
    })

})



