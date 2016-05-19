<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Affiliates.class.php';
    require_once 'Commissions.class.php';
    require_once 'Conversions.class.php';
    require_once 'Programs.class.php';

    /**
     * Tapfiliate
     * 
     * PHP OAuth wrapper for Tapfiliate, using PECL OAuth library
     * 
     * @author Oliver Nassar <onassar@gmail.com>
     * @see    https://github.com/onassar/PHP-Tapfiliate
     */
    class Tapfiliate
    {
        /**
         * _key
         * 
         * @var    string
         * @access protected
         */
        protected $_key;

        /**
         * _sub
         * 
         * @var    array
         * @access protected
         */
        protected $_sub = array();

        /**
         * __construct
         * 
         * @access public
         * @param  string $key
         * @return void
         */
        public function __construct($key)
        {
            $this->_key = $key;
        }

        /**
         * affiliates
         * 
         * @access public
         * @return Affiliates
         */
        public function affiliates()
        {
            if (isset($this->_sub['affiliates']) === false) {
                $this->_sub['affiliates'] = new Affiliates($this);
            }
            return $this->_sub['affiliates'];
        }

        /**
         * commissions
         * 
         * @access public
         * @return Commissions
         */
        public function commissions()
        {
            if (isset($this->_sub['commissions']) === false) {
                $this->_sub['commissions'] = new Commissions($this);
            }
            return $this->_sub['commissions'];
        }

        /**
         * conversions
         * 
         * @access public
         * @return Conversions
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
         * @access public
         * @return string
         */
        public function getKey()
        {
            return $this->_key;
        }

        /**
         * programs
         * 
         * @access public
         * @return Programs
         */
        public function programs()
        {
            if (isset($this->_sub['programs']) === false) {
                $this->_sub['programs'] = new Programs($this);
            }
            return $this->_sub['programs'];
        }
    }
