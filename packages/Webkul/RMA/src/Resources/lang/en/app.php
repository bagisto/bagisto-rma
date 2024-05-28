<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Allow new rma request for pending order',
                        'default-allow-days'                  => 'Default allowed days',
                        'enable'                              => 'Enable rma',
                        'info'                                => 'RMA is part of the process of returning a product to a business to receive a refund, replacement, or repair.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'RMA functionality allows handling situations when a customer returns items for repair and maintenance, or for refund or replacement.',
                            'title' => 'RMA',
                        ],
                    ],
                ],
            ],
        ],

        'components' => [
            'layouts' => [
                'sidebar' => [
                    'rma' => 'RMA',
                ],
            ],
        ],

        'sales' => [
            'rma' => [
                'index' => [
                    'rma-title'        => 'All RMA',
                    'reason-title'     => 'Reasons',
                    'create-rma-title' => 'Create RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'All RMA',

                        'datagrid' => [
                            'id'            => 'RMA Id',
                            'order-ref'     => 'Order Ref',
                            'customer-name' => 'Customer Name',
                            'rma-status'    => 'RMA Status',
                            'order-status'  => 'Order Status',
                            'create'        => 'Created At',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' Order ID :',
                        'request-on'             => 'Request On :',
                        'customer'               => 'Customer :',
                        'resolution-type'        => 'Resolution Type :',
                        'additional-information' => 'Additional Information :',
                        'images'                 => 'Image :',
                        'order-details'          => 'Change Item Requested for RMA',
                        'status'                 => 'Status',
                        'rma-status'             => 'RMA Status :',
                        'order-status'           => 'Order Status :',
                        'change-status'          => 'Change Status',
                        'conversations'          => 'Conversations',
                        'save-btn'               => 'Save',
                        'send-message'           => 'Send Message',
                        'enter-message'          => 'Enter Message',
                        'send-message-btn'       => 'Send Message',
                        'send-message-success'   => 'Message sent successfully.',
                        'update-success'         => 'Rma status updated successfully.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Reasons',
                        'create-btn' => 'Create RMA Reason',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Reason',
                            'status'              => 'Status',
                            'created-at'          => 'Created At',
                            'enabled'             => 'Active',
                            'disabled'            => 'InActive',
                            'delete-success'      => 'Reason deleted successfully.',
                            'mass-delete-success' => 'Selected data successfully deleted',
                            'reason-error'        => 'Reason is used in RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Add New Reason',
                        'save-btn'       => 'Save Reason',
                        'reason'         => 'Reason',
                        'status'         => 'Status',
                        'create-success' => 'Reason created successfully.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edit Reason',
                        'save-btn'            => 'Save Reason',
                        'reason'              => 'Reason',
                        'status'              => 'Status',
                        'mass-update-success' => 'Selected reasons updated successfully.',
                    ],
                ],

                'create-rma' => [
                    'create-title'             => 'Create RMA',
                    'order-id'                 => 'Order Id',
                    'new-rma'                  => 'New RMA',
                    'email'                    => 'Email',
                    'validate'                 => 'Validate',
                    'rma-already-exist'        => 'RMA already exists',
                    'mismatch'                 => 'Order Id and email mismatch',
                    'invalid-order-id'         => 'Invalid order Id',
                    'quantity'                 => 'Quantity',
                    'search'                   => '--Select--',
                    'image'                    => 'Image',
                    'reason'                   => 'Reason',
                    'rma-not-available-quotes' => 'Item not available for RMA',
                    'save-btn'                 => 'Save',
                    'create-success'           => 'Rma created successfully.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA Return',
            'offer'        => 'Get UPTO 40% OFF on your 1st order',
            'shop-now'     => 'SHOP NOW',

            'create' => [
                'heading'                  => 'New RMA Request',
                'create-btn'               => 'Save',
                'orders'                   => 'Orders',
                'resolution'               => 'Select Resolution',
                'item-ordered'             => 'Item Ordered',
                'images'                   => 'Images',
                'information'              => 'Additional Information',
                'order-status'             => 'Order Status',
                'product'                  => 'Product',
                'sku'                      => 'Sku',
                'price'                    => 'Price',
                'search-order'             => 'Search Order',
                'enter-order-id'           => 'Enter Order Id',
                'not-allowed'              => 'RMA is not allowed for pending order',
                'image'                    => 'Image',
                'quantity'                 => 'Quantity',
                'reason'                   => 'Reason',
                'rma-not-available-quotes' => 'Item not available for RMA',
                'product-name'             => 'Product Name',
                'reopen-request'           => 'Reopen Request',
                'save'                     => 'Save',
                'cancel'                   => 'Cancel',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMA Status :',
                'order-status' => 'Order Status :',
                'close-rma'    => 'Close RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'New RMA Request',
                'create-btn'               => 'Save',
                'orders'                   => 'Orders',
                'resolution'               => 'Select Resolution',
                'item-ordered'             => 'Item Ordered',
                'images'                   => 'Images',
                'information'              => 'Additional Information',
                'order-status'             => 'Order Status',
                'product'                  => 'Product',
                'sku'                      => 'Sku',
                'price'                    => 'Price',
                'search-order'             => 'Search Order',
                'enter-order-id'           => 'Enter Order Id',
                'not-allowed'              => 'RMA is not allowed for pending order',
                'image'                    => 'Image',
                'quantity'                 => 'Quantity',
                'reason'                   => 'Reason',
                'rma-not-available-quotes' => 'Item not available for RMA',
                'product-name'             => 'Product Name',
                'reopen-request'           => 'Reopen Request',
                'save'                     => 'Save',
                'cancel'                   => 'Cancel',
                'reopen-request'           => 'Reopen Request',
            ],

            'index' => [
                'create'  => 'Request new RMA',
                'heading' => 'Customer RMA Panel',
                'view'    => 'View',
                'edit'    => 'Edit',
                'delete'  => 'Delete',
                'update'  => 'Update',
                'guest'   => 'Guest RMA Panel',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Request new RMA',
            'heading' => 'Customer RMA Panel',
            'view'    => 'View',
            'edit'    => 'Edit',
            'delete'  => 'Delete',
            'update'  => 'Update',
            'guest'   => 'Guest RMA Panel',
        ],

        'validation' => [
            'orders'        => 'Orders',
            'resolution'    => 'Resolution',
            'information'   => 'Additional Information',
            'order-status'  => 'Order Status',
            'select-orders' => 'Select Order',
            'order-id'      => 'Order Selection',
            'close-rma'     => 'Confirm',
        ],

        'conversation-texts' => [
            'by'       => 'By',
            'seller'   => 'Seller',
            'customer' => 'Customer',
            'on'       => 'On',
        ],

        'default-option' => [
            'please-select-value' => 'Please Select Value',
            'select-quantity'     => 'Select Quantity',
            'select-reason'       => 'Select Reason',
            'others'              => 'Others',
            'select-order-status' => 'Select Order Status',
            'select-resolution'   => 'Select Resolution',
            'select-seller'       => 'Select Seller',
            'select-order'        => 'Select Order',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Guest',
            'heading'                 => 'RMA Details',
            'status'                  => 'Status',
            'order-id'                => ' Order ID :',
            'refund-details'          => 'Refund Details',
            'resolution-type'         => 'Resolution Type :',
            'additional-information'  => 'Additional Information :',
            'change-rma-status'       => 'Change RMA Status',
            'save-btn'                => 'Save',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Send',
            'items-requested-for-rma' => 'Item(s) Requested for RMA',
            'refund-offline-btn'      => 'Refund Offline',
            'send-message'            => 'Send Message',
            'conversations'           => 'Conversations',
            'cancel-order'            => 'Cancel Order',
            'status-details'          => 'Status Details',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Please agree to mark it as solved.',
            'term'                    => 'Agree mark field is required',
            'close-rma'               => 'Close RMA :',
            'images'                  => 'Images:',
            'items-request'           => 'Item(s) Requested for RMA',
            'refundable-amount'       => 'Refundable Amount',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Resolution Type :',
            'guest'                  => 'You',
            'status'                 => 'Status',
            'order-id'               => ' Order ID :',
            'additional-information' => 'Additional Information :',
            'save-btn'               => 'Save',
            'send-message-btn'       => 'Send',
            'refund-offline-btn'     => 'Refund Offline',
            'send-message'           => 'Send Message',
            'conversations'          => 'Conversations',
            'status-details'         => 'Status Details',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Please agree to mark it as solved.',
            'term'                   => 'Agree mark field is required',
            'close-rma'              => 'Close RMA',
            'images'                 => 'Images',
            'items-request'          => 'Item(s) Requested for RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMA Status :',
            'order-status' => 'Order Status :',
            'full-amount'  => 'Full Amount',
            'request-on'   => 'Request On :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Close RMA',
            'rma-status'              => 'RMA Status :',
            'admin-status'            => 'Admin Status:',
            'order-status'            => 'Order Status :',
            'consignment-no'          => 'Consignment Number:',
            'refundable-amount'       => 'Refundable Amount:',
            'full-amount'             => 'Full Amount',
            'partial-amount'          => 'Partial Amount',
            'total-refundable-amount' => 'Total Refundable Amount:',
            'enter-message'           => 'Enter Message',
            'request-on'              => 'Request On :',
            'seller'                  => 'Seller',
            'order-details'           => 'Order Details',
        ],

        'table-heading' => [
            'product-name' => 'Product Name',
            'sku'          => 'SKU',
            'price'        => 'Price',
            'qty'          => 'Qty',
            'reason'       => 'Reason',
        ],

        'guest-users' => [
            'heading'     => 'Guest Login Panel',
            'order-id'    => 'Order Id',
            'email'       => 'Email',
            'button-text' => 'Sign In',
            'title'       => 'Guest Login',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA Request',
            'hello'                  => 'Dear :name',
            'greeting'               => 'You requested new RMA for order :order_id.',
            'rma-id'                 => 'RMA Id :',
            'summary'                => 'Summary of Order\'s RMA',
            'order-id'               => 'Order Id :',
            'order-status'           => 'Order Status :',
            'resolution-type'        => 'Resolution Type :',
            'additional-information' => 'Additional Information :',
            'thank-you'              => 'Thank you',
            'requested-rma-product'  => 'Requested RMA\'s Product:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Product Name',
            'sku'          => 'Sku',
            'qty'          => 'Qty',
            'reason'       => 'Reason',
        ],

        'customer-conversation' => [
            'heading' => 'Dear :name,',
            'quotes'  => 'There is a new message from Buyer',
            'message' => 'Message',
        ],

        'seller-conversation' => [
            'heading' => 'Dear :name',
            'quotes'  => 'There is a new message from Seller',
            'message' => 'Message',
            'title'   => 'Message Received!',
        ],

        'status' => [
            'heading'       => 'Dear :name',
            'quotes'        => 'Your RMA status has been changed by Seller',
            'rma-id'        => 'RMA Id',
            'your-rma-id'   => 'Your RMA Id',
            'status-change' => ':id status has been changed by Seller',
            'status'        => 'Status',
            'title'         => 'Status Updated!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Pending',
            'processing'               => 'Processing',
            'item-canceled'            => 'Item Canceled',
            'solved'                   => 'Solved',
            'declined'                 => 'Declined',
            'received-package'         => 'Received Package',
            'dispatched-package'       => 'Dispatched Package',
            'not-received-package-yet' => 'Not received package yet',
            'accept'                   => 'Accept',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA is declined by Admin.',
            'declined-buyer'  => 'RMA is declined by Buyer.',
            'solved'          => 'RMA is Solved.',
            'solved-by-admin' => 'RMA is solved by admin.',
        ],
    ],

    'response' => [
        'create-success'    => ':name created successfully.',
        'send-message'      => ':name sent successfully.',
        'update-success'    => ':name updated successfully.',
        'permission-denied' => 'You are logged in',
    ],
];
