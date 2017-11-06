<?php
namespace Budihariyana\Banner\Ui\Component\Listing\Column\Budihariyanabannerbanneritem;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if(isset($item["budihariyana_banner_banneritem_id"]))
                {
                    $id = $item["budihariyana_banner_banneritem_id"];
                }
                $item[$name]["view"] = [
                    "href"=>$this->getContext()->getUrl(
                        "budihariyana_banner_banneritem/banneritem/edit",["budihariyana_banner_banneritem_id"=>$id]),
                    "label"=>__("Edit")
                ];
            }
        }

        return $dataSource;
    }    
    
}
