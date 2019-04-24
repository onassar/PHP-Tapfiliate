<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Affiliates.class.php';
    require_once 'Commissions.class.php';
    require_once 'Conversions.class.php';
    require_once 'Payouts.class.php';
    require_once 'Programs.class.php';

    /**
     * Tapfiliate
     * 
     * PHP OAuth wrapper for Tapfiliate, using PECL OAuth library
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     */
    class Tapfiliate
    {
        /**
         * _associative
         * 
         * @access  protected
         * @var     bool (default: true)
         */
        protected $_associative = true;

        /**
         * _debug
         * 
         * @access  protected
         * @var     bool (default: false)
         */
        protected $_debug = false;

        /**
         * _key
         * 
         * @access  protected
         * @var     string
         */
        protected $_key;

        /**
         * _sub
         * 
         * @access  protected
         * @var     array (default: array())
         */
        protected $_sub = array();

        /**
         * __construct
         * 
         * @access  public
         * @param   string $key
         * @param   bool $debug (default: false)
         * @return  void
         */
        public function __construct($key, $debug = false, $associative = true)
        {
            $this->_key = $key;
            $this->_debug = $debug;
            $this->_associative = $associative;
        }

        /**
         * affiliates
         * 
         * @access  public
         * @return  Affiliates
         */
        public function affiliates()
        {
            if (isset($this->_sub['affiliates']) === false) {
                $this->_sub['affiliates'] = new Affiliates($this);
            }
            return $this->_sub['affiliates'];
        }

        /**
         * associative
         * 
         * @access  public
         * @return  bool
         */
        public function associative()
        {
            return $this->_associative;
        }

        /**
         * commissions
         * 
         * @access  public
         * @return  Commissions
         */
        public function commissions()
        {
            if (isset($this->_sub['commissions']) === false) {
                $this->_sub['commissions'] = new Commissions($this);
            }
            return $this->_sub['commissions'];
        }

        /**
         * debug
         * 
         * @access  public
         * @return  bool
         */
        public function debug()
        {
            return $this->_debug;
        }

        /**
         * conversions
         * 
         * @access  public
         * @return  Conversions
         */
        public function conversions()
        {
            if (isset($this->_sub['conversions']) === false) {
                $this->_sub['conversions'] = new Conversions($this);
            }
            return $this->_sub['conversions'];
        }

        /**
         * getKey
         * 
         * @access  public
         * @return  string
         */
        public function getKey()
        {
            return $this->_key;
        }

        /**
         * payouts
         * 
         * @access  public
         * @return  Affiliates
         */
        public function payouts()
        {
            if (isset($this->_sub['payouts']) === false) {
                $this->_sub['payouts'] = new Payouts($this);
            }
            return $this->_sub['payouts'];
        }

        /**
         * programs
         * 
         * @access  public
         * @return  Programs
         */
        public function programs()
        {
            if (isset($this->_sub['programs']) === false) {
                $this->_sub['programs'] = new Programs($this);
            }
            return $this->_sub['programs'];
        }
    }
