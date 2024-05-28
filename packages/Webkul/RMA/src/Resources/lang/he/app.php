<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'אפשר בקשת RMA חדשה עבור הזמנה ממתינה',
                        'allow-rma-for-digital-product'       => 'אפשר RMA עבור מוצרים דיגיטליים',
                        'default-allow-days'                  => 'ימים מותרים ברירת מחדל',
                        'enable'                              => 'אפשר RMA',
                        'info'                                => 'RMA הוא חלק מתהליך ההחזר של מוצר לעסק כדי לקבל החזר, החלפה או תיקון.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'פונקציונליות RMA מאפשרת טיפול במצבים בהם לקוחות מחזירים פריטים לתיקון ותחזוקה, או להחזר או החלפה.',
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
                    'rma-title'        => 'כל Rma',
                    'reason-title'     => 'סיבות',
                    'create-rma-title' => 'צור Rma',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'כל Rma',

                        'datagrid' => [
                            'id'        => 'מזהה RMA',
                            'order-ref' => 'ספר הזמנה',
                            'status'    => 'סטטוס',
                            'create'    => 'נוצר בתאריך',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' מזהה הזמנה :',
                        'request-on'             => 'בקש בתאריך :',
                        'customer'               => 'לקוח :',
                        'resolution-type'        => 'סוג פתרון :',
                        'additional-information' => 'מידע נוסף :',
                        'images'                 => 'תמונה :',
                        'order-details'          => 'פרטי הזמנה',
                        'status'                 => 'סטטוס',
                        'rma-status'             => 'סטטוס RMA :',
                        'order-status'           => 'סטטוס הזמנה :',
                        'change-status'          => 'שינוי סטטוס',
                        'conversations'          => 'שיחות',
                        'save-btn'               => 'שמור',
                        'send-message'           => 'שלח הודעה',
                        'enter-message'          => 'הזן הודעה',
                        'send-message-btn'       => 'שלח הודעה',
                        'send-message-success'   => 'ההודעה נשלחה בהצלחה.',
                        'update-success'         => 'סטטוס Rma עודכן בהצלחה.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'סיבות',
                        'create-btn' => 'צור סיבת Rma',

                        'datagrid' => [
                            'id'                  => 'מזהה',
                            'reason'              => 'סיבה',
                            'status'              => 'סטטוס',
                            'created-at'          => 'נוצר בתאריך',
                            'enabled'             => 'מופעל',
                            'disabled'            => 'מנוטרל',
                            'delete-success'      => 'הסיבה נמחקה בהצלחה.',
                            'mass-delete-success' => 'מחיקה המונית של Rma הצליחה בהצלחה.',
                            'reason-error'        => 'הסיבה בשימוש ב RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'הוסף סיבה חדשה',
                        'save-btn'       => 'שמור סיבה',
                        'reason'         => 'סיבה',
                        'status'         => 'סטטוס',
                        'create-success' => 'הסיבה נוצרה בהצלחה.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ערוך סיבה',
                        'save-btn'            => 'שמור סיבה',
                        'reason'              => 'סיבה',
                        'status'              => 'סטטוס',
                        'mass-update-success' => 'הסיבות שנבחרו עודכנו בהצלחה.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'צור Rma',
                    'order-id'          => 'מספר הזמנה',
                    'email'             => 'דוא"ל',
                    'validate'          => 'אמת',
                    'rma-already-exist' => 'RMA כבר קיים',
                    'mismatch'          => 'מספר הזמנה ודוא"ל לא תואמים',
                    'invalid-order-id'  => 'מספר הזמנה לא תקין',
                    'quantity'          => 'כמות',
                    'reason'            => 'סיבה',
                    'save-btn'          => 'שמור',
                    'create-success'    => 'Rma נוצר בהצלחה.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'החזר RMA',
            'offer'        => 'קבל עד 40% הנחה בהזמנה הראשונה שלך',
            'shop-now'     => 'קנה עכשיו',

            'create' => [
                'heading'                  => 'בקשת RMA חדשה',
                'create-btn'               => 'שמור',
                'orders'                   => 'הזמנות',
                'resolution'               => 'בחר פתרון',
                'item-ordered'             => 'פריט הוזמן',
                'images'                   => 'תמונות',
                'information'              => 'מידע נוסף',
                'order-status'             => 'סטטוס הזמנה',
                'product'                  => 'מוצר',
                'sku'                      => 'SKU',
                'price'                    => 'מחיר',
                'search-order'             => 'חפש הזמנה',
                'enter-order-id'           => 'הזן מספר הזמנה',
                'not-allowed'              => 'RMA אינו מותר להזמנה ממתינה',
                'image'                    => 'תמונה',
                'quantity'                 => 'כמות',
                'reason'                   => 'סיבה',
                'rma-not-available-quotes' => 'הפריט אינו זמין ל RMA',
                'product-name'             => 'שם המוצר',
                'reopen-request'           => 'פתח בקשה מחדש',
                'save'                     => 'שמור',
                'cancel'                   => 'ביטול',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'סטטוס RMA :',
                'order-status' => 'סטטוס הזמנה :',
                'close-rma'    => 'סגור RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'בקשת RMA חדשה',
                'create-btn'               => 'שמור',
                'orders'                   => 'הזמנות',
                'resolution'               => 'בחר פתרון',
                'item-ordered'             => 'פריט הוזמן',
                'images'                   => 'תמונות',
                'information'              => 'מידע נוסף',
                'order-status'             => 'סטטוס הזמנה',
                'product'                  => 'מוצר',
                'sku'                      => 'SKU',
                'price'                    => 'מחיר',
                'search-order'             => 'חפש הזמנה',
                'enter-order-id'           => 'הזן מספר הזמנה',
                'not-allowed'              => 'RMA אינו מותר להזמנה ממתינה',
                'image'                    => 'תמונה',
                'quantity'                 => 'כמות',
                'reason'                   => 'סיבה',
                'rma-not-available-quotes' => 'הפריט אינו זמין ל RMA',
                'product-name'             => 'שם המוצר',
                'reopen-request'           => 'פתח בקשה מחדש',
                'save'                     => 'שמור',
                'cancel'                   => 'ביטול',
                'reopen-request'           => 'פתח בקשה מחדש',
            ],

            'index' => [
                'create'  => 'בקש RMA חדשה',
                'heading' => 'לוח בקרת RMA של הלקוח',
                'view'    => 'הצג',
                'edit'    => 'ערוך',
                'delete'  => 'מחק',
                'update'  => 'עדכן',
                'guest'   => 'לוח בקרת RMA של אורחים',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'בקש RMA חדשה',
            'heading' => 'לוח בקרת RMA של הלקוח',
            'view'    => 'הצג',
            'edit'    => 'ערוך',
            'delete'  => 'מחק',
            'update'  => 'עדכן',
            'guest'   => 'לוח בקרת RMA של אורחים',
        ],

        'validation' => [
            'orders'       => 'הזמנות',
            'resolution'   => 'פתרון',
            'information'  => 'מידע נוסף',
            'order-status' => 'סטטוס הזמנה',
            'order-id'     => 'בחירת הזמנה',
            'close-rma'    => 'אישור',
        ],

        'conversation-texts' => [
            'by'       => 'על ידי',
            'seller'   => 'מוכר',
            'customer' => 'לקוח',
            'on'       => 'ב',
        ],

        'default-option' => [
            'please-select-value' => 'בחר ערך',
            'select-quantity'     => 'בחר כמות',
            'select-reason'       => 'בחר סיבה',
            'others'              => 'אחר',
            'select-order-status' => 'בחר סטטוס הזמנה',
            'select-resolution'   => 'בחר פתרון',
            'select-seller'       => 'בחר סוחר',
            'select-order'        => 'בחר הזמנה',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'אורח',
            'heading'                 => 'פרטי RMA',
            'status'                  => 'סטטוס',
            'order-id'                => ' מזהה הזמנה :',
            'refund-details'          => 'פרטי החזר',
            'resolution-type'         => 'סוג הפתרון :',
            'additional-information'  => 'מידע נוסף :',
            'change-rma-status'       => 'שנה סטטוס RMA',
            'save-btn'                => 'שמור',
            'you'                     => 'מנהל',
            'send-message-btn'        => 'שלח',
            'items-requested-for-rma' => 'פריט(ים) בקשה ל RMA',
            'refund-offline-btn'      => 'החזר לא מקוון',
            'send-message'            => 'שלח הודעה',
            'conversations'           => 'שיחות',
            'cancel-order'            => 'בטל הזמנה',
            'status-details'          => 'פרטי סטטוס',
            'admin'                   => 'מנהל',
            'status-quotes'           => 'אנא אשר כדי לסמן זאת כפתור.',
            'close-rma'               => 'סגור RMA :',
            'images'                  => 'תמונות',
            'items-request'           => 'פריט(ים) בקשה ל RMA',
            'refundable-amount'       => 'סכום החזר',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'סוג הפתרון :',
            'guest'                  => 'אתה',
            'status'                 => 'סטטוס',
            'order-id'               => ' מזהה הזמנה :',
            'additional-information' => 'מידע נוסף :',
            'save-btn'               => 'שמור',
            'send-message-btn'       => 'שלח',
            'refund-offline-btn'     => 'החזר לא מקוון',
            'send-message'           => 'שלח הודעה',
            'conversations'          => 'שיחות',
            'status-details'         => 'פרטי סטטוס',
            'admin'                  => 'מנהל',
            'status-quotes'          => 'אנא אשר כדי לסמן זאת כפתור.',
            'close-rma'              => 'סגור RMA',
            'images'                 => 'תמונות',
            'items-request'          => 'פריט(ים) בקשה ל RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'סטטוס RMA :',
            'order-status' => 'סטטוס הזמנה :',
            'full-amount'  => 'סכום מלא',
            'request-on'   => 'בתאריך :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'סגור RMA',
            'rma-status'              => 'סטטוס RMA :',
            'admin-status'            => 'סטטוס מנהל:',
            'order-status'            => 'סטטוס הזמנה :',
            'consignment-no'          => 'מספר משלוח:',
            'refundable-amount'       => 'סכום החזר יתכן:',
            'full-amount'             => 'סכום מלא',
            'partial-amount'          => 'סכום חלקי',
            'total-refundable-amount' => 'סכום כולל שניתן להחזיר:',
            'enter-message'           => 'הזן הודעה',
            'request-on'              => 'בתאריך :',
            'seller'                  => 'מוכר',
            'order-details'           => 'פרטי הזמנה',
        ],

        'table-heading' => [
            'product-name' => 'שם המוצר',
            'sku'          => 'SKU',
            'price'        => 'מחיר',
            'qty'          => 'כמות',
            'reason'       => 'סיבה',
        ],

        'guest-users' => [
            'heading'     => 'פאנל התחברות אורחים',
            'order-id'    => 'מספר הזמנה',
            'email'       => 'אימייל',
            'submit-btn'  => 'שלח בקשה לאיפוס סיסמה',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'בקשת RMA',
            'hello'                  => 'יקר :name',
            'greeting'               => 'ביקשת RMA חדש עבור הזמנה :order_id.',
            'rma-id'                 => 'מספר RMA :',
            'summary'                => 'סיכום של RMA של ההזמנה',
            'order-id'               => 'מספר הזמנה :',
            'order-status'           => 'סטטוס הזמנה :',
            'resolution-type'        => 'סוג הפתרון :',
            'additional-information' => 'מידע נוסף :',
            'thank-you'              => 'תודה',
            'requested-rma-product'  => 'המוצר שביקשת RMA עבורו:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'שם המוצר',
            'sku'          => 'SKU',
            'qty'          => 'כמות',
            'reason'       => 'סיבה',
        ],

        'customer-conversation' => [
            'heading' => 'יקר :name,',
            'quotes'  => 'יש הודעה חדשה מהקונה',
            'message' => 'הודעה',
        ],

        'seller-conversation' => [
            'heading' => 'יקר :name',
            'quotes'  => 'יש הודעה חדשה מהמוכר',
            'message' => 'הודעה',
            'title'   => 'הודעה התקבלה!',
        ],

        'status' => [
            'heading'       => 'יקר :name',
            'quotes'        => 'הסטטוס של ה RMA שלך השתנה על ידי המוכר',
            'rma-id'        => 'מספר RMA',
            'your-rma-id'   => 'ה RMA שלך מספר',
            'status-change' => 'הסטטוס :id שונה על ידי המוכר',
            'status'        => 'סטטוס',
            'title'         => 'הסטטוס עודכן!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'ממתין',
            'processing'               => 'מעבד',
            'item-canceled'            => 'פריט בוטל',
            'solved'                   => 'פתור',
            'declined'                 => 'נדחה',
            'received-package'         => 'קבלת חבילה',
            'dispatched-package'       => 'שולח חבילה',
            'not-received-package-yet' => 'טרם קיבלתי את החבילה',
            'accept'                   => 'קבל',
        ],

        'status-quotes' => [
            'declined-admin'  => 'ה RMA נדחתה על ידי המנהל.',
            'declined-buyer'  => 'ה RMA נדחתה על ידי הקונה.',
            'solved'          => 'ה RMA פתורה.',
            'solved-by-admin' => 'ה RMA נפתרה על ידי המנהל.',
        ],
    ],

    'response' => [
        'create-success' => ':name נוצרה בהצלחה.',
        'send-message'   => 'נשלח בהצלחה.',
        'update-success' => 'עודכן בהצלחה.',
    ],
];
