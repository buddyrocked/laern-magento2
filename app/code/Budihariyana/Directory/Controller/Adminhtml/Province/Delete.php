<?php
/**
 * Delete
 *
 * @copyright Copyright © 2017 Budihariyana. All rights reserved.
 * @author    budihariyana@gmail.com
 */
namespace Budihariyana\Directory\Controller\Adminhtml\Province;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Budihariyana\Directory\Model\ProvinceFactory;

class Delete extends Action
{
    /** @var provinceFactory $objectFactory */
    protected $objectFactory;

    /**
     * @param Context $context
     * @param ProvinceFactory $objectFactory
     */
    public function __construct(
    Context $context,
    ProvinceFactory $objectFactory
    ) {
        $this->objectFactory = $objectFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Budihariyana_Directory::province');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id', null);

        try {
            $objectInstance = $this->objectFactory->create()->load($id);
            if ($objectInstance->getId()) {
                $objectInstance->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the record.'));
            } else {
                $this->messageManager->addErrorMessage(__('Record does not exist.'));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        
        return $resultRedirect->setPath('*/*');
    }
}
