<?php
namespace Budihariyana\Directory\Model\Province;

use Budihariyana\Directory\Model\ResourceModel\Country\Collection;

class CountryList implements \Magento\Framework\Option\ArrayInterface {

	/**
     * @var array
     */
    protected $options;

    protected $countryCollection;
    /**
     * 
     */
    public function __construct(Collection $countryCollection)
    {
        $this->countryCollection = $countryCollection;
    }

    /**
     * @param bool $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = false)
    {
        if (!$this->options) {
            $this->options = $this->getOptionArray();
        }

        $options = $this->options;
        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }

    public function getOptionArray(){

		$collection = $this->countryCollection;
		$data = [];
		foreach ($collection as $key => $value) {
			$data[$key] = ['value' => $value->getId(), 'label' => $value->getName()];
		}

		return $data;
	}
}