<?php
/**
 * Recurly Account model
 *
 * @copyright Copyright (c) 2024 Redo
 */
declare(strict_types=1);

namespace Redo\RecurlyIntegration\Model;

use Magento\Customer\Api\Data\CustomerInterface;
use Psr\Log\LoggerInterface;
use Redo\RecurlyIntegration\Helper\Data as RecurlyHelper;
use Recurly\Client;
use Recurly\Resources\Account;

class RecurlyAccount
{
    /**
     * @param RecurlyHelper $recurlyHelper
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly RecurlyHelper $recurlyHelper,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Create a Recurly account for the given Magento customer
     *
     * @param CustomerInterface $customer
     * @return Account|null
     */
    public function createAccount(CustomerInterface $customer): ?Account
    {
        if (!$this->recurlyHelper->isEnabled()) {
            return null;
        }

        try {
            $client = new Client($this->recurlyHelper->getApiKey());
            $accountCreate = [
                'code' => $customer->getId(),
                'email' => $customer->getEmail(),
                'first_name' => $customer->getFirstname(),
                'last_name' => $customer->getLastname()
            ];

            return $client->createAccount($accountCreate);
        } catch (\Throwable $e) {
            $this->logger->error('Error creating Recurly account: ' . $e->getMessage(), [
                'customer_id' => $customer->getId(),
                'customer_email' => $customer->getEmail()
            ]);
            return null;
        }
    }
}
