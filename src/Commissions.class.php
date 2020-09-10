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
            'approve' => '/1.6/commissions/:id/approved/',
            'create' => '/1.6/conversions/:id/commissions/',
            'disapprove' => '/1.6/commissions/:id/approved/',
            'find' => '/1.6/commissions/',
            'get' => '/1.6/commissions/:id/',
            'put' => '/1.6/commissions/:id/'
        );

        /**
         * _validateCommissionCreateProperties
         * 
         * @throws  \Exception
         * @access  protected
         * @param   array $properties
         * @return  void
         */
        protected function _validateCommissionCreateProperties(array $properties): void
        {
            if (isset($properties['conversion_id']) === false) {
                $msg = 'conversion_id must be specified';
                throw new \Exception($msg);
            }
            if (isset($properties['sub_amount']) === false) {
                $msg = 'sub_amount must be specified';
                throw new \Exception($msg);
            }
        }

        /**
         * approve
         * 
         * @access  public
         * @param   string $id
         * @return  bool
         */
        public function approve(string $id): bool
        {
            $host = $this->_host;
            $path = $this->_paths['approve'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('put');
            $this->setURL($url);
            $response = $this->_getURLResponse() ?? false;
            if ($response === false) {
                return false;
            }
            return true;
        }

        /**
         * create
         * 
         * @access  public
         * @param   array $properties
         * @return  null|array
         */
        public function create(array $properties): ?array
        {
            $this->_validateCommissionCreateProperties($properties);
            $conversionId = $properties['conversion_id'];
            unset($properties['conversion_id']);
            $host = $this->_host;
            $path = $this->_paths['create'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('post');
            $this->setURL($url);
el(pr($properties, true));
prx($properties);
            $response = $this->_getURLResponse() ?? null;
            return $response;
        }

        /**
         * disapprove
         * 
         * @access  public
         * @param   string $id
         * @return  bool
         */
        public function disapprove(string $id): bool
        {
            $host = $this->_host;
            $path = $this->_paths['disapprove'];
            $path = str_replace(':id', $id, $path);
            $url = 'https://' . ($host) . ($path);
            $this->setRequestMethod('delete');
            $this->setURL($url);
            $response = $this->_getURLResponse() ?? false;
            if ($response === false) {
                return false;
            }
            return true;
        }
    }
