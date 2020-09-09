<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Payments
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends Base
     * @final
     */
    final class Payments extends Base
    {
        /**
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'all' => '/1.6/payments/'
        );

        /**
         * paid
         * 
         * Marks a payment as paid.
         * 
         * @access  public
         * @param   string|int $id
         * @return  false|array
         */
        public function paid($id)
        {
            $directory = $this->_directory;
            $path = ($directory) . '/' . ($id) . '/paid/';
            $response = $this->_put($path);
            return $response;
        }
    }
