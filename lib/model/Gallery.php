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
        $path = $this->dirname.DIRECTORY_SEPARATOR.
            sfConfig::get('sf_gallery_media_dir_name').DIRECTORY_SEPARATOR.$filename;
        return new SplFileInfo($path);
    }
}
