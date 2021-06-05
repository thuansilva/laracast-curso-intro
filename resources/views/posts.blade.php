<!DOCTYPE html>
<title>My blog</title>
<link rel="stylesheet" href="./app.css">
<script src='./app.js'></script>

<body>
    <?php foreach ($posts as $post): ?>
    <article>
        <a href="/post/<?= $post->slug; ?>">
           <?= $post->title?>
        </a>
        <div>
            <?= $post->body ?>
        </div>
    </article>
    <?php endforeach; ?>

</body>
