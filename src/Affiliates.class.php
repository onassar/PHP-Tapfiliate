<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'API.class.php';

    /**
     * Affiliates
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends API
     * @final
     */
    final class Affiliates extends API
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'affiliates')
         */
        protected $_directory = 'affiliates';
    }
