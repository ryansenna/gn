/**
 * Created by 1333612 on 11/10/2016.
 */
$(function(){
    $('#searchBar').keyup(function(){
        var search = this.value;
        var autocomplete = document.getElementById('belowBox');
        autocomplete.innerHTML = "";
        if(search == ""){
            autocomplete.innerHTML = "";
            return;
        }

        $.ajax({
            url:"ajax_handler.php",
            data:{mySearch:search},
            type: "GET",
            dataType:"json",
            success:function(json){
                if(json.length == 0){
                    var option = document.createElement('option');
                    option.value = "No results.";
                    autocomplete.appendChild(option);
                    return;
                }
                for(var i =0; i <json.length; i++){
                    var option = document.createElement('option');
                    option.value = json[i];
                    autocomplete.appendChild(option);
                }
            }
        })
    });
});