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

class CustomerAccessMapper implements CustomerAccessMapperInterface
{
    public function mapCustomerAccessEntityToContentTypeAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        ContentTypeAccessTransfer $contentTypeAccessTransfer
    ): ContentTypeAccessTransfer {
        return $contentTypeAccessTransfer->fromArray($customerAccessEntity->toArray(), true);
    }

    public function mapEntitiesToCustomerAccessTransfer(
        Collection $customerAccessEntities,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer {
        foreach ($customerAccessEntities as $customerAccessEntity) {
            $customerAccessTransfer->addContentTypeAccess(
                $this->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer()),
            );
        }

        return $customerAccessTransfer;
    }

    public function mapEntityToCustomerAccessTransfer(
        SpyUnauthenticatedCustomerAccess $customerAccessEntity,
        CustomerAccessTransfer $customerAccessTransfer
    ): CustomerAccessTransfer {
        return $customerAccessTransfer->addContentTypeAccess(
            (new ContentTypeAccessTransfer())->fromArray($customerAccessEntity->toArray(), true),
        );
    }
}
