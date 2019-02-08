<div class="article-list">
    <p>Hieronder zijn alle artikelen te zien:</p>
    <ul>
    <?php foreach ($articleList as $article) { ?>
        <li>
            <a href="<?= $article->link; ?>">
                <?= $article->title; ?>
            </a>
        </li>
    <?php } ?>
    </ul>
</div>