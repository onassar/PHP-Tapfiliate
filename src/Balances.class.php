<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Balances
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends Base
     * @final
     */
    final class Balances extends Base
    {
        /**
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'find' => '/1.6/balances/'
        );
    }
