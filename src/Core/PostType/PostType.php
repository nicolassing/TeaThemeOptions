<?php

namespace crewstyle\TeaThemeOptions\Core\PostType;

use crewstyle\TeaThemeOptions\TeaThemeOptions;
use crewstyle\TeaThemeOptions\Core\Action\Action;
use crewstyle\TeaThemeOptions\Core\PostType\Engine\Engine;

/**
 * TTO POSTTYPE
 */

if (!defined('TTO_CONTEXT')) {
    die('You are not authorized to directly access to this page');
}


//----------------------------------------------------------------------------//

/**
 * TTO PostType
 *
 * To get its own post type.
 *
 * @package Tea Theme Options
 * @subpackage Core\PostType\PostType
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 3.3.6
 *
 */
class PostType
{
    /**
     * @var Engine
     */
    protected $engine = null;

    /**
     * Constructor.
     *
     * @since 3.3.6
     */
    public function __construct()
    {
        //Initialize search
        $this->engine = new Engine();

        //Hooks
        if (TTO_IS_ADMIN) {
            add_filter('tto_template_footer_urls', function ($urls, $identifier) {
                return array_merge($urls, array(
                    'posttypes' => array(
                        'url' => admin_url('admin.php?page='.$identifier.'&do=tto-action&from=footer&make=posttypes'),
                        'label' => TeaThemeOptions::__('post types'),
                    )
                ));
            }, 10, 2);
        }
    }

    /**
     * Add a post type to the theme options panel.
     *
     * @param array $configs Array containing all configurations
     *
     * @since 3.3.6
     */
    public function addPostType($configs = array())
    {
        $this->engine->addPostType($configs);
    }

    /**
     * Register post types.
     *
     * @since 3.3.6
     */
    public function buildPostTypes()
    {
        $this->engine->buildPostTypes();
    }
}
