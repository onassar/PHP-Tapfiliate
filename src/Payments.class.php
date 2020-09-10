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
            'list' => '/1.6/payments/',
            'paid' => '/1.6/payments/:id/paid/'
        );

        /**
         * paid
         * 
         * @access  public
         * @param   string $id
         * @return  bool
         */
        public function paid(string $id): bool
        {
            $host = $this->_host;
            $path = $this->_paths['paid'];
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('put');
            $this->setURL($url);
            $response = $this->_getURLResponse() ?? false;
            if ($response === false) {
                return false;
            }
            return true;
        }
    }
