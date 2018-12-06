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
     * @param   string  $path
     * @param   string  $extension
     */
    public function __construct(string $path, string $extension)
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    /**
     * @param   string  $file
     * @param   array   $params
     *
     * @return  string
     */
    public function render(string $file, array $params) : string
    {
        // Insert all external templates
        $string = $this->prerenderFile($file);

        // Render the template vars and tags
        $string = $this->renderString($string, $params);
        return $string;
    }

    /**
     * @param   string  $file
     *
     * @return  string
     */
    private function prerenderFile(string $file) : string
    {
        // Find inserted template occurances.
        $files = [];
        preg_match_all($this->insertion, $string, $files);

        foreach ($files[0] as $file)
        {
            // Clean conditional for checking
            $cleaned = str_replace(['@', '{', '}'], '', $file);

            // Get the file content to insert
            $path = $this->path . $cleaned . $this->extension;
            $content = file_get_contents($path);

            $string = str_replace('{@'.$cleaned.'?}', $content, $string);
        }

        return $string;
    }
}
