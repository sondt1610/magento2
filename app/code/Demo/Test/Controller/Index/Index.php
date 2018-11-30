<?php
 
namespace Demo\Test\Controller\Index;
 
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_registry;
    protected $bannerFactory;
    protected $testFactory;
    protected $_productRepository;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                                \Magento\Framework\Registry $registry, \Demo\Test\Model\BannerFactory $bannerFactory,
                                \Demo\Test\Model\TestFactory $testFactory, \Magento\Catalog\Model\ProductRepository $productRepository)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        $this->bannerFactory = $bannerFactory;
        $this->testFactory = $testFactory;
        $this->_productRepository = $productRepository;
        parent::__construct($context);
    }
 

    public function execute()
    {
        $product = $this->_productRepository->getById("1");
        $abc  = $product->getExtensionAttributes()->getDrupalProductKeywords();
        var_dump($abc);
        //var_dump($product);
        // Create banner instance
//        $banner = $this->bannerFactory->create();
//        $collection = $banner->getCollection();
//        $collection->getSelect()
//            ->joinLeft(
//                ['test'=>'cowell_test'],
//                "cowell_banner.id = test.banner_id"
//            );
//
//        echo $collection->getSelect();die;

        //$test = $this->testFactory->create();
        //$collection = $banner->getCollection();
       //$data = $collection->getData();
        //$data = $collection->addFieldToSelect('id')
            //->addFieldToFilter('id',['gt'=>1])
            //->getData();
//        echo $data;
        // Get banner with id = 1
//        $data = $banner->load(4)->getData();
        //$view = $test->load(4)->getData();
        //print_r(json_encode($view));
        //print_r(json_encode($data));die();

//        print_r($collection->getData(),true);
            //echo "Donedgds";

//        echo "<pre>";
//            var_dump($collection->getData());
//        echo "</pre>";

//        $attribute_value = $this->_productloader->create()->load('1');
//        print_r($attribute_value);
        $this->_registry->register('custom_va', 'dsgsd');
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}