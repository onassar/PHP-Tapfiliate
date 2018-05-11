<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'Api.class.php';

    /**
     * Payouts
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends Api
     * @final
     */
    final class Payouts extends Api
    {
        /**
         * _directory
         * 
         * @var     string (default: 'payouts')
         * @access  protected
         */
        protected $_directory = 'payouts';

        /**
         * paid
         * 
         * @access  public
         * @param   integer $id
         * @return  false|array|stdClass
         */
        public function paid($id)
        {
            $path = ($this->_directory) .'/' . ($id) . '/paid/';
            return $this->_put($path);
        }
    }
