<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'API.class.php';

    /**
     * Conversions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends API
     * @final
     */
    final class Conversions extends API
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'conversions')
         */
        protected $_directory = 'conversions';
    }
