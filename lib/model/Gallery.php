<?

class Gallery implements IteratorAggregate
{
    protected $dirname;

    public function __toString()
    {
        return basename($this->dirname);
    }

    public function __construct($dirname)
    {
        $this->dirname = $dirname;
    }

    public function getIterator()
    {
        return new FilesystemIterator(
            $this->dirname.DIRECTORY_SEPARATOR.sfConfig::get('sf_gallery_media_dir_name'),
            FilesystemIterator::NEW_CURRENT_AND_KEY | FilesystemIterator::SKIP_DOTS
        );
    }

    public function find($filename)
    {
        $path = $this->dirname.DIRECTORY_SEPARATOR.
            sfConfig::get('sf_gallery_media_dir_name').DIRECTORY_SEPARATOR.$filename;
        return new SplFileInfo($path);
    }
}
