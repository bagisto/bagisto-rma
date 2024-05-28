<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'اجازه درخواست جدید RMA برای سفارش معلق',
                        'allow-rma-for-digital-product'       => 'اجازه RMA برای محصولات دیجیتال',
                        'default-allow-days'                  => 'تعداد روزهای پیش فرض مجاز',
                        'enable'                              => 'فعال کردن RMA',
                        'info'                                => 'RMA بخشی از فرایند بازگشت محصول به یک کسب و کار برای دریافت بازپرداخت، جایگزینی یا تعمیر است.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'قابلیت RMA اجازه مدیریت موقعیت‌هایی را می‌دهد که مشتریان موارد را برای تعمیر و نگهداری، یا برای بازپرداخت یا جایگزینی برمی‌گردانند.',
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
                    'rma-title'        => 'تمام Rma ها',
                    'reason-title'     => 'دلایل',
                    'create-rma-title' => 'ساخت Rma',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'تمام Rma ها',

                        'datagrid' => [
                            'id'        => 'شناسه RMA',
                            'order-ref' => 'شماره سفارش',
                            'status'    => 'وضعیت',
                            'create'    => 'ایجاد شده در',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' شناسه سفارش :',
                        'request-on'             => 'درخواست در :',
                        'customer'               => 'مشتری :',
                        'resolution-type'        => 'نوع رزولوشن :',
                        'additional-information' => 'اطلاعات اضافی :',
                        'images'                 => 'تصویر :',
                        'order-details'          => 'جزئیات سفارش',
                        'status'                 => 'وضعیت',
                        'rma-status'             => 'وضعیت RMA :',
                        'order-status'           => 'وضعیت سفارش :',
                        'change-status'          => 'تغییر وضعیت',
                        'conversations'          => 'مکالمات',
                        'save-btn'               => 'ذخیره',
                        'send-message'           => 'ارسال پیام',
                        'enter-message'          => 'پیام را وارد کنید',
                        'send-message-btn'       => 'ارسال پیام',
                        'send-message-success'   => 'پیام با موفقیت ارسال شد.',
                        'update-success'         => 'وضعیت Rma با موفقیت به روز رسانی شد.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'دلایل',
                        'create-btn' => 'ساخت دلیل Rma',

                        'datagrid' => [
                            'id'                  => 'شناسه',
                            'reason'              => 'دلیل',
                            'status'              => 'وضعیت',
                            'created-at'          => 'ایجاد شده در',
                            'enabled'             => 'فعال',
                            'disabled'            => 'غیرفعال',
                            'delete-success'      => 'دلیل با موفقیت حذف شد.',
                            'mass-delete-success' => 'حذف جمعی Rma با موفقیت انجام شد.',
                            'reason-error'        => 'دلیل در RMA استفاده شده است.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'افزودن دلیل جدید',
                        'save-btn'       => 'ذخیره دلیل',
                        'reason'         => 'دلیل',
                        'status'         => 'وضعیت',
                        'create-success' => 'دلیل با موفقیت ایجاد شد.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ویرایش دلیل',
                        'save-btn'            => 'ذخیره دلیل',
                        'reason'              => 'دلیل',
                        'status'              => 'وضعیت',
                        'mass-update-success' => 'دلایل انتخابی با موفقیت به روز رسانی شدند.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'ساخت Rma',
                    'order-id'          => 'شناسه سفارش',
                    'email'             => 'ایمیل',
                    'validate'          => 'اعتبارسنجی',
                    'rma-already-exist' => 'RMA در حال حاضر وجود دارد',
                    'mismatch'          => 'شناسه سفارش و ایمیل مطابقت ندارند',
                    'invalid-order-id'  => 'شناسه سفارش نامعتبر است',
                    'quantity'          => 'تعداد',
                    'reason'            => 'دلیل',
                    'save-btn'          => 'ذخیره',
                    'create-success'    => 'Rma با موفقیت ایجاد شد.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'بازگشت RMA',
            'offer'        => 'تا 40٪ تخفیف درخواست خرید اولیه خود را دریافت کنید',
            'shop-now'     => 'هم اکنون خرید کنید',

            'create' => [
                'heading'                  => 'درخواست RMA جدید',
                'create-btn'               => 'ذخیره',
                'orders'                   => 'سفارشات',
                'resolution'               => 'انتخاب رزولوشن',
                'item-ordered'             => 'مورد سفارش',
                'images'                   => 'تصاویر',
                'information'              => 'اطلاعات اضافی',
                'order-status'             => 'وضعیت سفارش',
                'product'                  => 'محصول',
                'sku'                      => 'Sku',
                'price'                    => 'قیمت',
                'search-order'             => 'جستجوی سفارش',
                'enter-order-id'           => 'شناسه سفارش را وارد کنید',
                'not-allowed'              => 'RMA برای سفارش معلق مجاز نیست',
                'image'                    => 'تصویر',
                'quantity'                 => 'تعداد',
                'reason'                   => 'دلیل',
                'rma-not-available-quotes' => 'مورد برای RMA در دسترس نیست',
                'product-name'             => 'نام محصول',
                'reopen-request'           => 'باز کردن مجدد درخواست',
                'save'                     => 'ذخیره',
                'cancel'                   => 'انصراف',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'وضعیت RMA :',
                'order-status' => 'وضعیت سفارش :',
                'close-rma'    => 'بستن RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'درخواست RMA جدید',
                'create-btn'               => 'ذخیره',
                'orders'                   => 'سفارشات',
                'resolution'               => 'انتخاب رزولوشن',
                'item-ordered'             => 'مورد سفارش',
                'images'                   => 'تصاویر',
                'information'              => 'اطلاعات اضافی',
                'order-status'             => 'وضعیت سفارش',
                'product'                  => 'محصول',
                'sku'                      => 'Sku',
                'price'                    => 'قیمت',
                'search-order'             => 'جستجوی سفارش',
                'enter-order-id'           => 'شناسه سفارش را وارد کنید',
                'not-allowed'              => 'RMA برای سفارش معلق مجاز نیست',
                'image'                    => 'تصویر',
                'quantity'                 => 'تعداد',
                'reason'                   => 'دلیل',
                'rma-not-available-quotes' => 'مورد برای RMA در دسترس نیست',
                'product-name'             => 'نام محصول',
                'reopen-request'           => 'باز کردن مجدد درخواست',
                'save'                     => 'ذخیره',
                'cancel'                   => 'انصراف',
                'reopen-request'           => 'باز کردن مجدد درخواست',
            ],

            'index' => [
                'create'  => 'درخواست RMA جدید',
                'heading' => 'پنل RMA مشتری',
                'view'    => 'مشاهده',
                'edit'    => 'ویرایش',
                'delete'  => 'حذف',
                'update'  => 'به روزرسانی',
                'guest'   => 'پنل RMA مهمان',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'درخواست RMA جدید',
            'heading' => 'پنل RMA مشتری',
            'view'    => 'مشاهده',
            'edit'    => 'ویرایش',
            'delete'  => 'حذف',
            'update'  => 'به روزرسانی',
            'guest'   => 'پنل RMA مهمان',
        ],

        'validation' => [
            'orders'       => 'سفارشات',
            'resolution'   => 'رزولوشن',
            'information'  => 'اطلاعات اضافی',
            'order-status' => 'وضعیت سفارش',
            'order-id'     => 'انتخاب سفارش',
            'close-rma'    => 'تأیید',
        ],

        'conversation-texts' => [
            'by'       => 'توسط',
            'seller'   => 'فروشنده',
            'customer' => 'مشتری',
            'on'       => 'در',
        ],

        'default-option' => [
            'please-select-value' => 'لطفاً مقدار را انتخاب کنید',
            'select-quantity'     => 'انتخاب تعداد',
            'select-reason'       => 'انتخاب دلیل',
            'others'              => 'دیگران',
            'select-order-status' => 'انتخاب وضعیت سفارش',
            'select-resolution'   => 'انتخاب رزولوشن',
            'select-seller'       => 'انتخاب فروشنده',
            'select-order'        => 'انتخاب سفارش',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'مهمان',
            'heading'                 => 'جزئیات RMA',
            'status'                  => 'وضعیت',
            'order-id'                => ' شناسه سفارش :',
            'refund-details'          => 'جزئیات بازپرداخت',
            'resolution-type'         => 'نوع رزولوشن :',
            'additional-information'  => 'اطلاعات اضافی :',
            'change-rma-status'       => 'تغییر وضعیت RMA',
            'save-btn'                => 'ذخیره',
            'you'                     => 'مدیر',
            'send-message-btn'        => 'ارسال',
            'items-requested-for-rma' => 'مورد(های) درخواست شده برای RMA',
            'refund-offline-btn'      => 'بازپرداخت آفلاین',
            'send-message'            => 'ارسال پیام',
            'conversations'           => 'مکالمات',
            'cancel-order'            => 'لغو سفارش',
            'status-details'          => 'جزئیات وضعیت',
            'admin'                   => 'مدیر',
            'status-quotes'           => 'لطفاً با توافق برای علامت زدن آن به عنوان حل شده موافقت کنید.',
            'close-rma'               => 'بستن RMA :',
            'images'                  => 'تصاویر',
            'items-request'           => 'مورد(های) درخواست شده برای RMA',
            'refundable-amount'       => 'مبلغ قابل بازپرداخت',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'نوع رزولوشن :',
            'guest'                  => 'شما',
            'status'                 => 'وضعیت',
            'order-id'               => ' شناسه سفارش :',
            'additional-information' => 'اطلاعات اضافی :',
            'save-btn'               => 'ذخیره',
            'send-message-btn'       => 'ارسال',
            'refund-offline-btn'     => 'بازپرداخت آفلاین',
            'send-message'           => 'ارسال پیام',
            'conversations'          => 'مکالمات',
            'status-details'         => 'جزئیات وضعیت',
            'admin'                  => 'مدیر',
            'status-quotes'          => 'لطفاً با توافق برای علامت زدن آن به عنوان حل شده موافقت کنید.',
            'close-rma'              => 'بستن RMA',
            'images'                 => 'تصاویر',
            'items-request'          => 'مورد(های) درخواست شده برای RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'وضعیت RMA :',
            'order-status' => 'وضعیت سفارش :',
            'full-amount'  => 'مبلغ کامل',
            'request-on'   => 'درخواست در :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'بستن RMA',
            'rma-status'              => 'وضعیت RMA :',
            'admin-status'            => 'وضعیت مدیر:',
            'order-status'            => 'وضعیت سفارش :',
            'consignment-no'          => 'شماره محموله:',
            'refundable-amount'       => 'مبلغ قابل بازپرداخت:',
            'full-amount'             => 'مبلغ کامل',
            'partial-amount'          => 'مبلغ جزئی',
            'total-refundable-amount' => 'مجموع مبلغ قابل بازپرداخت:',
            'enter-message'           => 'پیام را وارد کنید',
            'request-on'              => 'درخواست در :',
            'seller'                  => 'فروشنده',
            'order-details'           => 'جزئیات سفارش',
        ],

        'table-heading' => [
            'product-name' => 'نام محصول',
            'sku'          => 'SKU',
            'price'        => 'قیمت',
            'qty'          => 'تعداد',
            'reason'       => 'دلیل',
        ],

        'guest-users' => [
            'heading'     => 'پنل ورود مهمان',
            'order-id'    => 'شناسه سفارش',
            'email'       => 'ایمیل',
            'button-text' => 'ورود',
            'title'       => 'ورود مهمان',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'درخواست RMA',
            'hello'                  => 'عزیز :name',
            'greeting'               => 'شما درخواست جدید RMA برای سفارش :order_id داده‌اید.',
            'rma-id'                 => 'شناسه RMA :',
            'summary'                => 'خلاصه RMA سفارش',
            'order-id'               => 'شناسه سفارش :',
            'order-status'           => 'وضعیت سفارش :',
            'resolution-type'        => 'نوع رزولوشن :',
            'reason'                 => 'دلیل :',
            'additional-information' => 'اطلاعات اضافی :',
            'closing'                => 'با تشکر',
            'shop-name'              => 'نام فروشگاه',
            'email'                  => 'ایمیل :email',
            'telephone'              => 'تلفن :telephone',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'نام محصول',
            'sku'          => 'کد SKU',
            'qty'          => 'تعداد',
            'reason'       => 'دلیل',
        ],

        'customer-conversation' => [
            'heading' => 'عزیز :name،',
            'quotes'  => 'یک پیام جدید از خریدار وجود دارد',
            'message' => 'پیام',
        ],

        'seller-conversation' => [
            'heading' => 'عزیز :name',
            'quotes'  => 'یک پیام جدید از فروشنده وجود دارد',
            'message' => 'پیام',
            'title'   => 'پیام دریافت شده!',
        ],

        'status' => [
            'heading'       => 'عزیز :name',
            'quotes'        => 'وضعیت RMA شما توسط فروشنده تغییر یافته است',
            'rma-id'        => 'شناسه RMA',
            'your-rma-id'   => 'شناسه RMA شما',
            'status-change' => 'وضعیت :id توسط فروشنده تغییر یافته است',
            'status'        => 'وضعیت',
            'title'         => 'وضعیت بروزرسانی شد!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'در انتظار',
            'processing'               => 'در حال پردازش',
            'item-canceled'            => 'لغو شده',
            'solved'                   => 'حل شده',
            'declined'                 => 'رد شده',
            'received-package'         => 'بسته دریافت شده',
            'dispatched-package'       => 'بسته ارسال شده',
            'not-received-package-yet' => 'هنوز بسته دریافت نشده است',
            'accept'                   => 'پذیرفته شده',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA توسط مدیر رد شده است.',
            'declined-buyer'  => 'RMA توسط خریدار رد شده است.',
            'solved'          => 'RMA حل شده است.',
            'solved-by-admin' => 'RMA توسط مدیر حل شده است.',
        ],
    ],

    'response' => [
        'create-success' => ':name با موفقیت ایجاد شد.',
        'send-message'   => ':name با موفقیت ارسال شد.',
        'update-success' => ':name با موفقیت به‌روزرسانی شد.',
    ],
];
