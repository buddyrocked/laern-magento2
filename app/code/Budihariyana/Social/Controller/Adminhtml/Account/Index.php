<?php
namespace Budihariyana\Social\Controller\Adminhtml\Account;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Budihariyana_Social::account';  
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }     
}
