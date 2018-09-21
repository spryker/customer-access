<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Business\Installer;

use Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessInterface;
use Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessReaderInterface;
use Spryker\Zed\CustomerAccess\CustomerAccessConfig;

class CustomerAccessInstaller implements CustomerAccessInstallerInterface
{
    /**
     * @var \Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessInterface
     */
    protected $customerAccess;

    /**
     * @var \Spryker\Zed\CustomerAccess\CustomerAccessConfig
     */
    protected $customerAccessConfig;

    /**
     * @var \Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessReaderInterface
     */
    protected $customerAccessReader;

    /**
     * @param \Spryker\Zed\CustomerAccess\CustomerAccessConfig $customerAccessConfig
     * @param \Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessInterface $customerAccess
     * @param \Spryker\Zed\CustomerAccess\Business\Model\CustomerAccessReaderInterface $customerAccessReader
     */
    public function __construct(CustomerAccessConfig $customerAccessConfig, CustomerAccessInterface $customerAccess, CustomerAccessReaderInterface $customerAccessReader)
    {
        $this->customerAccess = $customerAccess;
        $this->customerAccessReader = $customerAccessReader;
        $this->customerAccessConfig = $customerAccessConfig;
    }

    /**
     * @return void
     */
    public function install(): void
    {
        $defaultContentAccess = $this->customerAccessConfig->getContentTypeAccess();
        foreach ($this->customerAccessConfig->getContentTypes() as $contentType) {
            if ($this->customerAccessReader->findCustomerAccessByContentType($contentType) !== null) {
                continue;
            }

            $this->customerAccess->createCustomerAccess($contentType, $defaultContentAccess);
        }
    }
}
