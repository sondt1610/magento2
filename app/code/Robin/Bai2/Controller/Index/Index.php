<?php
 
namespace Robin\Bai2\Controller\Index;
 
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_registry;
    protected $bannerFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                                \Magento\Framework\Registry $registry, \Robin\Bai2\Model\BannerFactory $bannerFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context);
    }
 

    public function execute()
    {

        /**
         * Insert random data
         */
//        $extension = ['.png', '.jpg', '.gif'];
//        $url = ['https://www.google.com.vn/', 'http://www.w3schools.com/', 'https://techmaster.vn/'];
//
//        for ($i = 1; $i <= 100; $i++) {
//            // Create new instance before insert
//            $banner = $this->_objectManager->create('Robin\Bai2\Model\Banner');
//
//            // Insert data
//            $banner->addData([
//                'link' => $url[rand(0, 2)],
//                'image' => 'image' . $i . $extension[rand(0, 2)],
//                'sort_order' => $i,
//                'status' => rand(0, 1)
//            ])->save();
//        }

        /**
         * Select, update, delete
         */
        // Select record with id = 1
//        $banner = $this->_objectManager->create('Robin\Bai2\Model\Banner');
//        $data = $banner->load(1);
//        print_r(json_encode($data->getData()));
//
//        // Update selected record
//        $data->setImage('logo.png')->setLink('google.com')->save();
//
//        // Delete selected record
//        $data->delete();

        /**
         * Create banner instance; Get banner with id = 1
         */
//        $banner = $this->bannerFactory->create();
//        $data = $banner->load(1)->getData();
//        print_r(json_encode($data));

        /**
         * Using collection
         */
        $banner = $this->bannerFactory->create();
//        khoi tao collection
        $collection = $banner->getCollection();

        /**
         * Select * from banner
         */
        //$data = $collection;
//        $data = $collection->addFieldToSelect('id')
//        ->addFieldToFilter('id',['gt'=>50]);

        /**
         * Select id from banner where id > 50 and image like '%.png'
         */
        //$data = $collection;
//        $data = $collection->addFieldToSelect('id')
//            ->addFieldToFilter('id',['gt'=>50])
//            ->addFieldToFilter('image',['like'=>'%.png']);\
//        //Lay cau truy van query
//        echo $data->getSelect();

        /**
         * Select id from banner where id > 50 and (image like '%.png' or image like '%.jpg'
         */
        //$data = $collection;
//        $data = $collection->addFieldToSelect('id')
//            ->addFieldToFilter('id',['gt'=>50])
//            ->addFieldToFilter('image',
//                [
//                    ['like'=>'%.png'],
//                    ['like'=>'%.jpg']
//                ]);
//        //Lay cau truy van query
//        echo $data->getSelect();

        echo "<br/>Done.";
        exit;

        $this->_registry->register('custom_va', 'dsgsd');
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}