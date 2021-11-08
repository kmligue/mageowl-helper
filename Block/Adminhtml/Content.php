<?php

namespace Mageowl\Helper\Block\Adminhtml;

class Content extends \Magento\Backend\Block\Template
{
    protected $_template = "Mageowl_Helper::content.phtml";
    protected $request;
    protected $helper;
    protected $authSession;
    protected $videos;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Mageowl\Helper\Helper\Data $helper,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Mageowl\Helper\Block\Adminhtml\Videos $videos,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->request = $request;
        $this->helper = $helper;
        $this->authSession = $authSession;
        $this->videos= $videos;
    }

    public function getControllerName()
    {
        return $this->request->getControllerModule();
    }

    public function getActionName()
    {
        return $this->request->getActionName();
    }

    public function getPath(){
        return $this->request->getFullActionName();
    }

    public function isEnable()
    {
        return $this->helper->isEnable();
    }

    public function getCurrentUserRoleName()
    {
        $user = $this->authSession->getUser();
        
        return $user->getRole()->getData()['role_name'];
    }

    public function getVideos($fbkey)
    {
        return $this->videos->getVideos($fbkey);
    }

    public function save()
    {
        $this->videos->save();
    }
}