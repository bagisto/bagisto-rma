<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Zezwalaj na nowe żądanie RMA dla zamówienia oczekującego',
                        'allow-rma-for-digital-product'       => 'Zezwalaj na RMA dla produktów cyfrowych',
                        'default-allow-days'                  => 'Domyślna liczba dni zezwolenia',
                        'enable'                              => 'Włącz RMA',
                        'info'                                => 'RMA jest częścią procesu zwrotu produktu do firmy w celu uzyskania zwrotu pieniędzy, wymiany lub naprawy.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'Funkcjonalność RMA pozwala na radzenie sobie w sytuacjach, gdy klient zwraca przedmioty do naprawy i konserwacji, lub w celu zwrotu pieniędzy lub wymiany.',
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
                    'rma-title'        => 'Wszystkie RMA',
                    'reason-title'     => 'Powody',
                    'create-rma-title' => 'Utwórz RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Wszystkie RMA',

                        'datagrid' => [
                            'id'        => 'ID RMA',
                            'order-ref' => 'Numer zamówienia',
                            'status'    => 'Status',
                            'create'    => 'Utworzone',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID zamówienia :',
                        'request-on'             => 'Wniosek o :',
                        'customer'               => 'Klient :',
                        'resolution-type'        => 'Typ rozwiązania :',
                        'additional-information' => 'Dodatkowe informacje :',
                        'images'                 => 'Obraz :',
                        'order-details'          => 'Szczegóły zamówienia',
                        'status'                 => 'Status',
                        'rma-status'             => 'Status RMA :',
                        'order-status'           => 'Status zamówienia :',
                        'change-status'          => 'Zmień status',
                        'conversations'          => 'Rozmowy',
                        'save-btn'               => 'Zapisz',
                        'send-message'           => 'Wyślij wiadomość',
                        'enter-message'          => 'Wprowadź wiadomość',
                        'send-message-btn'       => 'Wyślij wiadomość',
                        'send-message-success'   => 'Wiadomość wysłana pomyślnie.',
                        'update-success'         => 'Status RMA zaktualizowany pomyślnie.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Powody',
                        'create-btn' => 'Utwórz powód RMA',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Powód',
                            'status'              => 'Status',
                            'created-at'          => 'Utworzony',
                            'enabled'             => 'Włączony',
                            'disabled'            => 'Wyłączony',
                            'delete-success'      => 'Powód usunięty pomyślnie.',
                            'mass-delete-success' => 'Masa RMA usunięta pomyślnie.',
                            'reason-error'        => 'Powód jest używany w RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Dodaj nowy powód',
                        'save-btn'       => 'Zapisz powód',
                        'reason'         => 'Powód',
                        'status'         => 'Status',
                        'create-success' => 'Powód utworzony pomyślnie.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edytuj powód',
                        'save-btn'            => 'Zapisz powód',
                        'reason'              => 'Powód',
                        'status'              => 'Status',
                        'mass-update-success' => 'Wybrane powody zaktualizowane pomyślnie.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Utwórz RMA',
                    'order-id'          => 'ID zamówienia',
                    'email'             => 'E-mail',
                    'validate'          => 'Sprawdź poprawność',
                    'rma-already-exist' => 'RMA już istnieje',
                    'mismatch'          => 'Niepasujące ID zamówienia i e-mail',
                    'invalid-order-id'  => 'Nieprawidłowe ID zamówienia',
                    'quantity'          => 'Ilość',
                    'reason'            => 'Powód',
                    'save-btn'          => 'Zapisz',
                    'create-success'    => 'RMA utworzone pomyślnie.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'Zwrot RMA',
            'offer'        => 'Otrzymaj DO 40% ZNIŻKI przy pierwszym zamówieniu',
            'shop-now'     => 'KUP TERAZ',

            'create' => [
                'heading'                  => 'Nowe żądanie RMA',
                'create-btn'               => 'Zapisz',
                'orders'                   => 'Zamówienia',
                'resolution'               => 'Wybierz rozwiązanie',
                'item-ordered'             => 'Zamówiony przedmiot',
                'images'                   => 'Obrazy',
                'information'              => 'Dodatkowe informacje',
                'order-status'             => 'Status zamówienia',
                'product'                  => 'Produkt',
                'sku'                      => 'SKU',
                'price'                    => 'Cena',
                'search-order'             => 'Szukaj zamówienia',
                'enter-order-id'           => 'Wprowadź ID zamówienia',
                'not-allowed'              => 'RMA nie jest dozwolone dla zamówienia oczekującego',
                'image'                    => 'Obraz',
                'quantity'                 => 'Ilość',
                'reason'                   => 'Powód',
                'rma-not-available-quotes' => 'Przedmiot niedostępny do RMA',
                'product-name'             => 'Nazwa produktu',
                'reopen-request'           => 'Ponownie otwórz żądanie',
                'save'                     => 'Zapisz',
                'cancel'                   => 'Anuluj',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'Status RMA :',
                'order-status' => 'Status zamówienia :',
                'close-rma'    => 'Zamknij RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Nowe żądanie RMA',
                'create-btn'               => 'Zapisz',
                'orders'                   => 'Zamówienia',
                'resolution'               => 'Wybierz rozwiązanie',
                'item-ordered'             => 'Zamówiony przedmiot',
                'images'                   => 'Obrazy',
                'information'              => 'Dodatkowe informacje',
                'order-status'             => 'Status zamówienia',
                'product'                  => 'Produkt',
                'sku'                      => 'SKU',
                'price'                    => 'Cena',
                'search-order'             => 'Szukaj zamówienia',
                'enter-order-id'           => 'Wprowadź ID zamówienia',
                'not-allowed'              => 'RMA nie jest dozwolone dla zamówienia oczekującego',
                'image'                    => 'Obraz',
                'quantity'                 => 'Ilość',
                'reason'                   => 'Powód',
                'rma-not-available-quotes' => 'Przedmiot niedostępny do RMA',
                'product-name'             => 'Nazwa produktu',
                'reopen-request'           => 'Ponownie otwórz żądanie',
                'save'                     => 'Zapisz',
                'cancel'                   => 'Anuluj',
                'reopen-request'           => 'Ponownie otwórz żądanie',
            ],

            'index' => [
                'create'  => 'Wniosek o nowe RMA',
                'heading' => 'Panel RMA klienta',
                'view'    => 'Zobacz',
                'edit'    => 'Edytuj',
                'delete'  => 'Usuń',
                'update'  => 'Aktualizuj',
                'guest'   => 'Panel RMA dla Gości',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Wniosek o nowe RMA',
            'heading' => 'Panel RMA klienta',
            'view'    => 'Zobacz',
            'edit'    => 'Edytuj',
            'delete'  => 'Usuń',
            'update'  => 'Aktualizuj',
            'guest'   => 'Panel RMA dla Gości',
        ],

        'validation' => [
            'orders'       => 'Zamówienia',
            'resolution'   => 'Rozwiązanie',
            'information'  => 'Dodatkowe informacje',
            'order-status' => 'Status zamówienia',
            'order-id'     => 'Wybór zamówienia',
            'close-rma'    => 'Potwierdź',
        ],

        'conversation-texts' => [
            'by'       => 'Przez',
            'seller'   => 'Sprzedawca',
            'customer' => 'Klient',
            'on'       => 'Na',
        ],

        'default-option' => [
            'please-select-value' => 'Wybierz wartość',
            'select-quantity'     => 'Wybierz ilość',
            'select-reason'       => 'Wybierz powód',
            'others'              => 'Inne',
            'select-order-status' => 'Wybierz status zamówienia',
            'select-resolution'   => 'Wybierz rozwiązanie',
            'select-seller'       => 'Wybierz sprzedawcę',
            'select-order'        => 'Wybierz zamówienie',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Gość',
            'heading'                 => 'Szczegóły RMA',
            'status'                  => 'Status',
            'order-id'                => ' ID zamówienia :',
            'refund-details'          => 'Szczegóły zwrotu',
            'resolution-type'         => 'Typ rozwiązania :',
            'additional-information'  => 'Dodatkowe informacje :',
            'change-rma-status'       => 'Zmień status RMA',
            'save-btn'                => 'Zapisz',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Wyślij',
            'items-requested-for-rma' => 'Przedmiot(y) żądane do RMA',
            'refund-offline-btn'      => 'Zwrot offline',
            'send-message'            => 'Wyślij wiadomość',
            'conversations'           => 'Rozmowy',
            'cancel-order'            => 'Anuluj zamówienie',
            'status-details'          => 'Szczegóły statusu',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Proszę zgodzić się, aby oznaczyć to jako rozwiązane.',
            'close-rma'               => 'Zamknij RMA :',
            'images'                  => 'Obrazy',
            'items-request'           => 'Przedmiot(y) żądane do RMA',
            'refundable-amount'       => 'Kwota do zwrotu',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Typ rozwiązania :',
            'guest'                  => 'Ty',
            'status'                 => 'Status',
            'order-id'               => ' ID zamówienia :',
            'additional-information' => 'Dodatkowe informacje :',
            'save-btn'               => 'Zapisz',
            'send-message-btn'       => 'Wyślij',
            'refund-offline-btn'     => 'Zwrot offline',
            'send-message'           => 'Wyślij wiadomość',
            'conversations'          => 'Rozmowy',
            'status-details'         => 'Szczegóły statusu',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Proszę zgodzić się, aby oznaczyć to jako rozwiązane.',
            'close-rma'              => 'Zamknij RMA',
            'images'                 => 'Obrazy',
            'items-request'          => 'Przedmiot(y) żądane do RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Status RMA :',
            'order-status' => 'Status zamówienia :',
            'full-amount'  => 'Pełna kwota',
            'request-on'   => 'Wniosek o :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Zamknij RMA',
            'rma-status'              => 'Status RMA :',
            'admin-status'            => 'Status admina:',
            'order-status'            => 'Status zamówienia :',
            'consignment-no'          => 'Numer przesyłki:',
            'refundable-amount'       => 'Kwota do zwrotu:',
            'full-amount'             => 'Pełna kwota',
            'partial-amount'          => 'Częściowa kwota',
            'total-refundable-amount' => 'Całkowita kwota do zwrotu:',
            'enter-message'           => 'Wprowadź wiadomość',
            'request-on'              => 'Wniosek o :',
            'seller'                  => 'Sprzedawca',
            'order-details'           => 'Szczegóły zamówienia',
        ],

        'table-heading' => [
            'product-name' => 'Nazwa produktu',
            'sku'          => 'SKU',
            'price'        => 'Cena',
            'qty'          => 'Ilość',
            'reason'       => 'Powód',
        ],

        'guest-users' => [
            'heading'     => 'Panel logowania gościa',
            'order-id'    => 'ID zamówienia',
            'email'       => 'E-mail',
            'button-text' => 'Zaloguj się',
            'title'       => 'Logowanie gościa',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Żądanie RMA',
            'hello'                  => 'Szanowny(a) :name',
            'greeting'               => 'Złożyłeś(aś) nowe żądanie RMA dla zamówienia :order_id.',
            'rma-id'                 => 'ID RMA :',
            'summary'                => 'Podsumowanie RMA zamówienia',
            'order-id'               => 'ID zamówienia :',
            'order-status'           => 'Status zamówienia :',
            'resolution-type'        => 'Typ rozwiązania :',
            'additional-information' => 'Dodatkowe informacje :',
            'thank-you'              => 'Dziękujemy',
            'requested-rma-product'  => 'Produkt(y) żądane do RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nazwa produktu',
            'sku'          => 'Sku',
            'qty'          => 'Ilość',
            'reason'       => 'Powód',
        ],

        'customer-conversation' => [
            'heading' => 'Szanowny(a) :name,',
            'quotes'  => 'Nowa wiadomość od kupującego',
            'message' => 'Wiadomość',
        ],

        'seller-conversation' => [
            'heading' => 'Szanowny(a) :name',
            'quotes'  => 'Nowa wiadomość od sprzedawcy',
            'message' => 'Wiadomość',
            'title'   => 'Otrzymano wiadomość!',
        ],

        'status' => [
            'heading'       => 'Szanowny(a) :name',
            'quotes'        => 'Twój status RMA został zmieniony przez sprzedawcę',
            'rma-id'        => 'ID RMA',
            'your-rma-id'   => 'Twoje ID RMA',
            'status-change' => ':id status został zmieniony przez sprzedawcę',
            'status'        => 'Status',
            'title'         => 'Status zaktualizowany!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Oczekujący',
            'processing'               => 'Przetwarzanie',
            'item-canceled'            => 'Przedmiot anulowany',
            'solved'                   => 'Rozwiązany',
            'declined'                 => 'Odrzucony',
            'received-package'         => 'Odebrano paczkę',
            'dispatched-package'       => 'Wysłano paczkę',
            'not-received-package-yet' => 'Nie odebrano jeszcze paczki',
            'accept'                   => 'Zaakceptuj',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA zostało odrzucone przez administratora.',
            'declined-buyer'  => 'RMA zostało odrzucone przez kupującego.',
            'solved'          => 'RMA zostało rozwiązane.',
            'solved-by-admin' => 'RMA zostało rozwiązane przez administratora.',
        ],
    ],

    'response' => [
        'create-success'    => ':name został(a) pomyślnie utworzony(a).',
        'send-message'      => ':name zostało(a) pomyślnie wysłane.',
        'update-success'    => ':name został(a) pomyślnie zaktualizowany(a).',
        'permission-denied' => 'Jesteś zalogowany(a)',
    ],
];
