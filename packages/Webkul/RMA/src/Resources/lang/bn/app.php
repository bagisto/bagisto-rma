<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'পেন্ডিং অর্ডারের জন্য নতুন আরএমএ অনুরোধ অনুমোদিত করুন',
                        'allow-rma-for-digital-product'       => 'ডিজিটাল পণ্যের জন্য আরএমএ অনুমোদিত করুন',
                        'default-allow-days'                  => 'ডিফল্ট অনুমোদিত দিন',
                        'enable'                              => 'আরএমএ সক্রিয় করুন',
                        'info'                                => 'আরএমএ প্রক্রিয়াটি পণ্যটি একটি ব্যবসায়ের কাছে ফেরৎ, পরিবর্তন বা মেরামত পেতে সংশ্লিষ্ট একটি অংশ।',
                        'title'                               => 'আরএমএ',

                        'setting' => [
                            'info'  => 'আরএমএ কার্যক্ষমতাটি একটি গ্রাহক পণ্য মেরামত এবং রক্ষণাবেক্ষণের পরিস্থিতি নিয়ে হ্যান্ডলিং করতে দেয় যখন একজন গ্রাহক পণ্যগুলি ফেরত দেয় এবং পিছিয়ে পানি, বা পরিবর্তন অথবা পরিমার্জনের জন্য ফেরত দেয়।',
                            'title' => 'আরএমএ',
                        ],
                    ],
                ],
            ],
        ],

        'components' => [
            'layouts' => [
                'sidebar' => [
                    'rma' => 'আরএমএ',
                ],
            ],
        ],

        'sales' => [
            'rma' => [
                'index' => [
                    'rma-title'        => 'সমস্ত আরএমএ',
                    'reason-title'     => 'কারণ',
                    'create-rma-title' => 'আরএমএ তৈরি করুন',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'সমস্ত আরএমএ',

                        'datagrid' => [
                            'id'        => 'আরএমএ আইডি',
                            'order-ref' => 'আদেশ রেফারেন্স',
                            'status'    => 'অবস্থা',
                            'create'    => 'তৈরি করা হয়েছে',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'আরএমএ',
                        'view-title'             => 'আরএমএ',
                        'order-id'               => ' অর্ডার আইডি :',
                        'request-on'             => 'অনুরোধ করুন :',
                        'customer'               => 'গ্রাহক :',
                        'resolution-type'        => 'রেজোলিউশন ধরন :',
                        'additional-information' => 'অতিরিক্ত তথ্য :',
                        'images'                 => 'ছবি :',
                        'order-details'          => 'অর্ডার বিবরণী',
                        'status'                 => 'অবস্থা',
                        'rma-status'             => 'আরএমএ অবস্থা :',
                        'order-status'           => 'আদেশের অবস্থা :',
                        'change-status'          => 'অবস্থা পরিবর্তন',
                        'conversations'          => 'সংলাপ',
                        'save-btn'               => 'সংরক্ষণ করুন',
                        'send-message'           => 'বার্তা প্রেরণ করুন',
                        'enter-message'          => 'বার্তা লিখুন',
                        'send-message-btn'       => 'বার্তা প্রেরণ করুন',
                        'send-message-success'   => 'বার্তা সফলভাবে প্রেরিত হয়েছে।',
                        'update-success'         => 'আরএমএ অবস্থা সফলভাবে আপডেট হয়েছে।',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'কারণ',
                        'create-btn' => 'আরএমএ কারণ তৈরি করুন',

                        'datagrid' => [
                            'id'                  => 'আইডি',
                            'reason'              => 'কারণ',
                            'status'              => 'অবস্থা',
                            'created-at'          => 'তৈরি করা হয়েছে',
                            'enabled'             => 'সক্রিয়',
                            'disabled'            => 'নিষ্ক্রিয়',
                            'delete-success'      => 'কারণ সফলভাবে মুছে ফেলা হয়েছে।',
                            'mass-delete-success' => 'আরএমএ গণতান্ত্রিক মুছে ফেলা হয়েছে সফলভাবে।',
                            'reason-error'        => 'কারণটি আরএমএতে ব্যবহৃত হয়।',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'নতুন কারণ যোগ করুন',
                        'save-btn'       => 'কারণ সংরক্ষণ করুন',
                        'reason'         => 'কারণ',
                        'status'         => 'অবস্থা',
                        'create-success' => 'কারণ সফলভাবে তৈরি হয়েছে।',
                    ],

                    'edit' => [
                        'edit-title'          => 'কারণ সম্পাদনা করুন',
                        'save-btn'            => 'কারণ সংরক্ষণ করুন',
                        'reason'              => 'কারণ',
                        'status'              => 'অবস্থা',
                        'mass-update-success' => 'নির্বাচিত কারণ সফলভাবে আপডেট হয়েছে।',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'আরএমএ তৈরি করুন',
                    'order-id'          => 'অর্ডার আইডি',
                    'email'             => 'ইমেল',
                    'validate'          => 'যাচাই করুন',
                    'rma-already-exist' => 'আরএমএ ইতিমধ্যে বিদ্যমান',
                    'mismatch'          => 'অর্ডার আইডি এবং ইমেল মিলছে না',
                    'invalid-order-id'  => 'অবৈধ অর্ডার আইডি',
                    'quantity'          => 'পরিমাণ',
                    'reason'            => 'কারণ',
                    'save-btn'          => 'সংরক্ষণ করুন',
                    'create-success'    => 'আরএমএ সফলভাবে তৈরি হয়েছে।',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'আরএমএ',
            'title'        => 'আরএমএ',
            'header-title' => 'আরএমএ রিটার্ন',
            'offer'        => 'আপনার ১ম অর্ডারে উপর পান ৪০% ছাড়',
            'shop-now'     => 'এখন কেনাকাটা করুন',

            'create' => [
                'heading'                  => 'নতুন আরএমএ অনুরোধ',
                'create-btn'               => 'সংরক্ষণ করুন',
                'orders'                   => 'অর্ডার',
                'resolution'               => 'রেজোলিউশন নির্বাচন করুন',
                'item-ordered'             => 'আইটেম অর্ডার করা হয়েছে',
                'images'                   => 'চিত্র',
                'information'              => 'অতিরিক্ত তথ্য',
                'order-status'             => 'অর্ডারের অবস্থা',
                'product'                  => 'পণ্য',
                'sku'                      => 'এসকিউ',
                'price'                    => 'মূল্য',
                'search-order'             => 'অর্ডার অনুসন্ধান করুন',
                'enter-order-id'           => 'অর্ডার আইডি লিখুন',
                'not-allowed'              => 'পেন্ডিং অর্ডারের জন্য আরএমএ অনুমোদিত নেই',
                'image'                    => 'চিত্র',
                'quantity'                 => 'পরিমাণ',
                'reason'                   => 'কারণ',
                'rma-not-available-quotes' => 'পণ্যটি আরএমএর জন্য উপলব্ধ নেই',
                'product-name'             => 'পণ্যের নাম',
                'reopen-request'           => 'রিওপেন অনুরোধ',
                'save'                     => 'সংরক্ষণ করুন',
                'cancel'                   => 'বাতিল করুন',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'আরএমএ',
                'rma-status'   => 'আরএমএ স্থিতি :',
                'order-status' => 'আদেশের অবস্থা :',
                'close-rma'    => 'আরএমএ বন্ধ করুন :',
            ],

            'create' => [
                'title'                    => 'আরএমএ',
                'heading'                  => 'নতুন আরএমএ অনুরোধ',
                'create-btn'               => 'সংরক্ষণ করুন',
                'orders'                   => 'অর্ডার',
                'resolution'               => 'রেজোলিউশন নির্বাচন করুন',
                'item-ordered'             => 'আইটেম অর্ডার করা হয়েছে',
                'images'                   => 'চিত্র',
                'information'              => 'অতিরিক্ত তথ্য',
                'order-status'             => 'অর্ডারের অবস্থা',
                'product'                  => 'পণ্য',
                'sku'                      => 'এসকিউ',
                'price'                    => 'মূল্য',
                'search-order'             => 'অর্ডার অনুসন্ধান করুন',
                'enter-order-id'           => 'অর্ডার আইডি লিখুন',
                'not-allowed'              => 'পেন্ডিং অর্ডারের জন্য আরএমএ অনুমোদিত নেই',
                'image'                    => 'চিত্র',
                'quantity'                 => 'পরিমাণ',
                'reason'                   => 'কারণ',
                'rma-not-available-quotes' => 'পণ্যটি আরএমএর জন্য উপলব্ধ নেই',
                'product-name'             => 'পণ্যের নাম',
                'reopen-request'           => 'রিওপেন অনুরোধ',
                'save'                     => 'সংরক্ষণ করুন',
                'cancel'                   => 'বাতিল করুন',
                'reopen-request'           => 'রিওপেন অনুরোধ',
            ],

            'index' => [
                'create'  => 'নতুন আরএমএ অনুরোধ করুন',
                'heading' => 'গ্রাহক আরএমএ প্যানেল',
                'view'    => 'দেখুন',
                'edit'    => 'সম্পাদনা করুন',
                'delete'  => 'মুছে ফেলুন',
                'update'  => 'আপডেট করুন',
                'guest'   => 'অতিথি আরএমএ প্যানেল',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'নতুন আরএমএ অনুরোধ করুন',
            'heading' => 'গ্রাহক আরএমএ প্যানেল',
            'view'    => 'দেখুন',
            'edit'    => 'সম্পাদনা করুন',
            'delete'  => 'মুছে ফেলুন',
            'update'  => 'আপডেট করুন',
            'guest'   => 'অতিথি আরএমএ প্যানেল',
        ],

        'validation' => [
            'orders'       => 'অর্ডার',
            'resolution'   => 'রেজোলিউশন',
            'information'  => 'অতিরিক্ত তথ্য',
            'order-status' => 'অর্ডারের অবস্থা',
            'order-id'     => 'আদেশ নির্বাচন',
            'close-rma'    => 'নিশ্চিত করুন',
        ],

        'conversation-texts' => [
            'by'       => 'দ্বারা',
            'seller'   => 'বিক্রেতা',
            'customer' => 'গ্রাহক',
            'on'       => 'উপর',
        ],

        'default-option' => [
            'please-select-value' => 'অনুগ্রহ করে মান নির্বাচন করুন',
            'select-quantity'     => 'পরিমাণ নির্বাচন করুন',
            'select-reason'       => 'কারণ নির্বাচন করুন',
            'others'              => 'অন্যান্য',
            'select-order-status' => 'অর্ডারের অবস্থা নির্বাচন করুন',
            'select-resolution'   => 'রেজোলিউশন নির্বাচন করুন',
            'select-seller'       => 'বিক্রেতা নির্বাচন করুন',
            'select-order'        => 'অর্ডার নির্বাচন করুন',
        ],

        'view-customer-rma' => [
            'rma'                     => 'আরএমএ',
            'guest'                   => 'অতিথি',
            'heading'                 => 'আরএমএ বিস্তারিত',
            'status'                  => 'অবস্থা',
            'order-id'                => ' অর্ডার আইডি :',
            'refund-details'          => 'পরিশোধের বিবরণ',
            'resolution-type'         => 'রেজোলিউশন প্রকার :',
            'additional-information'  => 'অতিরিক্ত তথ্য :',
            'change-rma-status'       => 'আরএমএ অবস্থা পরিবর্তন করুন',
            'save-btn'                => 'সংরক্ষণ করুন',
            'you'                     => 'প্রশাসক',
            'send-message-btn'        => 'প্রেরণ করুন',
            'items-requested-for-rma' => 'আরএমএ জন্য অনুরোধিত আইটেম(গুলি)',
            'refund-offline-btn'      => 'অফলাইন পরিশোধ',
            'send-message'            => 'বার্তা প্রেরণ করুন',
            'conversations'           => 'আলাপ',
            'cancel-order'            => 'অর্ডার বাতিল করুন',
            'status-details'          => 'অবস্থা বিস্তারিত',
            'admin'                   => 'প্রশাসক',
            'status-quotes'           => 'এটি সমাধান হিসাবে চিহ্নিত করতে সম্মত হন।',
            'close-rma'               => 'আরএমএ বন্ধ করুন :',
            'images'                  => 'চিত্র',
            'items-request'           => 'আরএমএ জন্য অনুরোধিত আইটেম(গুলি)',
            'refundable-amount'       => 'পরিশোধযোগ্য পরিমাণ',
        ],

        'view-guest-rma' => [
            'rma'                    => 'আরএমএ',
            'resolution-type'        => 'রেজোলিউশন প্রকার :',
            'guest'                  => 'আপনি',
            'status'                 => 'অবস্থা',
            'order-id'               => ' অর্ডার আইডি :',
            'additional-information' => 'অতিরিক্ত তথ্য :',
            'save-btn'               => 'সংরক্ষণ করুন',
            'send-message-btn'       => 'প্রেরণ করুন',
            'refund-offline-btn'     => 'অফলাইন পরিশোধ',
            'send-message'           => 'বার্তা প্রেরণ করুন',
            'conversations'          => 'আলাপ',
            'status-details'         => 'অবস্থা বিস্তারিত',
            'admin'                  => 'প্রশাসক',
            'status-quotes'          => 'এটি সমাধান হিসাবে চিহ্নিত করতে সম্মত হন।',
            'close-rma'              => 'আরএমএ বন্ধ করুন',
            'images'                 => 'চিত্র',
            'items-request'          => 'আরএমএ জন্য অনুরোধিত আইটেম(গুলি)',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'আরএমএ অবস্থা :',
            'order-status' => 'অর্ডারের অবস্থা :',
            'full-amount'  => 'পূর্ণ পরিমাণ',
            'request-on'   => 'অনুরোধ প্রদান :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'আরএমএ বন্ধ করুন',
            'rma-status'              => 'আরএমএ অবস্থা :',
            'admin-status'            => 'প্রশাসক অবস্থা:',
            'order-status'            => 'অর্ডারের অবস্থা :',
            'consignment-no'          => 'সমন্বয় নম্বর:',
            'refundable-amount'       => 'পরিশোধযোগ্য পরিমাণ:',
            'full-amount'             => 'পূর্ণ পরিমাণ',
            'partial-amount'          => 'আংশিক পরিমাণ',
            'total-refundable-amount' => 'মোট পরিশোধযোগ্য পরিমাণ:',
            'enter-message'           => 'বার্তা লিখুন',
            'request-on'              => 'অনুরোধ প্রদান :',
            'seller'                  => 'বিক্রেতা',
            'order-details'           => 'অর্ডারের বিবরণ',
        ],

        'table-heading' => [
            'product-name' => 'পণ্যের নাম',
            'sku'          => 'এসকিউ',
            'price'        => 'মূল্য',
            'qty'          => 'পরিমাণ',
            'reason'       => 'কারণ',
        ],

        'guest-users' => [
            'heading'     => 'অতিথি লগইন প্যানেল',
            'order-id'    => 'অর্ডার আইডি',
            'email'       => 'ইমেল',
            'button-text' => 'লগইন',
            'title'       => 'অতিথি লগইন',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA অনুরোধ',
            'hello'                  => 'প্রিয় :name',
            'greeting'               => 'আপনি অর্ডার :order_id এর জন্য নতুন RMA অনুরোধ করেছেন।',
            'rma-id'                 => 'RMA আইডি :',
            'summary'                => 'অর্ডারের RMA সংক্ষিপ্ত বিবরণ',
            'order-id'               => 'অর্ডার আইডি :',
            'order-status'           => 'অর্ডারের অবস্থা :',
            'resolution-type'        => 'রেজোলিউশন প্রকার :',
            'additional-information' => 'অতিরিক্ত তথ্য :',
            'thank-you'              => 'ধন্যবাদ',
            'requested-rma-product'  => 'অনুরোধিত RMA পণ্য:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'পণ্যের নাম',
            'sku'          => 'SKU',
            'qty'          => 'পরিমাণ',
            'reason'       => 'কারণ',
        ],

        'customer-conversation' => [
            'heading' => 'প্রিয় :name,',
            'quotes'  => 'কেনারদার থেকে নতুন বার্তা আছে',
            'message' => 'বার্তা',
        ],

        'seller-conversation' => [
            'heading' => 'প্রিয় :name',
            'quotes'  => 'বিক্রেতা থেকে নতুন বার্তা আছে',
            'message' => 'বার্তা',
            'title'   => 'বার্তা প্রাপ্তি!',
        ],

        'status' => [
            'heading'       => 'প্রিয় :name',
            'quotes'        => 'আপনার RMA অবস্থা বিক্রেতা দ্বারা পরিবর্তিত হয়েছে',
            'rma-id'        => 'RMA আইডি',
            'your-rma-id'   => 'আপনার RMA আইডি',
            'status-change' => ':id এর অবস্থা পরিবর্তিত হয়েছে বিক্রেতা দ্বারা',
            'status'        => 'অবস্থা',
            'title'         => 'অবস্থা আপডেট হয়েছে!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'মুলতুবি',
            'processing'               => 'প্রসেসিং',
            'item-canceled'            => 'আইটেম বাতিল হয়েছে',
            'solved'                   => 'সমাধান হয়েছে',
            'declined'                 => 'প্রত্যাখ্যান',
            'received-package'         => 'প্যাকেজ প্রাপ্ত',
            'dispatched-package'       => 'প্যাকেজ প্রেরিত',
            'not-received-package-yet' => 'এখনো প্যাকেজ প্রাপ্ত হয়নি',
            'accept'                   => 'গ্রহণ করুন',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA প্রশাসক দ্বারা প্রত্যাখ্যান করা হয়েছে।',
            'declined-buyer'  => 'RMA কেনারদার দ্বারা প্রত্যাখ্যান করা হয়েছে।',
            'solved'          => 'RMA সমাধান হয়েছে।',
            'solved-by-admin' => 'RMA প্রশাসক দ্বারা সমাধান করা হয়েছে।',
        ],
    ],

    'response' => [
        'create-success' => ':name সফলভাবে তৈরি করা হয়েছে।',
        'send-message'   => ':name সফলভাবে প্রেরণ করা হয়েছে।',
        'update-success' => ':name সফলভাবে আপডেট হয়েছে।',
    ],
];
