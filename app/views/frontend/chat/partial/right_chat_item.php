<?php
/**
 * @var array $item
 */

if (empty($item['img'])) {
    $userAvatar = 'user.png';
} else {
    $userAvatar = $item['img'];
}
?>

<div class="chat incoming">
    <img src="/public/frontend/images/<?= $userAvatar ?>" alt="">
    <div class="details">
        <p><?= $item['message'] ?></p>
    </div>
</div>