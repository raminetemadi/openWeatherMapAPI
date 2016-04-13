/**
 * Created by etema on 31/03/2016.
 */
$(document).ready(function(){
    $("button").click(function(e){
        e.preventDefault();
        $(this.id).fadeOut(300);

        var city=$("#city").val();
        //removing space between city name e.g. replace New York to NewYork to avoid respond error from API
        city=city.replace(/\s/g,"");
        console.log(city);
        $.ajax({
            type:'GET',
            url:'getweather.php',
            data:'city='+city,
            dataType:'html',
            beforeSend: function(){
                $("#result").html("<p>loading...</p>");
                if(!city[0]){
                    alert("enter a city");
                    return false;
                }
            },
            success: function(response){
                $("#result").html(response);
            }
        });
    });
});