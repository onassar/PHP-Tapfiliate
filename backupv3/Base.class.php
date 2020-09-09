<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Base
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @link    https://pecl.php.net/package/oauth
     * @link    http://php.net/manual/en/book.oauth.php
     */
    class Base
    {
        /**
         * _base
         * 
         * @access  protected
         * @var     string (default: 'https://api.tapfiliate.com/1.6/')
         */
        protected $_base = 'https://api.tapfiliate.com/1.6/';

        /**
         * _directory
         * 
         * @access  protected
         * @var     null|string (default: null)
         */
        protected $_directory = null;

        /**
         * _factory
         * 
         * @access  protected
         * @var     null|Factory (default: null)
         */
        protected $_factory = null;

        /**
         * __construct
         * 
         * @access  public
         * @param   Factory $factory
         * @return  void
         */
        public function __construct(Factory $factory)
        {
            $this->_factory = $factory;
        }

        /**
         * _isMore
         * 
         * @access  protected
         * @param   array $headers
         * @return  bool
         */
        protected function _isMore(array $headers)
        {
            foreach ($headers as $header) {
                if (strstr($header, 'rel="next"') !== false) {
                    return true;
                }
            }
            return false;
        }

        /**
         * _getNextPageLink
         * 
         * @throws  \Exception
         * @access  protected
         * @param   array $headers
         * @return  string
         */
        protected function _getNextPageLink(array $headers)
        {
            foreach ($headers as $header) {
                if (strstr($header, 'rel="next"') !== false) {
                    $pattern = '/(https?:\/\/.+)>; rel="next/';
                    preg_match($pattern, $header, $matches);
                    $link = array_pop($matches);
                    return $link;
                }
            }
            $msg = 'Could not find next page link';
            throw new \Exception($msg);
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
         * @param   bool $recursive (default: false)
         * @return  array
         */
        protected function _attempt($url, $context, $recursive = false)
        {
            set_error_handler(function() {});
            $response = file_get_contents($url, false, $context);
el('hi');
el($url);
el(pr($context, true));
el(pr($response, true));
            restore_error_handler();
            if ($response === false) {
                $response = array();
                if (isset($http_response_header) === true) {
                    $response = $http_response_header;
                }
                return array(
                    'success' => false,
                    'response' => $response
                );
            }
            if ($recursive === true) {
                if ($this->_isMore($http_response_header) === true) {
                    $link = $this->_getNextPageLink($http_response_header);
                    $recursiveResponse = $this->_attempt($link, $context, $recursive);
                    if ($recursiveResponse !== false) {
                        $decodedRecursiveResponse = json_decode(
                            $recursiveResponse['content'],
                            true
                        );
                        $decodedResponse = json_decode($response, true);
                        $mergedResponse = array_merge(
                            $decodedResponse,
                            $decodedRecursiveResponse
                        );
                        $response = json_encode($mergedResponse);
                    }
                }
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
         * @param   string $endpoint
         * @return  false|array
         */
        protected function _delete(string $endpoint)
        {
            $method = 'delete';
            $response = $this->_request($method, $endpoint);
            return $response;
        }

        /**
         * _get
         * 
         * @access  protected
         * @param   string $endpoint
         * @param   array $params (default: array())
         * @return  false|array
         */
        protected function _get(string $endpoint, array $params = array())
        {
            $method = 'get';
            $recursive = false;
            if (isset($params['recursive']) === true) {
                $recursive = $params['recursive'] === true;
                unset($params['recursive']);
            }
            if (empty($params) === false) {
                $queryString = http_build_query($params);
                $endpoint = ($endpoint) . '?' . ($queryString);
            }
            $data = array();
            $response = $this->_request($method, $endpoint, $data, $recursive);
el(pr($response, true));
            return $response;
        }

        /**
         * _post
         * 
         * @access  protected
         * @param   string $endpoint
         * @param   array $params (default: array())
         * @param   array $data (default: array())
         * @return  false|array
         */
        protected function _post(string $endpoint, array $params = array(), array $data = array())
        {
            $method = 'post';
            if (empty($params) === false) {
                $queryString = http_build_query($params);
                $endpoint = ($endpoint) . '?' . ($queryString);
            }
            $response = $this->_request($method, $endpoint, $data);
            return $response;
        }

        /**
         * _put
         * 
         * @access  protected
         * @param   string $endpoint
         * @param   array $params (default: array())
         * @param   array $data (default: array())
         * @return  false|array
         */
        protected function _put(string $endpoint, array $params = array(), array $data = array())
        {
            $method = 'put';
            if (empty($params) === false) {
                $queryString = http_build_query($params);
                $endpoint = ($endpoint) . '?' . ($queryString);
            }
            $response = $this->_request($method, $endpoint, $data);
            return $response;
        }

        /**
         * _request
         * 
         * @access  protected
         * @param   string $method
         * @param   string $endpoint
         * @param   array $data (default: array())
         * @param   bool $recursive (default: false)
         * @return  false|array
         */
        protected function _request(string $method, string $endpoint, array $data = array(), bool $recursive = false)
        {
            $key = $this->_factory->getKey();
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
            $url = ($this->_base) . ($endpoint);
            $context = stream_context_create($options);
            $response = $this->_attempt($url, $context, $recursive);
el($url);
el(pr($response, true));
            if ($response['success'] === false) {
                if ($this->_factory->debug() === true) {
                    echo '<pre>';
                    print_r($response);
                    echo '</pre>';
                    exit(0);
                }
                return false;
            }
            return json_decode($response['content'], true);
        }

        /**
         * all
         * 
         * @access  public
         * @param   array $params (default: array())
         * @return  false|array
         */
        public function all(array $params = array())
        {
            $directory = $this->_directory;
            $endpoint = ($directory) . '/';
el($endpoint);
            $response = $this->_get($endpoint, $params);
            return $response;
        }

        /**
         * delete
         * 
         * @access  public
         * @param   string $id
         * @return  false|array
         */
        public function delete(string $id)
        {
            $directory = $this->_directory;
            $endpoint = ($directory) . '/' . ($id) . '/';
            $response = $this->_delete($endpoint);
            return $response;
        }

        /**
         * get
         * 
         * @access  public
         * @param   string $id
         * @return  false|array
         */
        public function get(string $id)
        {
            $directory = $this->_directory;
            $endpoint = ($directory) . '/' . ($id) . '/';
            $response = $this->_get($endpoint);
            return $response;
        }

        /**
         * put
         * 
         * @access  public
         * @param   string $id
         * @param   array $attributes
         * @return  false|array
         */
        public function put(string $id, array $attributes)
        {
            $directory = $this->_directory;
            $endpoint = ($directory) . '/' . ($id) . '/';
            $params = array();
            $response = $this->_put($endpoint, $params, $attributes);
            return $response;
        }
    }
