<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => '保留中の注文の新しいRMAリクエストを許可する',
                        'allow-rma-for-digital-product'       => 'デジタル製品のRMAを許可する',
                        'default-allow-days'                  => 'デフォルト許可日数',
                        'enable'                              => 'RMAを有効にする',
                        'info'                                => 'RMAは、商品を返品して返金、交換、または修理を受けるためのプロセスの一部です。',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'RMA機能は、顧客が修理やメンテナンス、返金や交換のために商品を返品する状況を処理します。',
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
                    'rma-title'        => 'すべてのRMA',
                    'reason-title'     => '理由',
                    'create-rma-title' => 'RMAを作成する',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'すべてのRMA',

                        'datagrid' => [
                            'id'        => 'RMA ID',
                            'order-ref' => '注文参照',
                            'status'    => 'ステータス',
                            'create'    => '作成日時',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' 注文ID：',
                        'request-on'             => 'リクエスト日時：',
                        'customer'               => '顧客：',
                        'resolution-type'        => '解決方法：',
                        'additional-information' => '追加情報：',
                        'images'                 => '画像：',
                        'order-details'          => '注文の詳細',
                        'status'                 => 'ステータス',
                        'rma-status'             => 'RMAステータス：',
                        'order-status'           => '注文ステータス：',
                        'change-status'          => 'ステータスを変更する',
                        'conversations'          => '会話',
                        'save-btn'               => '保存',
                        'send-message'           => 'メッセージを送信',
                        'enter-message'          => 'メッセージを入力してください',
                        'send-message-btn'       => 'メッセージを送信',
                        'send-message-success'   => 'メッセージが正常に送信されました。',
                        'update-success'         => 'RMAステータスが正常に更新されました。',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => '理由',
                        'create-btn' => 'RMA理由を作成する',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => '理由',
                            'status'              => 'ステータス',
                            'created-at'          => '作成日時',
                            'enabled'             => '有効',
                            'disabled'            => '無効',
                            'delete-success'      => '理由が正常に削除されました。',
                            'mass-delete-success' => 'RMAが正常に削除されました。',
                            'reason-error'        => '理由はRMAで使用されています。',
                        ],
                    ],

                    'create' => [
                        'create-title'   => '新しい理由を追加',
                        'save-btn'       => '理由を保存',
                        'reason'         => '理由',
                        'status'         => 'ステータス',
                        'create-success' => '理由が正常に作成されました。',
                    ],

                    'edit' => [
                        'edit-title'          => '理由を編集する',
                        'save-btn'            => '理由を保存',
                        'reason'              => '理由',
                        'status'              => 'ステータス',
                        'mass-update-success' => '選択した理由が正常に更新されました。',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'RMAを作成する',
                    'order-id'          => '注文ID',
                    'email'             => 'メール',
                    'validate'          => '検証する',
                    'rma-already-exist' => 'RMAは既に存在します',
                    'mismatch'          => '注文IDとメールが一致しません',
                    'invalid-order-id'  => '無効な注文ID',
                    'quantity'          => '数量',
                    'reason'            => '理由',
                    'save-btn'          => '保存',
                    'create-success'    => 'RMAが正常に作成されました。',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA返品',
            'offer'        => '初めての注文で最大40％OFFをゲット',
            'shop-now'     => '今すぐショップ',

            'create' => [
                'heading'                  => '新しいRMAリクエスト',
                'create-btn'               => '保存',
                'orders'                   => '注文',
                'resolution'               => '解決方法を選択',
                'item-ordered'             => '注文された商品',
                'images'                   => '画像',
                'information'              => '追加情報',
                'order-status'             => '注文ステータス',
                'product'                  => '商品',
                'sku'                      => 'SKU',
                'price'                    => '価格',
                'search-order'             => '注文を検索',
                'enter-order-id'           => '注文IDを入力',
                'not-allowed'              => '保留中の注文にはRMAが許可されていません',
                'image'                    => '画像',
                'quantity'                 => '数量',
                'reason'                   => '理由',
                'rma-not-available-quotes' => '商品はRMA対象ではありません',
                'product-name'             => '商品名',
                'reopen-request'           => 'リクエストを再開',
                'save'                     => '保存',
                'cancel'                   => 'キャンセル',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMAステータス：',
                'order-status' => '注文ステータス：',
                'close-rma'    => 'RMAを閉じる：',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => '新しいRMAリクエスト',
                'create-btn'               => '保存',
                'orders'                   => '注文',
                'resolution'               => '解決方法を選択',
                'item-ordered'             => '注文された商品',
                'images'                   => '画像',
                'information'              => '追加情報',
                'order-status'             => '注文ステータス',
                'product'                  => '商品',
                'sku'                      => 'SKU',
                'price'                    => '価格',
                'search-order'             => '注文を検索',
                'enter-order-id'           => '注文IDを入力',
                'not-allowed'              => '保留中の注文にはRMAが許可されていません',
                'image'                    => '画像',
                'quantity'                 => '数量',
                'reason'                   => '理由',
                'rma-not-available-quotes' => '商品はRMA対象ではありません',
                'product-name'             => '商品名',
                'reopen-request'           => 'リクエストを再開',
                'save'                     => '保存',
                'cancel'                   => 'キャンセル',
                'reopen-request'           => 'リクエストを再開',
            ],

            'index' => [
                'create'  => '新しいRMAをリクエストする',
                'heading' => '顧客RMAパネル',
                'view'    => '表示',
                'edit'    => '編集',
                'delete'  => '削除',
                'update'  => '更新',
                'guest'   => 'ゲストRMAパネル',
            ],
        ],

        'customer-rma-index' => [
            'create'  => '新しいRMAをリクエストする',
            'heading' => '顧客RMAパネル',
            'view'    => '表示',
            'edit'    => '編集',
            'delete'  => '削除',
            'update'  => '更新',
            'guest'   => 'ゲストRMAパネル',
        ],

        'validation' => [
            'orders'       => '注文',
            'resolution'   => '解決方法',
            'information'  => '追加情報',
            'order-status' => '注文ステータス',
            'order-id'     => '注文選択',
            'close-rma'    => '確認',
        ],

        'conversation-texts' => [
            'by'       => 'By',
            'seller'   => 'Seller',
            'customer' => 'Customer',
            'on'       => 'On',
        ],

        'default-option' => [
            'please-select-value' => '値を選択してください',
            'select-quantity'     => '数量を選択',
            'select-reason'       => '理由を選択',
            'others'              => 'その他',
            'select-order-status' => '注文ステータスを選択',
            'select-resolution'   => '解決方法を選択',
            'select-seller'       => '販売者を選択',
            'select-order'        => '注文を選択',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Guest',
            'heading'                 => 'RMA詳細',
            'status'                  => 'ステータス',
            'order-id'                => ' 注文ID：',
            'refund-details'          => '返金の詳細',
            'resolution-type'         => '解決方法：',
            'additional-information'  => '追加情報：',
            'change-rma-status'       => 'RMAステータスを変更',
            'save-btn'                => '保存',
            'you'                     => 'Admin',
            'send-message-btn'        => '送信',
            'items-requested-for-rma' => 'RMA要求された商品',
            'refund-offline-btn'      => 'オフライン返金',
            'send-message'            => 'メッセージを送信',
            'conversations'           => '会話',
            'cancel-order'            => '注文をキャンセル',
            'status-details'          => 'ステータス詳細',
            'admin'                   => 'Admin',
            'status-quotes'           => '解決済みとしてマークするには同意してください。',
            'close-rma'               => 'RMAを閉じる：',
            'images'                  => '画像',
            'items-request'           => 'RMA要求された商品',
            'refundable-amount'       => '返金可能金額',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => '解決タイプ：',
            'guest'                  => 'ゲスト',
            'status'                 => 'ステータス',
            'order-id'               => '注文ID：',
            'additional-information' => '追加情報：',
            'save-btn'               => '保存',
            'send-message-btn'       => '送信',
            'refund-offline-btn'     => 'オフラインで返金',
            'send-message'           => 'メッセージを送信',
            'conversations'          => '会話',
            'status-details'         => 'ステータス詳細',
            'admin'                  => '管理者',
            'status-quotes'          => '解決済みとしてマークするには同意してください。',
            'close-rma'              => 'RMAを閉じる',
            'images'                 => '画像',
            'items-request'          => 'RMAのアイテムリクエスト',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMAステータス：',
            'order-status' => '注文ステータス：',
            'full-amount'  => '全額',
            'request-on'   => 'リクエスト日：',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'RMAを閉じる',
            'rma-status'              => 'RMAステータス：',
            'admin-status'            => '管理者ステータス：',
            'order-status'            => '注文ステータス：',
            'consignment-no'          => '委託番号：',
            'refundable-amount'       => '返金可能金額：',
            'full-amount'             => '全額',
            'partial-amount'          => '一部の金額',
            'total-refundable-amount' => '合計返金可能金額：',
            'enter-message'           => 'メッセージを入力',
            'request-on'              => 'リクエスト日：',
            'seller'                  => '売り手',
            'order-details'           => '注文詳細',
        ],

        'table-heading' => [
            'product-name' => '商品名',
            'sku'          => 'SKU',
            'price'        => '価格',
            'qty'          => '数量',
            'reason'       => '理由',
        ],

        'guest-users' => [
            'heading'     => 'ゲストログインパネル',
            'order-id'    => '注文ID',
            'email'       => 'Eメール',
            'button-text' => 'ログイン',
            'title'       => 'ゲストログイン',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMAリクエスト',
            'hello'                  => '親愛なる:nameさん',
            'greeting'               => '注文:order_idの新しいRMAをリクエストしました。',
            'rma-id'                 => 'RMA ID：',
            'summary'                => '注文のRMAの要約',
            'order-id'               => '注文ID：',
            'order-status'           => '注文ステータス：',
            'resolution-type'        => '解決タイプ：',
            'additional-information' => '追加情報：',
            'thank-you'              => 'ありがとうございます',
            'requested-rma-product'  => 'リクエストされたRMAの製品：',
        ],

        'customer-data-table-heading' => [
            'product-name' => '商品名',
            'sku'          => 'SKU',
            'qty'          => '数量',
            'reason'       => '理由',
        ],

        'customer-conversation' => [
            'heading' => '親愛なる:nameさん、',
            'quotes'  => 'バイヤーからの新しいメッセージがあります',
            'message' => 'メッセージ',
        ],

        'seller-conversation' => [
            'heading' => '親愛なる:nameさん',
            'quotes'  => '売り手からの新しいメッセージがあります',
            'message' => 'メッセージ',
            'title'   => 'メッセージが受信されました！',
        ],

        'status' => [
            'heading'       => '拝啓:name様',
            'quotes'        => '貴殿のRMAステータスが売り手によって変更されました',
            'rma-id'        => 'RMA識別子',
            'your-rma-id'   => '貴殿のRMA識別子',
            'status-change' => ':idのステータスが売り手によって変更されました',
            'status'        => 'ステータス',
            'title'         => 'ステータスが更新されました！',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => '保留中',
            'processing'               => '処理中',
            'item-canceled'            => 'アイテムキャンセル済み',
            'solved'                   => '解決済み',
            'declined'                 => '拒否済み',
            'received-package'         => 'パッケージ受取済み',
            'dispatched-package'       => 'パッケージ発送済み',
            'not-received-package-yet' => 'まだパッケージを受け取っていません',
            'accept'                   => '受け入れ',
        ],

        'status-quotes' => [
            'declined-admin'  => '管理者によってRMAが拒否されました。',
            'declined-buyer'  => '購入者によってRMAが拒否されました。',
            'solved'          => 'RMAが解決されました。',
            'solved-by-admin' => '管理者によってRMAが解決されました。',
        ],
    ],

    'response' => [
        'create-success' => ':nameが正常に作成されました。',
        'send-message'   => ':nameが正常に送信されました。',
        'update-success' => ':nameが正常に更新されました。',
    ],
];
