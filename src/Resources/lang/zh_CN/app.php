<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => '下午',
                        'all-products'                        => '所有产品',
                        'all-status'                          => '所有状态',
                        'allow-new-request-for-pending-order' => '允许针对待处理订单的新RMA请求',
                        'allow-rma-for-digital-product'       => '允许数字产品的RMA',
                        'allowed-file-extension'              => '允许的文件扩展名',
                        'allowed-file-types'                  => '请选择仅文件类型 ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => '用逗号分隔。例如：jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => '允许取消请求的新RMA请求',
                        'allowed-request-declined-request'    => '允许被拒请求的新RMA请求',
                        'allowed-rma-for-product'             => '允许产品的RMA',
                        'cancel-items'                        => '取消项目',
                        'complete'                            => '完成',
                        'current-order-quantity'              => '当前订单数量',
                        'days-info'                           => '客户在下订单后可以请求RMA的天数。',
                        'default-allow-days'                  => '默认允许天数',
                        'enable'                              => '启用RMA',
                        'evening'                             => '晚上',
                        'exchange'                            => '换货',
                        'info'                                => 'RMA是将产品退还给企业以获得退款、替换或修理的过程的一部分。',
                        'morning'                             => '早上',
                        'new-rma-message-to-customer'         => '给客户的新RMA消息',
                        'no'                                  => '否',
                        'open'                                => '打开',
                        'package-condition'                   => '包装状况',
                        'packed'                              => '已包装',
                        'print-page'                          => '打印页面', 
                        'product-already-raw'                 => '产品已在RMA中。',
                        'product-delivery-status'             => '产品交付状态',
                        'resolution-type'                     => '解决类型',
                        'return-pickup-address'               => '退货取件地址',
                        'return-pickup-time'                  => '退货取件时间',
                        'return-policy'                       => '退货政策',
                        'return'                              => '退货',
                        'select-allowed-order-status'         => '选择允许的订单状态',
                        'specific-products'                   => '特定产品',
                        'title'                               => 'RMA',
                        'yes'                                 => '是',

                        'setting' => [
                            'info'  => 'RMA功能允许处理客户退回商品进行修理和维护，或退款或更换的情况。',
                            'read'  => '阅读政策',
                            'terms' => '我已阅读并接受退货政策。',
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
                    'create-rma-title' => '创建RMA',
                    'reason-title'     => '原因',
                    'rma-title'        => '所有RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => '所有RMA',

                        'datagrid' => [
                            'create'        => '创建时间',
                            'customer-name' => '客户姓名',
                            'id'            => 'RMA编号',
                            'order-ref'     => '订单参考',
                            'order-status'  => '订单状态',
                            'rma-status'    => 'RMA状态',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => '添加附件',
                        'additional-information' => '附加信息：',
                        'attachment'             => '附件',
                        'change-status'          => '更改状态',
                        'confirm-print'          => '点击确定打印RMA',
                        'conversations'          => '对话',
                        'customer-details'       => '客户详情',
                        'customer-email'         => '客户邮箱：',
                        'customer'               => '客户：',
                        'enter-message'          => '输入消息',
                        'images'                 => '图片：',
                        'no-record'              => '未找到记录！',
                        'order-date'             => '订单日期：',
                        'order-details'          => 'RMA请求的商品',
                        'order-id'               => '订单编号：',
                        'order-status'           => '订单状态：',
                        'order-total'            => '订单总额：',
                        'request-on'             => '请求日期：',
                        'resolution-type'        => '解决类型：',
                        'rma-status'             => 'RMA状态：',
                        'save-btn'               => '保存',
                        'send-message-btn'       => '发送消息',
                        'send-message-success'   => '消息发送成功。',
                        'send-message'           => '发送消息',
                        'status'                 => '状态',
                        'title'                  => 'RMA',
                        'update-success'         => 'RMA状态更新成功。',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => '创建RMA状态',
                        'title'      => 'RMA状态',

                        'datagrid' => [
                            'created-at'          => '创建时间',
                            'delete-success'      => 'RMA状态删除成功。',
                            'disabled'            => '禁用',
                            'enabled'             => '启用',
                            'id'                  => 'ID',
                            'mass-delete-success' => '选定的RMA状态删除成功。',
                            'reason-error'        => 'RMA状态在RMA中使用。',
                            'reason'              => 'RMA状态',
                            'status'              => '状态',
                        ],
                    ],

                    'create' => [
                        'create-title' => '添加新的RMA状态',
                        'reason'       => 'RMA状态',
                        'save-btn'     => '保存RMA状态',
                        'status'       => '状态',
                        'success'      => 'RMA状态创建成功。',
                    ],

                    'edit' => [
                        'edit-title'          => '编辑RMA状态',
                        'mass-update-success' => '选定的RMA状态更新成功。',
                        'reason'              => 'RMA状态',
                        'save-btn'            => '保存RMA状态',
                        'status'              => '状态',
                        'success'             => 'RMA状态更新成功。',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => '创建RMA原因',
                        'title'      => '原因',

                        'datagrid' => [
                            'created-at'          => '创建时间',
                            'delete-success'      => '原因删除成功。',
                            'disabled'            => '禁用',
                            'enabled'             => '启用',
                            'id'                  => '编号',
                            'mass-delete-success' => '选中的数据删除成功',
                            'reason-error'        => '原因在RMA中使用。',
                            'reason'              => '原因',
                            'status'              => '状态',
                        ],
                    ],

                    'create' => [
                        'create-title' => '添加新原因',
                        'reason'       => '原因',
                        'save-btn'     => '保存原因',
                        'status'       => '状态',
                        'success'      => '原因创建成功。',
                    ],

                    'edit' => [
                        'edit-title'          => '编辑原因',
                        'mass-update-success' => '选中的原因更新成功。',
                        'reason'              => '原因',
                        'save-btn'            => '保存原因',
                        'status'              => '状态',
                        'success'             => '原因更新成功。',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => '添加新字段',
                        'title'      => 'RMA自定义字段',

                        'datagrid' => [
                            'created-at'          => '创建时间',
                            'delete-success'      => '自定义字段删除成功。',
                            'disabled'            => '禁用',
                            'enabled'             => '启用',
                            'id'                  => '编号',
                            'mass-delete-success' => '选中的数据已成功删除',
                            'status'              => '状态',
                        ],
                    ],

                    'create' => [
                        'create-title' => '新建自定义字段',
                        'save-btn'     => '保存自定义字段',
                        'status'       => '状态',
                        'success'      => '自定义字段创建成功。',
                    ],

                    'edit' => [
                        'edit-title'          => '编辑自定义字段',
                        'mass-update-success' => '选中的自定义字段已成功更新。',
                        'reason'              => '自定义字段',
                        'save-btn'            => '保存自定义字段',
                        'status'              => '状态',
                        'success'             => '自定义字段更新成功。',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => '创建RMA规则',
                        'title'      => 'RMA规则',

                        'datagrid' => [
                            'delete-success'      => 'RMA规则删除成功。',
                            'disabled'            => '禁用',
                            'enabled'             => '启用',
                            'exchange-period'     => '交换期（天）',
                            'id'                  => 'ID',
                            'mass-delete-success' => '选中的数据删除成功。',
                            'reason'              => '规则',
                            'return-period'       => '退货期（天）',
                            'status'              => '状态',
                        ],
                    ],

                    'create' => [
                        'create-title'       => '添加新RMA规则',
                        'reason'             => 'RMA规则',
                        'resolutions-period' => '解决期',
                        'rule-description'   => '规则描述',
                        'rule-details'       => '规则详情',
                        'rules-title'        => '规则标题',
                        'save-btn'           => '保存RMA规则',
                        'status'             => 'RMA状态',
                        'success'            => 'RMA规则创建成功。',
                    ],

                    'edit' => [
                        'edit-title'          => '编辑RMA规则',
                        'mass-update-success' => '选中的RMA规则更新成功。',
                        'reason'              => 'RMA规则',
                        'save-btn'            => '更新RMA规则',
                        'status'              => '状态',
                        'success'             => 'RMA规则更新成功。',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA创建成功。',
                    'create-title'             => '创建RMA',
                    'email'                    => '电子邮件',
                    'image'                    => '图片',
                    'invalid-order-id'         => '无效的订单编号',
                    'mismatch'                 => '订单编号和电子邮件不匹配',
                    'new-rma'                  => '新RMA',
                    'order-id'                 => '订单编号',
                    'quantity'                 => '数量',
                    'reason'                   => '原因',
                    'rma-already-exist'        => 'RMA已存在',
                    'rma-not-available-quotes' => '商品不可用于RMA',
                    'save-btn'                 => '保存',
                    'search'                   => '--选择--',
                    'validate'                 => '验证',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA已创建',
                    'rma-created-message'  => '产品数量为:qty的RMA请求已创建'
                ],
            ],
        ],

        'acl' => [
            'delete'      => '删除',
            'edit'        => '编辑',
            'mass-delete' => '批量删除',
            'mass-update' => '批量更新',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => '已送达',
            'menu-name'    => '退货申请 (RMA)',
            'offer'        => '首次订购享受高达40%折扣',
            'rma-qty'      => '退货数量',
            'shop-now'     => '立即购买',
            'submit-req'   => '提交请求',
            'title'        => '退货申请 (RMA)',
            'undelivered'  => '未送达',

            'create' => [
                'cancel'                   => '取消',
                'create-btn'               => '保存',
                'enter-order-id'           => '输入订单编号',
                'heading'                  => '新退货申请',
                'exchange-window'          => '交换窗口',
                'image'                    => '图片',
                'images'                   => '图片',
                'information'              => '附加信息',
                'item-ordered'             => '订购的商品',
                'no-record'                => '未找到记录！',
                'not-allowed'              => '待处理订单不允许退货申请',
                'order-status'             => '订单状态',
                'orders'                   => '订单',
                'price'                    => '价格',
                'product-name'             => '产品名称',
                'product'                  => '产品',
                'quantity'                 => '数量',
                'reason'                   => '原因',
                'reopen-request'           => '重新打开请求',
                'resolution'               => '选择解决方案',
                'return-window'            => '退货期限',
                'rma-not-available-quotes' => '商品不可退货',
                'save'                     => '保存',
                'search-order'             => '搜索订单',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => '关闭退货申请：',
                'order-status' => '订单状态：',
                'rma-status'   => '退货状态：',
                'title'        => '退货申请 (RMA)',
            ],

            'create' => [
                'cancel'                   => '取消',
                'create-btn'               => '保存',
                'enter-order-id'           => '输入订单编号',
                'heading'                  => '新退货申请',
                'image'                    => '图片',
                'images'                   => '图片',
                'information'              => '附加信息',
                'item-ordered'             => '订购的商品',
                'not-allowed'              => '待处理订单不允许退货申请',
                'order-status'             => '订单状态',
                'orders'                   => '订单',
                'price'                    => '价格',
                'product-name'             => '产品名称',
                'product'                  => '产品',
                'quantity'                 => '数量',
                'reason'                   => '原因',
                'reopen-request'           => '重新打开请求',
                'resolution'               => '选择解决方案',
                'rma-not-available-quotes' => '商品不可退货',
                'save'                     => '保存',
                'search-order'             => '搜索订单',
                'sku'                      => 'SKU',
                'title'                    => '退货申请 (RMA)',
            ],

            'index' => [
                'create'  => '申请新退货',
                'delete'  => '删除',
                'edit'    => '编辑',
                'guest'   => '访客退货申请面板',
                'heading' => '客户退货申请面板',
                'update'  => '更新',
                'view'    => '查看',
            ],
        ],

        'customer-rma-index' => [
            'create'  => '创建',
            'delete'  => '删除',
            'edit'    => '编辑',
            'guest'   => '访客退货申请面板',
            'heading' => '退货申请 (RMA)',
            'update'  => '更新',
            'view'    => '查看',
        ],

        'validation' => [
            'close-rma'     => '确认',
            'information'   => '附加信息',
            'order-id'      => '订单选择',
            'order-status'  => '订单状态',
            'orders'        => '订单',
            'resolution'    => '解决方案',
            'select-orders' => '选择订单',
        ],

        'conversation-texts' => [
            'by'        => '由',
            'customer'  => '客户',
            'no-record' => '未找到记录！',
            'on'        => '于',
            'seller'    => '卖家',
        ],

        'default-option' => [
            'others'              => '其他',
            'please-select-value' => '请选择值',
            'select-order-status' => '选择订单状态',
            'select-order'        => '选择订单',
            'select-quantity'     => '选择数量',
            'select-reason'       => '选择原因',
            'select-resolution'   => '选择解决方案',
            'select-seller'       => '选择卖家',
        ],

        'view-customer-rma' => [
            'additional-information'  => '附加信息：',
            'admin'                   => '管理员',
            'cancel-order'            => '取消订单',
            'change-rma-status'       => '更改退货申请状态',
            'close-rma'               => '关闭退货申请：',
            'conversations'           => '对话',
            'guest'                   => '访客',
            'heading'                 => '退货申请详情',
            'images'                  => '图片：',
            'items-request'           => '申请退货的商品',
            'items-requested-for-rma' => '申请退货的商品',
            'order-id'                => '订单编号：',
            'refund-details'          => '退款详情',
            'refund-offline-btn'      => '线下退款',
            'refundable-amount'       => '可退款金额',
            'resolution-type'         => '解决方案类型：',
            'rma'                     => '退货申请 (RMA)',
            'save-btn'                => '保存',
            'send-message-btn'        => '发送',
            'send-message'            => '发送消息',
            'status-details'          => '状态详情',
            'status-quotes'           => '请同意标记为已解决',
            'status-reopen'           => '选中以重新打开',
            'status'                  => '状态',
            'term'                    => '同意标记字段是必需的',
            'you'                     => '管理员',
        ],

        'view-guest-rma' => [
            'additional-information' => '附加信息：',
            'admin'                  => '管理员',
            'close-rma'              => '关闭退货申请',
            'conversations'          => '对话',
            'guest'                  => '您',
            'images'                 => '图片',
            'items-request'          => '申请退货的商品',
            'order-id'               => '订单编号：',
            'refund-offline-btn'     => '线下退款',
            'resolution-type'        => '解决方案类型：',
            'rma'                    => '退货申请 (RMA)',
            'save-btn'               => '保存',
            'send-message-btn'       => '发送',
            'send-message'           => '发送消息',
            'status-details'         => '状态详情',
            'status-quotes'          => '请同意标记为已解决',
            'status'                 => '状态',
            'term'                   => '同意标记字段是必需的',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => '全额',
            'order-status' => '订单状态：',
            'request-on'   => '请求日期：',
            'rma-status'   => '退货状态：',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => '管理员状态：',
            'close-rma'               => '关闭退货申请',
            'consignment-no'          => '托运单号：',
            'enter-message'           => '输入消息',
            'full-amount'             => '全额',
            'order-details'           => '订单详情',
            'order-status'            => '订单状态：',
            'partial-amount'          => '部分金额',
            'refundable-amount'       => '可退款金额：',
            'request-on'              => '请求日期：',
            'rma-status'              => '退货状态：',
            'seller'                  => '卖家',
            'total-refundable-amount' => '总可退款金额：',
        ],

        'table-heading' => [
            'image'           => '图片',
            'order-qty'       => '订单数量',
            'price'           => '价格',
            'product-name'    => '产品名称',
            'reason'          => '原因',
            'resolution-type' => '解决方案类型',
            'rma-qty'         => 'RMA 数量',
            'sku'             => 'SKU',
        ],

        'guest-users' => [
            'button-text' => '登录',
            'email'       => '电子邮件',
            'heading'     => '访客登录面板',
            'logout'      => '访客登出',
            'order-id'    => '订单编号',
            'title'       => '访客登录',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => '附加信息 :',
            'greeting'               => '您已为订单 :order_id 提交了新的 RMA 请求。',
            'heading'                => 'RMA 请求',
            'hello'                  => '亲爱的 :name',
            'order-id'               => '订单编号 :',
            'order-status'           => '订单状态 :',
            'requested-rma-product'  => '请求的 RMA 产品：',
            'resolution-type'        => '解决方案类型 :',
            'rma-id'                 => 'RMA 编号 :',
            'summary'                => '订单 RMA 概要',
            'thank-you'              => '谢谢',
        ],

        'customer-data-table-heading' => [
            'product-name' => '产品名称',
            'qty'          => '数量',
            'reason'       => '原因',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => '亲爱的 :name，',
            'message' => '消息',
            'process' => '您的退货请求正在处理中。',
            'quotes'  => '有买家的新消息',
            'solved'  => '客户已将RMA状态更改为已解决。',
        ],

        'seller-conversation' => [
            'heading' => '亲爱的 :name',
            'message' => '消息',
            'quotes'  => '有一条来自管理员的新消息',
            'title'   => '消息已收到！',
        ],

        'status' => [
            'heading'       => '亲爱的 :name',
            'quotes'        => '您的 RMA 状态已被卖家更改',
            'rma-id'        => 'RMA 编号',
            'status-change' => ':id 状态已被卖家更改',
            'status'        => '状态',
            'title'         => '状态已更新！',
            'your-rma-id'   => '您的 RMA 编号',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => '接受',
            'awaiting'                 => '等待中',
            'canceled'                 => '已取消',
            'declined'                 => '已拒绝',
            'dispatched-package'       => '包裹已发出',
            'item-canceled'            => '商品已取消',
            'not-received-package-yet' => '包裹尚未收到',
            'pending'                  => '待处理',
            'processing'               => '处理中',
            'received-package'         => '包裹已收到',
            'solved'                   => '已解决',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA 被管理员拒绝。',
            'declined-buyer'  => 'RMA 被买家拒绝。',
            'solved-by-admin' => 'RMA 已由管理员解决。',
            'solved'          => 'RMA 已解决。',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA 状态已被取消。',
        'cancel-success'    => 'RMA状态已成功取消。',
        'create-success'    => '请求已成功创建。',
        'creation-error'    => '无法更新 RMA 状态，因为尚未为此订单创建发票。',
        'permission-denied' => '您已登录',
        'rma-disabled'      => '该产品的 RMA 功能已禁用',
        'send-message'      => ':name 发送成功。',
        'update-success'    => ':name 更新成功。',
    ],
];