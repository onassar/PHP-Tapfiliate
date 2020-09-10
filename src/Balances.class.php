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
            'list' => '/1.6/balances/'
        );

        /**
         * _getPaginationRequestData
         * 
         * Overrides the parent method since balance list requests will always
         * return a non-paginated list of balances.
         * 
         * @access  protected
         * @return  array
         */
        protected function _getPaginationRequestData(): array
        {
            $paginationRequestData = array();
            return $paginationRequestData;
        }
    }
