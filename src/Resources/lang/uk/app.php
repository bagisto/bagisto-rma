<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'День',
                        'all-products'                        => 'Усі продукти',
                        'all-status'                          => 'Усі статуси',
                        'allow-new-request-for-pending-order' => 'Дозволити новий запит на RMA для очікуваного замовлення',
                        'allow-rma-for-digital-product'       => 'Дозволити RMA для цифрового продукту',
                        'allowed-file-extension'              => 'Дозволене розширення файлу',
                        'allowed-file-types'                  => 'Будь ласка, виберіть тільки типи файлів ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'), 
                        'allowed-info'                        => 'Розділено комами. Наприклад: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Дозволити новий запит на RMA для скасованого запиту',
                        'allowed-request-declined-request'    => 'Дозволити новий запит на RMA для відхиленого запиту',
                        'allowed-rma-for-product'             => 'Дозволити RMA для продукту',
                        'cancel-items'                        => 'Скасувати елементи',
                        'complete'                            => 'Завершено',
                        'current-order-quantity'              => 'Поточна кількість замовлень',
                        'days-info'                           => 'Кількість днів, протягом яких клієнт може подати запит на RMA після розміщення замовлення.',
                        'default-allow-days'                  => 'Дні, дозволені за замовчуванням',
                        'enable'                              => 'Увімкнути RMA',
                        'evening'                             => 'Вечір',
                        'exchange'                            => 'Обмін',
                        'info'                                => 'RMA є частиною процесу повернення продукту до компанії для отримання відшкодування, заміни або ремонту.',
                        'morning'                             => 'Ранок',
                        'new-rma-message-to-customer'         => 'Нове повідомлення RMA для клієнта',
                        'no'                                  => 'Ні',
                        'open'                                => 'Відкрити',
                        'package-condition'                   => 'Стан упаковки',
                        'packed'                              => 'Упаковано',
                        'print-page'                          => 'Друкувати сторінку',
                        'product-already-raw'                 => 'Продукт вже перебуває в RMA.',
                        'product-delivery-status'             => 'Статус доставки продукту',
                        'resolution-type'                     => 'Тип вирішення',
                        'return-pickup-address'               => 'Адреса для повернення',
                        'return-pickup-time'                  => 'Час повернення',
                        'return-policy'                       => 'Політика повернення',
                        'return'                              => 'Повернення',
                        'select-allowed-order-status'         => 'Виберіть дозволений статус замовлення',
                        'specific-products'                   => 'Конкретні продукти',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Так',

                        'setting' => [
                            'info'  => 'Функція RMA дозволяє обробляти повернення товарів клієнтами для ремонту, обслуговування або повернення грошей чи заміни.',
                            'read'  => 'Читати політику',
                            'terms' => 'Я прочитав і прийняв політику повернення.',
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
                    'create-rma-title' => 'Створити RMA',
                    'reason-title'     => 'Причина',
                    'rma-title'        => 'Усі RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Усі RMA',

                        'datagrid' => [
                            'create'        => 'Час створення',
                            'customer-name' => 'Ім\'я клієнта',
                            'id'            => 'Номер RMA',
                            'order-ref'     => 'Посилання на замовлення',
                            'order-status'  => 'Статус замовлення',
                            'rma-status'    => 'Статус RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Додати вкладення',
                        'additional-information' => 'Додаткова інформація:',
                        'attachment'             => 'Вкладення',
                        'change-status'          => 'Змінити статус',
                        'confirm-print'          => 'Натисніть OK, щоб надрукувати RMA',
                        'conversations'          => 'Розмови',
                        'customer-details'       => 'Деталі клієнта',
                        'customer-email'         => 'Електронна пошта клієнта:',
                        'customer'               => 'Клієнт:',
                        'enter-message'          => 'Введіть повідомлення',
                        'images'                 => 'Зображення:',
                        'no-record'              => 'Запис не знайдено!',
                        'order-date'             => 'Дата замовлення:',
                        'order-details'          => 'Замовлені товари для RMA',
                        'order-id'               => 'ID замовлення:',
                        'order-status'           => 'Статус замовлення:',
                        'order-total'            => 'Загальна сума замовлення:',
                        'request-on'             => 'Запит від:',
                        'resolution-type'        => 'Тип вирішення:',
                        'rma-status'             => 'Статус RMA:',
                        'save-btn'               => 'Зберегти',
                        'send-message-btn'       => 'Надіслати повідомлення',
                        'send-message-success'   => 'Повідомлення успішно надіслано.',
                        'send-message'           => 'Надіслати повідомлення',
                        'status'                 => 'Статус',
                        'title'                  => 'RMA',
                        'update-success'         => 'Статус RMA успішно оновлено.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Створити статус RMA',
                        'title'      => 'Статус RMA',

                        'datagrid' => [
                            'created-at'          => 'Створено',
                            'delete-success'      => 'Статус RMA успішно видалено.',
                            'disabled'            => 'Неактивний',
                            'enabled'             => 'Активний',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Вибраний статус RMA успішно видалено.',
                            'reason-error'        => 'Статус RMA використовується в RMA.',
                            'reason'              => 'Статус RMA',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Додати новий статус RMA',
                        'reason'       => 'Статус RMA',
                        'save-btn'     => 'Зберегти статус RMA',
                        'status'       => 'Статус',
                        'success'      => 'Статус RMA успішно створено.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редагувати статус RMA',
                        'mass-update-success' => 'Вибраний статус RMA успішно оновлено.',
                        'reason'              => 'Статус RMA',
                        'save-btn'            => 'Зберегти статус RMA',
                        'status'              => 'Статус',
                        'success'             => 'Статус RMA успішно оновлено.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'Створити причину RMA',
                        'title'      => 'Причини',

                        'datagrid' => [
                            'created-at'          => 'Час створення',
                            'delete-success'      => 'Причина успішно видалена.',
                            'disabled'            => 'Неактивний',
                            'enabled'             => 'Активний',
                            'id'                  => 'Номер',
                            'mass-delete-success' => 'Обрані дані успішно видалено',
                            'reason-error'        => 'Причина використовується в RMA.',
                            'reason'              => 'Причина',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Додати нову причину',
                        'reason'       => 'Причина',
                        'save-btn'     => 'Зберегти причину',
                        'status'       => 'Статус',
                        'success'      => 'Причину успішно створено.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редагувати причину',
                        'mass-update-success' => 'Обрані причини успішно оновлено.',
                        'reason'              => 'Причина',
                        'save-btn'            => 'Зберегти причину',
                        'status'              => 'Статус',
                        'success'             => 'Причину успішно оновлено.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Додати нове поле',
                        'title'      => 'Налаштовані поля RMA',

                        'datagrid' => [
                            'created-at'          => 'Створено',
                            'delete-success'      => 'Налаштовані поля успішно видалено.',
                            'disabled'            => 'Неактивний',
                            'enabled'             => 'Активний',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Обрані дані успішно видалено',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Нове налаштоване поле',
                        'save-btn'     => 'Зберегти налаштоване поле',
                        'status'       => 'Статус',
                        'success'      => 'Налаштоване поле успішно створено.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редагувати налаштоване поле',
                        'mass-update-success' => 'Обрані налаштовані поля успішно оновлено.',
                        'reason'              => 'Налаштоване поле',
                        'save-btn'            => 'Зберегти налаштоване поле',
                        'status'              => 'Статус',
                        'success'             => 'Налаштоване поле успішно оновлено.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Створити правила RMA',
                        'title'      => 'Правила RMA',

                        'datagrid' => [
                            'delete-success'      => 'Правила RMA успішно видалено.',
                            'disabled'            => 'Неактивний',
                            'enabled'             => 'Активний',
                            'exchange-period'     => 'Період обміну (дні)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Вибрані дані успішно видалено.',
                            'reason'              => 'Правила',
                            'return-period'       => 'Період повернення (дні)',
                            'status'              => 'Статус',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Додати нові правила RMA',
                        'reason'             => 'Правила RMA',
                        'resolutions-period' => 'Період вирішення',
                        'rule-description'   => 'Опис правил',
                        'rule-details'       => 'Деталі правил',
                        'rules-title'        => 'Заголовок правил',
                        'save-btn'           => 'Зберегти правила RMA',
                        'status'             => 'Статус RMA',
                        'success'            => 'Правила RMA успішно створено.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Редагувати правила RMA',
                        'mass-update-success' => 'Вибрані правила RMA успішно оновлено.',
                        'reason'              => 'Правила RMA',
                        'save-btn'            => 'Оновити правила RMA',
                        'status'              => 'Статус',
                        'success'             => 'Правила RMA успішно оновлено.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA успішно створено.',
                    'create-title'             => 'Створити RMA',
                    'email'                    => 'Електронна пошта',
                    'image'                    => 'Зображення',
                    'invalid-order-id'         => 'Неправильний номер замовлення',
                    'mismatch'                 => 'Номер замовлення та електронна пошта не співпадають',
                    'new-rma'                  => 'Нове RMA',
                    'order-id'                 => 'Номер замовлення',
                    'quantity'                 => 'Кількість',
                    'reason'                   => 'Причина',
                    'rma-already-exist'        => 'RMA вже існує',
                    'rma-not-available-quotes' => 'Товар недоступний для RMA',
                    'save-btn'                 => 'Зберегти',
                    'search'                   => '--Вибрати--',
                    'validate'                 => 'Перевірити',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA успішно створено',
                    'rma-created-message'  => 'Запит RMA доступний для продукту з кількістю :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Видалити',
            'edit'        => 'Редагувати',
            'mass-delete' => 'Масове видалення',
            'mass-update' => 'Масове оновлення',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Доставлено',
            'menu-name'    => 'RMA',
            'offer'        => 'Отримайте до 40% ЗНИЖКИ на ваше перше замовлення',
            'rma-qty'      => 'Кількість RMA',
            'shop-now'     => 'КУПИТИ ЗАРАЗ',
            'submit-req'   => 'Надіслати запит',
            'title'        => 'RMA',
            'undelivered'  => 'Не доставлено',

            'create' => [
                'cancel'                   => 'Скасувати',
                'create-btn'               => 'Зберегти',
                'enter-order-id'           => 'Введіть ID замовлення',
                'heading'                  => 'Новий запит RMA',
                'exchange-window'          => 'Вікно обміну',
                'image'                    => 'Зображення',
                'images'                   => 'Зображення',
                'information'              => 'Додаткова інформація',
                'item-ordered'             => 'Замовлений товар',
                'no-record'                => 'Записів не знайдено!',
                'not-allowed'              => 'RMA не дозволяється для очікуючих замовлень',
                'order-status'             => 'Статус замовлення',
                'orders'                   => 'Замовлення',
                'price'                    => 'Ціна',
                'product-name'             => 'Назва продукту',
                'product'                  => 'Продукт',
                'quantity'                 => 'Кількість',
                'reason'                   => 'Причина',
                'reopen-request'           => 'Повторний запит',
                'resolution'               => 'Вибрати рішення',
                'return-window'            => 'Вікно повернення',
                'rma-not-available-quotes' => 'Товар недоступний для RMA',
                'save'                     => 'Зберегти',
                'search-order'             => 'Пошук замовлення',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Закрити RMA:',
                'order-status' => 'Статус замовлення:',
                'rma-status'   => 'Статус RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Скасувати',
                'create-btn'               => 'Зберегти',
                'enter-order-id'           => 'Введіть ID замовлення',
                'heading'                  => 'Новий запит RMA',
                'image'                    => 'Зображення',
                'images'                   => 'Зображення',
                'information'              => 'Додаткова інформація',
                'item-ordered'             => 'Замовлений товар',
                'not-allowed'              => 'RMA не дозволяється для очікуючих замовлень',
                'order-status'             => 'Статус замовлення',
                'orders'                   => 'Замовлення',
                'price'                    => 'Ціна',
                'product-name'             => 'Назва продукту',
                'product'                  => 'Продукт',
                'quantity'                 => 'Кількість',
                'reason'                   => 'Причина',
                'reopen-request'           => 'Повторний запит',
                'resolution'               => 'Вибрати рішення',
                'rma-not-available-quotes' => 'Товар недоступний для RMA',
                'save'                     => 'Зберегти',
                'search-order'             => 'Пошук замовлення',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Запросити новий RMA',
                'delete'  => 'Видалити',
                'edit'    => 'Редагувати',
                'guest'   => 'Гостьова панель RMA',
                'heading' => 'Панель RMA клієнта',
                'update'  => 'Оновити',
                'view'    => 'Переглянути',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Створити',
            'delete'  => 'Видалити',
            'edit'    => 'Редагувати',
            'guest'   => 'Гостьова панель RMA',
            'heading' => 'RMA',
            'update'  => 'Оновити',
            'view'    => 'Переглянути',
        ],

        'validation' => [
            'close-rma'     => 'Підтвердити',
            'information'   => 'Додаткова інформація',
            'order-id'      => 'Вибір замовлення',
            'order-status'  => 'Статус замовлення',
            'orders'        => 'Замовлення',
            'resolution'    => 'Рішення',
            'select-orders' => 'Вибрати замовлення',
        ],

        'conversation-texts' => [
            'by'        => 'Автор',
            'customer'  => 'Клієнт',
            'no-record' => 'Записів не знайдено!',
            'on'        => 'Дата',
            'seller'    => 'Продавець',
        ],

        'default-option' => [
            'others'              => 'Інші',
            'please-select-value' => 'Будь ласка, виберіть значення',
            'select-order-status' => 'Виберіть статус замовлення',
            'select-order'        => 'Виберіть замовлення',
            'select-quantity'     => 'Виберіть кількість',
            'select-reason'       => 'Виберіть причину',
            'select-resolution'   => 'Виберіть рішення',
            'select-seller'       => 'Виберіть продавця',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Додаткова інформація:',
            'admin'                   => 'Адміністратор',
            'cancel-order'            => 'Скасувати замовлення',
            'change-rma-status'       => 'Змінити статус RMA',
            'close-rma'               => 'Закрити RMA:',
            'conversations'           => 'Розмови',
            'guest'                   => 'Гість',
            'heading'                 => 'Деталі RMA',
            'images'                  => 'Зображення:',
            'items-request'           => 'Товар(и) запрошені для RMA',
            'items-requested-for-rma' => 'Товар(и) запрошені для RMA',
            'order-id'                => 'ID замовлення:',
            'refund-details'          => 'Деталі відшкодування',
            'refund-offline-btn'      => 'Відшкодувати офлайн',
            'refundable-amount'       => 'Сума, що підлягає поверненню',
            'resolution-type'         => 'Тип рішення:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Зберегти',
            'send-message-btn'        => 'Надіслати',
            'send-message'            => 'Надіслати повідомлення',
            'status-details'          => 'Деталі статусу',
            'status-quotes'           => 'Будь ласка, погодьтеся відзначити як вирішене',
            'status-reopen'           => 'Перевірте, щоб відкрити знову',
            'status'                  => 'Статус',
            'term'                    => 'Поле згоди є обов’язковим',
            'you'                     => 'Адміністратор',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Додаткова інформація:',
            'admin'                  => 'Адміністратор',
            'close-rma'              => 'Закрити RMA',
            'conversations'          => 'Розмови',
            'guest'                  => 'Ви',
            'images'                 => 'Зображення',
            'items-request'          => 'Товар(и) запрошені для RMA',
            'order-id'               => 'ID замовлення:',
            'refund-offline-btn'     => 'Відшкодувати офлайн',
            'resolution-type'        => 'Тип рішення:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Зберегти',
            'send-message-btn'       => 'Надіслати',
            'send-message'           => 'Надіслати повідомлення',
            'status-details'         => 'Деталі статусу',
            'status-quotes'          => 'Будь ласка, погодьтеся відзначити як вирішене',
            'status'                 => 'Статус',
            'term'                   => 'Поле згоди є обов’язковим',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Повна сума',
            'order-status' => 'Статус замовлення:',
            'request-on'   => 'Запит від:',
            'rma-status'   => 'Статус RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Статус адміністратора:',
            'close-rma'               => 'Закрити RMA',
            'consignment-no'          => 'Номер відправлення:',
            'enter-message'           => 'Введіть повідомлення',
            'full-amount'             => 'Повна сума',
            'order-details'           => 'Деталі замовлення',
            'order-status'            => 'Статус замовлення:',
            'partial-amount'          => 'Часткова сума',
            'refundable-amount'       => 'Сума, що підлягає поверненню:',
            'request-on'              => 'Запит від:',
            'rma-status'              => 'Статус RMA:',
            'seller'                  => 'Продавець',
            'total-refundable-amount' => 'Загальна сума, що підлягає поверненню:',
        ],

        'table-heading' => [
            'image'           => 'Зображення',
            'order-qty'       => 'Кількість замовлення',
            'price'           => 'Ціна',
            'product-name'    => 'Назва продукту',
            'reason'          => 'Причина',
            'resolution-type' => 'Тип рішення',
            'rma-qty'         => 'Кількість RMA',
            'sku'             => 'Артикул',
        ],

        'guest-users' => [
            'button-text' => 'Увійти',
            'email'       => 'Електронна пошта',
            'heading'     => 'Панель входу для гостей',
            'logout'      => 'Вихід гостя',
            'order-id'    => 'ID замовлення',
            'title'       => 'Вхід для гостей',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Додаткова інформація :',
            'greeting'               => 'Ви подали новий запит на повернення товару (RMA) для замовлення :order_id.',
            'heading'                => 'Запит на повернення товару (RMA)',
            'hello'                  => 'Шановний(а) :name',
            'order-id'               => 'Ідентифікатор замовлення :',
            'order-status'           => 'Статус замовлення :',
            'requested-rma-product'  => 'Товар запиту на повернення (RMA):',
            'resolution-type'        => 'Тип вирішення :',
            'rma-id'                 => 'Ідентифікатор RMA :',
            'summary'                => 'Резюме повернення товару замовлення',
            'thank-you'              => 'Дякуємо',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Назва продукту',
            'qty'          => 'Кількість',
            'reason'       => 'Причина',
            'sku'          => 'Артикул (SKU)',
        ],

        'customer-conversation' => [
            'heading' => 'Шановний(а) :name,',
            'message' => 'Повідомлення',
            'process' => 'Ваш запит на повернення обробляється.',
            'quotes'  => 'Є нове повідомлення від покупця',
            'solved'  => 'Статус RMA було змінено на Вирішено клієнтом.',
        ],

        'seller-conversation' => [
            'heading' => 'Шановний(а) :name',
            'message' => 'Повідомлення',
            'quotes'  => 'Є нове повідомлення від адміністратора',
            'title'   => 'Отримано повідомлення!',
        ],

        'status' => [
            'heading'       => 'Шановний(а) :name',
            'quotes'        => 'Статус вашого запиту на повернення товару (RMA) змінено продавцем',
            'rma-id'        => 'Ідентифікатор RMA',
            'status-change' => 'Статус :id змінено продавцем',
            'status'        => 'Статус',
            'title'         => 'Статус оновлено!',
            'your-rma-id'   => 'Ваш ідентифікатор RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Прийняти',
            'awaiting'                 => 'Очікується',
            'canceled'                 => 'Скасовано',
            'declined'                 => 'Відхилено',
            'dispatched-package'       => 'Відправлено пакет',
            'item-canceled'            => 'Товар скасовано',
            'not-received-package-yet' => 'Пакет ще не отримано',
            'pending'                  => 'В очікуванні',
            'processing'               => 'В обробці',
            'received-package'         => 'Отримано пакет',
            'solved'                   => 'Вирішено',
        ],

        'status-quotes' => [
            'declined-admin'  => 'Запит на повернення товару (RMA) відхилено адміністратором.',
            'declined-buyer'  => 'Запит на повернення товару (RMA) відхилено покупцем.',
            'solved-by-admin' => 'Запит на повернення товару (RMA) вирішено адміністратором.',
            'solved'          => 'Запит на повернення товару (RMA) вирішено.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'Статус RMA вже скасовано.',
        'cancel-success'    => 'Статус RMA було успішно скасовано.',
        'create-success'    => 'Запит успішно створено.',
        'creation-error'    => 'Статус RMA не може бути оновлено, оскільки рахунок для цього замовлення не створено.',
        'permission-denied' => 'Ви увійшли до системи',
        'rma-disabled'      => 'Запити на повернення товару (RMA) для цього продукту заборонені',
        'send-message'      => ':name успішно надіслано.',
        'update-success'    => ':name успішно оновлено.',
    ],
];