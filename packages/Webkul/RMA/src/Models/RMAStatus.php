<?php

namespace Webkul\RMA\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\RMA\Contracts\RMAStatus as RMAStatusContract;

class RMAStatus extends Model implements RMAStatusContract
{
    /**
     * RMA status when the return request is pending
     */
    const PENDING = 'Pending';

    /**
     * RMA status when the package has been received
     */
    const RECEIVED_PACKAGE = 'Received Package';

    /**
     * RMA status when the return request has been declined
     */
    const DECLINED = 'Declined';

    /**
     * RMA status when the item has been canceled
     */
    const ITEM_CANCELED = 'Item Canceled';

    /**
     * RMA status when the package has not been received yet
     */
    const NOT_RECEIVED_PACKAGE_YET = 'Not Receive Package yet';

    /**
     * RMA status when the package has been dispatched
     */
    const DISPATCHED_PACKAGE = 'Dispatched Package';

    /**
     * RMA status when the return request is accepted
     */
    const ACCEPT = 'Accept';
}
