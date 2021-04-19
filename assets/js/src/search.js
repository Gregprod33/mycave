$(() => {

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

})



