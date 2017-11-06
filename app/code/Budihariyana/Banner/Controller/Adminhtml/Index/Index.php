<?php
namespace Budihariyana\Banner\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
    
    const ADMIN_RESOURCE = 'Index';       
        
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
    }
    
    public function execute()
    {
        $page = $this->resultPageFactory->create();  
        $page->setActiveMenu('Budihariyana_Banner::budihariyana_banner_list_menu');
        $page->getConfig()->getTitle()->prepend(__('Banner Lists'));
        return $page;
    }
}
