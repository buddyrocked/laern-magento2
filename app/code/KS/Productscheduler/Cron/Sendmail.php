<?php


namespace KS\Productscheduler\Cron;

class Sendmail
{

    protected $logger;
    protected $inlineTranslation;
    protected $transportBuilder;
    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $newdate = strtotime('+1 day', strtotime(date('Y-m-d h:i:s')));
        $date = date('Y-m-d 00:00:00', $newdate);

        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productCollection = $_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection  =  $productCollection->create()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('start_date', ['eq'=>$date])
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

                $this->logger->addInfo("Function Send Mail is executed.");
                
            } catch(\Exception $e){
                $this->logger->addInfo($e->getMessage());
            }
        else:
            $this->logger->addInfo("There is no products scheduler.");
        endif;
    }
}