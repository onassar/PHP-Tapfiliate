<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Api.class.php';

    /**
     * Affiliates
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends Api
     * @final
     */
    final class Affiliates extends Api
    {
        /**
         * _directory
         * 
         * @var     string (default: 'affiliates')
         * @access  protected
         */
        protected $_directory = 'affiliates';
    }
