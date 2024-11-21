<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   Hts_Security
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Security\Model;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\ObjectManagerInterface;
use Hts\Security\Api\LockDownInterface;
use Magento\Framework\App\Response\Http;
use Magento\Framework\UrlInterface;
use Magento\Framework\Phrase;

class LockDown implements LockDownInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Http
     */
    private $http;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var ActionFlag
     */
    private $actionFlag;

    /**
     * LockDown constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param ObjectManagerInterface $objectManager
     * @param ActionFlag $actionFlag
     * @param UrlInterface $url
     * @param Http $http
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ObjectManagerInterface $objectManager,
        ActionFlag $actionFlag,
        UrlInterface $url,
        Http $http
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->http = $http;
        $this->actionFlag = $actionFlag;
        $this->url = $url;
        $this->objectManager = $objectManager;
    }

    /**
     * @inheritdoc
     * @deprecated
     */
    public function getStealthMode()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function doHttpLockdown(Phrase $message)
    {
        $this->http->setStatusCode(LockDownInterface::HTTP_LOCKDOWN_CODE);
        $this->http->setBody(LockDownInterface::HTTP_LOCKDOWN_BODY);

        return $this->http;
    }

    /**
     * @inheritdoc
     */
    public function doActionLockdown(Action $action, Phrase $message)
    {
        $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);

        $action->getResponse()->setHttpResponseCode(LockDownInterface::HTTP_LOCKDOWN_CODE);
        $action->getResponse()->setBody(LockDownInterface::HTTP_LOCKDOWN_BODY);
    }
}
