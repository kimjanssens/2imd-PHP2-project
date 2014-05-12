    function load(){
    $.ajax({
        type: "POST",
        url: "ajax/get_restaurant.php",
        data: {restaurant: $('#restaurants').val()},
        dataType: "json"
    })
    .done(function( msg ){
        for(var i=0; i<msg.restaurant_name.length; i++)
        {
            $("#restaurantdata").html("<h1>"+msg.restaurant_name+"</h1>");
        }
    });
    };
$(document).ready(function(){
    $('#restaurants').on('change', function(e){
        load();
        if($(location).attr('pathname') != '/admin.php')
        {
            $(location).attr('href', 'admin.php');
        }
        e.preventDefault();
    });
});
