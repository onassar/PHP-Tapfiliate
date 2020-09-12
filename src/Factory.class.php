<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Factory
     * 
     * Operates as a factory for returning Tapfiliate clients.
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @link    https://tapfiliate.com/docs/rest/
     */
    class Factory
    {
        /**
         * _apiKey
         * 
         * @access  protected
         * @var     null|string (default: null)
         */
        protected $_apiKey = null;

        /**
         * _clients
         * 
         * @access  protected
         * @var     array (default: array())
         */
        protected $_clients = array();

        /**
         * __construct
         * 
         * @access  public
         * @param   string $apiKey
         * @return  void
         */
        public function __construct(string $apiKey)
        {
            $this->_apiKey = $apiKey;
        }

        /**
         * affiliates
         * 
         * @access  public
         * @return  Affiliates
         */
        public function affiliates(): Affiliates
        {
            $this->_clients['affiliates'] = $this->_clients['affiliates'] ?? new Affiliates($this);
            $client = $this->_clients['affiliates'];
            return $client;
        }

        /**
         * balances
         * 
         * @access  public
         * @return  Balances
         */
        public function balances(): Balances
        {
            $this->_clients['balances'] = $this->_clients['balances'] ?? new Balances($this);
            $client = $this->_clients['balances'];
            return $client;
        }

        /**
         * commissions
         * 
         * @access  public
         * @return  Commissions
         */
        public function commissions(): Commissions
        {
            $this->_clients['commissions'] = $this->_clients['commissions'] ?? new Commissions($this);
            $client = $this->_clients['commissions'];
            return $client;
        }

        /**
         * conversions
         * 
         * @access  public
         * @return  Conversions
         */
        public function conversions(): Conversions
        {
            $this->_clients['conversions'] = $this->_clients['conversions'] ?? new Conversions($this);
            $client = $this->_clients['conversions'];
            return $client;
        }

        /**
         * getAPIKey
         * 
         * @access  public
         * @return  string
         */
        public function getAPIKey(): string
        {
            $apiKey = $this->_apiKey;
            return $apiKey;
        }

        /**
         * payments
         * 
         * @access  public
         * @return  Payments
         */
        public function payments(): Payments
        {
            $this->_clients['payments'] = $this->_clients['payments'] ?? new Payments($this);
            $client = $this->_clients['payments'];
            return $client;
        }

        /**
         * programs
         * 
         * @access  public
         * @return  Programs
         */
        public function programs(): Programs
        {
            $this->_clients['programs'] = $this->_clients['programs'] ?? new Programs($this);
            $client = $this->_clients['programs'];
            return $client;
        }
    }
