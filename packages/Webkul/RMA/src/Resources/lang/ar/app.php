<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'السما�� بطلب ��ديد للطلبات المعلقة',
                        'allow-rma-for-digital-product'       => 'السما�� بالطلبات المرتجعة للمنتجات الرقمية',
                        'default-allow-days'                  => 'الأيام الافترا��ية المسموح بها',
                        'enable'                              => 'تمكين',
                        'info'                                => 'الطلب المرتجع (RMA) هو ��ز�� من عملية ا��ترجا�� المنتج للشركة للحصول على ا��ترداد أو ا��تبدال أو ��صلا��.',
                        'title'                               => 'الطلب المرتجع (RMA)',

                        'setting' => [
                            'info'  => 'يتيح و��يفة الطلب المرتجع (RMA) التعامل مع الحالات عندما يرجع العميل عن العناوين لصيانة و��صلا��، أو للحصول على ا��ترداد أو ا��تبدال.',
                            'title' => 'الطلب المرتجع (RMA)',
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
                    'rma-title'        => 'كل RMA',
                    'reason-title'     => 'الأسباب',
                    'create-rma-title' => '��نشا�� RMA',

                    'all-rma' => [
                        'index' => [
                            'title' => 'كل RMA',

                            'datagrid' => [
                                'id'        => 'معرف RMA',
                                'order-ref' => 'مرجع الطلب',
                                'status'    => 'الحالة',
                                'create'    => 'تم ال��نشا�� في',
                            ],
                        ],

                        'view' => [
                            'title'                  => 'RMA',
                            'view-title'             => 'RMA',
                            'order-id'               => ' معرف الطلب :',
                            'request-on'             => 'تم الطلب في :',
                            'customer'               => 'العميل :',
                            'resolution-type'        => 'نوع الحل :',
                            'additional-information' => 'معلومات ��ضافية :',
                            'images'                 => 'صورة :',
                            'order-details'          => 'تفا��يل الطلب',
                            'status'                 => 'الحالة',
                            'rma-status'             => 'حالة RMA :',
                            'order-status'           => 'حالة الطلب :',
                            'change-status'          => 'تغيير الحالة',
                            'conversations'          => 'المحادثات',
                            'save-btn'               => 'حف��',
                            'send-message'           => '��رسال رسالة',
                            'enter-message'          => 'أدخل الرسالة',
                            'send-message-btn'       => '��رسال رسالة',
                            'send-message-success'   => 'تم ��رسال الرسالة بنجا��.',
                            'update-success'         => 'تم تحديث حالة RMA بنجا��.',
                        ],
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'الأسباب',
                        'create-btn' => '��نشا�� سبب RMA',

                        'datagrid' => [
                            'id'                  => 'المعرف',
                            'reason'              => 'السبب',
                            'status'              => 'الحالة',
                            'created-at'          => 'تم ال��نشا�� في',
                            'enabled'             => 'مفعل',
                            'disabled'            => 'غير مفعل',
                            'delete-success'      => 'تم حذف السبب بنجا��.',
                            'mass-delete-success' => 'تم حذف السببين بنجا��.',
                            'reason-error'        => 'السبب مستخدم في RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => '��ضافة سبب ��ديد',
                        'save-btn'       => 'حف�� السبب',
                        'reason'         => 'السبب',
                        'status'         => 'الحالة',
                        'create-success' => 'تم ��نشا�� السبب بنجا��.',
                    ],

                    'edit' => [
                        'edit-title'          => 'تعديل السبب',
                        'save-btn'            => 'حف�� السبب',
                        'reason'              => 'السبب',
                        'status'              => 'الحالة',
                        'mass-update-success' => 'تم تحديث الأسباب المحددة بنجا��.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => '��نشا�� RMA',
                    'order-id'          => 'معرف الطلب',
                    'email'             => 'البريد ال��لكتروني',
                    'validate'          => 'التحقق',
                    'rma-already-exist' => 'الطلب المرتجع موجود بالفعل',
                    'mismatch'          => 'معرف الطلب والبريد ال��لكتروني ��ير متطابقين',
                    'invalid-order-id'  => 'معرف الطلب ��ير ��الح',
                    'quantity'          => 'الكمية',
                    'reason'            => 'السبب',
                    'save-btn'          => 'حف��',
                    'create-success'    => 'تم ��نشا�� RMA بنجا��.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA Return',
            'offer'        => 'ا��صل على 40�� من الخصم حتى 50�� على أول ��لبك',
            'shop-now'     => 'تسوق ال��ن',

            'create' => [
                'heading'                  => 'طلب ��لب مرتجع ��ديد',
                'create-btn'               => 'حف��',
                'orders'                   => 'الطلبات',
                'resolution'               => 'حدد الحل',
                'item-ordered'             => 'العنصر المطلوب',
                'images'                   => 'الصور',
                'information'              => 'معلومات ��ضافية',
                'order-status'             => 'حالة الطلب',
                'product'                  => 'المنتج',
                'sku'                      => 'SKU',
                'price'                    => 'السعر',
                'search-order'             => 'بحث عن الطلب',
                'enter-order-id'           => 'أدخل معرف الطلب',
                'not-allowed'              => 'لا يسمح بطلب RMA للطلب المعلق',
                'image'                    => 'صورة',
                'quantity'                 => 'الكمية',
                'reason'                   => 'السبب',
                'rma-not-available-quotes' => 'العنصر ��ير متا�� للطلب المرتجع',
                'product-name'             => 'ا��م المنتج',
                'reopen-request'           => '��عادة فتح الطلب',
                'save'                     => 'حف��',
                'cancel'                   => '��لغا��',
            ],
        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'حالة RMA :',
                'order-status' => 'حالة الطلب :',
                'close-rma'    => '��غلاق RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'طلب ��ديد لل��رجا��',
                'create-btn'               => 'حف��',
                'orders'                   => 'الطلبات',
                'resolution'               => 'حدد الحل',
                'item-ordered'             => 'العنصر المطلوب',
                'images'                   => 'الصور',
                'information'              => 'معلومات ��ضافية',
                'order-status'             => 'حالة الطلب',
                'product'                  => 'المنتج',
                'sku'                      => 'SKU',
                'price'                    => 'السعر',
                'search-order'             => 'بحث عن الطلب',
                'enter-order-id'           => 'أدخل معرف الطلب',
                'not-allowed'              => 'لا يسمح بطلب RMA للطلب المعلق',
                'image'                    => 'صورة',
                'quantity'                 => 'الكمية',
                'reason'                   => 'السبب',
                'rma-not-available-quotes' => 'العنصر ��ير متا�� لل��رجا��',
                'product-name'             => 'ا��م المنتج',
                'reopen-request'           => '��عادة فتح الطلب',
                'save'                     => 'حف��',
                'cancel'                   => '��لغا��',
                'reopen-request'           => '��عادة فتح الطلب',
            ],

            'index' => [
                'create'  => 'طلب ��ديد لل��رجا��',
                'heading' => 'لوحة التحكم لعميل RMA',
                'view'    => 'عرض',
                'edit'    => 'تعديل',
                'delete'  => 'حذف',
                'update'  => 'تحديث',
                'guest'   => 'لوحة التحكم لعميل ��ير مسجل',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'طلب ��ديد لل��رجا��',
            'heading' => 'لوحة التحكم لعميل RMA',
            'view'    => 'عرض',
            'edit'    => 'تعديل',
            'delete'  => 'حذف',
            'update'  => 'تحديث',
            'guest'   => 'لوحة التحكم لعميل ��ير مسجل',
        ],

        'validation' => [
            'orders'       => 'الطلبات',
            'resolution'   => 'الحل',
            'information'  => 'معلومات ��ضافية',
            'order-status' => 'حالة الطلب',
            'order-id'     => 'تحديد الطلب',
            'close-rma'    => 'تأكيد',
        ],

        'conversation-texts' => [
            'by'       => 'بوا��طة',
            'seller'   => 'البا��ع',
            'customer' => 'العميل',
            'on'       => 'في',
        ],

        'default-option' => [
            'please-select-value' => 'الرجا�� تحديد القيمة',
            'select-quantity'     => 'حدد الكمية',
            'select-reason'       => 'حدد السبب',
            'others'              => '��خرون',
            'select-order-status' => 'حدد حالة الطلب',
            'select-resolution'   => 'حدد الحل',
            'select-seller'       => 'حدد البا��ع',
            'select-order'        => 'حدد الطلب',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'ضيف',
            'heading'                 => 'تفا��يل RMA',
            'status'                  => 'الحالة',
            'order-id'                => ' معرف الطلب :',
            'refund-details'          => 'تفا��يل الا��ترداد',
            'resolution-type'         => 'نوع الحل :',
            'additional-information'  => 'معلومات ��ضافية :',
            'change-rma-status'       => 'تغيير حالة RMA',
            'save-btn'                => 'حف��',
            'you'                     => 'المشرف',
            'send-message-btn'        => '��رسال',
            'items-requested-for-rma' => 'العنا��ر المطلوبة لل��رجا��',
            'refund-offline-btn'      => 'ا��ترداد المبلغ خارج ال��نترنت',
            'send-message'            => '��رسال رسالة',
            'conversations'           => 'المحادثات',
            'cancel-order'            => '��لغا�� الطلب',
            'status-details'          => 'تفا��يل الحالة',
            'admin'                   => 'المشرف',
            'status-quotes'           => 'يرجى الموافقة على وضعها كمحلولة.',
            'close-rma'               => '��غلاق RMA :',
            'images'                  => 'صور',
            'items-request'           => 'العنا��ر المطلوبة لل��رجا��',
            'refundable-amount'       => 'المبلغ المسترد',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'نوع الحل :',
            'guest'                  => 'أنت',
            'status'                 => 'الحالة',
            'order-id'               => ' معرف الطلب :',
            'additional-information' => 'معلومات ��ضافية :',
            'save-btn'               => 'حف��',
            'send-message-btn'       => '��رسال',
            'refund-offline-btn'     => 'ا��ترداد المبلغ خارج ال��نترنت',
            'send-message'           => '��رسال رسالة',
            'conversations'          => 'المحادثات',
            'status-details'         => 'تفا��يل الحالة',
            'admin'                  => 'المشرف',
            'status-quotes'          => 'يرجى الموافقة على وضعها كمحلولة.',
            'close-rma'              => '��غلاق RMA',
            'images'                 => 'صور',
            'items-request'          => 'العنا��ر المطلوبة لل��رجا��',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'حالة RMA :',
            'order-status' => 'حالة الطلب :',
            'full-amount'  => 'المبلغ الكامل',
            'request-on'   => 'تم الطلب في :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => '��غلاق RMA',
            'rma-status'              => 'حالة RMA :',
            'admin-status'            => 'حالة المشرف:',
            'order-status'            => 'حالة الطلب :',
            'consignment-no'          => 'رقم التعليمات البريدية:',
            'refundable-amount'       => 'المبلغ المسترد:',
            'full-amount'             => 'المبلغ الكامل',
            'partial-amount'          => 'المبلغ الجز��ي',
            'total-refundable-amount' => 'المبلغ المسترد الكلي:',
            'enter-message'           => 'أدخل الرسالة',
            'request-on'              => 'تم الطلب في :',
            'seller'                  => 'البا��ع',
            'order-details'           => 'تفا��يل الطلب',
        ],

        'table-heading' => [
            'product-name' => 'ا��م المنتج',
            'sku'          => 'SKU',
            'price'        => 'السعر',
            'qty'          => 'الكمية',
            'reason'       => 'السبب',
        ],

        'guest-users' => [
            'heading'     => 'لوحة تسجيل دخول الضيف',
            'order-id'    => 'معرف الطلب',
            'email'       => 'البريد ال��لكتروني',
            'button-text' => 'تسجيل الدخول',
            'title'       => 'تسجيل دخول الضيف',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'طلب RMA',
            'hello'                  => 'عزيزي :name',
            'greeting'               => 'لقد ��لبت ��لب RMA ��ديد للطلب :order_id.',
            'rma-id'                 => 'معرف RMA :',
            'summary'                => 'ملخص RMA الطلب',
            'order-id'               => 'معرف الطلب :',
            'order-status'           => 'حالة الطلب :',
            'resolution-type'        => 'نوع الحل :',
            'additional-information' => 'معلومات ��ضافية :',
            'thank-you'              => 'شكرا�� لك',
            'requested-rma-product'  => 'منتجات RMA المطلوبة:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'ا��م المنتج',
            'sku'          => 'SKU',
            'qty'          => 'الكمية',
            'reason'       => 'السبب',
        ],

        'customer-conversation' => [
            'heading' => 'عزيزي :name,',
            'quotes'  => 'لديك رسالة ��ديدة من المشتري',
            'message' => 'الرسالة',
        ],

        'seller-conversation' => [
            'heading' => 'عزيزي :name',
            'quotes'  => 'لديك رسالة ��ديدة من البا��ع',
            'message' => 'الرسالة',
            'title'   => 'تم ا��تلام الرسالة!',
        ],

        'status' => [
            'heading'       => 'عزيزي :name',
            'quotes'        => 'تم تغيير حالة RMA الخا��ة بك من قبل البا��ع',
            'rma-id'        => 'معرف RMA',
            'your-rma-id'   => 'معرف RMA الخا�� بك',
            'status-change' => 'تم تغيير حالة :id من قبل البا��ع',
            'status'        => 'الحالة',
            'title'         => 'تم تحديث الحالة!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'قيد الانت��ار',
            'processing'               => 'قيد المعالجة',
            'item-canceled'            => 'تم ��لغا�� العنصر',
            'solved'                   => 'تم حلها',
            'declined'                 => 'مرفوض',
            'received-package'         => 'تم ا��تلام الطرد',
            'dispatched-package'       => 'تم ��رسال الطرد',
            'not-received-package-yet' => 'لم يتم ا��تلام الطرد بعد',
            'accept'                   => 'قبول',
        ],

        'status-quotes' => [
            'declined-admin'  => 'تم رفض RMA من قبل المشرف.',
            'declined-buyer'  => 'تم رفض RMA من قبل المشتري.',
            'solved'          => 'تم حل RMA.',
            'solved-by-admin' => 'تم حل RMA من قبل المشرف.',
        ],
    ],

    'response' => [
        'create-success' => ':name تم ��نشا�� بنجا��.',
        'send-message'   => ':name تم ��رسال بنجا��.',
        'update-success' => ':name تم تحديث بنجا��.',
    ],
];
