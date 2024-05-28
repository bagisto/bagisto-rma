<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Разрешить новый запрос RMA для ожидающего заказа',
                        'allow-rma-for-digital-product'       => 'Разрешить RMA для цифровых продуктов',
                        'default-allow-days'                  => 'Количество дней по умолчанию',
                        'enable'                              => 'Включить RMA',
                        'info'                                => 'RMA является частью процесса возврата товара в компанию для получения возврата денег, замены или ремонта.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'Функциональность RMA позволяет обрабатывать ситуации, когда клиенты возвращают товары на ремонт и обслуживание или для возврата или замены.',
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
                    'rma-title'        => 'Все Rma',
                    'reason-title'     => 'Причины',
                    'create-rma-title' => 'Создать Rma',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Все Rma',

                        'datagrid' => [
                            'id'        => 'Идентификатор RMA',
                            'order-ref' => 'Ссылка на заказ',
                            'status'    => 'Статус',
                            'create'    => 'Создано в',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID заказа :',
                        'request-on'             => 'Запрос в :',
                        'customer'               => 'Клиент :',
                        'resolution-type'        => 'Тип разрешения :',
                        'additional-information' => 'Дополнительная информация :',
                        'images'                 => 'Изображение :',
                        'order-details'          => 'Детали заказа',
                        'status'                 => 'Статус',
                        'rma-status'             => 'Статус RMA :',
                        'order-status'           => 'Статус заказа :',
                        'change-status'          => 'Изменить статус',
                        'conversations'          => 'Беседы',
                        'save-btn'               => 'Сохранить',
                        'send-message'           => 'Отправить сообщение',
                        'enter-message'          => 'Введите сообщение',
                        'send-message-btn'       => 'Отправить сообщение',
                        'send-message-success'   => 'Сообщение успешно отправлено.',
                        'update-success'         => 'Статус Rma успешно обновлен.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Причины',
                        'create-btn' => 'Создать причину Rma',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Причина',
                            'status'              => 'Статус',
                            'created-at'          => 'Создано в',
                            'enabled'             => 'Включено',
                            'disabled'            => 'Отключено',
                            'delete-success'      => 'Причина успешно удалена.',
                            'mass-delete-success' => 'Массовое удаление Rma успешно.',
                            'reason-error'        => 'Причина используется в RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Добавить новую причину',
                        'save-btn'       => 'Сохранить причину',
                        'reason'         => 'Причина',
                        'status'         => 'Статус',
                        'create-success' => 'Причина успешно создана.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Изменить причину',
                        'save-btn'            => 'Сохранить причину',
                        'reason'              => 'Причина',
                        'status'              => 'Статус',
                        'mass-update-success' => 'Выбранные причины успешно обновлены.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Создать Rma',
                    'order-id'          => 'ID заказа',
                    'email'             => 'Электронная почта',
                    'validate'          => 'Проверить',
                    'rma-already-exist' => 'RMA уже существует',
                    'mismatch'          => 'Несоответствие ID заказа и электронной почты',
                    'invalid-order-id'  => 'Неверный ID заказа',
                    'quantity'          => 'Количество',
                    'reason'            => 'Причина',
                    'save-btn'          => 'Сохранить',
                    'create-success'    => 'Rma успешно создан.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'Возврат',
            'title'        => 'Возврат',
            'header-title' => 'Возврат товара (RMA)',
            'offer'        => 'Получите до 40% СКИДКИ на ваш первый заказ',
            'shop-now'     => 'КУПИТЬ СЕЙЧАС',

            'create' => [
                'heading'                  => 'Новый запрос на возврат товара (RMA)',
                'create-btn'               => 'Сохранить',
                'orders'                   => 'Заказы',
                'resolution'               => 'Выберите разрешение',
                'item-ordered'             => 'Заказанный товар',
                'images'                   => 'Изображения',
                'information'              => 'Дополнительная информация',
                'order-status'             => 'Статус заказа',
                'product'                  => 'Продукт',
                'sku'                      => 'SKU',
                'price'                    => 'Цена',
                'search-order'             => 'Поиск заказа',
                'enter-order-id'           => 'Введите ID заказа',
                'not-allowed'              => 'RMA не разрешен для ожидающего заказа',
                'image'                    => 'Изображение',
                'quantity'                 => 'Количество',
                'reason'                   => 'Причина',
                'rma-not-available-quotes' => 'Товар недоступен для RMA',
                'product-name'             => 'Наименование продукта',
                'reopen-request'           => 'Повторно открыть запрос',
                'save'                     => 'Сохранить',
                'cancel'                   => 'Отменить',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'Возврат',
                'rma-status'   => 'Статус RMA:',
                'order-status' => 'Статус заказа:',
                'close-rma'    => 'Закрыть RMA:',
            ],

            'create' => [
                'title'                    => 'Возврат',
                'heading'                  => 'Новый запрос на возврат товара (RMA)',
                'create-btn'               => 'Сохранить',
                'orders'                   => 'Заказы',
                'resolution'               => 'Выберите разрешение',
                'item-ordered'             => 'Заказанный товар',
                'images'                   => 'Изображения',
                'information'              => 'Дополнительная информация',
                'order-status'             => 'Статус заказа',
                'product'                  => 'Продукт',
                'sku'                      => 'SKU',
                'price'                    => 'Цена',
                'search-order'             => 'Поиск заказа',
                'enter-order-id'           => 'Введите ID заказа',
                'not-allowed'              => 'RMA не разрешен для ожидающего заказа',
                'image'                    => 'Изображение',
                'quantity'                 => 'Количество',
                'reason'                   => 'Причина',
                'rma-not-available-quotes' => 'Товар недоступен для RMA',
                'product-name'             => 'Наименование продукта',
                'reopen-request'           => 'Повторно открыть запрос',
                'save'                     => 'Сохранить',
                'cancel'                   => 'Отменить',
                'reopen-request'           => 'Повторно открыть запрос',
            ],

            'index' => [
                'create'  => 'Запросить новый RMA',
                'heading' => 'Панель управления RMA для посетителя',
                'view'    => 'Просмотр',
                'edit'    => 'Редактировать',
                'delete'  => 'Удалить',
                'update'  => 'Обновить',
                'guest'   => 'Панель управления RMA для посетителя',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Запросить новый RMA',
            'heading' => 'Панель управления RMA для клиента',
            'view'    => 'Просмотр',
            'edit'    => 'Редактировать',
            'delete'  => 'Удалить',
            'update'  => 'Обновить',
            'guest'   => 'Панель управления RMA для посетителя',
        ],

        'validation' => [
            'orders'       => 'Заказы',
            'resolution'   => 'Разрешение',
            'information'  => 'Дополнительная информация',
            'order-status' => 'Статус заказа',
            'order-id'     => 'Выбор заказа',
            'close-rma'    => 'Подтвердить',
        ],

        'conversation-texts' => [
            'by'       => 'От',
            'seller'   => 'Продавец',
            'customer' => 'Клиент',
            'on'       => 'На',
        ],

        'default-option' => [
            'please-select-value' => 'Пожалуйста, выберите значение',
            'select-quantity'     => 'Выбрать количество',
            'select-reason'       => 'Выбрать причину',
            'others'              => 'Другое',
            'select-order-status' => 'Выбрать статус заказа',
            'select-resolution'   => 'Выбрать разрешение',
            'select-seller'       => 'Выбрать продавца',
            'select-order'        => 'Выбрать заказ',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Посетитель',
            'heading'                 => 'Детали RMA',
            'status'                  => 'Статус',
            'order-id'                => 'ID заказа:',
            'refund-details'          => 'Детали возврата',
            'resolution-type'         => 'Тип разрешения:',
            'additional-information'  => 'Дополнительная информация:',
            'change-rma-status'       => 'Изменить статус RMA',
            'save-btn'                => 'Сохранить',
            'you'                     => 'Администратор',
            'send-message-btn'        => 'Отправить',
            'items-requested-for-rma' => 'Товар(ы), запрошенный(е) для RMA',
            'refund-offline-btn'      => 'Возврат офлайн',
            'send-message'            => 'Отправить сообщение',
            'conversations'           => 'Беседы',
            'cancel-order'            => 'Отменить заказ',
            'status-details'          => 'Детали статуса',
            'admin'                   => 'Администратор',
            'status-quotes'           => 'Пожалуйста, согласитесь, чтобы отметить его как решенный.',
            'close-rma'               => 'Закрыть RMA:',
            'images'                  => 'Изображения',
            'items-request'           => 'Товар(ы), запрошенный(е) для RMA',
            'refundable-amount'       => 'Сумма к возврату',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Тип решения :',
            'guest'                  => 'Вы',
            'status'                 => 'Статус',
            'order-id'               => ' ID заказа :',
            'additional-information' => 'Дополнительная информация :',
            'save-btn'               => 'Сохранить',
            'send-message-btn'       => 'Отправить',
            'refund-offline-btn'     => 'Выплата наличными',
            'send-message'           => 'Отправить сообщение',
            'conversations'          => 'Общение',
            'status-details'         => 'Детали статуса',
            'admin'                  => 'Админ',
            'status-quotes'          => 'Пожалуйста, согласитесь пометить как решенное.',
            'close-rma'              => 'Закрыть RMA',
            'images'                 => 'Изображения',
            'items-request'          => 'Товар(ы) для возврата',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Статус RMA :',
            'order-status' => 'Статус заказа :',
            'full-amount'  => 'Полная сумма',
            'request-on'   => 'Запрошено :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Закрыть RMA',
            'rma-status'              => 'Статус RMA :',
            'admin-status'            => 'Статус админа:',
            'order-status'            => 'Статус заказа :',
            'consignment-no'          => 'Номер консигнации:',
            'refundable-amount'       => 'Возвращаемая сумма:',
            'full-amount'             => 'Полная сумма',
            'partial-amount'          => 'Частичная сумма',
            'total-refundable-amount' => 'Общая возвращаемая сумма:',
            'enter-message'           => 'Введите сообщение',
            'request-on'              => 'Запрошено :',
            'seller'                  => 'Продавец',
            'order-details'           => 'Детали заказа',
        ],

        'table-heading' => [
            'product-name' => 'Название продукта',
            'sku'          => 'SKU',
            'price'        => '��ена',
            'qty'          => 'Кол-во',
            'reason'       => 'Причина',
        ],

        'guest-users' => [
            'heading'     => 'Панель входа для гостей',
            'order-id'    => 'ID заказа',
            'email'       => 'Электронная почта',
            'button-text' => 'Войти',
            'title'       => 'Вход для гостей',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Запрос RMA',
            'hello'                  => 'Уважаемый :name',
            'greeting'               => 'Вы запросили новый RMA для заказа :order_id.',
            'rma-id'                 => 'ID RMA :',
            'summary'                => 'Сводка RMA заказа',
            'order-id'               => 'ID заказа :',
            'order-status'           => 'Статус заказа :',
            'resolution-type'        => 'Тип решения :',
            'additional-information' => 'Дополнительная информация :',
            'thank-you'              => 'Спасибо',
            'requested-rma-product'  => 'Запрошенный товар RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Название продукта',
            'sku'          => 'SKU',
            'qty'          => 'Кол-во',
            'reason'       => 'Причина',
        ],

        'customer-conversation' => [
            'heading' => 'Уважаемый :name,',
            'quotes'  => 'Новое сообщение от покупателя',
            'message' => 'Сообщение',
        ],

        'seller-conversation' => [
            'heading' => 'Уважаемый :name',
            'quotes'  => 'Новое сообщение от продавца',
            'message' => 'Сообщение',
            'title'   => 'Сообщение получено!',
        ],

        'status' => [
            'heading'       => 'Уважаемый :name',
            'quotes'        => 'Статус RMA был изменен продавцом',
            'rma-id'        => 'ID RMA',
            'your-rma-id'   => 'Ваш ID RMA',
            'status-change' => 'Статус :id был изменен продавцом',
            'status'        => 'Статус',
            'title'         => 'Статус обновлен!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Ожидание',
            'processing'               => 'В обработке',
            'item-canceled'            => 'Товар отменен',
            'solved'                   => 'Решено',
            'declined'                 => 'Отклонено',
            'received-package'         => 'Получен пакет',
            'dispatched-package'       => 'Отправлен пакет',
            'not-received-package-yet' => 'Пакет еще не получен',
            'accept'                   => 'Принять',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA отклонен администратором.',
            'declined-buyer'  => 'RMA отклонен покупателем.',
            'solved'          => 'RMA решено.',
            'solved-by-admin' => 'RMA решено администратором.',
        ],
    ],

    'response' => [
        'create-success'    => ':name успешно создан.',
        'send-message'      => ':name успешно отправлен.',
        'update-success'    => ':name успешно обновлен.',
        'permission-denied' => 'Вы вошли в систему',
    ],
];
