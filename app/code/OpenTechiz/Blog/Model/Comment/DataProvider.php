<?php
namespace OpenTechiz\Blog\Model\Comment;
use OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $commentCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $commentCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }
    /**
     * Prepares Meta
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }
    /**
     * Get data
     */
    public function getData()
    {
//        $cmt = $this->commentFactory->create();
//        $mmm = $cmt->load(2)->getData();
//        echo "222222222";
//        print_r($mmm);die();
        // Get items
//        if (isset($this->loadedData)) {
//            return $this->loadedData;
//        }
        //Chỉ lấy 1 bản ghi tương ứng với id trên url
        $items = $this->collection->getItems();
        //$items = $this->collection->count();
//        echo "22";
//        print_r($this->collection->getData());die();
        //echo "fsd";

        foreach ($items as $comment) {
           //print_r($comment->getData());
            //echo $comment->getId();
            $this->loadedData[$comment->getId()] = $comment->getData();
        }
        //Nếu không save được thì lấy dữ liệu đã set với key là comment
        $data = $this->dataPersistor->get('comment');
        if (!empty($data)) {
            $comment = $this->collection->getNewEmptyItem();
            $comment->setData($data);
            $this->loadedData[$comment->getId()] = $comment->getData();
            $this->dataPersistor->clear('comment');
        }
        return $this->loadedData;
    }
}