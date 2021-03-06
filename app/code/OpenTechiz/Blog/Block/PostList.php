<?php
namespace OpenTechiz\Blog\Block;

use OpenTechiz\Blog\Api\Data\PostInterface;
use OpenTechiz\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Magento\Framework\DataObject\IdentityInterface;
class PostList extends \Magento\Framework\View\Element\Template implements IdentityInterface
{

    protected $_postCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    public function getPosts()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('posts')) {
            $posts = $this->_postCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->setOrder(
                    PostInterface::CREATION_TIME,
                    'DESC'
                );
            $this->setData('posts', $posts);
        }
        return $this->getData('posts');
    }
    public function getIdentities()
    {
        $identities = [];
        $posts = $this->getPosts();
        foreach ($posts as $post) {
            $identities = array_merge($identities, $post->getIdentities());
        }
        return $identities;
    }
}
