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
            'get' => '/1.6/affiliates/:id/',
            'list' => '/1.6/affiliates/',
            'payoutMethods' => '/1.6/affiliates/:id/payout-methods/'
        );

        /**
         * payoutMethods
         * 
         * @access  public
         * @param   string $id
         * @return  null|array
         */
        public function payoutMethods(string $id): ?array
        {
            $host = $this->_host;
            $path = $this->_paths['payoutMethods'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('get');
            $this->setURL($url);
            $response = $this->_getURLResponse();
            return $response;
        }
    }
