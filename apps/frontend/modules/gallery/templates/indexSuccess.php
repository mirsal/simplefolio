<h2>Galleries</h2>

<ul class="galleries">
<?php foreach($galleries as $gallery): ?>
    <li><?php echo link_to($gallery, 'gallery', array('gallery' => (string) $gallery)) ?></li>
<?php endforeach; ?>
</ul>
