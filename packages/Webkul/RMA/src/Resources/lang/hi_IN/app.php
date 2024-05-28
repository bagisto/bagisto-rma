<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'अपेक्षारत आदेश के लिए नया आरएमए अनुरोध अनुमोदित करें',
                        'allow-rma-for-digital-product'       => 'डिजिटल उत्पादों के लिए आरएमए की अनुमति दें',
                        'default-allow-days'                  => 'डिफ़ॉल्ट अनुमति दिन',
                        'enable'                              => 'आरएमए सक्षम करें',
                        'info'                                => 'आरएमए व्यापार को उत्पाद को वापस भेजने की प्रक्रिया का हिस्सा है ताकि वह एक वापसी, पुनर्स्थापन या मरम्मत प्राप्त कर सके।',
                        'title'                               => 'आरएमए',

                        'setting' => [
                            'info'  => 'आरएमए कार्यक्षमता उन स्थितियों का हंडलिंग करने की अनुमति देता है जब ग्राहक वस्त्र सुरक्षा और रखरखाव के लिए आइटम लौटाता है, या वापसी या पुनर्स्थापन के लिए।',
                            'title' => 'आरएमए',
                        ],
                    ],
                ],
            ],
        ],

        'components' => [
            'layouts' => [
                'sidebar' => [
                    'rma' => 'आरएमए',
                ],
            ],
        ],

        'sales' => [
            'rma' => [
                'index' => [
                    'rma-title'        => 'सभी आरएमए',
                    'reason-title'     => 'कारण',
                    'create-rma-title' => 'आरएमए बनाएं',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'सभी आरएमए',

                        'datagrid' => [
                            'id'        => 'आरएमए आईडी',
                            'order-ref' => 'आदेश रेफ़',
                            'status'    => 'स्थिति',
                            'create'    => 'निर्मित किया गया',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'आरएमए',
                        'view-title'             => 'आरएमए',
                        'order-id'               => ' आदेश आईडी :',
                        'request-on'             => 'परिक़्षा द्वारा :',
                        'customer'               => 'ग्राहक :',
                        'resolution-type'        => 'परिणाम प्रकार :',
                        'additional-information' => 'अतिरिक्त जानकारी :',
                        'images'                 => 'तस्वीर :',
                        'order-details'          => 'आदेश विवरण',
                        'status'                 => 'स्थिति',
                        'rma-status'             => 'आरएमए स्थिति :',
                        'order-status'           => 'आदेश स्थिति :',
                        'change-status'          => 'स्थिति बदलें',
                        'conversations'          => 'बातचीत',
                        'save-btn'               => 'सहेजें',
                        'send-message'           => 'संदेश भेजें',
                        'enter-message'          => 'संदेश दर्ज करें',
                        'send-message-btn'       => 'संदेश भेजें',
                        'send-message-success'   => 'संदेश सफलतापूर्वक भेजा गया।',
                        'update-success'         => 'आरएमए स्थिति सफलतापूर्वक अपडेट की गई।',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'कारण',
                        'create-btn' => 'आरएमए का कारण बनाएं',

                        'datagrid' => [
                            'id'                  => 'आईडी',
                            'reason'              => 'कारण',
                            'status'              => 'स्थिति',
                            'created-at'          => 'निर्मित किया गया',
                            'enabled'             => 'सक्रिय',
                            'disabled'            => 'अक्षम',
                            'delete-success'      => 'कारण सफलतापूर्वक हटा दिया गया।',
                            'mass-delete-success' => 'आरएमए बड़े प्रमुख सफलतापूर्वक हटाया गया।',
                            'reason-error'        => 'कारण आरएमए में उपयोग किया जाता है।',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'नया कारण जोड़ें',
                        'save-btn'       => 'कारण सहेजें',
                        'reason'         => 'कारण',
                        'status'         => 'स्थिति',
                        'create-success' => 'कारण सफलतापूर्वक बनाया गया।',
                    ],

                    'edit' => [
                        'edit-title'          => 'कारण संपादित करें',
                        'save-btn'            => 'कारण सहेजें',
                        'reason'              => 'कारण',
                        'status'              => 'स्थिति',
                        'mass-update-success' => 'चयनित कारणों को सफलतापूर्वक अपडेट किया गया।',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'आरएमए बनाएं',
                    'order-id'          => 'आदेश आईडी',
                    'email'             => 'ईमेल',
                    'validate'          => 'मान्यता प्राप्त करें',
                    'rma-already-exist' => 'आरएमए पहले से ही मौजूद है',
                    'mismatch'          => 'आदेश आईडी और ईमेल मेल नहीं खाता',
                    'invalid-order-id'  => 'अवैध आदेश आईडी',
                    'quantity'          => 'मात्रा',
                    'reason'            => 'कारण',
                    'save-btn'          => 'सहेजें',
                    'create-success'    => 'आरएमए सफलतापूर्वक बनाया गया।',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'आरएमए',
            'title'        => 'आरएमए',
            'header-title' => 'आरएमए वापसी',
            'offer'        => 'अपने 1वें आदेश पर 40% तक की छूट प्राप्त करें',
            'shop-now'     => 'अभी खरीदें',

            'create' => [
                'heading'                  => 'नया आरएमए अनुरोध',
                'create-btn'               => 'सहेजें',
                'orders'                   => 'आदेश',
                'resolution'               => 'परिणाम चुनें',
                'item-ordered'             => 'मांगी गई वस्तु',
                'images'                   => 'तस्वीरें',
                'information'              => 'अतिरिक्त जानकारी',
                'order-status'             => 'आदेश की स्थिति',
                'product'                  => 'उत्पाद',
                'sku'                      => 'एसकेयू',
                'price'                    => 'मूल्य',
                'search-order'             => 'आदेश खोजें',
                'enter-order-id'           => 'आदेश आईडी दर्ज करें',
                'not-allowed'              => 'रीटर्न के लिए आरएमए अपेक्षारत नहीं है',
                'image'                    => 'तस्वीर',
                'quantity'                 => 'मात्रा',
                'reason'                   => 'कारण',
                'rma-not-available-quotes' => 'आइटम आरएमए के लिए उपलब्ध नहीं है',
                'product-name'             => 'उत्पाद का नाम',
                'reopen-request'           => 'अनुरोध फिर से खोलें',
                'save'                     => 'सहेजें',
                'cancel'                   => 'रद्द करें',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'आरएमए',
                'rma-status'   => 'आरएमए स्थिति :',
                'order-status' => 'आदेश की स्थिति :',
                'close-rma'    => 'आरएमए बंद करें :',
            ],

            'create' => [
                'title'                    => 'आरएमए',
                'heading'                  => 'नया आरएमए अनुरोध',
                'create-btn'               => 'सहेजें',
                'orders'                   => 'आदेश',
                'resolution'               => 'परिणाम चुनें',
                'item-ordered'             => 'मांगी गई वस्तु',
                'images'                   => 'तस्वीरें',
                'information'              => 'अतिरिक्त जानकारी',
                'order-status'             => 'आदेश की स्थिति',
                'product'                  => 'उत्पाद',
                'sku'                      => 'एसकेयू',
                'price'                    => 'मूल्य',
                'search-order'             => 'आदेश खोजें',
                'enter-order-id'           => 'आदेश आईडी दर्ज करें',
                'not-allowed'              => 'रीटर्न के लिए आरएमए अपेक्षारत नहीं है',
                'image'                    => 'तस्वीर',
                'quantity'                 => 'मात्रा',
                'reason'                   => 'कारण',
                'rma-not-available-quotes' => 'आइटम आरएमए के लिए उपलब्ध नहीं है',
                'product-name'             => 'उत्पाद का नाम',
                'reopen-request'           => 'अनुरोध फिर से खोलें',
                'save'                     => 'सहेजें',
                'cancel'                   => 'रद्द करें',
                'reopen-request'           => 'अनुरोध फिर से खोलें',
            ],

            'index' => [
                'create'  => 'नया आरएमए अनुरोध करें',
                'heading' => 'ग्राहक आरएमए पैनल',
                'view'    => 'देखें',
                'edit'    => 'संपादित करें',
                'delete'  => 'हटाएं',
                'update'  => 'अपडेट करें',
                'guest'   => 'मेहमान आरएमए पैनल',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'नया आरएमए अनुरोध करें',
            'heading' => 'ग्राहक आरएमए पैनल',
            'view'    => 'देखें',
            'edit'    => 'संपादित करें',
            'delete'  => 'हटाएं',
            'update'  => 'अपडेट करें',
            'guest'   => 'मेहमान आरएमए पैनल',
        ],

        'validation' => [
            'orders'       => 'आदेश',
            'resolution'   => 'परिणाम',
            'information'  => 'अतिरिक्त जानकारी',
            'order-status' => 'आदेश की स्थिति',
            'order-id'     => 'आदेश चयन',
            'close-rma'    => 'पुष्टि करें',
        ],

        'conversation-texts' => [
            'by'       => 'के द्वारा',
            'seller'   => 'विक्रेता',
            'customer' => 'ग्राहक',
            'on'       => 'पर',
        ],

        'default-option' => [
            'please-select-value' => 'कृपया मान चुनें',
            'select-quantity'     => 'मात्रा चुनें',
            'select-reason'       => 'कारण का चयन करें',
            'others'              => 'अन्य',
            'select-order-status' => 'आदेश की स्थिति चुनें',
            'select-resolution'   => 'परिणाम का चयन करें',
            'select-seller'       => 'विक्रेता का चयन करें',
            'select-order'        => 'आदेश का चयन करें',
        ],

        'view-customer-rma' => [
            'rma'                     => 'आरएमए',
            'guest'                   => 'मेहमान',
            'heading'                 => 'आरएमए विवरण',
            'status'                  => 'स्थिति',
            'order-id'                => ' आदेश आईडी :',
            'refund-details'          => 'वापसी की विवरण',
            'resolution-type'         => 'परिणाम प्रकार :',
            'additional-information'  => 'अतिरिक्त जानकारी :',
            'change-rma-status'       => 'आरएमए स्थिति बदलें',
            'save-btn'                => 'सहेजें',
            'you'                     => 'एडमिन',
            'send-message-btn'        => 'भेजें',
            'items-requested-for-rma' => 'आरएमए के लिए अनुरोधित आइटम(जी) :',
            'refund-offline-btn'      => 'ऑफ़लाइन वापसी',
            'select-seller'           => 'विक्रेता का चयन करें',
            'select-resolution'       => 'परिणाम का चयन करें',
            'reason'                  => 'कारण',
            'message'                 => 'संदेश',
            'refund-details'          => 'वापसी की विवरण',
            'amount-refunded'         => 'रिफंड हुआ राशि :',
            'offline-refund-method'   => 'ऑफ़लाइन वापसी का तरीका :',
            'refund-method'           => 'वापसी का तरीका :',
            'reference-number'        => 'संदर्भ संख्या :',
            'message-sent'            => 'संदेश सफलतापूर्वक भेजा गया।',
            'message-sending-error'   => 'संदेश भेजने में त्रुटि हुई।',
            'refund-action'           => 'रिफंड कार्रवाई :',
            'refund-status'           => 'रिफंड स्थिति :',
        ],

        'view-guest-rma' => [
            'rma'                    => 'आरएमए',
            'resolution-type'        => 'परिणाम प्रकार :',
            'guest'                  => 'आप',
            'status'                 => 'स्थिति',
            'order-id'               => ' आदेश आईडी :',
            'additional-information' => 'अतिरिक्त जानकारी :',
            'save-btn'               => 'सहेजें',
            'send-message-btn'       => 'भेजें',
            'refund-offline-btn'     => 'ऑफ़लाइन वापसी',
            'send-message'           => 'संदेश भेजें',
            'conversations'          => 'बातचीत',
            'status-details'         => 'स्थिति विवरण',
            'admin'                  => 'व्यवस्थापक',
            'status-quotes'          => 'कृपया इसे हल के रूप में चिह्नित करने के लिए सहमत हों।',
            'close-rma'              => 'आरएमए बंद करें',
            'images'                 => 'तस्वीरें',
            'items-request'          => 'आइटम(s) आरएमए के लिए अनुरोध किए गए',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'आरएमए स्थिति :',
            'order-status' => 'आदेश की स्थिति :',
            'full-amount'  => 'पूरी राशि',
            'request-on'   => 'अनुरोध किया गया :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'आरएमए बंद करें',
            'rma-status'              => 'आरएमए स्थिति :',
            'admin-status'            => 'व्यवस्थापक की स्थिति :',
            'order-status'            => 'आदेश की स्थिति :',
            'consignment-no'          => 'कन्साइनमेंट नंबर :',
            'refundable-amount'       => 'वापसी योग्य राशि :',
            'full-amount'             => 'पूरी राशि',
            'partial-amount'          => 'आंशिक राशि',
            'total-refundable-amount' => 'कुल वापसी योग्य राशि :',
            'enter-message'           => 'संदेश दर्ज करें',
            'request-on'              => 'अनुरोध किया गया :',
            'seller'                  => 'विक्रेता',
            'order-details'           => 'आदेश विवरण',
        ],

        'table-heading' => [
            'product-name' => 'उत्पाद का नाम',
            'sku'          => 'एसकेयू',
            'price'        => 'मूल्य',
            'qty'          => 'मात्रा',
            'reason'       => 'कारण',
        ],

        'guest-users' => [
            'heading'     => 'मेहमान लॉगिन पैनल',
            'order-id'    => 'आदेश आईडी',
            'email'       => 'ईमेल',
            'button-text' => 'लॉगिन',
            'title'       => 'मेहमान लॉगिन',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'आरएमए अनुरोध',
            'hello'                  => 'प्रिय :name',
            'greeting'               => 'आपने आदेश :order_id के लिए नया आरएमए अनुरोध किया है।',
            'rma-id'                 => 'आरएमए आईडी :',
            'summary'                => 'आदेश का आरएमए सारांश',
            'order-id'               => 'आदेश आईडी :',
            'order-status'           => 'आदेश की स्थिति :',
            'resolution-type'        => 'परिणाम प्रकार :',
            'additional-information' => 'अतिरिक्त जानकारी :',
            'thank-you'              => 'धन्यवाद',
            'requested-rma-product'  => 'अनुरोधित आरएमए का उत्पाद:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'उत्पाद का नाम',
            'sku'          => 'एसकेयू',
            'qty'          => 'मात्रा',
            'reason'       => 'कारण',
        ],

        'customer-conversation' => [
            'heading' => 'प्रिय :name,',
            'quotes'  => 'खरीदार से एक नया संदेश है',
            'message' => 'संदेश',
        ],

        'seller-conversation' => [
            'heading' => 'प्रिय :name',
            'quotes'  => 'विक्रेता से एक नया संदेश है',
            'message' => 'संदेश',
            'title'   => 'संदेश प्राप्त हुआ!',
        ],

        'status' => [
            'heading'       => 'प्रिय :name',
            'quotes'        => 'आपकी आरएमए स्थिति विक्रेता द्वारा बदल दी गई है',
            'rma-id'        => 'आरएमए आईडी',
            'your-rma-id'   => 'आपका आरएमए आईडी',
            'status-change' => ':id स्थिति विक्रेता द्वारा बदल दी गई है',
            'status'        => 'स्थिति',
            'title'         => 'स्थिति अद्यतन!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'अपूर्ण',
            'processing'               => 'प्रसंस्करण',
            'item-canceled'            => 'आइटम रद्द',
            'solved'                   => 'समाधान हो गया',
            'declined'                 => 'अस्वीकृत',
            'received-package'         => 'पैकेज प्राप्त',
            'dispatched-package'       => 'पैकेज भेजा गया',
            'not-received-package-yet' => 'अब तक पैकेज प्राप्त नहीं हुआ है',
            'accept'                   => 'स्वीकार करें',
        ],

        'status-quotes' => [
            'declined-admin'  => 'आरएमए को व्यवस्थापक द्वारा अस्वीकृत किया गया है।',
            'declined-buyer'  => 'आरएमए को खरीदार द्वारा अस्वीकृत किया गया है।',
            'solved'          => 'आरएमए हल हो गया है।',
            'solved-by-admin' => 'आरएमए को व्यवस्थापक द्वारा हल किया गया है।',
        ],
    ],

    'response' => [
        'create-success' => ':name सफलतापूर्वक बनाया गया।',
        'send-message'   => ':name सफलतापूर्वक भेजा गया।',
        'update-success' => ':name सफलतापूर्वक अपडेट किया गया।',
    ],
];
