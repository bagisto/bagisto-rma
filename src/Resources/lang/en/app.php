<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Afternoon',
                        'all-products'                        => 'All Products',
                        'all-status'                          => 'All Status',
                        'allow-new-request-for-pending-order' => 'Allow new rma request for pending order',
                        'allow-rma-for-digital-product'       => 'Allow RMA for digital product',
                        'allowed-file-extension'              => 'Allowed File Extension',
                        'allowed-file-types'                  => 'Please Select File Types '.core()->getConfigData('sales.rma.setting.allowed-file-extension').' only',
                        'allowed-info'                        => 'Comma Separated. For example: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Allowed New Rma Request For Cancelled Request',
                        'allowed-request-declined-request'    => 'Allowed New Rma Request For Declined Request',
                        'allowed-rma-for-product'             => 'Allowed Rma For Product',
                        'cancel-items'                        => 'Cancel-items',
                        'complete'                            => 'Complete',
                        'current-order-quantity'              => 'Current Order Quantity',
                        'days-info'                           => 'The number of days within which the customer can request an RMA after placing an order.',  
                        'default-allow-days'                  => 'Default allowed days',
                        'enable'                              => 'Enable rma',
                        'evening'                             => 'Evening',
                        'exchange'                            => 'Exchange',
                        'info'                                => 'RMA is part of the process of returning a product to a business to receive a refund, replacement, or repair.',
                        'morning'                             => 'Morning',
                        'new-rma-message-to-customer'         => 'New RMA Message to Customer',
                        'no'                                  => 'No',
                        'open'                                => 'Open',
                        'package-condition'                   => 'Package Condition',
                        'packed'                              => 'Packed',
                        'print-page'                          => 'Print RMA',
                        'product-already-raw'                 => 'Product is already in RMA.',
                        'product-delivery-status'             => 'Product Delivery Status',
                        'resolution-type'                     => 'Resolution Type',
                        'return-pickup-address'               => 'Return Pickup Address',
                        'return-pickup-time'                  => 'Return Pickup Time',
                        'return-policy'                       => 'Return Policy',
                        'return'                              => 'Return',
                        'select-allowed-order-status'         => 'Select Allowed Order Status',
                        'specific-products'                   => 'Specific Products',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Yes',

                        'setting' => [
                            'info'  => 'RMA functionality allows handling situations when a customer returns items for repair and maintenance, or for refund or replacement.',
                            'read'  => 'Read Policy',
                            'terms' => 'I have read and accepted the Return Policy.',
                            'title' => 'RMA',
                        ],
                    ],
                ],
            ],
        ],

        'components' => [
            'layouts' => [
                'sidebar' => [
                    'rma'=>'RMA',
                ],
            ],
        ],

        'sales' => [
            'rma' => [
                'index' => [
                    'create-rma-title' => 'Create RMA',
                    'reason-title'     => 'Reasons',
                    'rma-title'        => 'All RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'All RMA',

                        'datagrid' => [
                            'create'        => 'Created At',
                            'customer-name' => 'Customer Name',
                            'id'            => 'RMA ID',
                            'order-ref'     => 'Order Ref',
                            'order-status'  => 'Order Status',
                            'rma-status'    => 'RMA Status',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Add Attachments',
                        'additional-information' => 'Additional Information :',
                        'attachment'             => 'Attachment',
                        'change-status'          => 'Change Status',
                        'confirm-print'          => 'Click OK to print RMA',
                        'conversations'          => 'Conversations',
                        'customer-details'       => 'Customer Details',
                        'customer-email'         => 'Customer Email :',
                        'customer'               => 'Customer :',
                        'enter-message'          => 'Enter Message',
                        'images'                 => 'Image :',
                        'no-record'              => 'No Record Found !',
                        'order-date'             => 'Order Date :',
                        'order-details'          => 'Item(s) Requested for RMA',
                        'order-id'               => 'Order ID :',
                        'order-status'           => 'Order Status :',
                        'order-total'            => 'Order Total :',
                        'request-on'             => 'Request On :',
                        'resolution-type'        => 'Resolution Type :',
                        'rma-status'             => 'RMA Status :',
                        'save-btn'               => 'Save',
                        'send-message-btn'       => 'Send Message',
                        'send-message-success'   => 'Message sent successfully.',
                        'send-message'           => 'Send Message',
                        'status'                 => 'Status',
                        'title'                  => 'RMA',
                        'update-success'         => 'Rma status updated successfully.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Create RMA Status',
                        'title'      => 'RMA Status',

                        'datagrid' => [
                            'created-at'          => 'Created At',
                            'delete-success'      => 'RMA Status deleted successfully.',
                            'disabled'            => 'Inactive',
                            'enabled'             => 'Active',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Selected rma status deleted successfully.',
                            'reason-error'        => 'RMA Status is used in RMA.',
                            'reason'              => 'RMA Status',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Add New RMA Status',
                        'reason'       => 'RMA Status',
                        'save-btn'     => 'Save RMA Status',
                        'status'       => 'Status',
                        'success'      => 'RMA Status created successfully.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edit RMA Status',
                        'mass-update-success' => 'Selected rma status updated successfully.',
                        'reason'              => 'RMA Status',
                        'save-btn'            => 'Save RMA Status',
                        'status'              => 'Status',
                        'success'             => 'RMA Status updated successfully.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'Create RMA Reason',
                        'title'      => 'Reasons',

                        'datagrid' => [
                            'created-at'          => 'Created At',
                            'delete-success'      => 'Reason deleted successfully.',
                            'disabled'            => 'Inactive',
                            'enabled'             => 'Active',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Selected data successfully deleted',
                            'reason-error'        => 'Reason is used in RMA.',
                            'reason'              => 'Reason',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Add New Reason',
                        'reason'       => 'Reason',
                        'save-btn'     => 'Save Reason',
                        'status'       => 'Status',
                        'success'      => 'Reason created successfully.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edit Reason',
                        'mass-update-success' => 'Selected reasons updated successfully.',
                        'reason'              => 'Reason',
                        'save-btn'            => 'Save Reason',
                        'status'              => 'Status',
                        'success'             => 'Reason updated successfully.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Add New Field',
                        'title'      => 'RMA Custom Fields',

                        'datagrid' => [
                            'created-at'          => 'Created At',
                            'delete-success'      => 'Custom Fields deleted successfully.',
                            'disabled'            => 'Inactive',
                            'enabled'             => 'Active',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Selected data successfully deleted',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'New Custom Field',
                        'save-btn'     => 'Save Custom Field',
                        'status'       => 'Status',
                        'success'      => 'Custom Field created successfully.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edit Custom Field',
                        'mass-update-success' => 'Selected Custom Field updated successfully.',
                        'reason'              => 'Custom Field',
                        'save-btn'            => 'Save Custom Field',
                        'status'              => 'Status',
                        'success'             => 'Custom Field updated successfully.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Create RMA Rules',
                        'title'      => 'RMA Rules',

                        'datagrid' => [
                            'delete-success'      => 'RMA Rules deleted successfully.',
                            'disabled'            => 'Inactive',
                            'enabled'             => 'Active',
                            'exchange-period'     => 'Exchange Period(days)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Selected data successfully deleted.',
                            'reason'              => 'Rules',
                            'return-period'       => 'Return Period(days)',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Add New RMA Rules',
                        'reason'             => 'RMA Rules',
                        'resolutions-period' => 'Resolutions Period',
                        'rule-description'   => 'Rules Description',
                        'rule-details'       => 'Rules Details',
                        'rules-title'        => 'Rules Title',
                        'save-btn'           => 'Save RMA Rules',
                        'status'             => 'RMA Status',
                        'success'            => 'RMA Rules created successfully.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edit RMA Rules',
                        'mass-update-success' => 'Selected  RMA Rules updated successfully.',
                        'reason'              => 'RMA Rules',
                        'save-btn'            => 'Update RMA Rules',
                        'status'              => 'Status',
                        'success'             => 'RMA Rules updated successfully.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'Rma created successfully.',
                    'create-title'             => 'Create RMA',
                    'email'                    => 'Email',
                    'image'                    => 'Image',
                    'invalid-order-id'         => 'Invalid order Id',
                    'mismatch'                 => 'Order Id and email mismatch',
                    'new-rma'                  => 'New RMA',
                    'order-id'                 => 'Order Id',
                    'quantity'                 => 'Quantity',
                    'reason'                   => 'Reason',
                    'rma-already-exist'        => 'RMA already exists',
                    'rma-not-available-quotes' => 'Item not available for RMA',
                    'save-btn'                 => 'Save',
                    'search'                   => '--Select--',
                    'validate'                 => 'Validate',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA has been created',
                    'rma-created-message'  => 'An RMA request is available for the product with a quantity of :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Delete',
            'edit'        => 'Edit',
            'mass-delete' => 'Mass Delete',
            'mass-update' => 'Mass Update',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Delivered',
            'menu-name'    => 'RMA',
            'offer'        => 'Get UPTO 40% OFF on your 1st order',
            'rma-qty'      => 'RMA Qty',
            'shop-now'     => 'SHOP NOW',
            'submit-req'   => 'Submit request',
            'title'        => 'RMA',
            'undelivered'  => 'Undelivered',
            'canceled'     => 'Canceled',
            'closed'     => 'Closed',
            'by-admin'     => 'Order Canceled By Admin',

            'create' => [
                'cancel'                   => 'Cancel',
                'create-btn'               => 'Save',
                'enter-order-id'           => 'Enter Order Id',
                'exchange-window'          => 'Exchange Window',
                'heading'                  => 'New RMA Request',
                'image'                    => 'Image',
                'images'                   => 'Images',
                'information'              => 'Additional Information',
                'item-ordered'             => 'Item Ordered',
                'no-record'                => 'No Record Found !',
                'not-allowed'              => 'RMA is not allowed for pending order',
                'order-status'             => 'Order Status',
                'orders'                   => 'Orders',
                'price'                    => 'Price',
                'product-name'             => 'Product Name',
                'product'                  => 'Product',
                'quantity'                 => 'Quantity',
                'reason'                   => 'Reason',
                'reopen-request'           => 'Reopen Request',
                'resolution'               => 'Select Resolution',
                'return-window'            => 'Return Window',
                'rma-not-available-quotes' => 'Item not available for RMA',
                'save'                     => 'Save',
                'search-order'             => 'Search Order',
                'sku'                      => 'Sku',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Close RMA :',
                'order-status' => 'Order Status :',
                'rma-status'   => 'RMA Status :',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Cancel',
                'create-btn'               => 'Save',
                'enter-order-id'           => 'Enter Order Id',
                'heading'                  => 'New RMA Request',
                'image'                    => 'Image',
                'images'                   => 'Images',
                'information'              => 'Additional Information',
                'item-ordered'             => 'Item Ordered',
                'not-allowed'              => 'RMA is not allowed for pending order',
                'order-status'             => 'Order Status',
                'orders'                   => 'Orders',
                'price'                    => 'Price',
                'product-name'             => 'Product Name',
                'product'                  => 'Product',
                'quantity'                 => 'Quantity',
                'reason'                   => 'Reason',
                'reopen-request'           => 'Reopen Request',
                'resolution'               => 'Select Resolution',
                'rma-not-available-quotes' => 'Item not available for RMA',
                'save'                     => 'Save',
                'search-order'             => 'Search Order',
                'sku'                      => 'Sku',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Request new RMA',
                'delete'  => 'Delete',
                'edit'    => 'Edit',
                'guest'   => 'Guest RMA Panel',
                'heading' => 'Customer RMA Panel',
                'update'  => 'Update',
                'view'    => 'View',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Create',
            'delete'  => 'Delete',
            'edit'    => 'Edit',
            'guest'   => 'Guest RMA Panel',
            'heading' => 'RMA',
            'update'  => 'Update',
            'view'    => 'View',
        ],

        'validation' => [
            'close-rma'     => 'Confirm',
            'information'   => 'Additional Information',
            'order-id'      => 'Order Selection',
            'order-status'  => 'Order Status',
            'orders'        => 'Orders',
            'resolution'    => 'Resolution',
            'select-orders' => 'Select Order',
        ],

        'conversation-texts' => [
            'by'        => 'By',
            'customer'  => 'Customer',
            'no-record' => 'No Record Found !',
            'on'        => 'On',
            'seller'    => 'Seller',
        ],

        'default-option' => [
            'others'              => 'Others',
            'please-select-value' => 'Please Select Value',
            'select-order-status' => 'Select Order Status',
            'select-order'        => 'Select Order',
            'select-quantity'     => 'Select Quantity',
            'select-reason'       => 'Select Reason',
            'select-resolution'   => 'Select Resolution',
            'select-seller'       => 'Select Seller',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Additional Information :',
            'admin'                   => 'Admin',
            'cancel-order'            => 'Cancel Order',
            'change-rma-status'       => 'Change RMA Status',
            'close-rma'               => 'Close RMA :',
            'conversations'           => 'Conversations',
            'guest'                   => 'Guest',
            'heading'                 => 'RMA Details',
            'images'                  => 'Images:',
            'items-request'           => 'Item(s) Requested for RMA',
            'items-requested-for-rma' => 'Item(s) Requested for RMA',
            'order-id'                => 'Order ID :',
            'refund-details'          => 'Refund Details',
            'refund-offline-btn'      => 'Refund Offline',
            'refundable-amount'       => 'Refundable Amount',
            'resolution-type'         => 'Resolution Type :',
            'rma'                     => 'RMA',
            'save-btn'                => 'Save',
            'send-message-btn'        => 'Send',
            'send-message'            => 'Send Message',
            'status-details'          => 'Status Details',
            'status-quotes'           => 'Please agree to mark it as solved',
            'status-reopen'           => 'Check to reopen',
            'status'                  => 'Status',
            'term'                    => 'Agree mark field is required',
            'you'                     => 'Admin',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Additional Information :',
            'admin'                  => 'Admin',
            'close-rma'              => 'Close RMA',
            'conversations'          => 'Conversations',
            'guest'                  => 'You',
            'images'                 => 'Images',
            'items-request'          => 'Item(s) Requested for RMA',
            'order-id'               => ' Order ID :',
            'refund-offline-btn'     => 'Refund Offline',
            'resolution-type'        => 'Resolution Type :',
            'rma'                    => 'RMA',
            'save-btn'               => 'Save',
            'send-message-btn'       => 'Send',
            'send-message'           => 'Send Message',
            'status-details'         => 'Status Details',
            'status-quotes'          => 'Please agree to mark it as solved.',
            'status'                 => 'Status',
            'term'                   => 'Agree mark field is required',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Full Amount',
            'order-status' => 'Order Status :',
            'request-on'   => 'Request On :',
            'rma-status'   => 'RMA Status :',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Admin Status:',
            'close-rma'               => 'Close RMA',
            'consignment-no'          => 'Consignment Number:',
            'enter-message'           => 'Enter Message',
            'full-amount'             => 'Full Amount',
            'order-details'           => 'Order Details',
            'order-status'            => 'Order Status :',
            'partial-amount'          => 'Partial Amount',
            'refundable-amount'       => 'Refundable Amount:',
            'request-on'              => 'Request On :',
            'rma-status'              => 'RMA Status :',
            'seller'                  => 'Seller',
            'total-refundable-amount' => 'Total Refundable Amount:',
        ],

        'table-heading' => [
            'image'           => 'Image',
            'order-qty'       => 'Order Qty',
            'price'           => 'Price',
            'product-name'    => 'Product Name',
            'reason'          => 'Reason', 
            'resolution-type' => 'Resolution Type',
            'rma-qty'         => 'RMA Qty',
            'sku'             => 'SKU',
        ],

        'guest-users' => [
            'button-text' => 'Sign In',
            'email'       => 'Email',
            'heading'     => 'Guest Login Panel',
            'logout'      => 'Guest Logout',
            'order-id'    => 'Order Id',
            'title'       => 'Guest Login',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Additional Information :',
            'greeting'               => 'You requested new RMA for order :order_id.',
            'heading'                => 'RMA Request',
            'hello'                  => 'Dear :name',
            'order-id'               => 'Order Id :',
            'order-status'           => 'Order Status :',
            'requested-rma-product'  => 'Requested RMA\'s Product:',
            'resolution-type'        => 'Resolution Type :',
            'rma-id'                 => 'RMA Id :',
            'summary'                => 'Summary of Order\'s RMA',
            'thank-you'              => 'Thank you',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Product Name',
            'qty'          => 'Qty',
            'reason'       => 'Reason',
            'sku'          => 'Sku',
        ],

        'customer-conversation' => [
            'heading' => 'Dear :name,',
            'message' => 'Message',
            'process' => 'Your return request is under process.',
            'quotes'  => 'There is a new message from Buyer',
            'solved'  => 'RMA status has been changed to Solved by customer.',
        ],

        'seller-conversation' => [
            'heading' => 'Dear :name',
            'message' => 'Message',
            'quotes'  => 'There is a new message from Admin',
            'title'   => 'Message Received!',
        ],

        'status' => [
            'heading'       => 'Dear :name',
            'quotes'        => 'Your RMA status has been changed by Admin',
            'rma-id'        => 'RMA Id',
            'status-change' => ':id status has been changed by Admin',
            'status'        => 'Status',
            'title'         => 'Status Updated!',
            'your-rma-id'   => 'Your RMA Id',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Accept',
            'awaiting'                 => 'Awaiting',
            'canceled'                 => 'Canceled',
            'declined'                 => 'Declined',
            'dispatched-package'       => 'Dispatched Package',
            'item-canceled'            => 'Item Canceled',
            'not-received-package-yet' => 'Not received package yet',
            'pending'                  => 'Pending',
            'processing'               => 'Processing',
            'received-package'         => 'Received Package',
            'solved'                   => 'Solved',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA is declined by Admin.',
            'declined-buyer'  => 'RMA is declined by Buyer.',
            'solved-by-admin' => 'RMA is solved by admin.',
            'solved'          => 'RMA is Solved.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA status already canceled.',
        'cancel-success'    => 'RMA status canceled successfully.',
        'create-success'    => 'Request created successfully.',
        'creation-error'    => 'RMA status cannot be updated as the invoice for this order has not been created.',
        'permission-denied' => 'You are logged in',
        'rma-disabled'      => 'RMA is disabled for this product',
        'send-message'      => ':name sent successfully.',
        'update-success'    => ':name updated successfully.',
    ],
];