<?php
/**
 * @copyright Copyright (c) 2024 Redo
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

// Register the module with Magento
ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Redo_RecurlyIntegration',
    __DIR__
);
