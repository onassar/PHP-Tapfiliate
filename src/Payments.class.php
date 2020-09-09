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
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'payments')
         */
        protected $_directory = 'payments';

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
            $endpoint = ($directory) . '/' . ($id) . '/paid/';
            $response = $this->_put($endpoint);
            return $response;
        }
    }
