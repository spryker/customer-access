<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccess;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Spryker\Zed\CustomerAccess\Persistence\CustomerAccessPersistenceFactory getFactory()
 */
class CustomerAccessEntityManager extends AbstractEntityManager implements CustomerAccessEntityManagerInterface
{
    public function createCustomerAccess(string $contentType, bool $isRestricted): CustomerAccessTransfer
    {
        $customerAccessEntity = $this->getFactory()->createCustomerAccessQuery()
            ->filterByContentType($contentType)
            ->findOneOrCreate();

        $customerAccessEntity->setIsRestricted($isRestricted);
        $customerAccessEntity->save();

        return $this->getFactory()
            ->createCustomerAccessMapper()
            ->mapEntityToCustomerAccessTransfer($customerAccessEntity, new CustomerAccessTransfer());
    }

    public function setAllContentTypesToAccessible(): void
    {
        $customerAccessEntities = $this->getFactory()->createCustomerAccessQuery()->find();

        foreach ($customerAccessEntities as $customerAccessEntity) {
            $customerAccessEntity->setIsRestricted(false);
            $customerAccessEntity->save();
        }
    }

    public function setContentTypesToInaccessible(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        $updatedContentTypeAccessCollection = new ArrayObject();
        foreach ($customerAccessTransfer->getContentTypeAccess() as $contentTypeAccess) {
            $customerAccessEntity = $this->getCustomerAccessEntityByContentType($contentTypeAccess);
            $customerAccessEntity = $customerAccessEntity ?: $this->createCustomerAccessEntity($contentTypeAccess);
            $customerAccessEntity->setIsRestricted(true);
            $customerAccessEntity->save();
            $updatedContentTypeAccessCollection->append(
                $this->getFactory()
                    ->createCustomerAccessMapper()
                    ->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer()),
            );
        }
        $customerAccessTransfer->setContentTypeAccess($updatedContentTypeAccessCollection);

        return $customerAccessTransfer;
    }

    protected function getCustomerAccessEntityByContentType(ContentTypeAccessTransfer $contentTypeAccessTransfer): ?SpyUnauthenticatedCustomerAccess
    {
        return $this->getFactory()
            ->createCustomerAccessQuery()
            ->filterByContentType($contentTypeAccessTransfer->getContentType())
            ->findOne();
    }

    protected function createCustomerAccessEntity(ContentTypeAccessTransfer $contentTypeAccessTransfer): SpyUnauthenticatedCustomerAccess
    {
        $spyCustomerAccess = new SpyUnauthenticatedCustomerAccess();
        $spyCustomerAccess->setContentType($contentTypeAccessTransfer->getContentType());

        return $spyCustomerAccess;
    }
}
