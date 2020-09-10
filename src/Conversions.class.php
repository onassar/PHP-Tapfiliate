<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Conversions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends Base
     * @final
     */
    final class Conversions extends Base
    {
        /**
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'delete' => '/1.6/conversions/:id/',
            'get' => '/1.6/conversions/:id/',
            'list' => '/1.6/conversions/'
        );
    }
