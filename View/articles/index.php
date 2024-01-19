<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="color: #ff69b4;">Articles</h1>
    <ul style="list-style-type: none; padding: 0;">
        <?php foreach ($articles as $article) : ?>
            <li style="border-bottom: 1px solid #eee; padding: 10px 0;">
                <?= $article->title ?> (<?= $article->formatPublishDate() ?>)<br>
                <a href="index.php?page=articles-show&id=<?= $article->id ?>" style="color: #ff69b4; text-decoration: none;">Read more</a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>