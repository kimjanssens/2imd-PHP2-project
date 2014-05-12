function load(){
    $.ajax({
        type: "POST",
        url: "ajax/get_restaurant.php",
        data: {restaurant: $('#restaurants').val()},
        dataType: "json"
    })
    .done(function( msg ){
        var restaurantdiv = $("#restaurantdata");
        restaurantdiv.html("<h1>"+msg.restaurant_name+"</h1>");
        restaurantdiv.append("<h2>"+msg.restaurant_street+"</h2>");
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
