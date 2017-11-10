<?php

/**
 * CountryActions.php
 *
 * @copyright Copyright © 2017 Budihariyana. All rights reserved.
 * @author    budihariyana@gmail.com
 */
namespace Budihariyana\Directory\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Budihariyana\Directory\Model\CountryFactory;

class CountryName extends Column
{
    /**
     * Url path
     */
    const URL_PATH_EDIT = 'budihariyana_directory/country/edit';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    protected $countryFactory;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        CountryFactory $countryFactory,
        array $components = [],
        array $data = []
    ) {
        $this->countryFactory = $countryFactory;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['country_id'])) {
                    $item[$this->getData('name')] =  $this->countryFactory->create()->load($item['country_id'])->getName();
                }
            }
        }

        return $dataSource;
    }
}
