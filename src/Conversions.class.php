<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Api.class.php';

    /**
     * Conversions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends Api
     * @final
     */
    final class Conversions extends Api
    {
        /**
         * _directory
         * 
         * @var     string (default: 'conversions')
         * @access  protected
         */
        protected $_directory = 'conversions';
    }
