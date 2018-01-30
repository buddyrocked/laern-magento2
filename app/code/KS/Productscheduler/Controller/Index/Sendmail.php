<?php
namespace KS\Productscheduler\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Sendmail extends \Magento\Framework\App\Action\Action
{
    protected $inlineTranslation;
    protected $transportBuilder;
    protected $_logLoggerInterface;
    protected $scopeConfig;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        LoggerInterface $logLoggerInterface,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->_logLoggerInterface = $logLoggerInterface;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }


    public function execute()
    {
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productCollection = $_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection  =  $productCollection->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('start_date', ['lteq'=>date('Y-m-d h:i:s')])
                ->addAttributeToFilter('end_date', ['gteq'=>date('Y-m-d h:i:s')])
                ->load();

        $is_notification = $this->scopeConfig->getValue('productscheduler/email/email_notification', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);   
        if($is_notification == 1 && $collection->count() > 0):  

            $email = $this->scopeConfig->getValue('productscheduler/email/email_recipients', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $sender = $this->scopeConfig->getValue('productscheduler/email/email_sender', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            try
            {
                // Send Mail
                $this->inlineTranslation->suspend();
                $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
                $transport = $this->transportBuilder
                   ->setTemplateIdentifier('productscheduler_email_email_template')
                   ->setTemplateOptions(
                        [
                            'area' => 'adminhtml',
                            'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                        ]
                    )
                   ->setTemplateVars([
                        'message'  => 'This is Product Scheduler.'
                    ])
                   ->setFrom($sender)
                   ->addTo($email)
                   ->getTransport();
                $transport->sendMessage();
                $this->inlineTranslation->resume();

                $this->_logLoggerInterface->addInfo("Function Send Mail is executed.");
                
            } catch(\Exception $e){
                $this->_logLoggerInterface->addInfo($e->getMessage());
            }

        endif;
    }
}