<?php

    // Namespace and dependencies
    namespace Tapfiliate;
    require_once 'API.class.php';

    /**
     * Payouts
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @see     https://github.com/onassar/PHP-Tapfiliate
     * @extends API
     * @final
     */
    final class Payouts extends API
    {
        /**
         * _directory
         * 
         * @access  protected
         * @var     string (default: 'payouts')
         */
        protected $_directory = 'payouts';

        /**
         * paid
         * 
         * @access  public
         * @param   int $id
         * @return  false|array|stdClass
         */
        public function paid($id)
        {
            $path = ($this->_directory) . '/' . ($id) . '/paid/';
            return $this->_put($path);
        }
    }
