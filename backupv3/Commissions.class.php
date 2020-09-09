<?php

    // Namespace overhead
    namespace onassar\Tapfiliate;

    /**
     * Commissions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @link    https://github.com/onassar/PHP-Tapfiliate
     * @extends Base
     * @final
     */
    final class Commissions extends Base
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'commissions')
         */
        protected $_directory = 'commissions';

        /**
         * _validateCommissionCreateAttempt
         * 
         * @throws  \Exception
         * @access  protected
         * @param   array $data
         * @return  void
         */
        protected function _validateCommissionCreateAttempt(array $data): void
        {
            if (isset($data['conversion_id']) === false) {
                $msg = 'conversion_id must be specified';
                throw new \Exception($msg);
            }
            if (isset($data['sub_amount']) === false) {
                $msg = 'sub_amount must be specified';
                throw new \Exception($msg);
            }
        }

        /**
         * approve
         * 
         * @access  public
         * @param   string $id
         * @return  false|array
         */
        public function approve(string $id)
        {
            $endpoint = 'commissions/' . ($id) . '/approved/';
            $response = $this->_put($endpoint);
            return $response;
        }

        /**
         * create
         * 
         * @access  public
         * @param   array $data (default: array())
         * @return  false|array
         */
        public function create(array $data = array())
        {
            $this->_validateCommissionCreateAttempt($data);
            $conversion_id = $data['conversion_id'];
            unset($data['conversion_id']);
            $endpoint = 'conversions/' . ($conversion_id) . '/commissions/';
            $params = array();
            $response = $this->_post($endpoint, $params, array($data));
            return $response;
        }

        /**
         * disapprove
         * 
         * @access  public
         * @param   string $id
         * @return  false|array
         */
        public function disapprove(string $id)
        {
            $endpoint = 'commissions/' . ($id) . '/approved/';
            $response = $this->_delete($endpoint);
            return $response;
        }
    }
