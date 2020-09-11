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
            'create' => '/1.6/payments/',
            'list' => '/1.6/payments/',
            'paid' => '/1.6/payments/:id/paid/'
        );

        /**
         * create
         * 
         * @access  public
         * @param   array $properties
         * @return  null|array
         */
        public function create(array $properties): ?array
        {
            $host = $this->_host;
            $path = $this->_paths['create'];
            $url = 'https://' . ($host) . ($path);
            $this->_requestBody = json_encode($properties);
            $this->setRequestMethod('post');
            $this->setURL($url);
            $response = $this->_getURLResponse();
            return $response;
        }
    }
