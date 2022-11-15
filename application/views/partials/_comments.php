<div class = "comment_block">
    <p class = "user_name"><?= $data["creator"] ?> <?= $data["created_at"] ?> <?= ($this->user_login["id"] == $data["message_user_id"] ) ? '<a href = "#" data-attr-id = '.$data["id"].' data-attr-form = "delete_comment" >delete</a>' : '' ?></p>
    <p class = "content"><?= $data["comment"] ?> </p>
</div>
