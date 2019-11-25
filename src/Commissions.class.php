<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'API.class.php';

    /**
     * Commissions
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends API
     * @final
     */
    final class Commissions extends API
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'commissions')
         */
        protected $_directory = 'commissions';

        /**
         * approve
         * 
         * @access  public
         * @param   int $id
         * @return  false|stdClass|array
         */
        public function approve($id)
        {
            $path = 'commissions/' . ($id) . '/approval/';
            return $this->_put($path);
        }

        /**
         * create
         * 
         * @access  public
         * @param   array $data (default: array())
         * @return  false|stdClass|array
         */
        public function create(array $data = array())
        {
            if (isset($data['conversion_id']) === false) {
                throw new \Exception('conversion_id must be specified');
            }
            if (isset($data['sub_amount']) === false) {
                throw new \Exception('sub_amount must be specified');
            }
            $conversion_id = $data['conversion_id'];
            unset($data['conversion_id']);
            $path = 'conversions/' . ($conversion_id) . '/commissions/';
            return $this->_post($path, array(), array($data));
        }

        /**
         * disapprove
         * 
         * @access  public
         * @param   int $id
         * @return  false|stdClass|array
         */
        public function disapprove($id)
        {
            $path = 'commissions/' . ($id) . '/approval/';
            return $this->_delete($path);
        }
    }
