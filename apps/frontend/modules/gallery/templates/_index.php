<ul class="galleries">
<?php foreach($galleries as $gallery): ?>
    <li class="<?php $sf_request->getParameter('gallery') === (string) $gallery and print('current')?>">
        <?php echo link_to($gallery, 'gallery', array('gallery' => (string) $gallery)) ?>
    </li>
<?php endforeach; ?>
</ul>
