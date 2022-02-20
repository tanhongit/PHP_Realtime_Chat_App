<?php
if (empty($user_detail['img'])) {
    $userAvatar = 'user.png';
} else {
    $userAvatar = $user_detail['img'];
}

?>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <a href="user/list" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="./public/frontend/images/<?= $userAvatar ?>" alt="">
            <div class="details">
                <span><?= $user_detail['full_name'] ?></span>
                <p><?= $user_detail['status'] ?></p>
            </div>
        </header>

        <div class="chat-box"></div>

        <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="1" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                   autocomplete="off">
            <button><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
</div>