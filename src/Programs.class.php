<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Api.class.php';

    /**
     * Programs
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends Api
     * @final
     */
    final class Programs extends Api
    {
        /**
         * _directory
         * 
         * @var    string (default: 'programs')
         * @access protected
         */
        protected $_directory = 'programs';
    }
