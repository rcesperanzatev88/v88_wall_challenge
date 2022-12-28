$(document).ready(function(){
    $(document).on("submit", "form", function(){

        let form = $(this);
    
        $.post($(this).attr("action"), $(this).serialize(), function(data){
            
            $(".message").val("");
        
            if(data.status == true){
                $("#container").html(data.data);
            }
            else{
                form.children(".error").html(data.message);
            }

        }, 'json');

        return false;
    });

    $(document).on("click", "a", function(){

        let form = $(this);

        let delete_form = $("#" + form.attr("data-attr-form"));

        delete_form.children(".delete_id").val(form.attr("data-attr-id"));

        delete_form.submit();
    });
});