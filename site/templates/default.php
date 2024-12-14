<h1><?= $page->title() ?></h1>

<nav>
    <?php foreach($page->children()->listed() as $item): ?>
    <a href="<?= $item->url() ?>">
        <?= $item->title() ?>
    </a>
    <?php endforeach ?>
</nav>

<?= $page->text() ?>