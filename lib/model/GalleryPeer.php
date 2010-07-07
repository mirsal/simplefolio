<?

class GalleryPeer
{

    /**
     * Retrieves a gallery with its name as input
     *
     * @param String $name the name of the gallery to find
     * @return mixed A #Gallery instance or null if none is found
     */
    public static function find($name)
    {
        $basedir = self::checkGalleriesDir();
        $path    = $basedir.DIRECTORY_SEPARATOR.$name;

        if(!self::isGalleryDir($path))
            return NULL;

        return self::load($path);
    }

    /**
     * Finds all the available galleries
     *
     * @return an array of #Gallery instances
     */
    public static function getAll()
    {
        $ret     = array();
        $basedir = self::checkGalleriesDir();

        $d = dir($basedir);

        try {
            while (FALSE !== ($dirname = $d->read())) {

                $path = $basedir.DIRECTORY_SEPARATOR.$dirname;
                if(!self::isGalleryDir($path))
                    continue;

                $ret[] = self::load($path);

            }
            $d->close();
            return $ret;
        } catch(Exception $e) {

            $d->close();
            throw $e;

        }
    }

    /**
     * Checks the base galleries directory for permissions
     *
     * @return String the galleries directory path
     */
    protected static function checkGalleriesDir()
    {
        $basedir = sfConfig::get('sf_galleries_dir');
        if(!is_dir($basedir) or !is_readable($basedir))
            throw new Exception('The base gallery directory is not readable');

        return $basedir;
    }

    /**
     * Loads a gallery directory
     *
     * @param String $path the gallery directory
     * @return mixed a gallery instance
     */
    protected static function load($path)
    {
        return new Gallery($path);
    }

    /**
     * Checks whether a directory contains a gallery
     *
     * @return boolean wether the path given an input is a gallery directory
     */
    protected static function isGalleryDir($path)
    {
        return
            is_dir($path) and
            !in_array(basename($path), array('.', '..')) and
            is_dir($path.DIRECTORY_SEPARATOR.'media');
    }
}
