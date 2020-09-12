<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;
    use onassar\RemoteRequests;

    /**
     * Base
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends RemoteRequests\Base
     */
    class Base extends RemoteRequests\Base
    {
        /**
         * Traits
         * 
         */
        use RemoteRequests\RateLimits;

        /**
         * _factory
         * 
         * @access  protected
         * @var     null|Factory (default: null)
         */
        protected $_factory = null;

        /**
         * _host
         * 
         * @access  protected
         * @var     string (default: 'api.tapfiliate.com')
         */
        protected $_host = 'api.tapfiliate.com';

        /**
         * _maxAttempts
         * 
         * @access  protected
         * @var     int (default: 1)
         */
        protected $_maxAttempts = 1;

        /**
         * _requestBody
         * 
         * @access  protected
         * @var     null|string (default: null)
         */
        protected $_requestBody = null;

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
            $this->setExpectedResponseContentType('application/json');
        }

        /**
         * _getAuthorizationHeader
         * 
         * @access  protected
         * @return  string
         */
        protected function _getAuthorizationHeader(): string
        {
            $factory = $this->_factory;
            $apiKey = $factory->getAPIKey();
            $header = 'Api-Key: ' . ($apiKey);
            return $header;
        }

        /**
         * _getCURLRequestHeaders
         * 
         * @access  protected
         * @return  array
         */
        protected function _getCURLRequestHeaders(): array
        {
            $headers = parent::_getCURLRequestHeaders();
            $header = $this->_getAuthorizationHeader();
            array_push($headers, $header);
            return $headers;
        }

        /**
         * _getHeaderBasedListPage
         * 
         * @throws  \Exception
         * @access  protected
         * @return  int
         */
        protected function _getHeaderBasedListPage(): int
        {
            $headers = $this->_lastRemoteRequestHeaders;
            foreach ($headers as $header) {
                if (strstr($header, 'rel="next"') === false) {
                    continue;
                }
                $pattern = '/(https?:\/\/.+)>; rel="next/';
                preg_match($pattern, $header, $matches);
                $link = array_pop($matches);
                $pattern = '/page=([0-9]+)/';
                preg_match($pattern, $link, $matches);
                $page = array_pop($matches);
                return $page;
            }
            $msg = 'Could not find next page link';
            throw new \Exception($msg);
        }

        /**
         * _getListPage
         * 
         * @access  protected
         * @return  int
         */
        protected function _getListPage(): int
        {
            $page = 1;
            $more = $this->_moreListResults();
            if ($more === false) {
                return $page;
            }
            $page = $this->_getHeaderBasedListPage();
            return $page;
        }

        /**
         * _getPaginationRequestData
         * 
         * @access  protected
         * @return  array
         */
        protected function _getPaginationRequestData(): array
        {
            $page = $this->_getListPage();
            $paginationRequestData = compact('page');
            return $paginationRequestData;
        }

        /**
         * _getRequestStreamContextOptions
         * 
         * @access  protected
         * @return  array
         */
        protected function _getRequestStreamContextOptions(): array
        {
            $options = parent::_getRequestStreamContextOptions();
            $header = $this->_getAuthorizationHeader();
            $options['http']['header'] = $header;
            $options['http']['header'] .= "\r\nContent-type: application/json";
            $requestBody = $this->_requestBody;
            if ($requestBody === null) {
                return $options;
            }
            $options['http']['content'] = $this->_requestBody;
            return $options;
        }

        /**
         * _moreListResults
         * 
         * @access  protected
         * @return  bool
         */
        protected function _moreListResults()
        {
            $headers = $this->_lastRemoteRequestHeaders;
            foreach ($headers as $header) {
                if (strstr($header, 'rel="next"') !== false) {
                    return true;
                }
            }
            return false;
        }

        /**
         * _setListPaginationRequestData
         * 
         * @access  protected
         * @return  void
         */
        protected function _setListPaginationRequestData(): void
        {
            $paginationRequestData = $this->_getPaginationRequestData();
            $this->mergeRequestData($paginationRequestData);
        }

        /**
         * delete
         * 
         * @note    Returns a 204 header (with no content) if it's successful;
         *          not checking for this, and just assuming it was successful.
         * @access  public
         * @param   string $id
         * @return  bool
         */
        public function delete(string $id): bool
        {
            $host = $this->_host;
            $path = $this->_paths['delete'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('delete');
            $this->setURL($url);
            $response = $this->_getURLResponse();
            return true;
        }

        /**
         * get
         * 
         * @access  public
         * @param   string $id
         * @return  null|array
         */
        public function getTemp(string $id): ?array
        {
            $host = $this->_host;
            $path = $this->_paths['get'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setURL($url);
            $result = $this->_getURLResponse();
            return $result;
        }

        /**
         * list
         * 
         * @access  public
         * @param   array $params (default: array())
         * @param   bool $recursive (default: true)
         * @param   array $recursiveResults (default: array())
         * @return  array
         */
        public function list(array $params = array(), bool $recursive = true, array $recursiveResults = array()): array
        {
            $host = $this->_host;
            $path = $this->_paths['list'];
            $url = 'https://' . ($host) . ($path);
            $this->setRequestData($params);
            $this->setURL($url);
            $this->_setListPaginationRequestData();
            $results = $this->_getURLResponse() ?? array();
            if ($recursive === false) {
                return $results;
            }
            $recursiveResults = array_merge($recursiveResults, $results);
            $page = $this->_getListPage();
            if ($page === 1) {
                return $recursiveResults;
            }
            return $this->list($params, $recursive, $recursiveResults);
        }

        /**
         * patch
         * 
         * @access  public
         * @param   string $id
         * @param   array $properties
         * @return  bool
         */
        public function patch(string $id, array $properties): bool
        {
            $host = $this->_host;
            $path = $this->_paths['patch'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->_requestBody = json_encode($properties);
            $this->setRequestMethod('patch');
            $this->setURL($url);
            $response = $this->_getURLResponse();
            if ($response === null) {
                return false;
            }
            $errors = $response['errors'] ?? null;
            if ($errors === null) {
                return true;
            }
            return false;
        }
    }
