<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Persistence;

use Generated\Shared\Transfer\CustomerAccessTransfer;

interface CustomerAccessEntityManagerInterface
{
    public function createCustomerAccess(string $contentType, bool $isRestricted): CustomerAccessTransfer;

    public function setAllContentTypesToAccessible(): void;

    public function setContentTypesToInaccessible(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer;
}
