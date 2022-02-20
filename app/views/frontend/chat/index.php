<?php
if (empty($currentUser['img'])) {
    $userAvatar = 'user.png';
}

?>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <a href="users" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="./public/frontend/images/<?= $userAvatar ?>" alt="">
            <div class="details">
                <span><?= $currentUser['full_name'] ?></span>
                <p><?= $currentUser['status'] ?></p>
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