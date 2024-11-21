<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   Hts_Security
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Security\Api;

interface LockDownInterface
{
    const HTTP_LOCKDOWN_CODE = 403;
    const HTTP_LOCKDOWN_BODY = '<h1>403 Forbidden</h1>';

    /**
     * Return true if stealth mode is enabled
     * @return bool
     * @deprecated
     */
    public function getStealthMode();

    /**
     * Return an HTTP for lockdown
     * @param \Magento\Framework\Phrase $message
     * @return \Magento\Framework\App\Response\Http
     */
    public function doHttpLockdown(\Magento\Framework\Phrase $message);

    /**
     * Inject lockdown into action
     * @param \Magento\Framework\App\Action\Action $action
     * @param \Magento\Framework\Phrase $message
     * @return \Hts\Security\Api\LockDownInterface
     */
    public function doActionLockdown(\Magento\Framework\App\Action\Action $action, \Magento\Framework\Phrase $message);
}
