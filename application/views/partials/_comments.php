                        <div class = "comment_block">
                            <p class = "username"> <?= $data["creator"] ?> <?= $data["created_at"] ?>
                            <?= ($this->user_login["id"] == $comments->message_user_id ) ? '<a href = "#" data-attr-id = '.$comments->id.' data-attr-form = "delete_comment" >delete</a>' : '' ?>
                            </p>
                            <p class = "content"> <?=  $data["comment"] ?></p>
                        </div>