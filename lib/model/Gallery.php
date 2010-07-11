<?

/**
 * Gallery directory wrapper class
 *
 * @author Mirsal Ennaime
 */
class Gallery implements IteratorAggregate
{
    protected $dirname;

    public function __toString()
    {
        return basename($this->dirname);
    }

    /**
     * Class constructor
     *
     * @param String $dirname path to the gallery directory
     */
    public function __construct($dirname)
    {
        $this->dirname = $dirname;
    }

    /**
     * Creates a directory iterator over the gallery media directory
     *
     * @see #IteratorAggregate::getIterator()
     *
     * @return FilesystemIterator a filesystem iterator
     */
    public function getIterator()
    {
        return new FilesystemIterator(
            $this->dirname.DIRECTORY_SEPARATOR.sfConfig::get('sf_gallery_media_dir_name'),
            FilesystemIterator::NEW_CURRENT_AND_KEY | FilesystemIterator::SKIP_DOTS
        );
    }

    /**
     * Finds a media with its name as input
     *
     * @param String $filename name of the media to retrieve
     * @return SplFileInfo the requested media file
     */
    public function find($filename)
    {
        $subdir = sfConfig::get('sf_gallery_media_dir_name');
        $path   = $this->getCanonicalPath($subdir, $filename);

        if(false === $path)
            return null;

        return new SplFileInfo($path);
    }

    /**
     * Finds a media's thumbnail with its name as input
     *
     * @param String $filename name of the media for which to retrieve a thumb
     * @return SplFileInfo the requested media's thumbnail file
     */
    public function findThumbnail($filename)
    {
        $subdir = sfConfig::get('sf_gallery_thumbnails_dir_name');
        $path   = $this->getCanonicalPath($subdir, $filename);

        if(false === $path)
            return null;

        return new SplFileInfo($path);
    }

    /**
     * Builds a canonical path from a directory path and a media file name
     *
     * @param String dirpath The base directory path
     * @param String $filename A media file name
     * @return mixed The canonical path if it is valid, false otherwise
     */
    protected function getCanonicalPath($subdir, $filename)
    {
        $cdirpath = realpath($this->dirname.DIRECTORY_SEPARATOR.$subdir);
        $cpath    = realpath($cdirpath.DIRECTORY_SEPARATOR.$filename);

        if(strncmp($cdirpath, $cpath, strlen($cdirpath)))
            return false;

        return $cpath;
    }
}

