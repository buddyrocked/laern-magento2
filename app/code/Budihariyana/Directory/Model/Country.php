<?php

/**
 * Country.php
 *
 * @copyright Copyright © 2017 Budihariyana. All rights reserved.
 * @author    budihariyana@gmail.com
 */

namespace Budihariyana\Directory\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Country extends AbstractModel implements IdentityInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'budihariyana_directory_country';

    /**
     * @var string
     */
    protected $_cacheTag = 'budihariyana_directory_country';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'budihariyana_directory_country';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Budihariyana\Directory\Model\ResourceModel\Country');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->getResource()->save($this);
        }
        return $this;
    }
}
