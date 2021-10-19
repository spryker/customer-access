<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess\Persistence;

use Generated\Shared\Transfer\ContentTypeAccessTransfer;
use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\CustomerAccess\Persistence\CustomerAccessPersistenceFactory getFactory()
 */
class CustomerAccessRepository extends AbstractRepository implements CustomerAccessRepositoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @param string $contentType
     *
     * @return \Generated\Shared\Transfer\ContentTypeAccessTransfer|null
     */
    public function findCustomerAccessByContentType($contentType): ?ContentTypeAccessTransfer
    {
        $customerAccessEntity = $this->getFactory()
            ->createCustomerAccessQuery()
            ->filterByContentType($contentType)
            ->findOne();

        if (!$customerAccessEntity) {
            return null;
        }

        return $this->getFactory()
            ->createCustomerAccessMapper()
            ->mapCustomerAccessEntityToContentTypeAccessTransfer($customerAccessEntity, new ContentTypeAccessTransfer());
    }

    /**
     * {@inheritDoc}
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getUnrestrictedContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->createCustomerAccessQuery()
            ->filterByIsRestricted(false)
            ->find();

        return $this->getFactory()
            ->createCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }

    /**
     * {@inheritDoc}
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getAllContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->createCustomerAccessQuery()
            ->orderByIdUnauthenticatedCustomerAccess()
            ->find();

        return $this->getFactory()
            ->createCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }

    /**
     * {@inheritDoc}
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function getRestrictedContentTypes(): CustomerAccessTransfer
    {
        $unauthenticatedCustomerAccessEntity = $this->getFactory()
            ->createCustomerAccessQuery()
            ->filterByIsRestricted(true)
            ->find();

        return $this->getFactory()
            ->createCustomerAccessMapper()
            ->mapEntitiesToCustomerAccessTransfer($unauthenticatedCustomerAccessEntity, new CustomerAccessTransfer());
    }
}
