<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'День',
                        'all-products'                        => 'Все продукты',
                        'all-status'                          => 'Все статусы',
                        'allow-new-request-for-pending-order' => 'Разрешить новый запрос RMA для ожидающего заказа',
                        'allow-rma-for-digital-product'       => 'Разрешить RMA для цифрового продукта',
                        'allowed-file-extension'              => 'Разрешённое расширение файла',
                        'allowed-file-types'                  => 'Пожалуйста, выберите только типы файлов ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'Разделено запятыми. Например: jpg,jpeg,pdf', 
                        'allowed-request-cancelled-request'   => 'Разрешить новый запрос RMA для отменённого запроса',
                        'allowed-request-declined-request'    => 'Разрешить новый запрос RMA для отклонённого запроса',
                        'allowed-rma-for-product'             => 'Разрешить RMA для продукта',
                        'cancel-items'                        => 'Отменить предметы',
                        'complete'                            => 'Завершено',
                        'current-order-quantity'              => 'Текущее количество заказа',
                        'days-info'                           => 'Количество дней, в течение которых клиент может запросить RMA после оформления заказа.',
                        'default-allow-days'                  => 'Разрешённые дни по умолчанию',
                        'enable'                              => 'Включить RMA',
                        'evening'                             => 'Вечер',
                        'exchange'                            => 'Обмен',
                        'info'                                => 'RMA является частью процесса возврата продукта в компанию для получения возмещения, замены или ремонта.',
                        'morning'                             => 'Утро',
                        'new-rma-message-to-customer'         => 'Новое сообщение RMA клиенту',
                        'no'                                  => 'Нет',
                        'open'                                => 'Открыть',
                        'package-condition'                   => 'Состояние упаковки',
                        'packed'                              => 'Упаковано',
                        'print-page'                          => 'Распечатать страницу',
                        'product-already-raw'                 => 'Продукт уже находится в RMA.',
                        'product-delivery-status'             => 'Статус доставки продукта',
                        'resolution-type'                     => 'Тип решения',
                        'return-pickup-address'               => 'Адрес возврата',
                        'return-pickup-time'                  => 'Время возврата',
                        'return-policy'                       => 'Политика возврата',
                        'return'                              => 'Возврат',
                        'select-allowed-order-status'         => 'Выберите допустимый статус заказа',
                        'specific-products'                   => 'Конкретные продукты',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Да',

                        'setting' => [
                            'info'  => 'Функционал RMA позволяет управлять ситуациями, когда клиент возвращает товары для ремонта и обслуживания, или для возврата денег или замены.',
                            'read'  => 'Прочитать политику',
                            'terms' => 'Я прочитал и принял политику возврата.',
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
                    'rma-title'        => 'Все RMA',
                    'reason-title'     => 'Причины',
                    'create-rma-title' => 'Создать RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Все RMA',

                        'datagrid' => [
                            'id'            => 'ID RMA',
                            'order-ref'     => 'Номер заказа',
                            'customer-name' => 'Имя клиента',
                            'rma-status'    => 'Статус RMA',
                            'order-status'  => 'Статус заказа',
                            'create'        => 'Создано',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Добавить вложения',
                        'additional-information' => 'Дополнительная информация:',
                        'attachment'             => 'Вложение',
                        'change-status'          => 'Изменить статус',
                        'confirm-print'          => 'Нажмите ОК, чтобы распечатать RMA',
                        'conversations'          => 'Беседы',
                        'customer-details'       => 'Данные клиента',
                        'customer-email'         => 'Электронная почта клиента:',
                        'customer'               => 'Клиент:',
                        'enter-message'          => 'Введите сообщение',
                        'images'                 => 'Изображение:',
                        'no-record'              => 'Запись не найдена!',
                        'order-date'             => 'Дата заказа:',
                        'order-details'          => 'Запрошенные элементы для RMA',
                        'order-id'               => 'ID заказа:',
                        'order-status'           => 'Статус заказа:',
                        'order-total'            => 'Итоговая сумма заказа:',
                        'request-on'             => 'Запрос от:',
                        'resolution-type'        => 'Тип разрешения:',
                        'rma-status'             => 'Статус RMA:',
                        'save-btn'               => 'Сохранить',
                        'send-message-btn'       => 'Отправить сообщение',
                        'send-message-success'   => 'Сообщение успешно отправлено.',
                        'send-message'           => 'Отправить сообщение',
                        'status'                 => 'Статус',
                        'title'                  => 'RMA',
                        'update-success'         => 'Статус RMA успешно обновлен.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Создать статус RMA',
                        'title'      => 'Статус RMA',

                        'datagrid' => [
                            'created-at'          => 'Создано',
                            'delete-success'      => 'Статус RMA успешно удален.',
                            'disabled'            => 'Неактивен',
                            'enabled'             => 'Активен',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Выбранный статус RMA успешно удален.',
                            'reason-error'        => 'Статус RMA используется в RMA.',
                            'reason'              => 'Статус RMA',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Добавить новый статус RMA',
                        'reason'       => 'Статус RMA',
                        'save-btn'     => 'Сохранить статус RMA',
                        'status'       => 'Статус',
                        'success'      => 'Статус RMA успешно создан.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редактировать статус RMA',
                        'mass-update-success' => 'Выбранный статус RMA успешно обновлен.',
                        'reason'              => 'Статус RMA',
                        'save-btn'            => 'Сохранить статус RMA',
                        'status'              => 'Статус',
                        'success'             => 'Статус RMA успешно обновлен.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Причины',
                        'create-btn' => 'Создать причину RMA',

                        'datagrid' => [
                            'created-at'          => 'Создано',
                            'delete-success'      => 'Причина успешно удалена.',
                            'disabled'            => 'Неактивно',
                            'enabled'             => 'Активно',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Выбранные данные успешно удалены.',
                            'reason-error'        => 'Причина используется в RMA.',
                            'reason'              => 'Причина',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Добавить новую причину',
                        'reason'       => 'Причина',
                        'save-btn'     => 'Сохранить причину',
                        'status'       => 'Статус',
                        'success'      => 'Причина успешно создана.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редактировать причину',
                        'mass-update-success' => 'Выбранные причины успешно обновлены.',
                        'reason'              => 'Причина',
                        'save-btn'            => 'Сохранить причину',
                        'status'              => 'Статус',
                        'success'             => 'Причина успешно обновлена.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Добавить новое поле',
                        'title'      => 'Пользовательские поля RMA',

                        'datagrid' => [
                            'created-at'          => 'Создано',
                            'delete-success'      => 'Пользовательские поля успешно удалены.',
                            'disabled'            => 'Неактивно',
                            'enabled'             => 'Активно',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Выбранные данные успешно удалены',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Новое пользовательское поле',
                        'save-btn'     => 'Сохранить пользовательское поле',
                        'status'       => 'Статус',
                        'success'      => 'Пользовательское поле успешно создано.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редактировать пользовательское поле',
                        'mass-update-success' => 'Выбранные пользовательские поля успешно обновлены.',
                        'reason'              => 'Пользовательское поле',
                        'save-btn'            => 'Сохранить пользовательское поле',
                        'status'              => 'Статус',
                        'success'             => 'Пользовательское поле успешно обновлено.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Создать правила RMA',
                        'title'      => 'Правила RMA',

                        'datagrid' => [
                            'delete-success'      => 'Правила RMA успешно удалены.',
                            'disabled'            => 'Неактивно',
                            'enabled'             => 'Активно',
                            'exchange-period'     => 'Период обмена (дней)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Выбранные данные успешно удалены.',
                            'reason'              => 'Правила',
                            'return-period'       => 'Период возврата (дней)',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Добавить новые правила RMA',
                        'reason'             => 'Правила RMA',
                        'resolutions-period' => 'Период разрешений',
                        'rule-description'   => 'Описание правил',
                        'rule-details'       => 'Детали правил',
                        'rules-title'        => 'Название правил',
                        'save-btn'           => 'Сохранить правила RMA',
                        'status'             => 'Статус RMA',
                        'success'            => 'Правила RMA успешно созданы.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редактировать правила RMA',
                        'mass-update-success' => 'Выбранные правила RMA успешно обновлены.',
                        'reason'              => 'Правила RMA',
                        'save-btn'            => 'Обновить правила RMA',
                        'status'              => 'Статус',
                        'success'             => 'Правила RMA успешно обновлены.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA успешно создано.',
                    'create-title'             => 'Создать RMA',
                    'email'                    => 'Эл. почта',
                    'image'                    => 'Изображение',
                    'invalid-order-id'         => 'Недействительный ID заказа',
                    'mismatch'                 => 'Не соответствие ID заказа и эл. почты',
                    'new-rma'                  => 'Новый RMA',
                    'order-id'                 => 'ID заказа',
                    'quantity'                 => 'Количество',
                    'reason'                   => 'Причина',
                    'rma-already-exist'        => 'RMA уже существует',
                    'rma-not-available-quotes' => 'Товар недоступен для RMA',
                    'save-btn'                 => 'Сохранить',
                    'search'                   => '--Выбрать--',
                    'validate'                 => 'Проверить',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA было успешно создано',
                    'rma-created-message'  => 'Запрос RMA доступен для продукта с количеством :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Удалить',
            'edit'        => 'Редактировать',
            'mass-delete' => 'Массовое удаление',
            'mass-update' => 'Массовое обновление',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Доставлено',
            'menu-name'    => 'Возврат товара',
            'offer'        => 'СКИДКА до 40% на ваш первый заказ',
            'rma-qty'      => 'Количество RMA',
            'shop-now'     => 'КУПИТЬ СЕЙЧАС',
            'submit-req'   => 'Отправить запрос',
            'title'        => 'Возврат товара',
            'undelivered'  => 'Не доставлено',

            'create' => [
                'cancel'                   => 'Отмена',
                'create-btn'               => 'Сохранить',
                'enter-order-id'           => 'Введите ID заказа',
                'heading'                  => 'Новый запрос на возврат товара',
                'exchange-window'          => 'Окно обмена',
                'image'                    => 'Изображение',
                'images'                   => 'Изображения',
                'information'              => 'Дополнительная информация',
                'item-ordered'             => 'Заказанный товар',
                'no-record'                => 'Записей не найдено!',
                'not-allowed'              => 'Возврат товара недоступен для ожидающего заказа',
                'order-status'             => 'Статус заказа',
                'orders'                   => 'Заказы',
                'price'                    => 'Цена',
                'product-name'             => 'Название продукта',
                'product'                  => 'Продукт',
                'quantity'                 => 'Количество',
                'reason'                   => 'Причина',
                'reopen-request'           => 'Открыть запрос заново',
                'resolution'               => 'Выберите разрешение',
                'return-window'            => 'Окно возврата',
                'rma-not-available-quotes' => 'Товар недоступен для возврата',
                'save'                     => 'Сохранить',
                'search-order'             => 'Поиск заказа',
                'sku'                      => 'Артикул (SKU)',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Закрыть возврат товара:',
                'order-status' => 'Статус заказа:',
                'rma-status'   => 'Статус возврата товара:',
                'title'        => 'Возврат товара',
            ],

            'create' => [
                'cancel'                   => 'Отмена',
                'create-btn'               => 'Сохранить',
                'enter-order-id'           => 'Введите ID заказа',
                'heading'                  => 'Новый запрос на возврат товара',
                'image'                    => 'Изображение',
                'images'                   => 'Изображения',
                'information'              => 'Дополнительная информация',
                'item-ordered'             => 'Заказанный товар',
                'not-allowed'              => 'Возврат товара недоступен для ожидающего заказа',
                'order-status'             => 'Статус заказа',
                'orders'                   => 'Заказы',
                'price'                    => 'Цена',
                'product-name'             => 'Название продукта',
                'product'                  => 'Продукт',
                'quantity'                 => 'Количество',
                'reason'                   => 'Причина',
                'reopen-request'           => 'Открыть запрос заново',
                'resolution'               => 'Выберите разрешение',
                'rma-not-available-quotes' => 'Товар недоступен для возврата',
                'save'                     => 'Сохранить',
                'search-order'             => 'Поиск заказа',
                'sku'                      => 'Артикул (SKU)',
                'title'                    => 'Возврат товара',
            ],

            'index' => [
                'create'  => 'Создать новый запрос на возврат товара',
                'delete'  => 'Удалить',
                'edit'    => 'Редактировать',
                'guest'   => 'Панель возвратов товара для гостей',
                'heading' => 'Панель возвратов товара для гостей',
                'update'  => 'Обновить',
                'view'    => 'Просмотр',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Создать',
            'delete'  => 'Удалить',
            'edit'    => 'Редактировать',
            'guest'   => 'Панель возвратов товара для гостей',
            'heading' => 'Возврат товара',
            'update'  => 'Обновить',
            'view'    => 'Просмотр',
        ],

        'validation' => [
            'close-rma'     => 'Подтвердить',
            'information'   => 'Дополнительная информация',
            'order-id'      => 'Выбор заказа',
            'order-status'  => 'Статус заказа',
            'orders'        => 'Заказы',
            'resolution'    => 'Разрешение',
            'select-orders' => 'Выберите заказ',
        ],

        'conversation-texts' => [
            'by'        => 'От',
            'customer'  => 'Клиент',
            'no-record' => 'Записей не найдено!',
            'on'        => 'На',
            'seller'    => 'Продавец',
        ],

        'default-option' => [
            'others'              => 'Другое',
            'please-select-value' => 'Выберите значение',
            'select-order-status' => 'Выберите статус заказа',
            'select-order'        => 'Выберите заказ',
            'select-quantity'     => 'Выберите количество',
            'select-reason'       => 'Выберите причину',
            'select-resolution'   => 'Выберите разрешение',
            'select-seller'       => 'Выберите продавца',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Дополнительная информация:',
            'admin'                   => 'Администратор',
            'cancel-order'            => 'Отменить заказ',
            'change-rma-status'       => 'Изменить статус возврата товара',
            'close-rma'               => 'Закрыть возврат товара:',
            'conversations'           => 'Беседы',
            'guest'                   => 'Гость',
            'heading'                 => 'Детали возврата товара',
            'images'                  => 'Изображения:',
            'items-request'           => 'Товар(ы), запрошенные для возврата',
            'items-requested-for-rma' => 'Товар(ы), запрошенные для возврата',
            'order-id'                => 'ID заказа:',
            'refund-details'          => 'Детали возврата',
            'refund-offline-btn'      => 'Возврат оффлайн',
            'refundable-amount'       => 'Сумма для возврата',
            'resolution-type'         => 'Тип разрешения:',
            'rma'                     => 'Возврат товара',
            'save-btn'                => 'Сохранить',
            'send-message-btn'        => 'Отправить',
            'send-message'            => 'Отправить сообщение',
            'status-details'          => 'Детали статуса',
            'status-quotes'           => 'Пожалуйста, согласитесь для отметки как решено',
            'status-reopen'           => 'Проверьте, чтобы снова открыть', 
            'status'                  => 'Статус',
            'term'                    => 'Согласие с полем отметки обязательно',
            'you'                     => 'Администратор',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Дополнительная информация:',
            'admin'                  => 'Администратор',
            'close-rma'              => 'Закрыть возврат товара',
            'conversations'          => 'Беседы',
            'guest'                  => 'Вы',
            'images'                 => 'Изображения',
            'items-request'          => 'Товар(ы), запрошенные для возврата',
            'order-id'               => ' ID заказа:',
            'refund-offline-btn'     => 'Возврат оффлайн',
            'resolution-type'        => 'Тип разрешения:',
            'rma'                    => 'Возврат товара',
            'save-btn'               => 'Сохранить',
            'send-message-btn'       => 'Отправить',
            'send-message'           => 'Отправить сообщение',
            'status-details'         => 'Детали статуса',
            'status-quotes'          => 'Пожалуйста, согласитесь для отметки как решено.',
            'status'                 => 'Статус',
            'term'                   => 'Согласие с полем отметки обязательно',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Полная сумма',
            'order-status' => 'Статус заказа:',
            'request-on'   => 'Запрос на:',
            'rma-status'   => 'Статус возврата товара:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Статус администратора:',
            'close-rma'               => 'Закрыть возврат товара',
            'consignment-no'          => 'Номер отправления:',
            'enter-message'           => 'Введите сообщение',
            'full-amount'             => 'Полная сумма',
            'order-details'           => 'Детали заказа',
            'order-status'            => 'Статус заказа:',
            'partial-amount'          => 'Частичная сумма',
            'refundable-amount'       => 'Сумма для возврата:',
            'request-on'              => 'Запрос на:',
            'rma-status'              => 'Статус возврата товара:',
            'seller'                  => 'Продавец',
            'total-refundable-amount' => 'Общая сумма для возврата:',
        ],

        'table-heading' => [
            'image'           => 'Изображение',
            'order-qty'       => 'Количество заказа',
            'price'           => 'Цена',
            'product-name'    => 'Название продукта',
            'reason'          => 'Причина',
            'resolution-type' => 'Тип решения',
            'rma-qty'         => 'Количество RMA',
            'sku'             => 'Артикул',
        ],

        'guest-users' => [
            'button-text' => 'Войти',
            'email'       => 'E-mail',
            'heading'     => 'Панель входа для гостей',
            'logout'      => 'Выход гостя',
            'order-id'    => 'ID заказа',
            'title'       => 'Вход для гостей',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Дополнительная информация:',
            'greeting'               => 'Вы запросили новый RMA для заказа :order_id.',
            'heading'                => 'Запрос RMA',
            'hello'                  => 'Уважаемый(ая) :name',
            'order-id'               => 'ID Заказа:',
            'order-status'           => 'Статус Заказа:',
            'requested-rma-product'  => 'Запрошенный товар для RMA:',
            'resolution-type'        => 'Тип Решения:',
            'rma-id'                 => 'ID RMA:',
            'summary'                => 'Сводка RMA заказа',
            'thank-you'              => 'Спасибо',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Наименование Товара',
            'qty'          => 'Количество',
            'reason'       => 'Причина',
            'sku'          => 'Артикул (SKU)',
        ],

        'customer-conversation' => [
            'heading' => 'Уважаемый(ая) :name,',
            'message' => 'Сообщение',
            'process' => 'Ваш запрос на возврат находится в обработке.',
            'quotes'  => 'Есть новое сообщение от покупателя',
            'solved'  => 'Статус RMA был изменен на Решено клиентом.',
        ],

        'seller-conversation' => [
            'heading' => 'Уважаемый(ая) :name',
            'message' => 'Сообщение',
            'quotes'  => 'Есть новое сообщение от администратора',
            'title'   => 'Получено сообщение!',
        ],

        'status' => [
            'heading'       => 'Уважаемый(ая) :name',
            'quotes'        => 'Ваш статус RMA был изменен продавцом',
            'rma-id'        => 'ID RMA',
            'status-change' => ':id был изменен продавцом',
            'status'        => 'Статус',
            'title'         => 'Обновление статуса!',
            'your-rma-id'   => 'Ваш ID RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Принять',
            'awaiting'                 => 'В ожидании',
            'canceled'                 => 'Отменено',
            'declined'                 => 'Отклонено',
            'dispatched-package'       => 'Отправлен пакет',
            'item-canceled'            => 'Товар отменен',
            'not-received-package-yet' => 'Пакет еще не получен',
            'pending'                  => 'В ожидании',
            'processing'               => 'В обработке',
            'received-package'         => 'Получен пакет',
            'solved'                   => 'Решено',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA был отклонен администратором.',
            'declined-buyer'  => 'RMA был отклонен покупателем.',
            'solved-by-admin' => 'RMA был решен администратором.',
            'solved'          => 'RMA был решен.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'Статус RMA уже отменен.',
        'cancel-success'    => 'Статус RMA успешно отменен.',
        'create-success'    => 'Запрос успешно создан.',
        'creation-error'    => 'Статус RMA не может быть обновлен, так как счет для этого заказа не был создан.',
        'permission-denied' => 'Вы вошли в систему',
        'rma-disabled'      => 'RMA отключено для этого продукта',
        'send-message'      => ':name успешно отправлен(а).',
        'update-success'    => ':name успешно обновлен(а).',
    ],
];