<?php
namespace KS\Productscheduler\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\Mail\Template\TransportBuilder;
use \Magento\Framework\Translate\Inline\StateInterface;
use Psr\Log\LoggerInterface;

class Sendmail extends \Magento\Framework\App\Action\Action
{
    protected $inlineTranslation;
    protected $transportBuilder;
    protected $_logLoggerInterface;

    public function __construct(
    Context $context,
    StateInterface $inlineTranslation,
    TransportBuilder $transportBuilder,
    LoggerInterface $logLoggerInterface)
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->_logLoggerInterface = $logLoggerInterface;
        parent::__construct($context);
    }


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
                        'area' => 'frontend',
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
            echo 'berhasil';
        } catch(\Exception $e){
            $this->_logLoggerInterface->debug($e->getMessage());
            echo $e->getMessage();
            exit;   
        }
    }
}