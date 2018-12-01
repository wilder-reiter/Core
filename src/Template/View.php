<?php

namespace Wildgame\Template;

/**
 * @author      Lisa Saalfrank <lisa.saalfrank@web.de>
 * @copyright   2018 Lisa Saalfrank
 */
abstract class View {

    /**
     * @var \Wildgame\Template\Engine
     */
    protected $engine;

    /**
     * @param   \Wildgame\Template\Engine   $engine
     */
    public function __construct(Engine $engine) {
        $this->engine = $engine;
    }
}
