<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'दोपहर',
                        'all-products'                        => 'सभी उत्पाद',
                        'all-status'                          => 'सभी स्थिति',
                        'allow-new-request-for-pending-order' => 'लंबित ऑर्डर के लिए नए RMA अनुरोध की अनुमति दें',
                        'allow-rma-for-digital-product'       => 'डिजिटल उत्पाद के लिए RMA की अनुमति दें',
                        'allowed-file-extension'              => 'अनुमत फ़ाइल एक्सटेंशन',
                        'allowed-file-types'                  => 'कृपया केवल फ़ाइल प्रकार चुनें ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'अल्पविराम द्वारा विभाजित। उदाहरण के लिए: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'रद्द किए गए अनुरोध के लिए नए RMA अनुरोध की अनुमति दें',
                        'allowed-request-declined-request'    => 'अस्वीकृत अनुरोध के लिए नए RMA अनुरोध की अनुमति दें',
                        'allowed-rma-for-product'             => 'उत्पाद के लिए RMA की अनुमति दें',
                        'cancel-items'                        => 'आइटम रद्द करें',
                        'complete'                            => 'पूर्ण',
                        'current-order-quantity'              => 'वर्तमान ऑर्डर मात्रा',
                        'days-info'                           => 'ऑर्डर करने के बाद ग्राहक कितने दिनों के भीतर RMA का अनुरोध कर सकता है।',
                        'default-allow-days'                  => 'डिफ़ॉल्ट अनुमत दिन',
                        'enable'                              => 'RMA सक्षम करें',
                        'evening'                             => 'शाम',
                        'exchange'                            => 'विनिमय',
                        'info'                                => 'RMA उस प्रक्रिया का हिस्सा है जिसके अंतर्गत किसी उत्पाद को व्यवसाय में वापस भेजकर रिफंड, प्रतिस्थापन या मरम्मत प्राप्त की जाती है।',
                        'morning'                             => 'सुबह',
                        'new-rma-message-to-customer'         => 'ग्राहक के लिए नया RMA संदेश',
                        'no'                                  => 'नहीं',
                        'open'                                => 'खुला',
                        'package-condition'                   => 'पैकेज की स्थिति',
                        'packed'                              => 'पैक किया हुआ',
                        'print-page'                          => 'प्रिंट पेज', 
                        'product-already-raw'                 => 'उत्पाद पहले से ही RMA में है।',
                        'product-delivery-status'             => 'उत्पाद वितरण स्थिति',
                        'resolution-type'                     => 'समाधान प्रकार',
                        'return-pickup-address'               => 'वापसी पिकअप पता',
                        'return-pickup-time'                  => 'वापसी पिकअप समय',
                        'return-policy'                       => 'वापसी नीति',
                        'return'                              => 'वापसी',
                        'select-allowed-order-status'         => 'अनुमत ऑर्डर स्थिति चुनें',
                        'specific-products'                   => 'विशिष्ट उत्पाद',
                        'title'                               => 'RMA',
                        'yes'                                 => 'हाँ',

                        'setting' => [
                            'info'  => 'आरएमए कार्यक्षमता उन स्थितियों को संभालने की अनुमति देती है जब कोई ग्राहक मरम्मत और रखरखाव, या धनवापसी या प्रतिस्थापन के लिए वस्तुएं वापस करता है।',
                            'read'  => 'नीति पढ़ें', 
                            'terms' => 'मैंने रिटर्न नीति पढ़ ली है और इसे स्वीकार कर लिया है।', 
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
                    'create-rma-title' => 'आरएमए बनाएं',
                    'reason-title'     => 'कारण',
                    'rma-title'        => 'सभी आरएमए',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'सभी आरएमए',

                        'datagrid' => [
                            'create'        => 'निर्मित किया गया',
                            'customer-name' => 'ग्राहक का नाम',
                            'id'            => 'आरएमए आईडी',
                            'order-ref'     => 'आदेश संदर्भ',
                            'order-status'  => 'आदेश स्थिति',
                            'rma-status'    => 'आरएमए स्थिति',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'अटैचमेंट्स जोड़ें',
                        'additional-information' => 'अतिरिक्त जानकारी:',
                        'attachment'             => 'अटैचमेंट',
                        'change-status'          => 'स्थिति बदलें',
                        'confirm-print'          => 'RMA प्रिंट करने के लिए ठीक क्लिक करें',
                        'conversations'          => 'बातचीत',
                        'customer-details'       => 'ग्राहक विवरण',
                        'customer-email'         => 'ग्राहक ईमेल:',
                        'customer'               => 'ग्राहक:',
                        'enter-message'          => 'संदेश दर्ज करें',
                        'images'                 => 'चित्र:',
                        'no-record'              => 'कोई रिकॉर्ड नहीं मिला!',
                        'order-date'             => 'आर्डर की तारीख:',
                        'order-details'          => 'RMA के लिए अनुरोध की गई वस्तुएँ',
                        'order-id'               => 'आर्डर आईडी:',
                        'order-status'           => 'आर्डर की स्थिति:',
                        'order-total'            => 'कुल आर्डर:',
                        'request-on'             => 'अनुरोध किया गया:',
                        'resolution-type'        => 'समाधान प्रकार:',
                        'rma-status'             => 'RMA की स्थिति:',
                        'save-btn'               => 'सहेजें',
                        'send-message-btn'       => 'संदेश भेजें',
                        'send-message-success'   => 'संदेश सफलतापूर्वक भेजा गया।',
                        'send-message'           => 'संदेश भेजें',
                        'status'                 => 'स्थिति',
                        'title'                  => 'RMA',
                        'update-success'         => 'RMA की स्थिति सफलतापूर्वक अपडेट की गई।',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'RMA स्थिति बनाएँ',
                        'title'      => 'RMA स्थिति',

                        'datagrid' => [
                            'created-at'          => 'निर्मित समय',
                            'delete-success'      => 'RMA स्थिति सफलतापूर्वक हटाई गई।',
                            'disabled'            => 'निष्क्रिय',
                            'enabled'             => 'सक्रिय',
                            'id'                  => 'आईडी',
                            'mass-delete-success' => 'चयनित RMA स्थिति सफलतापूर्वक हटाई गई।',
                            'reason-error'        => 'RMA स्थिति RMA में उपयोग की जा रही है।',
                            'reason'              => 'RMA स्थिति',
                            'status'              => 'स्थिति',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'नई RMA स्थिति जोड़ें',
                        'reason'       => 'RMA स्थिति',
                        'save-btn'     => 'RMA स्थिति सहेजें',
                        'status'       => 'स्थिति',
                        'success'      => 'RMA स्थिति सफलतापूर्वक बनाई गई।',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA स्थिति संपादित करें',
                        'mass-update-success' => 'चयनित RMA स्थिति सफलतापूर्वक अपडेट की गई।',
                        'reason'              => 'RMA स्थिति',
                        'save-btn'            => 'RMA स्थिति सहेजें',
                        'status'              => 'स्थिति',
                        'success'             => 'RMA स्थिति सफलतापूर्वक अपडेट की गई।',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'आरएमए कारण बनाएं',
                        'title'      => 'कारण',

                        'datagrid' => [
                            'created-at'          => 'निर्मित किया गया',
                            'delete-success'      => 'कारण सफलतापूर्वक हटा दिया गया।',
                            'disabled'            => 'निष्क्रिय',
                            'enabled'             => 'सक्रिय',
                            'id'                  => 'आईडी',
                            'mass-delete-success' => 'चयनित डेटा सफलतापूर्वक हटा दिया गया',
                            'reason-error'        => 'कारण RMA में उपयोग किया गया है।',
                            'reason'              => 'कारण',
                            'status'              => 'स्थिति',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'नया कारण जोड़ें',
                        'reason'       => 'कारण',
                        'save-btn'     => 'कारण सहेजें',
                        'status'       => 'स्थिति',
                        'success'      => 'कारण सफलतापूर्वक बनाया गया।',
                    ],

                    'edit' => [
                        'edit-title'          => 'कारण संपादित करें',
                        'mass-update-success' => 'चयनित कारण सफलतापूर्वक अपडेट किए गए।',
                        'reason'              => 'कारण',
                        'save-btn'            => 'कारण सहेजें',
                        'status'              => 'स्थिति',
                        'success'             => 'कारण सफलतापूर्वक अपडेट किया गया।',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'नया फ़ील्ड जोड़ें',
                        'title'      => 'RMA कस्टम फ़ील्ड्स',

                        'datagrid' => [
                            'created-at'          => 'बनाया गया',
                            'delete-success'      => 'कस्टम फ़ील्ड्स को सफलतापूर्वक हटा दिया गया।',
                            'disabled'            => 'निष्क्रिय',
                            'enabled'             => 'सक्रिय',
                            'id'                  => 'आईडी',
                            'mass-delete-success' => 'चयनित डेटा सफलतापूर्वक हटाया गया।',
                            'status'              => 'स्थिति',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'नया कस्टम फ़ील्ड',
                        'save-btn'     => 'कस्टम फ़ील्ड सहेजें',
                        'status'       => 'स्थिति',
                        'success'      => 'कस्टम फ़ील्ड सफलतापूर्वक बनाया गया।',
                    ],

                    'edit' => [
                        'edit-title'          => 'कस्टम फ़ील्ड संपादित करें',
                        'mass-update-success' => 'चयनित कस्टम फ़ील्ड्स को सफलतापूर्वक अपडेट किया गया।',
                        'reason'              => 'कस्टम फ़ील्ड',
                        'save-btn'            => 'कस्टम फ़ील्ड सहेजें',
                        'status'              => 'स्थिति',
                        'success'             => 'कस्टम फ़ील्ड सफलतापूर्वक अपडेट किया गया।',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'RMA नियम बनाएं',
                        'title'      => 'RMA नियम',

                        'datagrid' => [
                            'delete-success'      => 'RMA नियम सफलतापूर्वक हटाए गए।',
                            'disabled'            => 'निष्क्रिय',
                            'enabled'             => 'सक्रिय',
                            'exchange-period'     => 'विनिमय अवधि (दिन)',
                            'id'                  => 'आईडी',
                            'mass-delete-success' => 'चयनित डेटा सफलतापूर्वक हटाया गया।',
                            'reason'              => 'नियम',
                            'return-period'       => 'वापसी अवधि (दिन)',
                            'status'              => 'स्थिति',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'नए RMA नियम जोड़ें',
                        'reason'             => 'RMA नियम',
                        'rule-description'   => 'नियमों का विवरण',
                        'rule-details'       => 'नियमों का विवरण',
                        'resolutions-period' => 'समाधान अवधि',
                        'rules-title'        => 'नियमों का शीर्षक',
                        'save-btn'           => 'RMA नियम सहेजें',
                        'status'             => 'RMA स्थिति',
                        'success'            => 'RMA नियम सफलतापूर्वक बनाए गए।',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA नियम संपादित करें',
                        'mass-update-success' => 'चयनित RMA नियम सफलतापूर्वक अपडेट किए गए।',
                        'reason'              => 'RMA नियम',
                        'save-btn'            => 'RMA नियम अपडेट करें',
                        'status'              => 'स्थिति',
                        'success'             => 'RMA नियम सफलतापूर्वक अपडेट किए गए।',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'आरएमए सफलतापूर्वक बनाई गई।',
                    'create-title'             => 'आरएमए बनाएं',
                    'email'                    => 'ईमेल',
                    'image'                    => 'छवि',
                    'invalid-order-id'         => 'अमान्य आदेश आईडी',
                    'mismatch'                 => 'आदेश आईडी और ईमेल मेल नहीं खाते',
                    'new-rma'                  => 'नया आरएमए',
                    'order-id'                 => 'आदेश आईडी',
                    'quantity'                 => 'मात्रा',
                    'reason'                   => 'कारण',
                    'rma-already-exist'        => 'यह आरएमए पहले से मौजूद है',
                    'rma-not-available-quotes' => 'आइटम आरएमए के लिए उपलब्ध नहीं है',
                    'save-btn'                 => 'सहेजें',
                    'search'                   => '--चयन करें--',
                    'validate'                 => 'मान्य करें',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'आरएमए सफलतापूर्वक बनाई गई है',
                    'rma-created-message'  => 'RMA अनुरोध :qty मात्रा वाले उत्पाद के लिए उपलब्ध है'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'हटाएं',
            'edit'        => 'संपादित करें',
            'mass-delete' => 'थोक में हटाएं',
            'mass-update' => 'थोक में अपडेट करें',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'वितरित',
            'menu-name'    => 'आरएमए',
            'offer'        => 'अपने पहले ऑर्डर पर 40% तक की छूट पाएं',
            'rma-qty'      => 'RMA मात्रा',
            'shop-now'     => 'अभी खरीदें',
            'submit-req'   => 'अनुरोध सबमिट करें',
            'title'        => 'आरएमए',
            'undelivered'  => 'अवितरित',

            'create' => [
                'cancel'                   => 'रद्द करें',
                'create-btn'               => 'सहेजें',
                'enter-order-id'           => 'आदेश आईडी दर्ज करें',
                'heading'                  => 'नया आरएमए अनुरोध',
                'exchange-window'          => 'विनिमय विंडो',
                'image'                    => 'छवि',
                'images'                   => 'छवियाँ',
                'information'              => 'अतिरिक्त जानकारी',
                'item-ordered'             => 'आदेश किया गया आइटम',
                'no-record'                => 'कोई रिकॉर्ड नहीं मिला!',
                'not-allowed'              => 'RMA लंबित आदेश के लिए अनुमति नहीं है',
                'order-status'             => 'ऑर्डर स्थिति',
                'orders'                   => 'आदेश',
                'price'                    => 'मूल्य',
                'product-name'             => 'उत्पाद का नाम',
                'product'                  => 'उत्पाद',
                'quantity'                 => 'मात्रा',
                'reason'                   => 'कारण',
                'reopen-request'           => 'अनुरोध फिर से खोलें',
                'resolution'               => 'समाधान चुनें',
                'return-window'            => 'वापसी विंडो',
                'rma-not-available-quotes' => 'RMA के लिए आइटम उपलब्ध नहीं है',
                'save'                     => 'सहेजें',
                'search-order'             => 'आदेश खोजें',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'आरएमए बंद करें:',
                'order-status' => 'ऑर्डर स्थिति:',
                'rma-status'   => 'आरएमए स्थिति:',
                'title'        => 'आरएमए',
            ],

            'create' => [
                'cancel'                   => 'रद्द करें',
                'create-btn'               => 'सहेजें',
                'enter-order-id'           => 'आदेश आईडी दर्ज करें',
                'heading'                  => 'नया आरएमए अनुरोध',
                'image'                    => 'छवि',
                'images'                   => 'छवियाँ',
                'information'              => 'अतिरिक्त जानकारी',
                'item-ordered'             => 'आदेश किया गया आइटम',
                'not-allowed'              => 'RMA लंबित आदेश के लिए अनुमति नहीं है',
                'order-status'             => 'ऑर्डर स्थिति',
                'orders'                   => 'आदेश',
                'price'                    => 'मूल्य',
                'product-name'             => 'उत्पाद का नाम',
                'product'                  => 'उत्पाद',
                'quantity'                 => 'मात्रा',
                'reason'                   => 'कारण',
                'reopen-request'           => 'अनुरोध फिर से खोलें',
                'resolution'               => 'समाधान चुनें',
                'rma-not-available-quotes' => 'RMA के लिए आइटम उपलब्ध नहीं है',
                'save'                     => 'सहेजें',
                'search-order'             => 'आदेश खोजें',
                'sku'                      => 'SKU',
                'title'                    => 'आरएमए',
            ],

            'index' => [
                'create'  => 'नया आरएमए अनुरोध करें',
                'delete'  => 'हटाएं',
                'edit'    => 'संपादित करें',
                'guest'   => 'अतिथि आरएमए पैनल',
                'heading' => 'अतिथि आरएमए पैनल',
                'update'  => 'अपडेट करें',
                'view'    => 'देखें',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'बनाएं',
            'delete'  => 'हटाएं',
            'edit'    => 'संपादित करें',
            'guest'   => 'अतिथि आरएमए पैनल',
            'heading' => 'आरएमए',
            'update'  => 'अपडेट करें',
            'view'    => 'देखें',
        ],

        'validation' => [
            'close-rma'     => 'पुष्टि करें',
            'information'   => 'अतिरिक्त जानकारी',
            'order-id'      => 'ऑर्डर चयन',
            'order-status'  => 'ऑर्डर स्थिति',
            'orders'        => 'आदेश',
            'resolution'    => 'समाधान',
            'select-orders' => 'आदेश चुनें',
        ],

        'conversation-texts' => [
            'by'        => 'द्वारा',
            'customer'  => 'ग्राहक',
            'no-record' => 'कोई रिकॉर्ड नहीं मिला!',
            'on'        => 'पर',
            'seller'    => 'विक्रेता',
        ],

        'default-option' => [
            'others'              => 'अन्य',
            'please-select-value' => 'कृपया मान चुनें',
            'select-order-status' => 'ऑर्डर स्थिति चुनें',
            'select-order'        => 'आदेश चुनें',
            'select-quantity'     => 'मात्रा चुनें',
            'select-reason'       => 'कारण चुनें',
            'select-resolution'   => 'समाधान चुनें',
            'select-seller'       => 'विक्रेता चुनें',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'अतिरिक्त जानकारी :',
            'admin'                   => 'व्यवस्थापक',
            'cancel-order'            => 'ऑर्डर रद्द करें',
            'change-rma-status'       => 'आरएमए स्थिति बदलें',
            'close-rma'               => 'आरएमए बंद करें :',
            'conversations'           => 'बातचीतें',
            'guest'                   => 'अतिथि',
            'heading'                 => 'आरएमए विवरण',
            'images'                  => 'तस्वीरें:',
            'items-request'           => 'RMA के लिए मांगी गई वस्तु(एँ)',
            'items-requested-for-rma' => 'RMA के लिए मांगी गई वस्तु(एँ)',
            'order-id'                => 'आदेश आईडी :',
            'refund-details'          => 'धन वापसी विवरण',
            'refund-offline-btn'      => 'ऑफलाइन धन वापसी',
            'refundable-amount'       => 'धन वापसी योग्य राशि',
            'resolution-type'         => 'समाधान प्रकार :',
            'rma'                     => 'आरएमए',
            'save-btn'                => 'सहेजें',
            'send-message-btn'        => 'भेजें',
            'send-message'            => 'संदेश भेजें',
            'status-details'          => 'स्थिति विवरण',
            'status-quotes'           => 'कृपया सहमत होने के लिए चिह्नित करें',
            'status-reopen'           => 'फिर से खोलने के लिए चेक करें',
            'status'                  => 'स्थिति',
            'term'                    => 'सहमति चिह्न क्षेत्र आवश्यक है',
            'you'                     => 'व्यवस्थापक',
        ],

        'view-guest-rma' => [
            'additional-information' => 'अतिरिक्त जानकारी :',
            'admin'                  => 'व्यवस्थापक',
            'close-rma'              => 'आरएमए बंद करें',
            'conversations'          => 'बातचीतें',
            'guest'                  => 'आप',
            'images'                 => 'तस्वीरें',
            'items-request'          => 'RMA के लिए मांगी गई वस्तु(एँ)',
            'order-id'               => ' आदेश आईडी :',
            'refund-offline-btn'     => 'ऑफलाइन धन वापसी',
            'resolution-type'        => 'समाधान प्रकार :',
            'rma'                    => 'आरएमए',
            'save-btn'               => 'सहेजें',
            'send-message-btn'       => 'भेजें',
            'send-message'           => 'संदेश भेजें',
            'status-details'         => 'स्थिति विवरण',
            'status-quotes'          => 'कृपया सहमत होने के लिए चिह्नित करें।',
            'status'                 => 'स्थिति',
            'term'                   => 'सहमति चिह्न क्षेत्र आवश्यक है',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'पूर्ण राशि',
            'order-status' => 'ऑर्डर स्थिति :',
            'request-on'   => 'पर अनुरोध :',
            'rma-status'   => 'आरएमए स्थिति :',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'व्यवस्थापक स्थिति :',
            'close-rma'               => 'आरएमए बंद करें',
            'consignment-no'          => 'वितरण संख्या :',
            'enter-message'           => 'संदेश दर्ज करें',
            'full-amount'             => 'पूर्ण राशि',
            'order-details'           => 'ऑर्डर विवरण',
            'order-status'            => 'ऑर्डर स्थिति :',
            'partial-amount'          => 'आंशिक राशि',
            'refundable-amount'       => 'धन वापसी योग्य राशि',
            'request-on'              => 'पर अनुरोध :',
            'rma-status'              => 'आरएमए स्थिति :',
            'seller'                  => 'विक्रेता',
            'total-refundable-amount' => 'कुल धन वापसी योग्य राशि :',
        ],

        'table-heading' => [
            'image'           => 'चित्र',
            'product-name'    => 'उत्पाद का नाम',
            'sku'             => 'एसकेयू',
            'price'           => 'कीमत',
            'rma-qty'         => 'RMA मात्रा',
            'order-qty'       => 'आदेश मात्रा',
            'resolution-type' => 'समाधान प्रकार',
            'reason'          => 'कारण',
        ],

        'guest-users' => [
            'button-text' => 'लॉग इन करें',
            'email'       => 'ईमेल',
            'heading'     => 'अतिथि लॉगिन पैनल',
            'logout'      => 'अतिथि लॉगआउट',
            'order-id'    => 'ऑर्डर आईडी',
            'title'       => 'अतिथि लॉगिन',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'अतिरिक्त जानकारी :',
            'greeting'               => 'आपने ऑर्डर :order_id के लिए नई आरएमए का अनुरोध किया है।',
            'heading'                => 'आरएमए अनुरोध',
            'hello'                  => 'प्रिय :name',
            'order-id'               => 'ऑर्डर आईडी :',
            'order-status'           => 'ऑर्डर स्थिति :',
            'requested-rma-product'  => 'अनुरोधित आरएमए का उत्पाद:',
            'resolution-type'        => 'समाधान प्रकार :',
            'rma-id'                 => 'आरएमए आईडी :',
            'summary'                => 'आरडर की आरएमए का सारांश',
            'thank-you'              => 'धन्यवाद',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'उत्पाद का नाम',
            'qty'          => 'मात्रा',
            'reason'       => 'कारण',
            'sku'          => 'एसकेयू',
        ],

        'customer-conversation' => [
            'heading' => 'प्रिय :name,',
            'message' => 'संदेश',
            'quotes'  => 'खरीदार से नई संदेश है',
            'process' => 'आपकी रिटर्न अनुरोध प्रक्रिया में है।',
            'solved'  => 'ग्राहक द्वारा RMA स्थिति को हल किया गया है।',
        ],

        'seller-conversation' => [
            'heading' => 'प्रिय :name',
            'message' => 'संदेश',
            'quotes'  => 'प्रशासक से एक नया संदेश है',
            'title'   => 'संदेश प्राप्त हुआ!',
        ],

        'status' => [
            'heading'       => 'प्रिय :name',
            'quotes'        => 'आपकी आरएमए स्थिति को विक्रेता ने बदल दिया है',
            'rma-id'        => 'आरएमए आईडी',
            'status-change' => ':id की स्थिति विक्रेता द्वारा बदल दी गई है',
            'status'        => 'स्थिति',
            'title'         => 'स्थिति अपडेट!',
            'your-rma-id'   => 'आपका आरएमए आईडी',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'स्वीकृत',
            'awaiting'                 => 'प्रतीक्षारत',
            'canceled'                 => 'रद्द किया गया',
            'declined'                 => 'अस्वीकृत',
            'dispatched-package'       => 'पैकेज भेजा गया',
            'item-canceled'            => 'आइटम रद्द',
            'not-received-package-yet' => 'अभी तक पैकेज प्राप्त नहीं हुआ',
            'pending'                  => 'विचाराधीन',
            'processing'               => 'प्रसंस्करण',
            'received-package'         => 'पैकेज प्राप्त हुआ',
            'solved'                   => 'समाधान हुआ',
        ],

        'status-quotes' => [
            'declined-admin'  => 'आरएमए व्यवस्थापक द्वारा अस्वीकृत किया गया है।',
            'declined-buyer'  => 'आरएमए खरीदार द्वारा अस्वीकृत किया गया है।',
            'solved-by-admin' => 'आरएमए व्यवस्थापक द्वारा समाधान हुआ है।',
            'solved'          => 'आरएमए समाधान हुआ है।',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA स्थिति पहले ही रद्द की जा चुकी है।',
        'cancel-success'    => 'RMA स्थिति सफलतापूर्वक रद्द कर दी गई।',
        'create-success'    => 'अनुरोध सफलतापूर्वक बनाया गया।',
        'creation-error'    => 'RMA स्थिति को अपडेट नहीं किया जा सकता क्योंकि इस ऑर्डर के लिए चालान नहीं बनाया गया है।',
        'permission-denied' => 'आप लॉग इन हैं',
        'rma-disabled'      => 'इस उत्पाद के लिए आरएमए निष्क्रिय किया गया है',
        'send-message'      => ':name सफलतापूर्वक भेजा गया।',
        'update-success'    => ':name सफलतापूर्वक अपडेट किया गया।',
    ],
];