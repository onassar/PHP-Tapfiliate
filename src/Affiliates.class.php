<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Affiliates
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends Base
     * @final
     */
    final class Affiliates extends Base
    {
        /**
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'find' => '/1.6/affiliates/',
            'get' => '/1.6/affiliates/:id/'
        );
    }
