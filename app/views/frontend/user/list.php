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
                <img src="/public/frontend/images/<?= $userAvatar ?>" alt="">
                <div class="details">
                    <span><?= $currentUser['full_name'] ?></span>
                    <p><?= ucwords($currentUser['status']) ?></p>
                </div>
            </div>
            <a href="/user/logout" class="logout">Logout</a>
        </header>
        <?php $this->renderPartial('frontend.user.partial.search_bar') ?>
        <div class="users-list">
        </div>
    </section>
</div>