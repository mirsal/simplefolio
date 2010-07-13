<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
    $this->enablePlugins('sfGuardPlugin');

    sfConfig::add(array(
        'sf_galleries_dir' => sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'galleries',
        'sf_gallery_media_dir_name' => 'media',
        'sf_gallery_thumbnails_dir_name' => 'thumbnails',
        'sf_gallery_incoming_dir_name' => 'incoming'
    ));
  }
}
