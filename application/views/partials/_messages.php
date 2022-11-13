<div class = "message_block" data-attr-id = <?= $data["id"] ?>>
    <p class = "user_name"><?= $data["creator"] ?> <?= $data["created_at"] ?> <?= ($this->user_login["id"] == $data["message_user_id"] ) ? '<a href = '.base_url().'delete_message/'.$data["id"].'>delete</a>' : '' ?></p>
    <p class = "content"><?= $data["message"] ?></p>
    <div class = "error_comment"></div>
    <textarea class = "message" name = "message"></textarea>
    <button class = "submit_comment">Comment</button>
    <div class = "comment_container"></div>
</div>  
