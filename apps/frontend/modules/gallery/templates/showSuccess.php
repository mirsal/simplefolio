<?php use_stylesheet('gallery') ?>

<h2><?php echo $gallery ?></h2>

<ul class="thumbnails">
<?php foreach ($gallery as $filename => $file): ?>

    <li><a href="#">

    <img src="<?php
        echo url_for('media', array(
            'gallery' => (string) $gallery,
            'media'   => $filename
        ))
    ?>" />

    </a></li>

<?php endforeach; ?>
</ul>
