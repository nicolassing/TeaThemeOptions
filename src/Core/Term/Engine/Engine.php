<?php

namespace crewstyle\TeaThemeOptions\Core\Term\Engine;

use crewstyle\TeaThemeOptions\TeaThemeOptions;
use crewstyle\TeaThemeOptions\Core\Term\Hook\Hook;

/**
 * TTO TERM ENGINE
 */

if (!defined('TTO_CONTEXT')) {
    die('You are not authorized to directly access to this page');
}


//----------------------------------------------------------------------------//

/**
 * TTO Term Engine
 *
 * Class used to work with Term Engine.
 *
 * @package Tea Theme Options
 * @subpackage Core\Term\Engine\Engine
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 3.3.6
 *
 */
class Engine
{
    /**
     * @var Hook
     */
    protected $hook = null;

    /**
     * @var string
     */
    protected static $index = 'term';

    /**
     * @var string
     */
    protected static $prefix = '%TERM%-%SLUG%';

    /**
     * @var array
     */
    protected $terms = array();

    /**
     * Constructor.
     *
     * @since 3.3.6
     */
    public function __construct()
    {
        //Initialize all default configurations
        $this->hook = new Hook();
    }

    /**
     * Add a term to the theme options panel.
     *
     * @param array $configs Array containing all configurations
     * @param array $contents Contains all data
     *
     * @since 3.3.4
     */
    public function addTerm($configs = array())
    {
        //Check if we are in admin panel
        if (empty($configs) || !isset($configs['slug']) || empty($configs['slug'])) {
            return;
        }

        //Define the slug
        $configs['slug'] = TeaThemeOptions::getUrlize($configs['slug']);
        $slug = $configs['slug'];

        //Check if slug has already been registered
        if (isset($this->terms[$slug]) && !empty($this->terms[$slug])) {
            return;
        }

        //Define cpt configurations
        $this->terms[$slug] = $configs;
    }

    /**
     * Build terms.
     *
     * @uses add_action()
     *
     * @since 3.3.4
     */
    public function buildTerms()
    {
        //Check if we are in admin panel
        if (empty($this->terms)) {
            return;
        }

        //Add WP Hooks
        $this->hook->setTerms($this->terms);
    }

    /**
     * Get index.
     *
     * @return string $index Post type index
     *
     * @since 3.0.0
     */
    public static function getIndex()
    {
        return (string) self::$index;
    }

    /**
     * Get prefix.
     *
     * @return string $prefix Post type prefix
     *
     * @since 3.0.0
     */
    public static function getPrefix()
    {
        return (string) self::$prefix;
    }
}
