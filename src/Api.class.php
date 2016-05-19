<?php

    // Namespace and dependencies
    namespace Tapfiliate;

    /**
     * Api
     * 
     * @author Oliver Nassar <onassar@gmail.com>
     * @see    https://github.com/onassar/PHP-Tapfiliate
     * @see    https://pecl.php.net/package/oauth
     * @see    http://php.net/manual/en/book.oauth.php
     */
    class Api
    {
        /**
         * _base
         * 
         * @var    string
         * @access protected
         */
        protected $_base = 'https://tapfiliate.com/api/1.4/';

        /**
         * _directory
         * 
         * @var    false|string (default: false)
         * @access protected
         */
        protected $_directory = false;

        /**
         * _key
         * 
         * @var    string
         * @access protected
         */
        protected $_key;

        /**
         * __construct
         * 
         * @access public
         * @param string $key
         * @return void
         */
        public function __construct($key)
        {
            $this->_key = $key;
        }

        /**
         * _delete
         * 
         * @access protected
         * @param  string $path
         * @return false|array|stdClass
         */
        protected function _delete($path)
        {
            return $this->_request('delete', $path);
        }

        /**
         * _get
         * 
         * @access protected
         * @param  string $path
         * @param  array $params = array()
         * @return false|array|stdClass
         */
        protected function _get($path, array $params = array())
        {
            $path = ($path) . '?' . http_build_query($params);
            return $this->_request('get', $path);
        }

        /**
         * _request
         * 
         * @access protected
         * @param  string $method
         * @param  string $path
         * @param  array $params = array()
         * @return false|array|stdClass
         */
        public function _request($method, $path, array $params = array())
        {
            $options = array(
              'http' => array(
                'method' => strtoupper($method),
                'header' => 'Api-Key: ' . ($this->_key)
              )
            );
            $url = ($this->_base) . ($path);
            $context = stream_context_create($options);
            return file_get_contents($url, false, $context);
        }

        /**
         * all
         * 
         * @access public
         * @param  array $params = array()
         * @return array
         */
        public function all(array $params = array())
        {
            $path = ($this->_directory) .'/';
            return $this->_get($path, $params);
        }

        /**
         * create
         * 
         * @access public
         * @param  array $params = array()
         * @return array
         */
        public function create(array $params = array())
        {
            throw new Exception('untested');
            $path = ($this->_directory) .'/';
            return $this->_post($path, $params);
        }

        /**
         * get
         * 
         * @access public
         * @param  int $id
         * @return mixed
         */
        public function get($id)
        {
            $path = ($this->_directory) .'/' . ($id) . '/';
            return $this->_get($path);
        }

        /**
         * put
         * 
         * @access public
         * @param  int $id
         * @return mixed
         */
        public function put($id)
        {
            $path = ($this->_directory) .'/' . ($id) . '/';
            return $this->_get($path);
        }
    }
