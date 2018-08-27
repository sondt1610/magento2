<?php
namespace OpenTechiz\Blog\Block;

class PostView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    protected $_commentCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \OpenTechiz\Blog\Model\Post $post,
        \OpenTechiz\Blog\Model\PostFactory $postFactory,
        \OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory $commentCollection,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_post = $post;
        $this->_postFactory = $postFactory;
        $this->_commentCollection = $commentCollection;
    }


    public function getPost()
    {
        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('post')) {
            if ($this->getPostId()) {
                echo "dss";die();
                //echo $this->getPostId();die();
                /** @var \OpenTechiz\Blog\Model\Post $page */
                $post = $this->_postFactory->create();
            } else {
                //$post = $this->_postFactory->create();
                $post = $this->_post;
                //var_dump(get_class_vars('OpenTechiz\Blog\Block\PostView'));echo "sdfs";
//                print_r($post->getData());
//                echo "dsgsd";die();
                //print_r($post);die();
            }
            $this->setData('post', $post);
        }
        return $this->getData('post');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = $this->getPost()->getIdentities();
        $comments = $this->_commentCollection
            ->create()
            ->addFieldToFilter('is_active', '1');
        foreach ($comments as $comment) {
            $identities = array_merge($identities,
                [\OpenTechiz\Blog\Model\Comment::CACHE_COMMENT_POST_TAG."_".$comment->getID()]);
        }
        return ($identities);
    }

}
