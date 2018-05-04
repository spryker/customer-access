<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CustomerAccess;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class CustomerAccessConfig extends AbstractBundleConfig
{
    public const CONTENT_TYPE_PRICE = 'price';

    /**
     * Gets list of content types for which admin will be able to define permissions
     *
     * @return array
     */
    public function getContentTypes(): array
    {
        return [];
    }

    /**
     * Gets default content type access for install (all content types will be created with restricted access)
     *
     * @return bool
     */
    public function getDefaultContentTypeAccess(): bool
    {
        return false;
    }
}
