<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'API.class.php';

    /**
     * Programs
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends API
     * @final
     */
    final class Programs extends API
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'programs')
         */
        protected $_directory = 'programs';
    }
