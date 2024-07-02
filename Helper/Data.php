<?php
/**
 * Recurly Integration helper
 *
 * @copyright Copyright (c) 2024 Redo
 */
declare(strict_types=1);

namespace Redo\RecurlyIntegration\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    private const XML_PATH_ENABLED = 'recurly_integration/general/enabled';
    private const XML_PATH_API_KEY = 'recurly_integration/general/api_key';

    /**
     * Check if the Recurly integration is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get the Recurly API key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE);
    }
}
