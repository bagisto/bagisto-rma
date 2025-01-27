<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'بعد از ظهر',
                        'all-products'                        => 'تمام محصولات',
                        'all-status'                          => 'تمام وضعیت‌ها',
                        'allow-new-request-for-pending-order' => 'اجازه درخواست جدید RMA برای سفارش معلق',
                        'allow-rma-for-digital-product'       => 'اجازه RMA برای محصول دیجیتال',
                        'allowed-file-extension'              => 'پسوند فایل مجاز',
                        'allowed-file-types'                  => 'لطفاً فقط نوع فایل‌های ' . core()->getConfigData('sales.rma.setting.allowed-file-extension') . ' را انتخاب کنید',
                        'allowed-info'                        => 'با کاما جدا شده. به عنوان مثال: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'اجازه درخواست جدید RMA برای درخواست لغو شده',
                        'allowed-request-declined-request'    => 'اجازه درخواست جدید RMA برای درخواست رد شده',
                        'allowed-rma-for-product'             => 'اجازه RMA برای محصول',
                        'cancel-items'                        => 'لغو موارد',
                        'complete'                            => 'کامل',
                        'current-order-quantity'              => 'مقدار سفارش فعلی',
                        'days-info'                           => 'تعداد روزهایی که مشتری می‌تواند پس از ثبت سفارش، درخواست RMA کند.',
                        'default-allow-days'                  => 'روزهای مجاز پیش‌فرض',
                        'enable'                              => 'فعال‌سازی RMA',
                        'evening'                             => 'عصر',
                        'exchange'                            => 'تعویض',
                        'info'                                => 'RMA بخشی از فرآیند بازگرداندن محصول به کسب و کار برای دریافت بازپرداخت، تعویض یا تعمیر است.',
                        'morning'                             => 'صبح',
                        'new-rma-message-to-customer'         => 'پیام جدید RMA به مشتری',
                        'no'                                  => 'نه',
                        'open'                                => 'باز',
                        'package-condition'                   => 'وضعیت بسته‌بندی',
                        'packed'                              => 'بسته‌بندی شده',
                        'print-page'                          => 'چاپ صفحه', 
                        'product-already-raw'                 => 'محصول در حال حاضر در RMA است.',
                        'product-delivery-status'             => 'وضعیت تحویل محصول',
                        'resolution-type'                     => 'نوع راه‌حل',
                        'return-pickup-address'               => 'آدرس برداشت بازگشت',
                        'return-pickup-time'                  => 'زمان برداشت بازگشت',
                        'return-policy'                       => 'سیاست بازگشت',
                        'return'                              => 'بازگشت',
                        'select-allowed-order-status'         => 'وضعیت سفارش مجاز را انتخاب کنید',
                        'specific-products'                   => 'محصولات خاص',
                        'title'                               => 'RMA',
                        'yes'                                 => 'بله',

                        'setting' => [
                            'info'  => 'قابلیت RMA اجازه می‌دهد که در مواقعی که مشتری اقلام را برای تعمیر و نگهداری، یا برای بازپرداخت یا تعویض بازمی‌گرداند، مدیریت شود.',
                            'read'  => 'مطالعه سیاست',
                            'terms' => 'من سیاست بازگشت را خوانده و پذیرفته‌ام.', 
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
                    'create-rma-title' => 'ایجاد RMA',
                    'reason-title'     => 'دلایل',
                    'rma-title'        => 'همه RMA ها',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'همه RMA ها',

                        'datagrid' => [
                            'create'        => 'ایجاد شده در',
                            'customer-name' => 'نام مشتری',
                            'id'            => 'شناسه RMA',
                            'order-ref'     => 'مرجع سفارش',
                            'order-status'  => 'وضعیت سفارش',
                            'rma-status'    => 'وضعیت RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'افزودن پیوست‌ها',
                        'additional-information' => 'اطلاعات اضافی:',
                        'attachment'             => 'پیوست',
                        'change-status'          => 'تغییر وضعیت',
                        'confirm-print'          => 'برای چاپ RMA روی تأیید کلیک کنید',
                        'conversations'          => 'مکالمات',
                        'customer-details'       => 'جزئیات مشتری',
                        'customer-email'         => 'ایمیل مشتری:',
                        'customer'               => 'مشتری:',
                        'enter-message'          => 'پیام را وارد کنید',
                        'images'                 => 'تصویر:',
                        'no-record'              => 'هیچ سابقه‌ای یافت نشد!',
                        'order-date'             => 'تاریخ سفارش:',
                        'order-details'          => 'آیتم(های) درخواست شده برای RMA',
                        'order-id'               => 'شناسه سفارش:',
                        'order-status'           => 'وضعیت سفارش:',
                        'order-total'            => 'مجموع سفارش:',
                        'request-on'             => 'درخواست در:',
                        'resolution-type'        => 'نوع راه حل:',
                        'rma-status'             => 'وضعیت RMA:',
                        'save-btn'               => 'ذخیره',
                        'send-message-btn'       => 'ارسال پیام',
                        'send-message-success'   => 'پیام با موفقیت ارسال شد.',
                        'send-message'           => 'ارسال پیام',
                        'status'                 => 'وضعیت',
                        'title'                  => 'RMA',
                        'update-success'         => 'وضعیت RMA با موفقیت به‌روزرسانی شد.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'ایجاد وضعیت RMA',
                        'title'      => 'وضعیت RMA',

                        'datagrid' => [
                            'created-at'          => 'ایجاد شده در',
                            'delete-success'      => 'وضعیت RMA با موفقیت حذف شد.',
                            'disabled'            => 'غیرفعال',
                            'enabled'             => 'فعال',
                            'id'                  => 'شناسه',
                            'mass-delete-success' => 'وضعیت RMA انتخاب شده با موفقیت حذف شد.',
                            'reason-error'        => 'وضعیت RMA در RMA استفاده شده است.',
                            'reason'              => 'وضعیت RMA',
                            'status'              => 'وضعیت',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'افزودن وضعیت RMA جدید',
                        'reason'       => 'وضعیت RMA',
                        'save-btn'     => 'ذخیره وضعیت RMA',
                        'status'       => 'وضعیت',
                        'success'      => 'وضعیت RMA با موفقیت ایجاد شد.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ویرایش وضعیت RMA',
                        'mass-update-success' => 'وضعیت RMA انتخاب شده با موفقیت به‌روزرسانی شد.',
                        'reason'              => 'وضعیت RMA',
                        'save-btn'            => 'ذخیره وضعیت RMA',
                        'status'              => 'وضعیت',
                        'success'             => 'وضعیت RMA با موفقیت به‌روزرسانی شد.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'ایجاد دلیل RMA',
                        'title'      => 'دلایل',

                        'datagrid' => [
                            'created-at'          => 'ایجاد شده در',
                            'delete-success'      => 'دلیل با موفقیت حذف شد.',
                            'disabled'            => 'غیرفعال',
                            'enabled'             => 'فعال',
                            'id'                  => 'شناسه',
                            'mass-delete-success' => 'اطلاعات انتخاب شده با موفقیت حذف شدند',
                            'reason-error'        => 'این دلیل در RMA استفاده شده است.',
                            'reason'              => 'دلیل',
                            'status'              => 'وضعیت',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'افزودن دلیل جدید',
                        'reason'       => 'دلیل',
                        'save-btn'     => 'ذخیره دلیل',
                        'status'       => 'وضعیت',
                        'success'      => 'دلیل با موفقیت ایجاد شد.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ویرایش دلیل',
                        'mass-update-success' => 'دلایل انتخاب شده با موفقیت به روز شدند.',
                        'reason'              => 'دلیل',
                        'save-btn'            => 'ذخیره دلیل',
                        'status'              => 'وضعیت',
                        'success'             => 'دلیل با موفقیت به روز شد.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'اضافه کردن فیلد جدید',
                        'title'      => 'فیلدهای سفارشی RMA',

                        'datagrid' => [
                            'created-at'          => 'ایجاد شده در',
                            'delete-success'      => 'فیلدهای سفارشی با موفقیت حذف شدند.',
                            'disabled'            => 'غیرفعال',
                            'enabled'             => 'فعال',
                            'id'                  => 'شناسه',
                            'mass-delete-success' => 'داده‌های انتخاب شده با موفقیت حذف شدند',
                            'status'              => 'وضعیت',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'فیلد سفارشی جدید',
                        'save-btn'     => 'ذخیره فیلد سفارشی',
                        'status'       => 'وضعیت',
                        'success'      => 'فیلد سفارشی با موفقیت ایجاد شد.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ویرایش فیلد سفارشی',
                        'mass-update-success' => 'فیلدهای سفارشی انتخاب شده با موفقیت به‌روزرسانی شدند.',
                        'reason'              => 'فیلد سفارشی',
                        'save-btn'            => 'ذخیره فیلد سفارشی',
                        'status'              => 'وضعیت',
                        'success'             => 'فیلد سفارشی با موفقیت به‌روزرسانی شد.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'ایجاد قوانین RMA',
                        'title'      => 'قوانین RMA',

                        'datagrid' => [
                            'delete-success'      => 'قوانین RMA با موفقیت حذف شدند.',
                            'disabled'            => 'غیرفعال',
                            'enabled'             => 'فعال',
                            'exchange-period'     => 'دوره تعویض (روزها)',
                            'id'                  => 'شناسه',
                            'mass-delete-success' => 'داده‌های انتخاب شده با موفقیت حذف شدند.',
                            'reason'              => 'قوانین',
                            'return-period'       => 'دوره بازگشت (روزها)',
                            'status'              => 'وضعیت',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'افزودن قوانین جدید RMA',
                        'reason'             => 'قوانین RMA',
                        'rule-description'   => 'توضیحات قوانین',
                        'rule-details'       => 'جزئیات قوانین',
                        'resolutions-period' => 'دوره راه‌حل‌ها',
                        'rules-title'        => 'عنوان قوانین',
                        'save-btn'           => 'ذخیره قوانین RMA',
                        'status'             => 'وضعیت RMA',
                        'success'            => 'قوانین RMA با موفقیت ایجاد شدند.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ویرایش قوانین RMA',
                        'mass-update-success' => 'قوانین RMA انتخاب شده با موفقیت به‌روزرسانی شدند.',
                        'reason'              => 'قوانین RMA',
                        'save-btn'            => 'به‌روزرسانی قوانین RMA',
                        'status'              => 'وضعیت',
                        'success'             => 'قوانین RMA با موفقیت به‌روزرسانی شدند.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA با موفقیت ایجاد شد.',
                    'create-title'             => 'ایجاد RMA',
                    'email'                    => 'ایمیل',
                    'image'                    => 'تصویر',
                    'invalid-order-id'         => 'شناسه سفارش نامعتبر است',
                    'mismatch'                 => 'شناسه سفارش و ایمیل مطابقت ندارند',
                    'new-rma'                  => 'RMA جدید',
                    'order-id'                 => 'شناسه سفارش',
                    'quantity'                 => 'تعداد',
                    'reason'                   => 'دلیل',
                    'rma-already-exist'        => 'این RMA از قبل وجود دارد',
                    'rma-not-available-quotes' => 'مورد برای RMA در دسترس نیست',
                    'save-btn'                 => 'ذخیره',
                    'search'                   => '--انتخاب--',
                    'validate'                 => 'اعتبارسنجی',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA با موفقیت ایجاد شد',
                    'rma-created-message'  => 'درخواست RMA برای محصول با مقدار :qty موجود است'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'حذف',
            'edit'        => 'ویرایش',
            'mass-delete' => 'حذف گروهی',
            'mass-update' => 'به روزرسانی گروهی',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'تحویل داده شده',
            'menu-name'    => 'RMA',
            'offer'        => 'تا 40% تخفیف در سفارش اول شما',
            'rma-qty'      => 'تعداد RMA',
            'shop-now'     => 'خرید کنید',
            'submit-req'   => 'ارسال درخواست',
            'title'        => 'RMA',
            'undelivered'  => 'تحویل نشده',

            'create' => [
                'cancel'                   => 'انصراف',
                'create-btn'               => 'ذخیره',
                'enter-order-id'           => 'شناسه سفارش را وارد کنید',
                'heading'                  => 'درخواست جدید RMA',
                'exchange-window'          => 'پنجره تبادل',
                'image'                    => 'تصویر',
                'images'                   => 'تصاویر',
                'information'              => 'اطلاعات اضافی',
                'item-ordered'             => 'آیتم سفارش داده شده',
                'no-record'                => 'رکوردی یافت نشد!',
                'not-allowed'              => 'امکان RMA برای سفارش معلق وجود ندارد',
                'order-status'             => 'وضعیت سفارش',
                'orders'                   => 'سفارشات',
                'price'                    => 'قیمت',
                'product-name'             => 'نام محصول',
                'product'                  => 'محصول',
                'quantity'                 => 'تعداد',
                'reason'                   => 'دلیل',
                'reopen-request'           => 'باز کردن درخواست',
                'resolution'               => 'انتخاب رزولوشن',
                'return-window'            => 'پنجره بازگشت',
                'rma-not-available-quotes' => 'مورد برای RMA در دسترس نیست',
                'save'                     => 'ذخیره',
                'search-order'             => 'جستجوی سفارش',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'بستن RMA:',
                'order-status' => 'وضعیت سفارش:',
                'rma-status'   => 'وضعیت RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'انصراف',
                'create-btn'               => 'ذخیره',
                'enter-order-id'           => 'شناسه سفارش را وارد کنید',
                'heading'                  => 'درخواست جدید RMA',
                'image'                    => 'تصویر',
                'images'                   => 'تصاویر',
                'information'              => 'اطلاعات اضافی',
                'item-ordered'             => 'آیتم سفارش داده شده',
                'not-allowed'              => 'امکان RMA برای سفارش معلق وجود ندارد',
                'order-status'             => 'وضعیت سفارش',
                'orders'                   => 'سفارشات',
                'price'                    => 'قیمت',
                'product-name'             => 'نام محصول',
                'product'                  => 'محصول',
                'quantity'                 => 'تعداد',
                'reason'                   => 'دلیل',
                'reopen-request'           => 'باز کردن درخواست',
                'resolution'               => 'انتخاب رزولوشن',
                'rma-not-available-quotes' => 'مورد برای RMA در دسترس نیست',
                'save'                     => 'ذخیره',
                'search-order'             => 'جستجوی سفارش',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'درخواست جدید RMA',
                'delete'  => 'حذف',
                'edit'    => 'ویرایش',
                'guest'   => 'پنل RMA مهمان',
                'heading' => 'پنل RMA مشتری',
                'update'  => 'به روز رسانی',
                'view'    => 'مشاهده',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'ایجاد',
            'delete'  => 'حذف',
            'edit'    => 'ویرایش',
            'guest'   => 'پنل RMA مهمان',
            'heading' => 'RMA',
            'update'  => 'به روز رسانی',
            'view'    => 'مشاهده',
        ],

        'validation' => [
            'close-rma'     => 'تأیید',
            'information'   => 'اطلاعات اضافی',
            'order-id'      => 'انتخاب سفارش',
            'order-status'  => 'وضعیت سفارش',
            'orders'        => 'سفارشات',
            'resolution'    => 'رزولوشن',
            'select-orders' => 'انتخاب سفارش',
        ],

        'conversation-texts' => [
            'by'        => 'توسط',
            'customer'  => 'مشتری',
            'no-record' => 'رکوردی یافت نشد!',
            'on'        => 'در تاریخ',
            'seller'    => 'فروشنده',
        ],

        'default-option' => [
            'others'              => 'دیگر',
            'please-select-value' => 'لطفاً مقدار را انتخاب کنید',
            'select-order-status' => 'انتخاب وضعیت سفارش',
            'select-order'        => 'انتخاب سفارش',
            'select-quantity'     => 'انتخاب تعداد',
            'select-reason'       => 'انتخاب دلیل',
            'select-resolution'   => 'انتخاب رزولوشن',
            'select-seller'       => 'انتخاب فروشنده',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'اطلاعات اضافی:',
            'admin'                   => 'مدیر',
            'cancel-order'            => 'لغو سفارش',
            'change-rma-status'       => 'تغییر وضعیت RMA',
            'close-rma'               => 'بستن RMA:',
            'conversations'           => 'گفتگوها',
            'guest'                   => 'مهمان',
            'heading'                 => 'جزئیات RMA',
            'images'                  => 'تصاویر:',
            'items-request'           => 'آیتم‌های درخواست شده برای RMA',
            'items-requested-for-rma' => 'آیتم‌های درخواست شده برای RMA',
            'order-id'                => 'شناسه سفارش:',
            'refund-details'          => 'جزئیات بازپرداخت',
            'refund-offline-btn'      => 'بازپرداخت آفلاین',
            'refundable-amount'       => 'مبلغ قابل بازپرداخت',
            'resolution-type'         => 'نوع رزولوشن:',
            'rma'                     => 'RMA',
            'save-btn'                => 'ذخیره',
            'send-message-btn'        => 'ارسال',
            'send-message'            => 'ارسال پیام',
            'status-details'          => 'جزئیات وضعیت',
            'status-quotes'           => 'لطفاً برای نشانه‌گذاری به عنوان حل شده موافقت کنید',
            'status-reopen'           => 'برای باز کردن مجدد بررسی کنید',
            'status'                  => 'وضعیت',
            'term'                    => 'موافقت با فیلد نشانه‌گذاری الزامی است',
            'you'                     => 'مدیر',
        ],

        'view-guest-rma' => [
            'additional-information' => 'اطلاعات اضافی:',
            'admin'                  => 'مدیر',
            'close-rma'              => 'بستن RMA',
            'conversations'          => 'گفتگوها',
            'guest'                  => 'شما',
            'images'                 => 'تصاویر',
            'items-request'          => 'آیتم‌های درخواست شده برای RMA',
            'order-id'               => 'شناسه سفارش:',
            'refund-offline-btn'     => 'بازپرداخت آفلاین',
            'resolution-type'        => 'نوع رزولوشن:',
            'rma'                    => 'RMA',
            'save-btn'               => 'ذخیره',
            'send-message-btn'       => 'ارسال',
            'send-message'           => 'ارسال پیام',
            'status-details'         => 'جزئیات وضعیت',
            'status-quotes'          => 'لطفاً برای نشانه‌گذاری به عنوان حل شده موافقت کنید.',
            'status'                 => 'وضعیت',
            'term'                   => 'موافقت با فیلد نشانه‌گذاری الزامی است',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'مبلغ کل',
            'order-status' => 'وضعیت سفارش:',
            'request-on'   => 'درخواست در تاریخ:',
            'rma-status'   => 'وضعیت RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'وضعیت مدیر:',
            'close-rma'               => 'بستن RMA',
            'consignment-no'          => 'شماره حمل و نقل:',
            'enter-message'           => 'وارد کردن پیام',
            'full-amount'             => 'مبلغ کل',
            'order-details'           => 'جزئیات سفارش',
            'order-status'            => 'وضعیت سفارش:',
            'partial-amount'          => 'مبلغ جزئی',
            'refundable-amount'       => 'مبلغ قابل بازپرداخت:',
            'request-on'              => 'درخواست در تاریخ:',
            'rma-status'              => 'وضعیت RMA:',
            'seller'                  => 'فروشنده',
            'total-refundable-amount' => 'مجموع مبلغ قابل بازپرداخت:',
        ],

        'table-heading' => [
            'image'           => 'تصویر',
            'product-name'    => 'نام محصول',
            'sku'             => 'کد محصول',
            'price'           => 'قیمت',
            'rma-qty'         => 'تعداد RMA',
            'order-qty'       => 'تعداد سفارش',
            'resolution-type' => 'نوع راه حل',
            'reason'          => 'دلیل',
        ],

        'guest-users' => [
            'button-text' => 'ورود',
            'email'       => 'ایمیل',
            'heading'     => 'پنل ورود مهمان',
            'logout'      => 'خروج مهمان',
            'order-id'    => 'شناسه سفارش',
            'title'       => 'ورود مهمان',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'اطلاعات اضافی :',
            'greeting'               => 'شما درخواست جدید RMA برای سفارش :order_id داده‌اید.',
            'heading'                => 'درخواست RMA',
            'hello'                  => 'عزیز :name',
            'order-id'               => 'شناسه سفارش :',
            'order-status'           => 'وضعیت سفارش :',
            'requested-rma-product'  => 'محصول درخواست شده برای RMA:',
            'resolution-type'        => 'نوع راه‌حل :',
            'rma-id'                 => 'شناسه RMA :',
            'summary'                => 'خلاصه RMA سفارش',
            'thank-you'              => 'با تشکر',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'نام محصول',
            'qty'          => 'تعداد',
            'reason'       => 'دلیل',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'عزیز :name',
            'message' => 'پیام',
            'quotes'  => 'یک پیام جدید از خریدار وجود دارد',
            'process' => 'درخواست بازگشت شما در حال پردازش است.',
            'solved'  => 'وضعیت RMA توسط مشتری به حل شده تغییر یافته است.', 
        ],

        'seller-conversation' => [
            'heading' => 'عزیز :name',
            'message' => 'پیام',
            'quotes'  => 'پیام جدیدی از طرف مدیریت موجود است',
            'title'   => 'پیام دریافت شده!',
        ],

        'status' => [
            'heading'       => 'عزیز :name',
            'quotes'        => 'وضعیت RMA شما توسط فروشنده تغییر کرده است',
            'rma-id'        => 'شناسه RMA',
            'status-change' => 'وضعیت :id توسط فروشنده تغییر کرده است',
            'status'        => 'وضعیت',
            'title'         => 'وضعیت به روز شد!',
            'your-rma-id'   => 'شناسه RMA شما',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'پذیرفته شده',
            'awaiting'                 => 'در انتظار',
            'canceled'                 => 'لغو شد', 
            'declined'                 => 'رد شده',
            'dispatched-package'       => 'ارسال پکیج',
            'item-canceled'            => 'لغو مورد',
            'not-received-package-yet' => 'هنوز پکیج دریافت نشده',
            'pending'                  => 'در انتظار',
            'processing'               => 'در حال پردازش',
            'received-package'         => 'دریافت پکیج',
            'solved'                   => 'حل شده',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA توسط مدیر رد شده است.',
            'declined-buyer'  => 'RMA توسط خریدار رد شده است.',
            'solved-by-admin' => 'RMA توسط مدیر حل شده است.',
            'solved'          => 'RMA حل شده است.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'وضعیت RMA قبلاً لغو شده است.',
        'cancel-success'    => 'وضعیت RMA با موفقیت لغو شد.',
        'create-success'    => 'درخواست با موفقیت ایجاد شد.',
        'creation-error'    => 'وضعیت RMA نمی‌تواند به‌روزرسانی شود زیرا فاکتور برای این سفارش ایجاد نشده است.',
        'permission-denied' => 'شما وارد شده‌اید',
        'rma-disabled'      => 'RMA برای این محصول غیرفعال است',
        'send-message'      => ':name با موفقیت ارسال شد.',
        'update-success'    => ':name با موفقیت به‌روزرسانی شد.',
    ],
];