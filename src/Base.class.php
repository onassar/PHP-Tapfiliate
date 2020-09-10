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
            $key = $factory->getKey();
            $header = 'Api-Key: ' . ($key);
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
         * _getFindPage
         * 
         * @access  protected
         * @return  int
         */
        protected function _getFindPage(): int
        {
            $page = 1;
            $more = $this->_moreFindResults();
            if ($more === false) {
                return $page;
            }
            $page = $this->_getHeaderBasedFindPage();
            return $page;
        }


        /**
         * _getHeaderBasedFindPage
         * 
         * @throws  \Exception
         * @access  protected
         * @return  int
         */
        protected function _getHeaderBasedFindPage(): int
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
         * _getPaginationRequestData
         * 
         * @access  protected
         * @return  array
         */
        protected function _getPaginationRequestData(): array
        {
            $page = $this->_getFindPage();
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
            return $options;
        }

        /**
         * _moreFindResults
         * 
         * @access  protected
         * @return  bool
         */
        protected function _moreFindResults()
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
         * _setFindPaginationRequestData
         * 
         * @access  protected
         * @return  void
         */
        protected function _setFindPaginationRequestData(): void
        {
            $paginationRequestData = $this->_getPaginationRequestData();
            $this->mergeRequestData($paginationRequestData);
        }

        /**
         * delete
         * 
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
            $response = $this->_getURLResponse() ?? false;
            if ($response === false) {
                return false;
            }
            return true;
        }

        /**
         * find
         * 
         * @access  public
         * @param   array $params (default: array())
         * @param   bool $recursive (default: true)
         * @param   array $recursiveResults (default: array())
         * @return  array
         */
        public function find(array $params = array(), bool $recursive = true, array $recursiveResults = array()): array
        {
            $host = $this->_host;
            $path = $this->_paths['find'];
            $url = 'https://' . ($host) . ($path);
            $this->setRequestData($params);
            $this->setURL($url);
            $this->_setFindPaginationRequestData();
            $results = $this->_getURLResponse() ?? array();
            if ($recursive === false) {
                return $results;
            }
            $recursiveResults = array_merge($recursiveResults, $results);
            $page = $this->_getFindPage();
// if ($page === 4) {
//     prx($recursiveResults);
// }
            if ($page === 1) {
                return $recursiveResults;
            }
            return $this->find($params, $recursive, $recursiveResults);
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
         * put
         * 
         * @access  public
         * @param   string $id
         * @param   array $properties
         * @return  bool
         */
        public function put(string $id, array $properties): bool
        {
            $host = $this->_host;
            $path = $this->_paths['put'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('put');
            $this->setURL($url);
prx($properties);
            $response = $this->_getURLResponse() ?? false;
            if ($response === false) {
                return false;
            }
            return true;
        }
    }
