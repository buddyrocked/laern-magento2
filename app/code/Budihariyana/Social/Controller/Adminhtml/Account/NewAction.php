<?php
namespace Budihariyana\Social\Controller\Adminhtml\Account;

class NewAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Budihariyana_Social::account';       
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();  
    }    
}
