<?php
namespace Budihariyana\Banner\Block;
class Main extends \Magento\Framework\View\Element\Template
{
	protected $bannerItemFactory;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Budihariyana\Banner\Model\BannerItemFactory $bannerItemFactory
	){
		$this->bannerItemFactory = $bannerItemFactory;
		parent::__construct($context);
	}

    function _prepareLayout(){
    	$model = $this->bannerItemFactory->create();

    	//save data
    	/*$model->setTitle('Test Banner');
    	$model->setImage('banner.jpg');
    	$model->setImageMobile('banner_mobile.jpg');
    	$model->setUrl('http://www.facebook.com/');
    	$model->setIsActive(true);
    	$model->save();*/

    	//get data
    	/*$model = $model->load(1);
    	var_dump($model->getTitle());
    	var_dump($model->getData('title'));
    	var_dump($model->getData());*/

    	//get collections
    	/*$collection = $model->getCollection();
    	foreach ($collection as $item):
    		var_dump($item->getId());
    		var_dump($item->getData());
    	endforeach;*/

    	//exit;
    }
}
