$(document).ready(function(){
    
    $("form").submit(function(){
        let form =  $(this);

        $.post($(this).attr("action"), $(this).serialize(), function(data){
            form.children(".error").html(data.message);
            $(".csrf").val(data.csrf);
            $(".message").val("");


            if(data.form == 'messages'){
                $("#container").prepend(data.data);
            }
            else{
                update_comment_form(data);
            }
            
        }, 'json');
        
        return false;
    })

    $(document).on("click", "a", function(){
        let form = $(this);
        let delete_form = $("#" + form.attr("data-attr-form"));

        delete_form.children(".delete_id").val($(this).attr("data-attr-id"));

        $.post(delete_form.attr("action"), delete_form.serialize(), function(data){
           
            if(data.status == true){
                form.parent().parent().remove();
                $(".csrf").val(data.csrf);
                $(".delete_id").val("");
                alert("deleted");
            }
        }, 'json');

        return false;
    });

    $(document).on("click", ".submit_comment", function(){
       
        let comment = $(this).parent().children(".message").val();
        let message_id = $(this).parent().attr("data-attr-id");
        $(this).parent().children(".error_comment").addClass("current");
        $(this).parent().addClass("current");

        $("#form_comment").children(".message").val(comment);
        $("#form_comment").children("#message_id").val(message_id);
       
        $("#form_comment").submit();
    });

    function update_comment_form(data){
        $(".error_comment.current").html(data.message);
        $(".error_comment.current").removeClass("current");

        $(".message_block.current").children(".comment_container").prepend(data.data);
        $(".message_block.current").removeClass("current");
    }

});