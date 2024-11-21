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

use Magento\Framework\Event\ManagerInterface;
use Hts\Security\Api\AlertInterface;

class Alert implements AlertInterface
{
    /**
     * @var ManagerInterface
     */
    private $eventManager;

    public function __construct(
        ManagerInterface $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

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
    public function event($module, $message, $level = null, $username = null, $action = null, $payload = null)
    {
        if ($level === null) {
            $level = self::LEVEL_INFO;
        }

        $params = [
            AlertInterface::ALERT_PARAM_LEVEL => $level,
            AlertInterface::ALERT_PARAM_MODULE => $module,
            AlertInterface::ALERT_PARAM_MESSAGE => $message,
            AlertInterface::ALERT_PARAM_USERNAME => $username,
            AlertInterface::ALERT_PARAM_PAYLOAD => $payload,
        ];

        $genericEvent = AlertInterface::EVENT_PREFIX . '_event';
        $moduleEvent = AlertInterface::EVENT_PREFIX . '_event_' . strtolower($module);
        $severityEvent = AlertInterface::EVENT_PREFIX . '_level_' . strtolower($level);

        $this->eventManager->dispatch($genericEvent, $params);
        $this->eventManager->dispatch($moduleEvent, $params);
        $this->eventManager->dispatch($severityEvent, $params);

        if ($action) {
            $actionEvent = AlertInterface::EVENT_PREFIX . '_action_' . strtolower($action);
            $this->eventManager->dispatch($actionEvent, $params);
        }

        return true;
    }
}
