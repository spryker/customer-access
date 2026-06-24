<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\CustomerAccess;

interface CustomerAccessConfig
{
    /**
     * @api
     *
     * @var string
     */
    public const CONTENT_TYPE_PRICE = 'price';

    /**
     * @api
     *
     * @var string
     */
    public const CONTENT_TYPE_ORDER_PLACE_SUBMIT = 'order-place-submit';

    /**
     * @api
     *
     * @var string
     */
    public const CONTENT_TYPE_ADD_TO_CART = 'add-to-cart';

    /**
     * @api
     *
     * @var string
     */
    public const CONTENT_TYPE_WISHLIST = 'wishlist';

    /**
     * @api
     *
     * @var string
     */
    public const CONTENT_TYPE_SHOPPING_LIST = 'shopping-list';
}
