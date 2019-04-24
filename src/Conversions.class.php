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
         * @access  protected
         * @var     string (default: 'conversions')
         */
        protected $_directory = 'conversions';
    }
