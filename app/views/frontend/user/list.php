<?php
if (empty($currentUser['img'])) {
    $userAvatar = 'user.png';
} else {
    $userAvatar = $currentUser['img'];
}

?>
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <img src="./public/frontend/images/<?= $userAvatar ?>" alt="">
                <div class="details">
                    <span><?= $currentUser['full_name'] ?></span>
                    <p><?= $currentUser['status'] ?></p>
                </div>
            </div>
            <a href="#" class="logout">Logout</a>
        </header>
        <div class="search">
            <span class="text">Select an user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
        </div>
    </section>
</div>