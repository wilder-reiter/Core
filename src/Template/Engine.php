<?php

namespace Wildgame\Template;

/**
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
class Engine {

    /**
     * @var array
     */
    private $config;

    /**
     * @param   array   $config
     */
    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * @param   string  $name
     * @param   array   $data
     *
     * @return  string
     */
    public function render(string $name, array $data = []) : string
    {
        $template = new Template($name, $data, $this->config);
        return $template->render();
    }
}
