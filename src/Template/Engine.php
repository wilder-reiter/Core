<?php

namespace Wildgame\Template;

/**
 * Extends the Template class by adding embedded subtemplates to the
 * functionality range.
 *
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Engine extends Template {

    /**
     * @var string
     */
    private $insertion = '#\{\@[a-z]+\}#';

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $cache;

    /**
     * @param   string  $path
     * @param   string  $extension
     * @param   string  $cache
     */
    public function __construct(
        string $path,
        string $extension,
        string $cache
    ) {
        $this->path = $path;
        $this->extension = $extension;
        $this->cache = $cache;
    }

    /**
     * @param   string  $file
     * @param   array   $params
     *
     * @return  string
     */
    public function render(string $file, array $params) : string
    {
        $cachePath = $this->cache.$file.$this->extension;

        // If file in cache, load cached file
        if (file_exists($cachePath)) {
            $string = file_get_contents($cachePath);
        // Otherwise prerender the template and save it to the cache
        } else {
            $string = $this->prerenderFile($file);
            $string = $this->deleteComments($string);

            file_put_contents($cachePath, $string);
        }

        // Render the template vars and tags
        $string = $this->renderString($string, $params);
        return $string;
    }

    /**
     * Searches for insertion tags and replaces them with requested
     * subtemplates. Insertion tags look like: {@filename}.
     *
     * @param   string  $file
     *
     * @return  string
     */
    private function prerenderFile(string $file) : string
    {
        // Load requested file
        $string = file_get_contents($this->path.$file.$this->extension);
        // Find inserted template occurances.
        $files = [];
        preg_match_all($this->insertion, $string, $files);

        foreach ($files[0] as $template)
        {
            // Clean conditional for checking
            $cleaned = str_replace(['@', '{', '}'], '', $template);

            // Get the file content to insert
            $path = $this->path.$cleaned.$this->extension;
            $content = file_get_contents($path);

            $string = str_replace('{@'.$cleaned.'?}', $content, $string);
        }

        return $string;
    }
}
