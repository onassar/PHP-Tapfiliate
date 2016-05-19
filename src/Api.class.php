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
         * _tapfiliate
         * 
         * @var    Tapfiliate
         * @access protected
         */
        protected $_tapfiliate;

        /**
         * __construct
         * 
         * @access public
         * @param  Tapfiliate $tapfiliate
         * @return void
         */
        public function __construct(Tapfiliate $tapfiliate)
        {
            $this->_tapfiliate = $tapfiliate;
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
            if (empty($params) === false) {
                $path = ($path) . '?' . http_build_query($params);
            }
            return $this->_request('get', $path);
        }

        /**
         * _post
         * 
         * @access protected
         * @param  string $path
         * @param  array $params = array()
         * @param  array $data = array()
         * @return false|array|stdClass
         */
        protected function _post(
            $path,
            array $params = array(),
            array $data = array()
        ) {
            if (empty($params) === false) {
                $path = ($path) . '?' . http_build_query($params);
            }
            return $this->_request('post', $path, $data);
        }

        /**
         * _put
         * 
         * @access protected
         * @param  string $path
         * @param  array $params = array()
         * @param  array $data = array()
         * @return false|array|stdClass
         */
        protected function _put(
            $path,
            array $params = array(),
            array $data = array()
        ) {
            if (empty($params) === false) {
                $path = ($path) . '?' . http_build_query($params);
            }
            return $this->_request('put', $path, $data);
        }

        /**
         * _request
         * 
         * @access protected
         * @param  string $method
         * @param  string $path
         * @param  array $data = array()
         * @return false|array|stdClass
         */
        public function _request($method, $path, array $data = array())
        {
            $key = $this->_tapfiliate->getKey();
            $options = array(
                'http' => array(
                    'method' => strtoupper($method),
                    'header' => 'Api-Key: ' . ($key)
                )
            );
            if (empty($data) === false) {
                $options['http']['header'] .= '\nContent-type: application/x-www-form-urlencoded';
                $options['http']['content'] = http_build_query($data);
            }
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
            throw new \Exception('Not yet implemented');
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
            return $this->_put($path);
        }
    }
