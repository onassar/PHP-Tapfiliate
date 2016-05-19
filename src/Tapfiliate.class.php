<?php

    // Namespace and dependencies
    namespace Tapfiliate;
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
            return new Affiliates($this->_key);
        }

        /**
         * commissions
         * 
         * @access public
         * @return Commissions
         */
        public function commissions()
        {
            return new Commissions($this->_key);
        }

        /**
         * conversions
         * 
         * @access public
         * @return Conversions
         */
        public function conversions()
        {
            return new Conversions($this->_key);
        }

        /**
         * programs
         * 
         * @access public
         * @return Programs
         */
        public function programs()
        {
            return new Programs($this->_key);
        }
    }
