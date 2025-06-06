<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'দুপুর',
                        'all-products'                        => 'সব পণ্য',
                        'all-status'                          => 'সব অবস্থা',
                        'allow-new-request-for-pending-order' => 'মুলতুবি অর্ডারের জন্য নতুন RMA অনুরোধ অনুমোদন করুন',
                        'allow-rma-for-digital-product'       => 'ডিজিটাল পণ্যের জন্য RMA অনুমোদন করুন',
                        'allowed-file-extension'              => 'অনুমোদিত ফাইল এক্সটেনশন',
                        'allowed-file-types'                  => 'অনুগ্রহ করে ফাইলের ধরন নির্বাচন করুন ' . core()->getConfigData('sales.rma.setting.allowed-file-extension') . ' কেবল', 
                        'allowed-info'                        => 'কমা দিয়ে পৃথক করা হয়েছে। উদাহরণস্বরূপ: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'বাতিল অনুরোধের জন্য নতুন RMA অনুরোধ অনুমোদন করুন',
                        'allowed-request-declined-request'    => 'প্রত্যাখ্যাত অনুরোধের জন্য নতুন RMA অনুরোধ অনুমোদন করুন',
                        'allowed-rma-for-product'             => 'পণ্যের জন্য RMA অনুমোদন',
                        'cancel-items'                        => 'আইটেম বাতিল করুন',
                        'complete'                            => 'সম্পূর্ণ',
                        'current-order-quantity'              => 'বর্তমান অর্ডারের পরিমাণ',
                        'days-info'                           => 'অর্ডার দেওয়ার পরে গ্রাহক কত দিনের মধ্যে একটি RMA অনুরোধ করতে পারেন।',
                        'default-allow-days'                  => 'ডিফল্ট অনুমোদিত দিন',
                        'enable'                              => 'RMA সক্রিয় করুন',
                        'evening'                             => 'সন্ধ্যা',
                        'exchange'                            => 'বিনিময়',
                        'info'                                => 'RMA একটি প্রক্রিয়ার অংশ যা পণ্য ফেরত দিয়ে রিফান্ড, প্রতিস্থাপন বা মেরামত পেতে হয়।',
                        'morning'                             => 'সকাল',
                        'new-rma-message-to-customer'         => 'গ্রাহকের জন্য নতুন RMA বার্তা',
                        'no'                                  => 'না',
                        'open'                                => 'খোলা',
                        'package-condition'                   => 'প্যাকেজের অবস্থা',
                        'packed'                              => 'প্যাক করা হয়েছে',
                        'print-page'                          => 'প্রিন্ট পৃষ্ঠা', 
                        'product-already-raw'                 => 'পণ্যটি ইতিমধ্যে RMA তে রয়েছে।',
                        'product-delivery-status'             => 'পণ্য বিতরণের অবস্থা',
                        'resolution-type'                     => 'সমাধানের ধরন',
                        'return-pickup-address'               => 'ফেরত পিকআপ ঠিকানা',
                        'return-pickup-time'                  => 'ফেরত পিকআপ সময়',
                        'return-policy'                       => 'ফেরত নীতি',
                        'return'                              => 'ফেরত',
                        'select-allowed-order-status'         => 'অনুমোদিত অর্ডার অবস্থা নির্বাচন করুন',
                        'specific-products'                   => 'নির্দিষ্ট পণ্য',
                        'title'                               => 'RMA',
                        'yes'                                 => 'হ্যাঁ',

                        'setting' => [
                            'info'  => 'RMA কার্যকারিতা এমন পরিস্থিতি পরিচালনা করতে সহায়তা করে যেখানে একটি গ্রাহক মেরামত এবং রক্ষণাবেক্ষণের জন্য বা ফেরত বা প্রতিস্থাপনের জন্য আইটেমগুলি ফেরত দেয়।',
                            'read'  => 'নীতি পড়ুন',
                            'terms' => 'আমি ফেরত নীতিটি পড়েছি এবং গ্রহণ করেছি।', 
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
                    'create-rma-title' => 'RMA তৈরি করুন',
                    'reason-title'     => 'কারণ',
                    'rma-title'        => 'সমস্ত RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'সমস্ত RMA',

                        'datagrid' => [
                            'create'        => 'তৈরি হয়েছে',
                            'customer-name' => 'গ্রাহকের নাম',
                            'id'            => 'RMA আইডি',
                            'order-ref'     => 'অর্ডার রেফারেন্স',
                            'order-status'  => 'অর্ডারের স্ট্যাটাস',
                            'rma-status'    => 'RMA স্ট্যাটাস',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'সংযুক্তি যুক্ত করুন',
                        'additional-information' => 'অতিরিক্ত তথ্য:',
                        'attachment'             => 'সংযুক্তি',
                        'change-status'          => 'স্থিতি পরিবর্তন করুন',
                        'confirm-print'          => 'RMA মুদ্রণের জন্য ঠিক আছে ক্লিক করুন',
                        'conversations'          => 'আলাপচারিতা',
                        'customer-details'       => 'গ্রাহকের বিবরণ',
                        'customer-email'         => 'গ্রাহকের ইমেইল:',
                        'customer'               => 'গ্রাহক:',
                        'enter-message'          => 'বার্তা লিখুন',
                        'images'                 => 'ছবি:',
                        'no-record'              => 'কোনো রেকর্ড পাওয়া যায়নি!',
                        'order-date'             => 'অর্ডারের তারিখ:',
                        'order-details'          => 'RMA এর জন্য অনুরোধকৃত আইটেম',
                        'order-id'               => 'অর্ডার আইডি:',
                        'order-status'           => 'অর্ডারের স্থিতি:',
                        'order-total'            => 'মোট অর্ডার:',
                        'request-on'             => 'অনুরোধের তারিখ:',
                        'resolution-type'        => 'সমাধানের ধরন:',
                        'rma-status'             => 'RMA স্থিতি:',
                        'save-btn'               => 'সংরক্ষণ করুন',
                        'send-message-btn'       => 'বার্তা পাঠান',
                        'send-message-success'   => 'বার্তা সফলভাবে পাঠানো হয়েছে।',
                        'send-message'           => 'বার্তা পাঠান',
                        'status'                 => 'স্থিতি',
                        'title'                  => 'RMA',
                        'update-success'         => 'RMA স্থিতি সফলভাবে আপডেট হয়েছে।',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'RMA স্ট্যাটাস তৈরি করুন',
                        'title'      => 'RMA স্ট্যাটাস',

                        'datagrid' => [
                            'created-at'          => 'তৈরি হয়েছে',
                            'delete-success'      => 'RMA স্ট্যাটাস সফলভাবে মুছে ফেলা হয়েছে।',
                            'disabled'            => 'নিষ্ক্রিয়',
                            'enabled'             => 'সক্রিয়',
                            'id'                  => 'আইডি',
                            'mass-delete-success' => 'নির্বাচিত RMA স্ট্যাটাস সফলভাবে মুছে ফেলা হয়েছে।',
                            'reason-error'        => 'RMA স্ট্যাটাস RMA তে ব্যবহৃত হচ্ছে।',
                            'reason'              => 'RMA স্ট্যাটাস',
                            'status'              => 'স্ট্যাটাস',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'নতুন RMA স্ট্যাটাস যোগ করুন',
                        'reason'       => 'RMA স্ট্যাটাস',
                        'save-btn'     => 'RMA স্ট্যাটাস সংরক্ষণ করুন',
                        'status'       => 'স্ট্যাটাস',
                        'success'      => 'RMA স্ট্যাটাস সফলভাবে তৈরি করা হয়েছে।',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA স্ট্যাটাস সম্পাদনা করুন',
                        'mass-update-success' => 'নির্বাচিত RMA স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে।',
                        'reason'              => 'RMA স্ট্যাটাস',
                        'save-btn'            => 'RMA স্ট্যাটাস সংরক্ষণ করুন',
                        'status'              => 'স্ট্যাটাস',
                        'success'             => 'RMA স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে।',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'RMA কারণ তৈরি করুন',
                        'title'      => 'কারণ',

                        'datagrid' => [
                            'created-at'          => 'তৈরি হয়েছে',
                            'delete-success'      => 'কারণটি সফলভাবে মুছে ফেলা হয়েছে।',
                            'disabled'            => 'নিষ্ক্রিয়',
                            'enabled'             => 'সক্রিয়',
                            'id'                  => 'আইডি',
                            'mass-delete-success' => 'নির্বাচিত তথ্য সফলভাবে মুছে ফেলা হয়েছে',
                            'reason-error'        => 'কারণটি RMA এ ব্যবহৃত হচ্ছে।',
                            'reason'              => 'কারণ',
                            'status'              => 'স্ট্যাটাস',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'নতুন কারণ যোগ করুন',
                        'reason'       => 'কারণ',
                        'save-btn'     => 'কারণ সংরক্ষণ করুন',
                        'status'       => 'স্ট্যাটাস',
                        'success'      => 'কারণ সফলভাবে তৈরি হয়েছে।',
                    ],

                    'edit' => [
                        'edit-title'          => 'কারণ সম্পাদনা করুন',
                        'mass-update-success' => 'নির্বাচিত কারণগুলি সফলভাবে আপডেট হয়েছে।',
                        'reason'              => 'কারণ',
                        'save-btn'            => 'কারণ সংরক্ষণ করুন',
                        'status'              => 'স্ট্যাটাস',
                        'success'             => 'কারণটি সফলভাবে আপডেট হয়েছে।',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'নতুন ক্ষেত্র যোগ করুন',
                        'title'      => 'RMA কাস্টম ক্ষেত্র',

                        'datagrid' => [
                            'created-at'          => 'তৈরির তারিখ',
                            'delete-success'      => 'কাস্টম ক্ষেত্র সফলভাবে মুছে ফেলা হয়েছে।',
                            'disabled'            => 'নিষ্ক্রিয়',
                            'enabled'             => 'সক্রিয়',
                            'id'                  => 'আইডি',
                            'mass-delete-success' => 'নির্বাচিত তথ্য সফলভাবে মুছে ফেলা হয়েছে',
                            'status'              => 'অবস্থা',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'নতুন কাস্টম ক্ষেত্র',
                        'save-btn'     => 'কাস্টম ক্ষেত্র সংরক্ষণ করুন',
                        'status'       => 'অবস্থা',
                        'success'      => 'কাস্টম ক্ষেত্র সফলভাবে তৈরি হয়েছে।',
                    ],

                    'edit' => [
                        'edit-title'          => 'কাস্টম ক্ষেত্র সম্পাদনা করুন',
                        'mass-update-success' => 'নির্বাচিত কাস্টম ক্ষেত্র সফলভাবে আপডেট হয়েছে।',
                        'reason'              => 'কাস্টম ক্ষেত্র',
                        'save-btn'            => 'কাস্টম ক্ষেত্র সংরক্ষণ করুন',
                        'status'              => 'অবস্থা',
                        'success'             => 'কাস্টম ক্ষেত্র সফলভাবে আপডেট হয়েছে।',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'RMA নিয়ম তৈরি করুন',
                        'title'      => 'RMA নিয়ম',

                        'datagrid' => [
                            'delete-success'      => 'RMA নিয়ম সফলভাবে মুছে ফেলা হয়েছে।',
                            'disabled'            => 'নিষ্ক্রিয়',
                            'enabled'             => 'সক্রিয়',
                            'exchange-period'     => 'বিনিময় সময়কাল (দিন)',
                            'id'                  => 'আইডি',
                            'mass-delete-success' => 'নির্বাচিত ডেটা সফলভাবে মুছে ফেলা হয়েছে।',
                            'reason'              => 'নিয়ম',
                            'return-period'       => 'ফেরত সময়কাল (দিন)',
                            'status'              => 'অবস্থা',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'নতুন RMA নিয়ম যোগ করুন',
                        'reason'             => 'RMA নিয়ম',
                        'resolutions-period' => 'সমাধান সময়কাল',
                        'rule-description'   => 'নিয়মের বিবরণ',
                        'rule-details'       => 'নিয়মের বিবরণী',
                        'rules-title'        => 'নিয়মের শিরোনাম',
                        'save-btn'           => 'RMA নিয়ম সংরক্ষণ করুন',
                        'status'             => 'RMA অবস্থা',
                        'success'            => 'RMA নিয়ম সফলভাবে তৈরি করা হয়েছে।',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA নিয়ম সম্পাদনা করুন',
                        'mass-update-success' => 'নির্বাচিত RMA নিয়ম সফলভাবে আপডেট করা হয়েছে।',
                        'reason'              => 'RMA নিয়ম',
                        'save-btn'            => 'RMA নিয়ম আপডেট করুন',
                        'status'              => 'অবস্থা',
                        'success'             => 'RMA নিয়ম সফলভাবে আপডেট করা হয়েছে।',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA সফলভাবে তৈরি হয়েছে।',
                    'create-title'             => 'RMA তৈরি করুন',
                    'email'                    => 'ইমেল',
                    'image'                    => 'চিত্র',
                    'invalid-order-id'         => 'অবৈধ অর্ডার আইডি',
                    'mismatch'                 => 'অর্ডার আইডি এবং ইমেলের মিল নেই',
                    'new-rma'                  => 'নতুন RMA',
                    'order-id'                 => 'অর্ডার আইডি',
                    'quantity'                 => 'পরিমাণ',
                    'reason'                   => 'কারণ',
                    'rma-already-exist'        => 'RMA ইতিমধ্যে বিদ্যমান',
                    'rma-not-available-quotes' => 'আইটেম RMA এর জন্য পাওয়া যায়নি',
                    'save-btn'                 => 'সংরক্ষণ করুন',
                    'search'                   => '--নির্বাচন করুন--',
                    'validate'                 => 'যাচাই করুন',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA তৈরি করা হয়েছে',
                    'rma-created-message'  => 'RMA অনুরোধটি :qty পরিমাণ পণ্যের জন্য উপলব্ধ'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'মুছে ফেলুন',
            'edit'        => 'সম্পাদনা',
            'mass-delete' => 'সামগ্রিক মুছুন',
            'mass-update' => 'সামগ্রিক আপডেট',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'বিতরণ করা হয়েছে',
            'menu-name'    => 'আরএমএ',
            'offer'        => 'আপনার প্রথম অর্ডারে ৪০% পর্যন্ত ছাড় পান',
            'rma-qty'      => 'RMA পরিমাণ',
            'shop-now'     => 'এখনই কেনাকাটা করুন',
            'submit-req'   => 'অনুরোধ জমা দিন',
            'title'        => 'আরএমএ',
            'undelivered'  => 'অপ্রদত্ত',

            'create' => [
                'cancel'                   => 'বাতিল করুন',
                'create-btn'               => 'সংরক্ষণ করুন',
                'enter-order-id'           => 'অর্ডার আইডি প্রবেশ করুন',
                'heading'                  => 'নতুন আরএমএ অনুরোধ',
                'exchange-window'          => 'বিনিময় উইন্ডো',
                'image'                    => 'ছবি',
                'images'                   => 'ছবি',
                'information'              => 'অতিরিক্ত তথ্য',
                'item-ordered'             => 'অর্ডার করা আইটেম',
                'no-record'                => 'কোনও রেকর্ড পাওয়া যায়নি!',
                'not-allowed'              => 'বিচারাধীন অর্ডারের জন্য আরএমএ অনুমোদিত নয়',
                'order-status'             => 'অর্ডারের অবস্থা',
                'orders'                   => 'অর্ডারসমূহ',
                'price'                    => 'মূল্য',
                'product-name'             => 'পণ্যের নাম',
                'product'                  => 'পণ্য',
                'quantity'                 => 'পরিমাণ',
                'reason'                   => 'কারণ',
                'reopen-request'           => 'আবার অনুরোধ করুন',
                'resolution'               => 'সমাধান নির্বাচন করুন',
                'return-window'            => 'ফেরত উইন্ডো',
                'rma-not-available-quotes' => 'আরএমএর জন্য উপলব্ধ নয়',
                'save'                     => 'সংরক্ষণ করুন',
                'search-order'             => 'অর্ডার অনুসন্ধান করুন',
                'sku'                      => 'এসকিউ',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'আরএমএ বন্ধ করুন:',
                'order-status' => 'অর্ডারের অবস্থা:',
                'rma-status'   => 'আরএমএর অবস্থা:',
                'title'        => 'আরএমএ',
            ],

            'create' => [
                'cancel'                   => 'বাতিল করুন',
                'create-btn'               => 'সংরক্ষণ করুন',
                'enter-order-id'           => 'অর্ডার আইডি প্রবেশ করুন',
                'heading'                  => 'নতুন আরএমএ অনুরোধ',
                'image'                    => 'ছবি',
                'images'                   => 'ছবি',
                'information'              => 'অতিরিক্ত তথ্য',
                'item-ordered'             => 'অর্ডার করা আইটেম',
                'not-allowed'              => 'বিচারাধীন অর্ডারের জন্য আরএমএ অনুমোদিত নয়',
                'order-status'             => 'অর্ডারের অবস্থা',
                'orders'                   => 'অর্ডারসমূহ',
                'price'                    => 'মূল্য',
                'product-name'             => 'পণ্যের নাম',
                'product'                  => 'পণ্য',
                'quantity'                 => 'পরিমাণ',
                'reason'                   => 'কারণ',
                'reopen-request'           => 'আবার অনুরোধ করুন',
                'resolution'               => 'সমাধান নির্বাচন করুন',
                'rma-not-available-quotes' => 'আরএমএর জন্য উপলব্ধ নয়',
                'save'                     => 'সংরক্ষণ করুন',
                'search-order'             => 'অর্ডার অনুসন্ধান করুন',
                'sku'                      => 'এসকিউ',
                'title'                    => 'আরএমএ',
            ],

            'index' => [
                'create'  => 'নতুন আরএমএ অনুরোধ',
                'delete'  => 'মুছুন',
                'edit'    => 'সম্পাদনা করুন',
                'guest'   => 'অতিথি আরএমএ প্যানেল',
                'heading' => 'গ্রাহক আরএমএ প্যানেল',
                'update'  => 'আপডেট করুন',
                'view'    => 'দেখুন',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'তৈরি করুন',
            'delete'  => 'মুছুন',
            'edit'    => 'সম্পাদনা করুন',
            'guest'   => 'অতিথি আরএমএ প্যানেল',
            'heading' => 'আরএমএ',
            'update'  => 'আপডেট করুন',
            'view'    => 'দেখুন',
        ],

        'validation' => [
            'close-rma'     => 'নিশ্চিত করুন',
            'information'   => 'অতিরিক্ত তথ্য',
            'order-id'      => 'অর্ডার নির্বাচন',
            'order-status'  => 'অর্ডারের অবস্থা',
            'orders'        => 'অর্ডারসমূহ',
            'resolution'    => 'সমাধান',
            'select-orders' => 'অর্ডার নির্বাচন করুন',
        ],

        'conversation-texts' => [
            'by'        => 'দ্বারা',
            'customer'  => 'গ্রাহক',
            'no-record' => 'কোনও রেকর্ড পাওয়া যায়নি!',
            'on'        => 'উপর',
            'seller'    => 'বিক্রেতা',
        ],

        'default-option' => [
            'others'              => 'অন্যান্য',
            'please-select-value' => 'দয়া করে মান নির্বাচন করুন',
            'select-order-status' => 'অর্ডারের অবস্থা নির্বাচন করুন',
            'select-order'        => 'অর্ডার নির্বাচন করুন',
            'select-quantity'     => 'পরিমাণ নির্বাচন করুন',
            'select-reason'       => 'কারণ নির্বাচন করুন',
            'select-resolution'   => 'সমাধান নির্বাচন করুন',
            'select-seller'       => 'বিক্রেতা নির্বাচন করুন',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'অতিরিক্ত তথ্য:',
            'admin'                   => 'অ্যাডমিন',
            'cancel-order'            => 'অর্ডার বাতিল করুন',
            'change-rma-status'       => 'আরএমএর অবস্থা পরিবর্তন করুন',
            'close-rma'               => 'আরএমএ বন্ধ করুন:',
            'conversations'           => 'আলাপচারিতা',
            'guest'                   => 'অতিথি',
            'heading'                 => 'আরএমএ বিবরণ',
            'images'                  => 'ছবি:',
            'items-request'           => 'আরএমএর জন্য অনুরোধকৃত আইটেম(গুলি)',
            'items-requested-for-rma' => 'আরএমএর জন্য অনুরোধকৃত আইটেম(গুলি)',
            'order-id'                => 'অর্ডার আইডি:',
            'refund-details'          => 'ফেরত বিবরণ',
            'refund-offline-btn'      => 'অফলাইন ফেরত',
            'refundable-amount'       => 'ফেরতযোগ্য পরিমাণ',
            'resolution-type'         => 'সমাধানের ধরন:',
            'rma'                     => 'আরএমএ',
            'save-btn'                => 'সংরক্ষণ করুন',
            'send-message-btn'        => 'বার্তা পাঠান',
            'send-message'            => 'বার্তা পাঠান',
            'status-details'          => 'অবস্থার বিবরণ',
            'status-quotes'           => 'সমাধান হিসেবে চিহ্নিত করতে সম্মত হন',
            'status-reopen'           => 'পুনরায় খোলার জন্য চেক করুন',
            'status'                  => 'অবস্থা',
            'term'                    => 'সম্মতি চিহ্ন ক্ষেত্র প্রয়োজনীয়',
            'you'                     => 'অ্যাডমিন',
        ],

        'view-guest-rma' => [
            'additional-information' => 'অতিরিক্ত তথ্য:',
            'admin'                  => 'অ্যাডমিন',
            'close-rma'              => 'আরএমএ বন্ধ করুন',
            'conversations'          => 'আলাপচারিতা',
            'guest'                  => 'আপনি',
            'images'                 => 'ছবি',
            'items-request'          => 'আরএমএর জন্য অনুরোধকৃত আইটেম(গুলি)',
            'order-id'               => 'অর্ডার আইডি:',
            'refund-offline-btn'     => 'অফলাইন ফেরত',
            'resolution-type'        => 'সমাধানের ধরন:',
            'rma'                    => 'আরএমএ',
            'save-btn'               => 'সংরক্ষণ করুন',
            'send-message-btn'       => 'বার্তা পাঠান',
            'send-message'           => 'বার্তা পাঠান',
            'status-details'         => 'অবস্থার বিবরণ',
            'status-quotes'          => 'সমাধান হিসেবে চিহ্নিত করতে সম্মত হন।',
            'status'                 => 'অবস্থা',
            'term'                   => 'সম্মতি চিহ্ন ক্ষেত্র প্রয়োজনীয়',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'পূর্ণ পরিমাণ',
            'order-status' => 'অর্ডারের অবস্থা :',
            'request-on'   => 'অনুরোধ প্রদান :',
            'rma-status'   => 'আরএমএ অবস্থা :',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'প্রশাসক অবস্থা:',
            'close-rma'               => 'আরএমএ বন্ধ করুন',
            'consignment-no'          => 'সমন্বয় নম্বর:',
            'enter-message'           => 'বার্তা লিখুন',
            'full-amount'             => 'পূর্ণ পরিমাণ',
            'order-details'           => 'অর্ডারের বিবরণ',
            'order-status'            => 'অর্ডারের অবস্থা :',
            'partial-amount'          => 'আংশিক পরিমাণ',
            'refundable-amount'       => 'পরিশোধযোগ্য পরিমাণ:',
            'request-on'              => 'অনুরোধ প্রদান :',
            'rma-status'              => 'আরএমএ অবস্থা :',
            'seller'                  => 'বিক্রেতা',
            'total-refundable-amount' => 'মোট পরিশোধযোগ্য পরিমাণ:',
        ],

        'table-heading' => [
            'image'           => 'ছবি',
            'order-qty'       => 'অর্ডার পরিমাণ',
            'price'           => 'মূল্য',
            'product-name'    => 'পণ্যের নাম',
            'reason'          => 'কারণ',
            'resolution-type' => 'সমাধানের ধরন',
            'rma-qty'         => 'RMA পরিমাণ',
            'sku'             => 'এসকেইউ',
        ],

        'guest-users' => [
            'button-text' => 'লগইন',
            'email'       => 'ইমেল',
            'heading'     => 'অতিথি লগইন প্যানেল',
            'logout'      => 'অতিথি লগআউট',
            'order-id'    => 'অর্ডার আইডি',
            'title'       => 'অতিথি লগইন',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'অতিরিক্ত তথ্য :',
            'greeting'               => 'আপনি অর্ডার :order_id এর জন্য নতুন RMA অনুরোধ করেছেন।',
            'heading'                => 'RMA অনুরোধ',
            'hello'                  => 'প্রিয় :name',
            'order-id'               => 'অর্ডার আইডি :',
            'order-status'           => 'অর্ডারের স্থিতি :',
            'requested-rma-product'  => 'অনুরোধিত RMA পণ্য:',
            'resolution-type'        => 'সমাধানের ধরণ :',
            'rma-id'                 => 'RMA আইডি :',
            'summary'                => 'অর্ডারের RMA সংক্ষিপ্তসারণ',
            'thank-you'              => 'ধন্যবাদ',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'পণ্যের নাম',
            'qty'          => 'পরিমাণ',
            'reason'       => 'কারণ',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'প্রিয় :name,',
            'message' => 'বার্তা',
            'process' => 'আপনার ফেরতের অনুরোধ প্রক্রিয়াধীন রয়েছে।',
            'quotes'  => 'ক্রেতার দিক থেকে একটি নতুন বার্তা রয়েছে',
            'solved'  => 'RMA স্থিতি গ্রাহকের দ্বারা সমাধান করা হয়েছে।',
        ],

        'seller-conversation' => [
            'heading' => 'প্রিয় :name',
            'message' => 'বার্তা',
            'quotes'  => 'অ্যাডমিন থেকে একটি নতুন বার্তা এসেছে',
            'title'   => 'বার্তা প্রাপ্ত হয়েছে!',
        ],

        'status' => [
            'heading'       => 'প্রিয় :name',
            'quotes'        => 'আপনার RMA অবস্থা বিক্রেতার দ্বারা পরিবর্তিত হয়েছে',
            'rma-id'        => 'RMA আইডি',
            'status-change' => ':id টি বিক্রেতার দ্বারা পরিবর্তিত হয়েছে',
            'status'        => 'অবস্থা',
            'title'         => 'অবস্থা আপডেট হয়েছে!',
            'your-rma-id'   => 'আপনার RMA আইডি',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'গ্রহণ',
            'awaiting'                 => 'অপেক্ষারত',
            'canceled'                 => 'বাতিল হয়েছে',
            'declined'                 => 'অস্বীকৃত',
            'dispatched-package'       => 'প্যাকেজ প্রেরিত',
            'item-canceled'            => 'আইটেম বাতিল করা হয়েছে',
            'not-received-package-yet' => 'এখনো প্যাকেজ পাওয়া যায়নি',
            'pending'                  => 'অপেক্ষারত',
            'processing'               => 'প্রসেসিং',
            'received-package'         => 'প্যাকেজ প্রাপ্ত',
            'solved'                   => 'সমাধান করা হয়েছে',
        ],

        'status-quotes' => [
            'declined-admin'  => 'এডমিন দ্বারা RMA অস্বীকৃত হয়েছে।',
            'declined-buyer'  => 'ক্রেতা দ্বারা RMA অস্বীকৃত হয়েছে।',
            'solved-by-admin' => 'এডমিন দ্বারা RMA সমাধান করা হয়েছে।',
            'solved'          => 'RMA সমাধান করা হয়েছে।',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA স্ট্যাটাস ইতিমধ্যেই বাতিল করা হয়েছে।',
        'cancel-success'    => 'RMA স্থিতি সফলভাবে বাতিল করা হয়েছে।',
        'create-success'    => 'অনুরোধ সফলভাবে তৈরি করা হয়েছে।',
        'creation-error'    => 'RMA স্ট্যাটাস আপডেট করা সম্ভব নয় কারণ এই অর্ডারের জন্য চালান তৈরি করা হয়নি।',
        'permission-denied' => 'আপনি লগ ইন করেছেন',
        'rma-disabled'      => 'এই পণ্যের জন্য RMA অক্ষম করা হয়েছে',
        'send-message'      => ':name সফলভাবে প্রেরণ করা হয়েছে।',
        'update-success'    => ':name সফলভাবে আপডেট হয়েছে।',
        'please-select-the-item' => 'অনুগ্রহ করে আইটেমটি নির্বাচন করুন',

    ],
];