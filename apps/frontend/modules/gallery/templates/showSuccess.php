<?php use_javascript('jquery') ?>
<?php use_javascript('jquery.lightbox.js')?>
<?php use_stylesheet('jquery.lightbox.css')?>

<?php use_stylesheet('gallery') ?>
<?php use_javascript('gallery')?>

<h2><?php echo $gallery ?></h2>

<ul class="thumbnails">
<?php foreach ($gallery as $filename => $file): ?>

    <li><a href="<?php
        echo url_for('media', array(
            'gallery' => (string) $gallery,
            'media'   => $filename
        ))
    ?>">

    <img src="<?php
        echo url_for('thumbnail', array(
            'gallery' => (string) $gallery,
            'media'   => $filename
        ))
    ?>" />

    </a></li>

<?php endforeach; ?>
</ul>
