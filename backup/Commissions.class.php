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
         * _paths
         * 
         * @access  protected
         * @var     array
         */
        protected $_paths = array(
            'all' => '/1.6/commissions/'
        );

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
            $path = 'commissions/' . ($id) . '/approved/';
            $response = $this->_put($path);
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
            $path = 'conversions/' . ($conversion_id) . '/commissions/';
            $params = array();
            $response = $this->_post($path, $params, array($data));
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
            $path = 'commissions/' . ($id) . '/approved/';
            $response = $this->_delete($path);
            return $response;
        }
    }
