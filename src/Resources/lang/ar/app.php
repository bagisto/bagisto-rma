<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'بعد الظهر',
                        'all-products'                        => 'جميع المنتجات',
                        'all-status'                          => 'جميع الحالات',
                        'allow-new-request-for-pending-order' => 'السماح بطلب RMA جديد للطلب المعلق',
                        'allow-rma-for-digital-product'       => 'السماح بـ RMA للمنتجات الرقمية',
                        'allowed-file-extension'              => 'الامتدادات المسموح بها للملفات',
                        'allowed-file-types'                  => 'يرجى اختيار أنواع الملفات ' . core()->getConfigData('sales.rma.setting.allowed-file-extension') . ' فقط',
                        'allowed-info'                        => 'مفصولة بفواصل. على سبيل المثال: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'السماح بطلب RMA جديد للطلبات الملغاة',
                        'allowed-request-declined-request'    => 'السماح بطلب RMA جديد للطلبات المرفوضة',
                        'allowed-rma-for-product'             => 'السماح بـ RMA للمنتج',
                        'cancel-items'                        => 'إلغاء العناصر',
                        'complete'                            => 'مكتمل',
                        'current-order-quantity'              => 'الكمية الحالية للطلب',
                        'days-info'                           => 'عدد الأيام التي يمكن خلالها للعميل طلب RMA بعد تقديم الطلب.',
                        'default-allow-days'                  => 'الأيام المسموح بها افتراضيًا',
                        'enable'                              => 'تمكين RMA',
                        'evening'                             => 'مساءً',
                        'exchange'                            => 'استبدال',
                        'info'                                => 'RMA هو جزء من عملية إرجاع المنتج إلى النشاط التجاري للحصول على استرداد أو استبدال أو إصلاح.',
                        'morning'                             => 'صباحًا',
                        'new-rma-message-to-customer'         => 'رسالة RMA جديدة إلى العميل',
                        'no'                                  => 'لا',
                        'open'                                => 'مفتوح',
                        'package-condition'                   => 'حالة العبوة',
                        'packed'                              => 'معبأة',
                        'print-page'                          => 'طباعة الصفحة',
                        'product-already-raw'                 => 'المنتج موجود بالفعل في RMA.',
                        'product-delivery-status'             => 'حالة تسليم المنتج',
                        'resolution-type'                     => 'نوع الحل',
                        'return-pickup-address'               => 'عنوان استلام الإرجاع',
                        'return-pickup-time'                  => 'وقت استلام الإرجاع',
                        'return-policy'                       => 'سياسة الإرجاع',
                        'return'                              => 'إرجاع',
                        'select-allowed-order-status'         => 'اختر حالة الطلب المسموح بها',
                        'specific-products'                   => 'منتجات محددة',
                        'title'                               => 'RMA',
                        'yes'                                 => 'نعم',

                        'setting' => [
                            'info'  => 'تتيح وظيفة RMA التعامل مع الحالات التي يعيد فيها العميل العناصر للإصلاح والصيانة أو لاسترداد الأموال أو الاستبدال.',
                            'read'  => 'قراءة السياسة',
                            'terms' => 'لقد قرأت وقبلت سياسة الإرجاع.', 
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
                    'create-rma-title' => 'إنشاء طلب RMA',
                    'reason-title'     => 'الأسباب',
                    'rma-title'        => 'جميع طلبات RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'جميع طلبات RMA',

                        'datagrid' => [
                            'create'        => 'تم الإنشاء في',
                            'customer-name' => 'اسم العميل',
                            'id'            => 'معرف RMA',
                            'order-ref'     => 'رقم الطلب',
                            'order-status'  => 'حالة الطلب',
                            'rma-status'    => 'حالة RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'إضافة مرفقات',
                        'additional-information' => 'معلومات إضافية:',
                        'attachment'             => 'مرفق',
                        'change-status'          => 'تغيير الحالة',
                        'confirm-print'          => 'انقر على موافق لطباعة RMA',
                        'conversations'          => 'المحادثات',
                        'customer-details'       => 'تفاصيل العميل',
                        'customer-email'         => 'بريد العميل الإلكتروني:',
                        'customer'               => 'العميل:',
                        'enter-message'          => 'أدخل الرسالة',
                        'images'                 => 'صورة:',
                        'no-record'              => 'لم يتم العثور على سجل!',
                        'order-date'             => 'تاريخ الطلب:',
                        'order-details'          => 'العناصر المطلوبة لـ RMA',
                        'order-id'               => 'رقم الطلب:',
                        'order-status'           => 'حالة الطلب:',
                        'order-total'            => 'إجمالي الطلب:',
                        'request-on'             => 'تم الطلب في:',
                        'resolution-type'        => 'نوع الحل:',
                        'rma-status'             => 'حالة RMA:',
                        'save-btn'               => 'حفظ',
                        'send-message-btn'       => 'إرسال الرسالة',
                        'send-message-success'   => 'تم إرسال الرسالة بنجاح.',
                        'send-message'           => 'إرسال الرسالة',
                        'status'                 => 'الحالة',
                        'title'                  => 'RMA',
                        'update-success'         => 'تم تحديث حالة RMA بنجاح.',
                        'view-title'             => 'RMA',
                    ],
                ],
                
                'rma-status' => [
                    'index' => [
                        'create-btn' => 'إنشاء حالة RMA',
                        'title'      => 'حالة RMA',

                        'datagrid' => [
                            'created-at'          => 'تم الإنشاء في',
                            'delete-success'      => 'تم حذف حالة RMA بنجاح.',
                            'disabled'            => 'غير نشط',
                            'enabled'             => 'نشط',
                            'id'                  => 'معرف',
                            'mass-delete-success' => 'تم حذف حالة RMA المحددة بنجاح.',
                            'reason-error'        => 'حالة RMA مستخدمة في RMA.',
                            'reason'              => 'حالة RMA',
                            'status'              => 'الحالة',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'إضافة حالة RMA جديدة',
                        'reason'       => 'حالة RMA',
                        'save-btn'     => 'حفظ حالة RMA',
                        'status'       => 'الحالة',
                        'success'      => 'تم إنشاء حالة RMA بنجاح.',
                    ],

                    'edit' => [
                        'edit-title'          => 'تعديل حالة RMA',
                        'mass-update-success' => 'تم تحديث حالة RMA المحددة بنجاح.',
                        'reason'              => 'حالة RMA',
                        'save-btn'            => 'حفظ حالة RMA',
                        'status'              => 'الحالة',
                        'success'             => 'تم تحديث حالة RMA بنجاح.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'إنشاء سبب RMA',
                        'title'      => 'الأسباب',

                        'datagrid' => [
                            'created-at'          => 'تم الإنشاء في',
                            'delete-success'      => 'تم حذف السبب بنجاح.',
                            'disabled'            => 'غير نشط',
                            'enabled'             => 'نشط',
                            'id'                  => 'المعرف',
                            'mass-delete-success' => 'تم حذف البيانات المحددة بنجاح',
                            'reason-error'        => 'السبب مستخدم في RMA.',
                            'reason'              => 'السبب',
                            'status'              => 'الحالة',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'إضافة سبب جديد',
                        'reason'       => 'السبب',
                        'save-btn'     => 'حفظ السبب',
                        'status'       => 'الحالة',
                        'success'      => 'تم إنشاء السبب بنجاح.',
                    ],

                    'edit' => [
                        'edit-title'          => 'تعديل السبب',
                        'mass-update-success' => 'تم تحديث الأسباب المحددة بنجاح.',
                        'reason'              => 'السبب',
                        'save-btn'            => 'حفظ السبب',
                        'status'              => 'الحالة',
                        'success'             => 'تم تحديث السبب بنجاح.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'إضافة حقل جديد',
                        'title'      => 'حقول مخصصة لـ RMA',

                        'datagrid' => [
                            'created-at'          => 'تم الإنشاء في',
                            'delete-success'      => 'تم حذف الحقول المخصصة بنجاح.',
                            'disabled'            => 'غير نشط',
                            'enabled'             => 'نشط',
                            'id'                  => 'معرّف',
                            'mass-delete-success' => 'تم حذف البيانات المحددة بنجاح',
                            'status'              => 'الحالة',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'حقل مخصص جديد',
                        'save-btn'     => 'حفظ الحقل المخصص',
                        'status'       => 'الحالة',
                        'success'      => 'تم إنشاء الحقل المخصص بنجاح.',
                    ],

                    'edit' => [
                        'edit-title'          => 'تعديل الحقل المخصص',
                        'mass-update-success' => 'تم تحديث الحقول المخصصة المحددة بنجاح.',
                        'reason'              => 'الحقل المخصص',
                        'save-btn'            => 'حفظ الحقل المخصص',
                        'status'              => 'الحالة',
                        'success'             => 'تم تحديث الحقل المخصص بنجاح.',
                    ],
                ],
                
                'rules' => [
                    'index' => [
                        'create-btn' => 'إنشاء قواعد RMA',
                        'title'      => 'قواعد RMA',

                        'datagrid' => [
                            'delete-success'      => 'تم حذف قواعد RMA بنجاح.',
                            'disabled'            => 'غير نشط',
                            'enabled'             => 'نشط',
                            'exchange-period'     => 'فترة التبديل (بالأيام)',
                            'id'                  => 'معرف',
                            'mass-delete-success' => 'تم حذف البيانات المحددة بنجاح.',
                            'reason'              => 'قواعد',
                            'return-period'       => 'فترة الإرجاع (بالأيام)',
                            'status'              => 'الحالة',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'إضافة قواعد RMA جديدة',
                        'reason'             => 'قواعد RMA',
                        'resolutions-period' => 'فترة الحلول',
                        'rule-description'   => 'وصف القواعد',
                        'rule-details'       => 'تفاصيل القواعد',
                        'rules-title'        => 'عنوان القواعد',
                        'save-btn'           => 'حفظ قواعد RMA',
                        'status'             => 'حالة RMA',
                        'success'            => 'تم إنشاء قواعد RMA بنجاح.',
                    ],

                    'edit' => [
                        'edit-title'          => 'تعديل قواعد RMA',
                        'mass-update-success' => 'تم تحديث قواعد RMA المحددة بنجاح.',
                        'reason'              => 'قواعد RMA',
                        'save-btn'            => 'تحديث قواعد RMA',
                        'status'              => 'الحالة',
                        'success'             => 'تم تحديث قواعد RMA بنجاح.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'تم إنشاء RMA بنجاح.',
                    'create-title'             => 'إنشاء طلب RMA',
                    'email'                    => 'البريد الإلكتروني',
                    'image'                    => 'صورة',
                    'invalid-order-id'         => 'معرف الطلب غير صالح',
                    'mismatch'                 => 'عدم تطابق معرف الطلب والبريد الإلكتروني',
                    'new-rma'                  => 'طلب RMA جديد',
                    'order-id'                 => 'معرف الطلب',
                    'quantity'                 => 'الكمية',
                    'reason'                   => 'السبب',
                    'rma-already-exist'        => 'RMA موجود بالفعل',
                    'rma-not-available-quotes' => 'العنصر غير متوفر لـ RMA',
                    'save-btn'                 => 'حفظ',
                    'search'                   => '--اختر--',
                    'validate'                 => 'التحقق',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'تم إنشاء RMA',
                    'rma-created-message'  => 'طلب RMA متاح للمنتج بكمية :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'حذف',
            'edit'        => 'تعديل',
            'mass-delete' => 'حذف جماعي',
            'mass-update' => 'تحديث جماعي',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'تم التوصيل',
            'menu-name'    => 'RMA',
            'offer'        => 'احصل على خصم يصل إلى 40٪ على أول طلب لك',
            'rma-qty'      => 'كمية RMA',
            'shop-now'     => 'تسوق الآن',
            'submit-req'   => 'إرسال الطلب',
            'title'        => 'RMA',
            'undelivered'  => 'غير مُسَلَّم',

            'create' => [
                'cancel'                   => 'إلغاء',
                'create-btn'               => 'حفظ',
                'enter-order-id'           => 'أدخل رقم الطلب',
                'heading'                  => 'طلب RMA جديد',
                'exchange-window'          => 'نافذة التبديل',
                'image'                    => 'صورة',
                'images'                   => 'الصور',
                'information'              => 'معلومات إضافية',
                'item-ordered'             => 'العنصر المطلوب',
                'no-record'                => 'لا توجد سجلات!',
                'not-allowed'              => 'RMA غير مسموح به للطلب المعلق',
                'order-status'             => 'حالة الطلب',
                'orders'                   => 'الطلبات',
                'price'                    => 'السعر',
                'product-name'             => 'اسم المنتج',
                'product'                  => 'المنتج',
                'quantity'                 => 'الكمية',
                'reason'                   => 'السبب',
                'reopen-request'           => 'إعادة فتح الطلب',
                'resolution'               => 'حدد القرار',
                'return-window'            => 'نافذة الإرجاع',
                'rma-not-available-quotes' => 'العنصر غير متاح لـ RMA',
                'save'                     => 'حفظ',
                'search-order'             => 'البحث عن الطلب',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'إغلاق RMA :',
                'order-status' => 'حالة الطلب :',
                'rma-status'   => 'حالة RMA :',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'إلغاء',
                'create-btn'               => 'حفظ',
                'enter-order-id'           => 'أدخل رقم الطلب',
                'heading'                  => 'طلب RMA جديد',
                'image'                    => 'صورة',
                'images'                   => 'الصور',
                'information'              => 'معلومات إضافية',
                'item-ordered'             => 'العنصر المطلوب',
                'not-allowed'              => 'RMA غير مسموح به للطلب المعلق',
                'order-status'             => 'حالة الطلب',
                'orders'                   => 'الطلبات',
                'price'                    => 'السعر',
                'product-name'             => 'اسم المنتج',
                'product'                  => 'المنتج',
                'quantity'                 => 'الكمية',
                'reason'                   => 'السبب',
                'reopen-request'           => 'إعادة فتح الطلب',
                'resolution'               => 'حدد القرار',
                'rma-not-available-quotes' => 'العنصر غير متاح لـ RMA',
                'save'                     => 'حفظ',
                'search-order'             => 'البحث عن الطلب',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'طلب RMA جديد',
                'delete'  => 'حذف',
                'edit'    => 'تعديل',
                'guest'   => 'لوحة تحكم RMA للزوار',
                'heading' => 'لوحة تحكم RMA للعملاء',
                'update'  => 'تحديث',
                'view'    => 'عرض',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'إنشاء',
            'delete'  => 'حذف',
            'edit'    => 'تعديل',
            'guest'   => 'لوحة تحكم RMA للزوار',
            'heading' => 'RMA',
            'update'  => 'تحديث',
            'view'    => 'عرض',
        ],

        'validation' => [
            'close-rma'     => 'تأكيد',
            'information'   => 'معلومات إضافية',
            'order-id'      => 'اختيار الطلب',
            'order-status'  => 'حالة الطلب',
            'orders'        => 'الطلبات',
            'resolution'    => 'القرار',
            'select-orders' => 'اختر الطلب',
        ],

        'conversation-texts' => [
            'by'        => 'من قبل',
            'customer'  => 'العميل',
            'no-record' => 'لا توجد سجلات!',
            'on'        => 'في',
            'seller'    => 'البائع',
        ],

        'default-option' => [
            'others'              => 'أخرى',
            'please-select-value' => 'الرجاء تحديد القيمة',
            'select-order-status' => 'حدد حالة الطلب',
            'select-order'        => 'اختر الطلب',
            'select-quantity'     => 'حدد الكمية',
            'select-reason'       => 'حدد السبب',
            'select-resolution'   => 'حدد القرار',
            'select-seller'       => 'حدد البائع',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'معلومات إضافية :',
            'admin'                   => 'المسؤول',
            'cancel-order'            => 'إلغاء الطلب',
            'change-rma-status'       => 'تغيير حالة RMA',
            'close-rma'               => 'إغلاق RMA :',
            'conversations'           => 'المحادثات',
            'guest'                   => 'زائر',
            'heading'                 => 'تفاصيل RMA',
            'images'                  => 'الصور:',
            'items-request'           => 'العناصر المطلوبة لـ RMA',
            'items-requested-for-rma' => 'العناصر المطلوبة لـ RMA',
            'order-id'                => 'رقم الطلب :',
            'refund-details'          => 'تفاصيل الاسترداد',
            'refund-offline-btn'      => 'استرداد غير متصل بالإنترنت',
            'refundable-amount'       => 'المبلغ المسترد',
            'resolution-type'         => 'نوع القرار :',
            'rma'                     => 'RMA',
            'save-btn'                => 'حفظ',
            'send-message-btn'        => 'إرسال',
            'send-message'            => 'إرسال رسالة',
            'status-details'          => 'تفاصيل الحالة',
            'status-quotes'           => 'الرجاء الموافقة على تحديدها كمحلول',
            'status-reopen'           => 'تحقق لإعادة الفتح',
            'status'                  => 'الحالة',
            'term'                    => 'موافقة الحقل المطلوبة',
            'you'                     => 'المسؤول',
        ],

        'view-guest-rma' => [
            'additional-information' => 'معلومات إضافية :',
            'admin'                  => 'المسؤول',
            'close-rma'              => 'إغلاق RMA',
            'conversations'          => 'المحادثات',
            'guest'                  => 'أنت',
            'images'                 => 'الصور',
            'items-request'          => 'العناصر المطلوبة لـ RMA',
            'order-id'               => 'رقم الطلب :',
            'refund-offline-btn'     => 'استرداد غير متصل بالإنترنت',
            'resolution-type'        => 'نوع القرار :',
            'rma'                    => 'RMA',
            'save-btn'               => 'حفظ',
            'send-message-btn'       => 'إرسال',
            'send-message'           => 'إرسال رسالة',
            'status-details'         => 'تفاصيل الحالة',
            'status-quotes'          => 'الرجاء الموافقة على تحديدها كمحلول.',
            'status'                 => 'الحالة',
            'term'                   => 'موافقة الحقل المطلوبة',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'المبلغ الكامل',
            'order-status' => 'حالة الطلب :',
            'request-on'   => 'الطلب في :',
            'rma-status'   => 'حالة RMA :',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'حالة المسؤول:',
            'close-rma'               => 'إغلاق RMA',
            'consignment-no'          => 'رقم الشحن:',
            'enter-message'           => 'أدخل الرسالة',
            'full-amount'             => 'المبلغ الكامل',
            'order-details'           => 'تفاصيل الطلب',
            'order-status'            => 'حالة الطلب :',
            'partial-amount'          => 'المبلغ الجزئي',
            'refundable-amount'       => 'المبلغ المسترد:',
            'request-on'              => 'الطلب في :',
            'rma-status'              => 'حالة RMA :',
            'seller'                  => 'البائع',
            'total-refundable-amount' => 'المبلغ الكلي المسترد:',
        ],

        'table-heading' => [
            'image'           => 'صورة',
            'order-qty'       => 'كمية الطلب',
            'price'           => 'السعر',
            'product-name'    => 'اسم المنتج',
            'reason'          => 'السبب',
            'resolution-type' => 'نوع الحل',
            'rma-qty'         => 'كمية RMA',
            'sku'             => 'رمز المنتج',
        ],

        'guest-users' => [
            'button-text' => 'تسجيل الدخول',
            'email'       => 'البريد الإلكتروني',
            'heading'     => 'لوحة تسجيل الدخول كضيف',
            'logout'      => 'تسجيل خروج الضيف',
            'order-id'    => 'رقم الطلب',
            'title'       => 'تسجيل الدخول كضيف',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'معلومات إضافية :',
            'greeting'               => 'لقد طلبت RMA جديدة للطلب :order_id.',
            'heading'                => 'طلب RMA',
            'hello'                  => 'عزيزي :name',
            'order-id'               => 'معرف الطلب :',
            'order-status'           => 'حالة الطلب :',
            'requested-rma-product'  => 'منتج RMA المطلوب:',
            'resolution-type'        => 'نوع القرار :',
            'rma-id'                 => 'معرف RMA :',
            'summary'                => 'ملخص RMA للطلب',
            'thank-you'              => 'شكرًا لك',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'اسم المنتج',
            'qty'          => 'الكمية',
            'reason'       => 'السبب',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'عزيزي :name،',
            'message' => 'رسالة',
            'process' => 'طلب الإرجاع الخاص بك قيد المعالجة.',
            'quotes'  => 'هناك رسالة جديدة من المشتري',
            'solved'  => 'تم تغيير حالة RMA إلى تم الحل بواسطة العميل.',
        ],

        'seller-conversation' => [
            'heading' => 'عزيزي :name',
            'message' => 'رسالة',
            'quotes'  => 'هناك رسالة جديدة من الإدارة',
            'title'   => 'تم استلام الرسالة!',
        ],

        'status' => [
            'heading'       => 'عزيزي :name',
            'quotes'        => 'تم تغيير حالة RMA الخاصة بك من قبل البائع',
            'rma-id'        => 'معرف RMA',
            'status-change' => 'تم تغيير حالة :id من قبل البائع',
            'status'        => 'الحالة',
            'title'         => 'تم تحديث الحالة!',
            'your-rma-id'   => 'معرف RMA الخاص بك',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'قبول',
            'awaiting'                 => 'في انتظار',
            'canceled'                 => 'تم الإلغاء',
            'declined'                 => 'تم رفضه',
            'dispatched-package'       => 'تم إرسال الطرد',
            'item-canceled'            => 'تم إلغاء العنصر',
            'not-received-package-yet' => 'لم يتم استلام الطرد بعد',
            'pending'                  => 'قيد الانتظار',
            'processing'               => 'قيد المعالجة',
            'received-package'         => 'تم استلام الطرد',
            'solved'                   => 'تم حله',
        ],

        'status-quotes' => [
            'declined-admin'  => 'تم رفض RMA من قبل المسؤول.',
            'declined-buyer'  => 'تم رفض RMA من قبل المشتري.',
            'solved-by-admin' => 'تم حل RMA بواسطة المسؤول.',
            'solved'          => 'تم حل RMA.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'حالة RMA تم إلغاؤها بالفعل.',
        'cancel-success'    => 'تم إلغاء حالة RMA بنجاح.',
        'create-success'    => 'تم إنشاء الطلب بنجاح.',
        'creation-error'    => 'لا يمكن تحديث حالة RMA لأن الفاتورة الخاصة بهذا الطلب لم يتم إنشاؤها.',
        'permission-denied' => 'أنت مسجل الدخول',
        'rma-disabled'      => 'تم تعطيل RMA لهذا المنتج',
        'send-message'      => 'تم إرسال :name بنجاح.',
        'update-success'    => 'تم تحديث :name بنجاح.',
        'please-select-the-item' => 'يرجى اختيار العنصر',

    ],
];