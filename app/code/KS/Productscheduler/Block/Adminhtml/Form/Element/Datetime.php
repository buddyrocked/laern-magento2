<?php
namespace KS\Productscheduler\Block\Adminhtml\Form\Element;

use Magento\Framework\Data\Form\Element\Date;

/**
 * Class Datetime
 *
 * Created to allow full date+time picker on eav attribute. See \Magento\Backend\Block\Widget\Form methods
 * _setFieldset and _applyTypeSpecificConfig for why this is necessary.
 */
class Datetime extends Date
{
    /**
     * Override to force date and time formats before rendering html
     *
     * @return string
     * @throws \Exception
     */
    public function getElementHtml()
    {
        $this->setDateFormat($this->localeDate->getDateFormat(\IntlDateFormatter::SHORT));
        $this->setTimeFormat($this->localeDate->getTimeFormat(\IntlDateFormatter::SHORT));
        return parent::getElementHtml();
    }
}
