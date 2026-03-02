<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Business\CustomerAccess;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;

interface CustomerAccessReaderInterface
{
    public function findCustomerAccessByContentType(string $contentType): ?ContentTypeAccessTransfer;

    public function getUnrestrictedContentTypes(): CustomerAccessTransfer;

    public function getAllContentTypes(): CustomerAccessTransfer;

    public function getRestrictedContentTypes(): CustomerAccessTransfer;
}
