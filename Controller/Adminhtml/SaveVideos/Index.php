<?php

namespace Mageowl\Helper\Controller\Adminhtml\SaveVideos;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    protected $videos;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Mageowl\Helper\Block\Adminhtml\Videos $videos
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->videos = $videos;
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $controller_name = $params['controller_name'];
        $action_name = $params['action_name'];
        $urls = $params['urls'];
        $titles = $params['titles'];
        $key = $params['controller_name'] . '-----' . $params['action_name'];

        $data = $this->videos->save($urls, $titles, $key);

        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData([
            'data' => $data,
            'success' => true
        ]);
    }
}