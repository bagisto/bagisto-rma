<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'אחר הצהריים',
                        'all-products'                        => 'כל המוצרים',
                        'all-status'                          => 'כל הסטטוסים',
                        'allow-new-request-for-pending-order' => 'אפשר בקשת RMA חדשה עבור הזמנה ממתינה',
                        'allow-rma-for-digital-product'       => 'אפשר RMA עבור מוצר דיגיטלי',
                        'allowed-file-types'                  => 'אנא בחר סוגי קבצים ' . core()->getConfigData('sales.rma.setting.allowed-file-extension') . ' בלבד',
                        'allowed-file-extension'              => 'סיומת קובץ מותרת',
                        'allowed-info'                        => 'מופרד באמצעות פסיקים. לדוגמה: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'אפשר בקשת RMA חדשה עבור בקשה מבוטלת',
                        'allowed-request-declined-request'    => 'אפשר בקשת RMA חדשה עבור בקשה נדחתה',
                        'allowed-rma-for-product'             => 'אפשר RMA עבור מוצר',
                        'cancel-items'                        => 'בטל פריטים',
                        'complete'                            => 'הושלם',
                        'current-order-quantity'              => 'כמות הזמנה נוכחית',
                        'days-info'                           => 'מספר הימים שבהם הלקוח יכול לבקש RMA לאחר ביצוע הזמנה.',
                        'default-allow-days'                  => 'ימים מותרים כברירת מחדל',
                        'enable'                              => 'אפשר RMA',
                        'evening'                             => 'ערב',
                        'exchange'                            => 'החלפה',
                        'info'                                => 'RMA הוא חלק מהתהליך של החזרת מוצר לעסק כדי לקבל החזר, החלפה או תיקון.',
                        'morning'                             => 'בוקר',
                        'new-rma-message-to-customer'         => 'הודעת RMA חדשה ללקוח',
                        'no'                                  => 'לא',
                        'open'                                => 'פתוח',
                        'package-condition'                   => 'מצב החבילה',
                        'packed'                              => 'ארוז',
                        'print-page'                          => 'הדפס עמוד', 
                        'product-already-raw'                 => 'המוצר כבר נמצא ב-RMA.',
                        'product-delivery-status'             => 'מצב מסירת המוצר',
                        'resolution-type'                     => 'סוג פתרון',
                        'return-pickup-address'               => 'כתובת איסוף החזרה',
                        'return-pickup-time'                  => 'זמן איסוף החזרה',
                        'return-policy'                       => 'מדיניות החזרה',
                        'return'                              => 'החזרה',
                        'select-allowed-order-status'         => 'בחר סטטוס הזמנה מותר',
                        'specific-products'                   => 'מוצרים ספציפיים',
                        'title'                               => 'RMA',
                        'yes'                                 => 'כן',

                        'setting' => [
                            'info'  => 'הפונקציונליות של RMA מאפשרת טיפול במצבים בהם לקוח מחזיר פריטים לצורך תיקון ותחזוקה, או לצורך החזר כספי או החלפה.',
                            'read'  => 'קרא את המדיניות', 
                            'terms' => 'קראתי וקיבלתי את מדיניות ההחזרה.',
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
                    'create-rma-title' => 'יצירת RMA',
                    'reason-title'     => 'סיבות',
                    'rma-title'        => 'כל ה-RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'כל ה-RMA',

                        'datagrid' => [
                            'create'        => 'נוצר בתאריך',
                            'customer-name' => 'שם הלקוח',
                            'id'            => 'מזהה RMA',
                            'order-ref'     => 'מספר הזמנה',
                            'order-status'  => 'מצב הזמנה',
                            'rma-status'    => 'מצב RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'הוסף קבצים מצורפים',
                        'additional-information' => 'מידע נוסף:',
                        'attachment'             => 'קובץ מצורף',
                        'change-status'          => 'שנה מצב',
                        'confirm-print'          => 'לחץ על אישור להדפסת ה-RMA',
                        'conversations'          => 'שיחות',
                        'customer-details'       => 'פרטי לקוח',
                        'customer-email'         => 'אימייל לקוח:',
                        'customer'               => 'לקוח:',
                        'enter-message'          => 'הזן הודעה',
                        'images'                 => 'תמונה:',
                        'no-record'              => 'לא נמצא תיעוד!',
                        'order-date'             => 'תאריך הזמנה:',
                        'order-details'          => 'פריטים מבוקשים עבור RMA',
                        'order-id'               => 'מספר הזמנה:',
                        'order-status'           => 'מצב הזמנה:',
                        'order-total'            => 'סך הכל הזמנה:',
                        'request-on'             => 'בקשה בתאריך:',
                        'resolution-type'        => 'סוג פתרון:',
                        'rma-status'             => 'מצב RMA:',
                        'save-btn'               => 'שמור',
                        'send-message-btn'       => 'שלח הודעה',
                        'send-message-success'   => 'הודעה נשלחה בהצלחה.',
                        'send-message'           => 'שלח הודעה',
                        'status'                 => 'מצב',
                        'title'                  => 'RMA',
                        'update-success'         => 'מצב RMA עודכן בהצלחה.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'צור מצב RMA',
                        'title'      => 'מצב RMA',

                        'datagrid' => [
                            'created-at'          => 'נוצר ב',
                            'delete-success'      => 'מצב RMA נמחק בהצלחה.',
                            'disabled'            => 'לא פעיל',
                            'enabled'             => 'פעיל',
                            'id'                  => 'מזהה',
                            'mass-delete-success' => 'מצב RMA שנבחר נמחק בהצלחה.',
                            'reason-error'        => 'מצב RMA בשימוש ב-RMA.',
                            'reason'              => 'מצב RMA',
                            'status'              => 'מצב',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'הוסף מצב RMA חדש',
                        'reason'       => 'מצב RMA',
                        'save-btn'     => 'שמור מצב RMA',
                        'status'       => 'מצב',
                        'success'      => 'מצב RMA נוצר בהצלחה.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ערוך מצב RMA',
                        'mass-update-success' => 'מצב RMA שנבחר עודכן בהצלחה.',
                        'reason'              => 'מצב RMA',
                        'save-btn'            => 'שמור מצב RMA',
                        'status'              => 'מצב',
                        'success'             => 'מצב RMA עודכן בהצלחה.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'יצירת סיבת RMA',
                        'title'      => 'סיבות',

                        'datagrid' => [
                            'created-at'          => 'נוצר בתאריך',
                            'delete-success'      => 'הסיבה נמחקה בהצלחה.',
                            'disabled'            => 'לא פעיל',
                            'enabled'             => 'פעיל',
                            'id'                  => 'מזהה',
                            'mass-delete-success' => 'הנתונים שנבחרו נמחקו בהצלחה',
                            'reason-error'        => 'הסיבה בשימוש ב-RMA.',
                            'reason'              => 'סיבה',
                            'status'              => 'מצב',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'הוספת סיבה חדשה',
                        'reason'       => 'סיבה',
                        'save-btn'     => 'שמירת סיבה',
                        'status'       => 'מצב',
                        'success'      => 'הסיבה נוצרה בהצלחה.',
                    ],

                    'edit' => [
                        'edit-title'          => 'עריכת סיבה',
                        'mass-update-success' => 'הסיבות שנבחרו עודכנו בהצלחה.',
                        'reason'              => 'סיבה',
                        'save-btn'            => 'שמירת שינויים',
                        'status'              => 'מצב',
                        'success'             => 'הסיבה עודכנה בהצלחה.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'הוסף שדה חדש',
                        'title'      => 'שדות מותאמים אישית ל-RMA',

                        'datagrid' => [
                            'created-at'          => 'נוצר בתאריך',
                            'delete-success'      => 'שדות מותאמים אישית נמחקו בהצלחה.',
                            'disabled'            => 'לא פעיל',
                            'enabled'             => 'פעיל',
                            'id'                  => 'מזהה',
                            'mass-delete-success' => 'הנתונים שנבחרו נמחקו בהצלחה',
                            'status'              => 'סטטוס',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'שדה מותאם אישית חדש',
                        'save-btn'     => 'שמור שדה מותאם אישית',
                        'status'       => 'סטטוס',
                        'success'      => 'שדה מותאם אישית נוצר בהצלחה.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ערוך שדה מותאם אישית',
                        'mass-update-success' => 'השדות המותאמים אישית שנבחרו עודכנו בהצלחה.',
                        'reason'              => 'שדה מותאם אישית',
                        'save-btn'            => 'שמור שדה מותאם אישית',
                        'status'              => 'סטטוס',
                        'success'             => 'השדה המותאם אישית עודכן בהצלחה.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'צור כללי RMA',
                        'title'      => 'כללי RMA',

                        'datagrid' => [
                            'delete-success'      => 'כללי RMA נמחקו בהצלחה.',
                            'disabled'            => 'לא פעיל',
                            'enabled'             => 'פעיל',
                            'exchange-period'     => 'תקופת החלפה (ימים)',
                            'id'                  => 'מזהה',
                            'mass-delete-success' => 'הנתונים שנבחרו נמחקו בהצלחה.',
                            'reason'              => 'כללים',
                            'return-period'       => 'תקופת החזרה (ימים)',
                            'status'              => 'סטטוס',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'הוסף כללי RMA חדשים',
                        'reason'             => 'כללי RMA',
                        'rule-description'   => 'תיאור הכללים',
                        'rule-details'       => 'פרטי הכללים',
                        'resolutions-period' => 'תקופת פתרונות',
                        'rules-title'        => 'כותרת הכללים',
                        'save-btn'           => 'שמור כללי RMA',
                        'status'             => 'סטטוס RMA',
                        'success'            => 'כללי RMA נוצרו בהצלחה.',
                    ],

                    'edit' => [
                        'edit-title'          => 'ערוך כללי RMA',
                        'mass-update-success' => 'כללי RMA שנבחרו עודכנו בהצלחה.',
                        'reason'              => 'כללי RMA',
                        'save-btn'            => 'עדכן כללי RMA',
                        'status'              => 'סטטוס',
                        'success'             => 'כללי RMA עודכנו בהצלחה.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA נוצרה בהצלחה.',
                    'create-title'             => 'יצירת RMA',
                    'email'                    => 'אימייל',
                    'image'                    => 'תמונה',
                    'invalid-order-id'         => 'מספר הזמנה אינו תקין',
                    'mismatch'                 => 'מספר הזמנה וכתובת האימייל לא תואמים',
                    'new-rma'                  => 'RMA חדשה',
                    'order-id'                 => 'מספר הזמנה',
                    'quantity'                 => 'כמות',
                    'reason'                   => 'סיבה',
                    'rma-already-exist'        => 'ה-RMA כבר קיימת',
                    'rma-not-available-quotes' => 'הפריט לא זמין ל-RMA',
                    'save-btn'                 => 'שמירה',
                    'search'                   => '--בחר--',
                    'validate'                 => 'אימות',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'ה-RMA נוצרה בהצלחה',
                    'rma-created-message'  => 'בקשת RMA זמינה עבור המוצר עם כמות של :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'מחיקה',
            'edit'        => 'עריכה',
            'mass-delete' => 'מחיקה מרובה',
            'mass-update' => 'עדכון מרובה',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'נמסר',
            'menu-name'    => 'RMA',
            'offer'        => 'עד 40% הנחה ברכישת ההזמנה הראשונה שלך',
            'rma-qty'      => 'כמות RMA',
            'shop-now'     => 'קנה עכשיו',
            'submit-req'   => 'שלח בקשה',
            'title'        => 'RMA',
            'undelivered'  => 'לא נמסר',

            'create' => [
                'cancel'                   => 'בטל',
                'create-btn'               => 'שמור',
                'enter-order-id'           => 'הזן מזהה הזמנה',
                'heading'                  => 'בקשת RMA חדשה',
                'exchange-window'          => 'חלון החלפה',
                'image'                    => 'תמונה',
                'images'                   => 'תמונות',
                'information'              => 'מידע נוסף',
                'item-ordered'             => 'פריט הוזמן',
                'no-record'                => 'לא נמצאו רשומות!',
                'not-allowed'              => 'RMA לא מותר עבור הזמנה בהמתנה',
                'order-status'             => 'מצב הזמנה',
                'orders'                   => 'הזמנות',
                'price'                    => 'מחיר',
                'product-name'             => 'שם המוצר',
                'product'                  => 'מוצר',
                'quantity'                 => 'כמות',
                'reason'                   => 'סיבה',
                'reopen-request'           => 'פתח בקשה מחדש',
                'resolution'               => 'בחר פתרון',
                'return-window'            => 'חלון החזרה',
                'rma-not-available-quotes' => 'הפריט לא זמין ל-RMA',
                'save'                     => 'שמור',
                'search-order'             => 'חפש הזמנה',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'סגור RMA:',
                'order-status' => 'מצב הזמנה:',
                'rma-status'   => 'מצב RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'בטל',
                'create-btn'               => 'שמור',
                'enter-order-id'           => 'הזן מזהה הזמנה',
                'heading'                  => 'בקשת RMA חדשה',
                'image'                    => 'תמונה',
                'images'                   => 'תמונות',
                'information'              => 'מידע נוסף',
                'item-ordered'             => 'פריט הוזמן',
                'not-allowed'              => 'RMA לא מותר עבור הזמנה בהמתנה',
                'order-status'             => 'מצב הזמנה',
                'orders'                   => 'הזמנות',
                'price'                    => 'מחיר',
                'product-name'             => 'שם המוצר',
                'product'                  => 'מוצר',
                'quantity'                 => 'כמות',
                'reason'                   => 'סיבה',
                'reopen-request'           => 'פתח בקשה מחדש',
                'resolution'               => 'בחר פתרון',
                'rma-not-available-quotes' => 'הפריט לא זמין ל-RMA',
                'save'                     => 'שמור',
                'search-order'             => 'חפש הזמנה',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'בקש RMA חדשה',
                'delete'  => 'מחק',
                'edit'    => 'ערוך',
                'guest'   => 'פאנל RMA לאורחים',
                'heading' => 'פאנל RMA לאורחים',
                'update'  => 'עדכן',
                'view'    => 'צפה',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'צור',
            'delete'  => 'מחק',
            'edit'    => 'ערוך',
            'guest'   => 'פאנל RMA לאורחים',
            'heading' => 'RMA',
            'update'  => 'עדכן',
            'view'    => 'צפה',
        ],

        'validation' => [
            'close-rma'     => 'אשר',
            'information'   => 'מידע נוסף',
            'order-id'      => 'בחירת הזמנה',
            'order-status'  => 'מצב הזמנה',
            'orders'        => 'הזמנות',
            'resolution'    => 'פתרון',
            'select-orders' => 'בחר הזמנה',
        ],

        'conversation-texts' => [
            'by'        => 'על ידי',
            'customer'  => 'לקוח',
            'no-record' => 'לא נמצאו רשומות!',
            'on'        => 'ב',
            'seller'    => 'מוכר',
        ],

        'default-option' => [
            'others'              => 'אחר',
            'please-select-value' => 'בחר ערך',
            'select-order-status' => 'בחר מצב הזמנה',
            'select-order'        => 'בחר הזמנה',
            'select-quantity'     => 'בחר כמות',
            'select-reason'       => 'בחר סיבה',
            'select-resolution'   => 'בחר פתרון',
            'select-seller'       => 'בחר מוכר',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'מידע נוסף:',
            'admin'                   => 'מנהל',
            'cancel-order'            => 'ביטול הזמנה',
            'change-rma-status'       => 'שנה מצב RMA',
            'close-rma'               => 'סגור RMA :',
            'conversations'           => 'שיחות',
            'guest'                   => 'אורח',
            'heading'                 => 'פרטי RMA',
            'images'                  => 'תמונות:',
            'items-request'           => 'פריטים בקשת RMA',
            'items-requested-for-rma' => 'פריטים בקשת RMA',
            'order-id'                => 'מספר הזמנה:',
            'refund-details'          => 'פרטי החזר',
            'refund-offline-btn'      => 'החזרה לא מקוונת',
            'refundable-amount'       => 'סכום המזומן הניתן להחזר',
            'resolution-type'         => 'סוג הפתרון:',
            'rma'                     => 'RMA',
            'save-btn'                => 'שמור',
            'send-message-btn'        => 'שלח',
            'send-message'            => 'שלח הודעה',
            'status-details'          => 'פרטי המצב',
            'status-quotes'           => 'אנא אשר לסמן כפתור פתרון',
            'status-reopen'           => 'בדוק כדי לפתוח מחדש',
            'status'                  => 'מצב',
            'term'                    => 'אישור תחום המרקות נדרש',
            'you'                     => 'מנהל',
        ],

        'view-guest-rma' => [
            'additional-information' => 'מידע נוסף:',
            'admin'                  => 'מנהל',
            'close-rma'              => 'סגור RMA',
            'conversations'          => 'שיחות',
            'guest'                  => 'אתה',
            'images'                 => 'תמונות',
            'items-request'          => 'פריטים בקשת RMA',
            'order-id'               => ' מספר הזמנה:',
            'refund-offline-btn'     => 'החזרה לא מקוונת',
            'resolution-type'        => 'סוג הפתרון:',
            'rma'                    => 'RMA',
            'save-btn'               => 'שמור',
            'send-message-btn'       => 'שלח',
            'send-message'           => 'שלח הודעה',
            'status-details'         => 'פרטי המצב',
            'status-quotes'          => 'אנא אשר לסמן כפתור פתרון.',
            'status'                 => 'מצב',
            'term'                   => 'אישור תחום המרקות נדרש',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'סכום מלא',
            'order-status' => 'מצב הזמנה :',
            'request-on'   => 'בקשה ב :',
            'rma-status'   => 'מצב RMA :',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'מצב מנהל:',
            'close-rma'               => 'סגור RMA',
            'consignment-no'          => 'מספר המשלוח:',
            'enter-message'           => 'הזן הודעה',
            'full-amount'             => 'סכום מלא',
            'order-details'           => 'פרטי הזמנה',
            'order-status'            => 'מצב הזמנה :',
            'partial-amount'          => 'סכום חלקי',
            'refundable-amount'       => 'סכום המזומן הניתן להחזר',
            'request-on'              => 'בקשה ב :',
            'rma-status'              => 'מצב RMA :',
            'seller'                  => 'מוכר',
            'total-refundable-amount' => 'סכום המזומן הכולל להחזרה:',
        ],

        'table-heading' => [
            'image'           => 'תמונה',
            'product-name'    => 'שם מוצר',
            'sku'             => 'קוד מוצר',
            'price'           => 'מחיר',
            'rma-qty'         => 'כמות RMA',
            'order-qty'       => 'כמות הזמנה',
            'resolution-type' => 'סוג פתרון',
            'reason'          => 'סיבה',
        ],

        'guest-users' => [
            'button-text' => 'התחבר',
            'email'       => 'אימייל',
            'heading'     => 'פאנל התחברות אורחים',
            'logout'      => 'התנתקות אורח',
            'order-id'    => 'מספר הזמנה',
            'title'       => 'התחברות אורחים',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'מידע נוסף :',
            'greeting'               => 'ביקשת RMA חדש להזמנה :order_id.',
            'heading'                => 'בקשת RMA',
            'hello'                  => 'יקר :name',
            'order-id'               => 'מספר הזמנה :',
            'order-status'           => 'סטטוס הזמנה :',
            'requested-rma-product'  => 'מוצר RMA המבוקש:',
            'resolution-type'        => 'סוג פתרון :',
            'rma-id'                 => 'מזהה RMA :',
            'summary'                => 'סיכום של RMA הזמנה',
            'thank-you'              => 'תודה',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'שם המוצר',
            'qty'          => 'כמות',
            'reason'       => 'סיבה',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'יקר :name,',
            'message' => 'הודעה',
            'quotes'  => 'יש הודעה חדשה מהקונה',
            'process' => 'בקשת ההחזרה שלך נמצאת בתהליך.',
            'solved'  => 'סטטוס RMA שונה לפתרון על ידי הלקוח.',
        ],

        'seller-conversation' => [
            'heading' => 'יקר :name',
            'message' => 'הודעה',
            'quotes'  => 'יש הודעה חדשה מהאדמין',
            'title'   => 'הודעה התקבלה!',
        ],

        'status' => [
            'heading'       => 'יקר :name',
            'quotes'        => 'הסטטוס של RMA שלך השתנה על ידי המוכר',
            'rma-id'        => 'מזהה RMA',
            'status-change' => 'הסטטוס של :id השתנה על ידי המוכר',
            'status'        => 'סטטוס',
            'title'         => 'עדכון סטטוס!',
            'your-rma-id'   => 'המזהה שלך RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'קבל',
            'awaiting'                 => 'ממתין',
            'canceled'                 => 'בוטל',
            'declined'                 => 'נדחה',
            'dispatched-package'       => 'חבילה שנשלחה',
            'item-canceled'            => 'פריט בוטל',
            'not-received-package-yet' => 'טרם התקבלה החבילה',
            'pending'                  => 'ממתין לטיפול',
            'processing'               => 'מעבד',
            'received-package'         => 'החבילה התקבלה',
            'solved'                   => 'פתרון נמצא',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA נדחה על ידי המנהל.',
            'declined-buyer'  => 'RMA נדחה על ידי הלקוח.',
            'solved-by-admin' => 'RMA פתר על ידי המנהל.',
            'solved'          => 'RMA פתור.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'סטטוס RMA כבר בוטל.',
        'cancel-success'    => 'סטטוס RMA בוטל בהצלחה.',
        'create-success'    => 'הבקשה נוצרה בהצלחה.',
        'permission-denied' => 'אתה מחובר',
        'rma-disabled'      => 'RMA מנוטרל עבור מוצר זה',
        'send-message'      => ':name נשלח בהצלחה.',
        'update-success'    => ':name עודכן בהצלחה.',
        'creation-error'    => 'לא ניתן לעדכן את סטטוס ה-RMA מכיוון שהחשבונית להזמנה זו לא נוצרה.', 
    ],
];