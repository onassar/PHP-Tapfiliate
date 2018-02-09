<?php

    // Namespace and dependencies
    namespace Tapfiliate;

    /**
     * Api
     * 
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @link    https://pecl.php.net/package/oauth
     * @link    http://php.net/manual/en/book.oauth.php
     * @author  Oliver Nassar <onassar@gmail.com>
     */
    class Api
    {
        /**
         * _base
         * 
         * @var     string
         * @access  protected
         */
        protected $_base = 'https://tapfiliate.com/api/1.4/';

        /**
         * _directory
         * 
         * @var     false|string (default: false)
         * @access  protected
         */
        protected $_directory = false;

        /**
         * _tapfiliate
         * 
         * @var     Tapfiliate
         * @access  protected
         */
        protected $_tapfiliate;

        /**
         * __construct
         * 
         * @access  public
         * @param   Tapfiliate $tapfiliate
         * @return  void
         */
        public function __construct(Tapfiliate $tapfiliate)
        {
            $this->_tapfiliate = $tapfiliate;
        }

        /**
         * _attempt
         * 
         * Attempts to call the endpoint, ensuring that no native error handling
         * can intercept a failed request.
         * 
         * @access  protected
         * @param   string $url
         * @param   resource $context
         * @return  array
         */
        protected function _attempt($url, $context)
        {
            set_error_handler(function() {});
            $response = file_get_contents($url, false, $context);
            restore_error_handler();
            if ($response === false) {
                return array(
                    'success' => false,
                    'response' => $http_response_header
                );
            }
            return array(
                'success' => true,
                'content' => $response
            );
        }

        /**
         * _delete
         * 
         * @access  protected
         * @param   string $path
         * @return  false|array|stdClass
         */
        protected function _delete($path)
        {
            return $this->_request('delete', $path);
        }

        /**
         * _get
         * 
         * @access  protected
         * @param   string $path
         * @param   array $params (default: array())
         * @return  false|array|stdClass
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
         * @access  protected
         * @param   string $path
         * @param   array $params (default: array())
         * @param   array $data (default: array())
         * @return  false|array|stdClass
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
         * @access  protected
         * @param   string $path
         * @param   array $params (default: array())
         * @param   array $data (default: array())
         * @return  false|array|stdClass
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
         * @access  protected
         * @param   string $method
         * @param   string $path
         * @param   array $data (default: array())
         * @return  false|array|stdClass
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
                $contentType = 'application/json';
                $options['http']['header'] .= "\r\nContent-type: " .
                    ($contentType);
                $options['http']['content'] = json_encode($data);
            }
            $url = ($this->_base) . ($path);
            $context = stream_context_create($options);
            $response = $this->_attempt($url, $context);
            if ($response['success'] === false) {
                if ($this->_tapfiliate->debug() === true) {
                    echo '<pre>';
                    print_r($response);
                    echo '</pre>';
                    exit(0);
                }
                return false;
            }
            $associative = $this->_tapfiliate->associative();
            return json_decode($response['content'], $associative);
        }

        /**
         * all
         * 
         * @access  public
         * @param   array $params (default: array())
         * @return  false|array|stdClass
         */
        public function all(array $params = array())
        {
            $path = ($this->_directory) .'/';
            return $this->_get($path, $params);
        }

        /**
         * create
         * 
         * @access  public
         * @param   array $data (default: array())
         * @return  false|array|stdClass
         */
        public function create(array $data = array())
        {
            throw new \Exception('Not yet implemented');
            $path = ($this->_directory) .'/';
            return $this->_post($path, $data);
        }

        /**
         * delete
         * 
         * @access  public
         * @param   integer $id
         * @return  false|array|stdClass
         */
        public function delete($id)
        {
            $path = ($this->_directory) .'/' . ($id) . '/';
            return $this->_delete($path);
        }

        /**
         * get
         * 
         * @access  public
         * @param   integer $id
         * @return  false|array|stdClass
         */
        public function get($id)
        {
            $path = ($this->_directory) .'/' . ($id) . '/';
            return $this->_get($path);
        }

        /**
         * put
         * 
         * @access  public
         * @param   integer $id
         * @param   array $attributes
         * @return  false|array|stdClass
         */
        public function put($id, array $attributes)
        {
            $path = ($this->_directory) .'/' . ($id) . '/';
            return $this->_put($path, array(), $attributes);
        }
    }
