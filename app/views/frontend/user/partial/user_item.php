<?php
/**
 * @var array $user
 * @var string $yourTag
 * @var string $message
 * @var string $status
 */
?>

<a href="/chat?user_id=<?= $user['unique_id'] ?>">
    <div class="content">
        <img src="/public/frontend/images/<?= empty($user['img']) ? 'user.png' : $user['img'] ?>" alt="">
        <div class="details">
            <span><?= $user['full_name'] ?></span>
            <p><?= $yourTag . $message ?></p>
        </div>
    </div>
    <div class="status-dot <?= $status ?>"><i class="fas fa-circle"></i></div>
</a>