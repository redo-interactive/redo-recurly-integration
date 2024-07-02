<?php
/**
 * Observer for customer creation
 *
 * @copyright Copyright (c) 2024 Redo
 */
declare(strict_types=1);

namespace Redo\RecurlyIntegration\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Redo\RecurlyIntegration\Model\RecurlyAccount;

class CustomerCreateObserver implements ObserverInterface
{
    /**
     * @param RecurlyAccount $recurlyAccount
     */
    public function __construct(
        private readonly RecurlyAccount $recurlyAccount
    ) {}

    /**
     * Create a Recurly account when a new Magento customer is created
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $customer = $observer->getEvent()->getCustomer();
        $this->recurlyAccount->createAccount($customer);
    }
}
