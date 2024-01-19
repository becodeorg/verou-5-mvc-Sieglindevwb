<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="color: #ff69b4;"><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>

     <?php
    $imageUrl = $article->getImageUrl();
    if ($imageUrl !== null): ?>
        <img src="<?= $imageUrl ?>" alt="Article Image" style="max-width: 100%;"><br>
    <?php endif; ?>
    <br>

    <!-- links to next and previous -->
    <?php if ($prevArticleId !== null):  ?>
        <a href="index.php?page=articles-show&id=<?= $prevArticleId ?>" style="color: #ff69b4; text-decoration: none;">Previous article</a>
    <?php endif; ?>
    
    <?php if ($nextArticleId !== null):  ?>
        <a href="index.php?page=articles-show&id=<?= $nextArticleId ?>" style="color: #ff69b4; text-decoration: none;">Next article</a>
    <?php endif; ?>
    
</section>

<?php require 'View/includes/footer.php'?>