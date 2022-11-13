<div class = "comment_block">
    <p class = "user_name"><?= $data["creator"] ?> <?= $data["created_at"] ?> <?= ($this->user_login["id"] == $data["message_user_id"] ) ? '<a href = '.base_url().'delete_comment/'.$data["id"].'>delete</a>' : '' ?></p>
    <p class = "content"><?= $data["comment"] ?> </p>
</div>
