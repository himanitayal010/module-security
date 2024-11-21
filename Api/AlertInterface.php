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

interface AlertInterface
{
    const EVENT_PREFIX = 'hts_security';

    const LEVEL_INFO = 'info';
    const LEVEL_WARNING = 'warn';
    const LEVEL_ERROR = 'error';
    const LEVEL_SECURITY_ALERT = 'security_alert';

    const ACTION_LOG = 'log';
    const ACTION_LOCKDOWN = 'lockdown';

    const ALERT_PARAM_LEVEL = 'level';
    const ALERT_PARAM_MODULE = 'module';
    const ALERT_PARAM_MESSAGE = 'message';
    const ALERT_PARAM_USERNAME = 'username';
    const ALERT_PARAM_PAYLOAD = 'payload';

    /**
     * Trigger a security suite event
     * @param string $module
     * @param string $message
     * @param string $level
     * @param string $username
     * @param string $action
     * @param array|string $payload
     * @return boolean
     */
    public function event($module, $message, $level = null, $username = null, $action = null, $payload = null);
}
