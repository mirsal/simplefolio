<?php

/**
 * gallery actions.
 *
 * @package    simplefolio
 * @subpackage gallery
 * @author     Mirsal Ennaime
 * @version    $Id$
 */
class galleryActions extends sfActions
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

 /**
  * Shows the gallery specified as a GET parameter
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless(
        $gallery = GalleryPeer::find($request->getParameter('gallery')));

    $this->gallery = $gallery;
  }

 /**
  * Renders the specified media
  *
  * @param sfRequest $request A request object
  */
  public function executeRenderMedia(sfWebRequest $request)
  {
    $this->forward404Unless(
        $gallery = GalleryPeer::find($request->getParameter('gallery')) and
        $media   = $gallery->find($request->getParameter('media'))
    );

    return $this->renderImage($media);
  }

 /**
  * Renders the specified media's thumbnail
  *
  * @param sfRequest $request A request object
  */
  public function executeRenderThumbnail(sfWebRequest $request)
  {
    $this->forward404Unless(
        $gallery   = GalleryPeer::find($request->getParameter('gallery')) and
        $thumbnail = $gallery->findThumbnail($request->getParameter('media'))
    );

    return $this->renderImage($thumbnail);
  }

 /**
  * Serves the specified image file
  *
  * @param SplFileInfo $file an image file
  */
  public function renderImage(SplFileInfo $file)
  {
    $img = getimagesize($file->getPathname());

    $this->getResponse()->clearHttpHeaders();

    $this->getResponse()->addCacheControlHttpHeader('public');
    $this->getResponse()->addCacheControlHttpHeader('must-revalidate');
    $this->getResponse()->addCacheControlHttpHeader('max_age=86400');
    $this->getResponse()->setHttpHeader('Last-Modified', $this->getResponse()->getDate($file->getCTime()));

    if(($ts = strtotime($this->getRequest()->getHttpHeader('If-Modified-Since'))) and $ts < $file->getCTime())
    {
        $this->getResponse()->setStatusCode(304, 'Not Modified');
        $this->getResponse()->sendHttpHeaders();
        return sfView::HEADERS_ONLY;
    }

    $this->getResponse()->setHttpHeader('Expires', $this->getResponse()->getDate(time() + 3600));
    $this->getResponse()->setHttpHeader('Content-Type', $img['mime']);
    $this->getResponse()->setHttpHeader('Content-Length', $file->getSize());

    $this->getResponse()->sendHttpHeaders();

    readfile($file->getPathname());
    return sfView::NONE;
  }
}
