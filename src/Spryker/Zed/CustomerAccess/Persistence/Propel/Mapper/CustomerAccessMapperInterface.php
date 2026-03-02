<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess;
use Propel\Runtime\Collection\Collection;

interface CustomerAccessMapperInterface
{
    public function mapCustomerAccessEntityToContentTypeAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        ContentTypeAccessTransfer $contentTypeAccessTransfer
    ): ContentTypeAccessTransfer;

    public function mapEntitiesToCustomerAccessTransfer(
        Collection $customerAccessEntities,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer;

    public function mapEntityToCustomerAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer;
}
