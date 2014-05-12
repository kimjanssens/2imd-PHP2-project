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
        restaurantdiv.append("<span style='display:none' class='restoId'>"+msg.restaurant_id+"</span>");
        restaurantdiv.append("<ul><li>"+msg.restaurant_street+" "+msg.restaurant_number+"</li><li>"+msg.restaurant_city+"</li></ul>");
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
    
    $('.btnRemoveTable').on('click', function(e){
        var tableId = $(this).parent().siblings('a').find('.tableId');
        var listitem = $(this).parent().parent();
        $.ajax({
            type: "POST",
            url: "ajax/remove_table.php",
            data: {tableId: tableId.text()},
            dataType: "json"
        })
        .done(function( msg ){
            var restaurantdiv = $(".container");
            restaurantdiv.append("<p class='bg-success'>"+msg.feedback+"</p>");
            listitem.fadeOut(1000);
        });
    });
    
    $('#btnRemoveRestaurant').on('click', function(e){
        var restoId = $(this).parent().find('.restoId');
        $.ajax({
            type: "POST",
            url: "ajax/remove_restaurant.php",
            data: {restoId: restoId.text()},
            dataType: "json"
        })
        .done(function( msg ){
            var restaurantdiv = $("#restaurantdata");
            restaurantdiv.html("<p class='bg-success'>"+msg.feedback+"</p>");
        });
    });
});
