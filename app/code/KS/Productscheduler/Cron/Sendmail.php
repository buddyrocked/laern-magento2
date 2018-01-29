<?php


namespace KS\Productscheduler\Cron;

class Sendmail
{

    protected $logger;
    protected $inlineTranslation;
    protected $transportBuilder;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    )
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $logger;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
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
                    'message'  => 'Hellooooooooo..!!!',
                ])
               ->setFrom('general')
               ->addTo('bhariyana@kemana.com')
               ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            $this->logger->addInfo("Cronjob Send Mail is executed.");
        } catch(\Exception $e){
            $this->logger->addInfo($e->getMessage());
        }
        
    }
}
