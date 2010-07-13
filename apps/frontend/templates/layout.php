<!DOCTYPE html>
<html>
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="page">
        <header>
            <?php echo link_to(image_tag('header_logo'), '@homepage') ?>
            <?php include_component('gallery', 'index') ?>
        </header>
        <?php echo $sf_content ?>
    </page>
  </body>
</html>
