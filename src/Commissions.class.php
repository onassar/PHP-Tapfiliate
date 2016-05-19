<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Api.class.php';

    /**
     * Commissions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends Api
     * @final
     */
    final class Commissions extends Api
    {
        /**
         * _directory
         * 
         * @var    string (default: 'commissions')
         * @access protected
         */
        protected $_directory = 'commissions';

        /**
         * all
         * 
         * @see    http://docs.tapfiliate.apiary.io/#reference/commissions
         * @access public
         * @param  array $params = array()
         * @return array
         */
        public function all(array $params = array())
        {
            throw new \Exception('Invalid API request');
        }

        /**
         * create
         * 
         * @access public
         * @param  array $data
         * @return array
         */
        public function create(array $data = array())
        {
            if (isset($data['conversionId']) === false) {
                throw new \Exception('conversionId must be specified');
            }
            if (isset($data['sub_amount']) === false) {
                throw new \Exception('sub_amount must be specified');
            }
            $conversionId = $data['conversionId'];
            unset($data['conversionId']);
            $path = 'conversions/' . ($conversionId) . '/commissions/';
            return $this->_post($path, array(), $data);
        }
    }
