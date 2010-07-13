<?php

/**
 * gallery components.
 *
 * @package    simplefolio
 * @subpackage gallery
 * @author     Mirsal Ennaime
 * @version    $Id$
 */
class galleryComponents extends sfComponents
{
 /**
  * Displays a list of galleries
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->galleries = GalleryPeer::getAll();
  }
}
