<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'අනුපිටපත් ඇනවුමක් සඳහා නව RMA ඉල්ලීම ඉඩදෙන්න',
                        'allow-rma-for-digital-product'       => 'ඩිජිටල් නිෂ්පාදනයක් සඳහා RMA ඉල්ලීම ඉඩදෙන්න',
                        'default-allow-days'                  => 'සාමාජික ඉඩදෙන දින',
                        'enable'                              => 'RMA සක්‍රිය කරන්න',
                        'info'                                => 'RMA නවතා ප්‍රවාහනය කිරීමට, නැවුම් හෝ ප්‍රමාණය සඳහා ප්‍රවාහනයට ආපසු ගෙවා ගැනීමේ කොටසක් විය හැක.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'RMA ක්‍රියාකාරකම තාවකාලික භාවිතා කිරීමේ පිටුව පද්ධතියේ අත්‍යවශ්‍යයන්ට අයිතිකරු හෝ නැවුම් හෝ ප්‍රමාණය සඳහා වෙළෙන අයිතිකරුගේ නැවුම් හෝ නැවුම් හෝ ප්‍රමාණයක් හෝ වෙළෙන්දෝ සඳහා වන සෘජුව.',
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
                    'rma-title'        => 'සියලු ආරාධනා',
                    'reason-title'     => 'හේතුවන්',
                    'create-rma-title' => 'Rma නිර්මාණය කරන්න',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'සියලු Rma',

                        'datagrid' => [
                            'id'        => 'RMA අංකය',
                            'order-ref' => 'ඇණවුම් ආලෝකය',
                            'status'    => 'ස්ථානය',
                            'create'    => 'තත්ත්වය',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ඇණවුම් සංඛ්යාව :',
                        'request-on'             => 'වාර්තා කළ දිනය :',
                        'customer'               => 'සැපයුම්කරු :',
                        'resolution-type'        => 'විවේචන වර්ගය :',
                        'additional-information' => 'අතිරේක තොරතුරු :',
                        'images'                 => 'රූප :',
                        'order-details'          => 'ඇණවුම් විස්තර',
                        'status'                 => 'ස්ථානය',
                        'rma-status'             => 'RMA තත්ත්වය :',
                        'order-status'           => 'ඇණවුම් තත්ත්වය :',
                        'change-status'          => 'ස්ථානය වෙනස් කරන්න',
                        'conversations'          => 'සන්ධ්‍යාතාව',
                        'save-btn'               => 'ඉතිරි කරන්න',
                        'send-message'           => 'පණිවිඩය යවන්න',
                        'enter-message'          => 'පණිවිඩය ඇතුල් කරන්න',
                        'send-message-btn'       => 'පණිවිඩය යවන්න',
                        'send-message-success'   => 'පණිවිඩය සාර්ථකව යවන ලදි.',
                        'update-success'         => 'Rma තත්ත්වය සාර්ථකව යාවත්කාලීන විය.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'හේතුවන්',
                        'create-btn' => 'Rma හේතුවන් සාදන්න',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'හේතුව',
                            'status'              => 'ස්ථානය',
                            'created-at'          => 'තත්ත්වය',
                            'enabled'             => 'සක්‍රිය කර ඇත',
                            'disabled'            => 'අක්‍රිය කර ඇත',
                            'delete-success'      => 'හේතුව සාර්ථකව මකා දමන ලදි.',
                            'mass-delete-success' => 'Rma බහුලවට ඉතිරි කර ඇත.',
                            'reason-error'        => 'RMA හිස් වී ඇත.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'නව හේතුව එකතු කරන්න',
                        'save-btn'       => 'හේතුව සුරකින්න',
                        'reason'         => 'හේතුව',
                        'status'         => 'ස්ථානය',
                        'create-success' => 'හේතුව සාර්ථකව එකතු කරන ලදි.',
                    ],

                    'edit' => [
                        'edit-title'          => 'හේතුව සංස්කරණය කරන්න',
                        'save-btn'            => 'හේතුව සුරකින්න',
                        'reason'              => 'හේතුව',
                        'status'              => 'ස්ථානය',
                        'mass-update-success' => 'තෝරා ගන්නා හේතුවන් සාර්ථකව යාවත්කාලීන විය.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Rma නිර්මාණය කරන්න',
                    'order-id'          => 'ඇණවුම් සංඛ්යාව',
                    'email'             => 'ඊමේල්',
                    'validate'          => 'වලංගු කරන්න',
                    'rma-already-exist' => 'RMA දැනටමත් පවතී',
                    'mismatch'          => 'ඇණවුම් සංඛ්යා සහ ඊමේල් අසමත් වුණි',
                    'invalid-order-id'  => 'වලංගු ඇණවුම් සංඛ්යාකාරී නොවේ',
                    'quantity'          => 'ප්රමාණය',
                    'reason'            => 'හේතුව',
                    'save-btn'          => 'සුරකින්න',
                    'create-success'    => 'Rma සාර්ථකව නිර්මාණය කරන ලදි.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA පෙරමුණ',
            'offer'        => 'ඔබගේ 1 වසරක් තුල 40% ට ඉහළ කිරීමට',
            'shop-now'     => 'දැනට ස්වයංක්රීයයි',

            'create' => [
                'heading'                  => 'නව RMA ඉල්ලීම',
                'create-btn'               => 'සුරකින්න',
                'orders'                   => 'ඇණවුම්',
                'resolution'               => 'විශ්ලේෂණය තෝරන්න',
                'item-ordered'             => 'ඇණවුම් ක්‍රම',
                'images'                   => 'රූපවාහිනී',
                'information'              => 'අතිරික්තය',
                'order-status'             => 'ඇණවුම් තත්වය',
                'product'                  => 'නිෂ්පාදනය',
                'sku'                      => 'Sku',
                'price'                    => 'මිල',
                'search-order'             => 'ඇණවුම් සොයන්න',
                'enter-order-id'           => 'ඇණවුම් අංකය ඇතුලත් කරන්න',
                'not-allowed'              => 'අනුමැතියක් සඳහා RMA අවසන් කිරීමට ඉඩ නැත',
                'image'                    => 'රූපය',
                'quantity'                 => 'ප්‍රමාණය',
                'reason'                   => 'හේතුව',
                'rma-not-available-quotes' => 'අයිතමය RMA සඳහා ලබා ගත නොහැක',
                'product-name'             => 'නිෂ්පාදනයක්',
                'reopen-request'           => 'නැවත විස්තර කරන්න',
                'save'                     => 'සුරකින්න',
                'cancel'                   => 'අවලංගු කරන්න',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMA තත්වය :',
                'order-status' => 'ඇණවුම් තත්වය :',
                'close-rma'    => 'RMA වසන්න :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'නව RMA ඉල්ලීම',
                'create-btn'               => 'සුරකින්න',
                'orders'                   => 'ඇණවුම්',
                'resolution'               => 'විශ්ලේෂණය තෝරන්න',
                'item-ordered'             => 'ඇණවුම් ක්‍රම',
                'images'                   => 'රූපවාහිනී',
                'information'              => 'අතිරික්තය',
                'order-status'             => 'ඇණවුම් තත්වය',
                'product'                  => 'නිෂ්පාදනය',
                'sku'                      => 'Sku',
                'price'                    => 'මිල',
                'search-order'             => 'ඇණවුම් සොයන්න',
                'enter-order-id'           => 'ඇණවුම් අංකය ඇතුලත් කරන්න',
                'not-allowed'              => 'අනුමැතියක් සඳහා RMA අවසන් කිරීමට ඉඩ නැත',
                'image'                    => 'රූපය',
                'quantity'                 => 'ප්‍රමාණය',
                'reason'                   => 'හේතුව',
                'rma-not-available-quotes' => 'අයිතමය RMA සඳහා ලබා ගත නොහැක',
                'product-name'             => 'නිෂ්පාදනයක්',
                'reopen-request'           => 'නැවත විස්තර කරන්න',
                'save'                     => 'සුරකින්න',
                'cancel'                   => 'අවලංගු කරන්න',
                'reopen-request'           => 'නැවත විස්තර කරන්න',
            ],

            'index' => [
                'create'  => 'නව RMA ඉල්ලීම් කිරීම',
                'heading' => 'ප්‍රශ්න ලිපියේ පැනලය',
                'view'    => 'දර්ශකය',
                'edit'    => 'සංස්කරණය',
                'delete'  => 'මකා දමන්න',
                'update'  => 'යාවත්කාලීන කරන්න',
                'guest'   => 'දර්ශක පැනලය',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'නව RMA ඉල්ලීම් කිරීම',
            'heading' => 'ප්‍රශ්න ලිපියේ පැනලය',
            'view'    => 'දර්ශකය',
            'edit'    => 'සංස්කරණය',
            'delete'  => 'මකා දමන්න',
            'update'  => 'යාවත්කාලීන කරන්න',
            'guest'   => 'දර්ශක පැනලය',
        ],

        'validation' => [
            'orders'       => 'ඇණවුම්',
            'resolution'   => 'විශ්ලේෂණය',
            'information'  => 'අතිරික්තය',
            'order-status' => 'ඇණවුම් තත්වය',
            'order-id'     => 'ඇණවුම් තෝරාගන්න',
            'close-rma'    => 'සත්කාල කරන්න',
        ],

        'conversation-texts' => [
            'by'       => 'කෙටියා',
            'seller'   => 'අග්‍රාමික',
            'customer' => 'පුද්ගලයා',
            'on'       => 'මෙය',
        ],

        'default-option' => [
            'please-select-value' => 'කරුණාකර අගයක් තෝරන්න',
            'select-quantity'     => 'ප්‍රමාණය තෝරන්න',
            'select-reason'       => 'හේතුව තෝරන්න',
            'others'              => 'වෙනත්',
            'select-order-status' => 'ඇණවුම් තත්වය තෝරන්න',
            'select-resolution'   => 'විශ්ලේෂණය තෝරන්න',
            'select-seller'       => 'විකිණීම්ගේ තෝරන්න',
            'select-order'        => 'ඇණවුම තෝරන්න',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'දර්ශකය',
            'heading'                 => 'RMA විස්තර',
            'status'                  => 'තත්වය',
            'order-id'                => ' ඇණවුම් අංකය :',
            'refund-details'          => 'ආපසු විස්තර',
            'resolution-type'         => 'විශ්ලේෂණයේ වර්ගය :',
            'additional-information'  => 'අතිරික්තය :',
            'change-rma-status'       => 'RMA තත්වය වෙනස් කරන්න',
            'save-btn'                => 'සුරකින්න',
            'you'                     => 'පපුවට',
            'send-message-btn'        => 'යවන්න',
            'items-requested-for-rma' => 'RMA සඳහා ඉල්ලීමට ඉල්ලීම්',
            'refund-offline-btn'      => 'රීති ස්ථානයේ ආපසු පිහිටුවන්න',
            'send-message'            => 'පණිවිඩ යවන්න',
            'conversations'           => 'සන්නිවේදන',
            'cancel-order'            => 'ඇණවුම අවලංගු කරන්න',
            'status-details'          => 'ස්ථාපන විස්තර',
            'admin'                   => 'පරිපාලක',
            'status-quotes'           => 'එය සම්බන්ධ කිරීමට සමන්විත වන්න.',
            'close-rma'               => 'RMA වසන්න :',
            'images'                  => 'රූපවාහිනී',
            'items-request'           => 'RMA සඳහා ඉල්ලීමක්',
            'refundable-amount'       => 'ආපසු ක්‍රියාවක්',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'විශ්ලේෂණයේ වර්ගය :',
            'guest'                  => 'ඔබ',
            'status'                 => 'තත්වය',
            'order-id'               => ' ඇණවුම් අංකය :',
            'additional-information' => 'අතිරික්තය :',
            'save-btn'               => 'සුරකින්න',
            'send-message-btn'       => 'යවන්න',
            'refund-offline-btn'     => 'රීති ස්ථානයේ ආපසු පිහිටුවන්න',
            'send-message'           => 'පණිවිඩ යවන්න',
            'conversations'          => 'සන්නිවේදන',
            'status-details'         => 'ස්ථාපන විස්තර',
            'admin'                  => 'පරිපාලක',
            'status-quotes'          => 'එය සම්බන්ධ කිරීමට සමන්විත වන්න.',
            'close-rma'              => 'RMA වසන්න',
            'images'                 => 'රූපවාහිනී',
            'items-request'          => 'RMA සඳහා ඉල්ලීමක්',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMA තත්වය :',
            'order-status' => 'ඇණවුම් තත්වය :',
            'full-amount'  => 'මූලික මුදල',
            'request-on'   => 'ඉල්ලීමට ඉදිරියට :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'RMA වසන්න',
            'rma-status'              => 'RMA තත්වය :',
            'admin-status'            => 'පරිපාලක තත්වය:',
            'order-status'            => 'ඇණවුම් තත්වය :',
            'consignment-no'          => 'ප්‍රාහාර අංකය:',
            'refundable-amount'       => 'ආපසු ක්‍රියාකාරී මුදල:',
            'full-amount'             => 'මූලික මුදල',
            'partial-amount'          => 'පැතුම් මුදල',
            'total-refundable-amount' => 'මුළු ආපසු ක්‍රියාකාරී මුදල:',
            'enter-message'           => 'පණිවිඩක් ඇතුලත් කරන්න',
            'request-on'              => 'ඉල්ලීමට ඉදිරියට :',
            'seller'                  => 'අමාත්‍යාංශයා',
            'order-details'           => 'ඇණවුම් විස්තර',
        ],

        'table-heading' => [
            'product-name' => 'නිෂ්පාදන නම',
            'sku'          => 'SKU',
            'price'        => 'මිල',
            'qty'          => 'ප්‍රමාණය',
            'reason'       => 'හේතුව',
        ],

        'guest-users' => [
            'heading'     => 'අමාත්‍යාංශයා ලොගින් පැනලය',
            'order-id'    => 'ඇණවුම් අංකය',
            'email'       => 'ඊමේල්',
            'button-text' => 'ලොගින් වන්න',
            'title'       => 'අමාත්‍යාංශයා ලොගින්',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA ඉල්ලීම',
            'hello'                  => 'ස්තුතියි :name',
            'greeting'               => 'ඔබට :order_id වෙනුවට නව RMA සැකසුමක් ඉල්ලීමේ ඉල්ලුම.',
            'rma-id'                 => 'RMA අංකය :',
            'summary'                => 'ඇණවුම් සඳහා RMA සාරාංශය',
            'order-id'               => 'ඇණවුම් අංකය :',
            'order-status'           => 'ඇණවුම් තත්වය :',
            'resolution-type'        => 'විශ්ලේෂණ වර්ගය :',
            'additional-information' => 'අමතර විස්තර :',
            'thank-you'              => 'ස්තුතියි',
            'requested-rma-product'  => 'ඉල්ලුම් කිරීමේ RMA නිෂ්පාදනය:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'නිෂ්පාදන නම',
            'sku'          => 'SKU',
            'qty'          => 'ප්‍රමාණය',
            'reason'       => 'හේතුව',
        ],

        'customer-conversation' => [
            'heading' => 'ස්තුතියි :name,',
            'quotes'  => 'ඇණවුමේහි නව පණිවිඩයක් සිටියි',
            'message' => 'පණිවිඩය',
        ],

        'seller-conversation' => [
            'heading' => 'ස්තුතියි :name',
            'quotes'  => 'විකිණීම් වෙතින් නව පණිවිඩයක් සිටියි',
            'message' => 'පණිවිඩය',
            'title'   => 'පණිවිඩය ලබා ගනිමු!',
        ],

        'status' => [
            'heading'       => 'ස්තුතියි :name',
            'quotes'        => 'ඔබගේ RMA තත්වය විවෘත කළවුවහි මෙය වෙනස් කරන ලදි',
            'rma-id'        => 'RMA අංකය',
            'your-rma-id'   => 'ඔබගේ RMA අංකය',
            'status-change' => ':id මාතෘකාව වෙනස් කර ඇත්තේ විවෘත කරන ලදි',
            'status'        => 'තත්වය',
            'title'         => 'තත්වය යාවත්කාලීන විය!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'කිරීමේ තත්වය',
            'processing'               => 'ප්‍රතිසාධන කිරීමේ තත්වය',
            'item-canceled'            => 'අයිතම අවලංගු කරන ලදි',
            'solved'                   => 'විවෘත කරන ලදි',
            'declined'                 => 'අත් කරන ලදි',
            'received-package'         => 'භාණ්ඩය ලබා ඇත',
            'dispatched-package'       => 'භාණ්ඩය යෙදිය ඇත',
            'not-received-package-yet' => 'භාණ්ඩය තවම ලබා නොමැත',
            'accept'                   => 'පිවිසීම',
        ],

        'status-quotes' => [
            'declined-admin'  => 'පපාලක විසින් RMA අත් කළ ලදි.',
            'declined-buyer'  => 'මිලදී ගන්නා ලදි වෙළඳපොළ විසින් RMA අත් කළ ලදි.',
            'solved'          => 'RMA විවෘත කරන ලදි.',
            'solved-by-admin' => 'පපාලක විසින් RMA විවෘත කරන ලදි.',
        ],
    ],

    'response' => [
        'create-success'    => ':name සාර්ථකයි නිවැරදියි.',
        'send-message'      => ':name සාර්ථකයි නිර්නාමිකයි.',
        'update-success'    => ':name සාර්ථකයි යාවත්කාලීන කරන ලදි.',
        'permission-denied' => 'ඔබ ලොග් වී ඇත',
    ],
];
