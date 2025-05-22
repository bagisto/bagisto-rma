<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Popołudnie',
                        'all-products'                        => 'Wszystkie produkty',
                        'all-status'                          => 'Wszystkie statusy',
                        'allow-new-request-for-pending-order' => 'Zezwól na nowe żądanie RMA dla oczekującego zamówienia',
                        'allow-rma-for-digital-product'       => 'Zezwól na RMA dla produktu cyfrowego',
                        'allowed-file-extension'              => 'Dozwolone rozszerzenie pliku',
                        'allowed-file-types'                  => 'Proszę wybrać tylko typy plików ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'Oddzielone przecinkami. Na przykład: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Zezwól na nowe żądanie RMA dla anulowanego żądania',
                        'allowed-request-declined-request'    => 'Zezwól na nowe żądanie RMA dla odrzuconego żądania',
                        'allowed-rma-for-product'             => 'Zezwól na RMA dla produktu',
                        'cancel-items'                        => 'Anuluj przedmioty',
                        'complete'                            => 'Zakończone',
                        'current-order-quantity'              => 'Obecna ilość zamówienia',
                        'days-info'                           => 'Liczba dni, w których klient może zażądać RMA po złożeniu zamówienia.',
                        'default-allow-days'                  => 'Domyślne dni dozwolone',
                        'enable'                              => 'Włącz RMA',
                        'evening'                             => 'Wieczór',
                        'exchange'                            => 'Wymiana',
                        'info'                                => 'RMA to część procesu zwracania produktu do firmy w celu uzyskania zwrotu pieniędzy, wymiany lub naprawy.',
                        'morning'                             => 'Poranek',
                        'new-rma-message-to-customer'         => 'Nowa wiadomość RMA do klienta',
                        'no'                                  => 'Nie',
                        'open'                                => 'Otwórz',
                        'package-condition'                   => 'Stan opakowania',
                        'packed'                              => 'Zapakowane',
                        'print-page'                          => 'Drukuj stronę',
                        'product-already-raw'                 => 'Produkt jest już w RMA.',
                        'product-delivery-status'             => 'Status dostawy produktu',
                        'resolution-type'                     => 'Rodzaj rozwiązania',
                        'return-pickup-address'               => 'Adres odbioru zwrotu',
                        'return-pickup-time'                  => 'Czas odbioru zwrotu',
                        'return-policy'                       => 'Polityka zwrotów',
                        'return'                              => 'Zwrot',
                        'select-allowed-order-status'         => 'Wybierz dozwolony status zamówienia',
                        'specific-products'                   => 'Określone produkty',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Tak',

                        'setting' => [
                            'info'  => 'Funkcjonalność RMA pozwala na zarządzanie sytuacjami, gdy klient zwraca przedmioty do naprawy i konserwacji, lub w celu zwrotu pieniędzy lub wymiany.',
                            'read'  => 'Przeczytaj politykę',
                            'terms' => 'Przeczytałem i zaakceptowałem politykę zwrotów.',
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
                            'id'            => 'ID RMA',
                            'order-ref'     => 'Referencja zamówienia',
                            'customer-name' => 'Nazwa klienta',
                            'rma-status'    => 'Status RMA',
                            'order-status'  => 'Status zamówienia',
                            'create'        => 'Utworzono',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Dodaj załączniki',
                        'additional-information' => 'Dodatkowe informacje:',
                        'attachment'             => 'Załącznik',
                        'change-status'          => 'Zmień status',
                        'confirm-print'          => 'Kliknij OK, aby wydrukować RMA',
                        'conversations'          => 'Rozmowy',
                        'customer-details'       => 'Dane klienta',
                        'customer-email'         => 'Email klienta:',
                        'customer'               => 'Klient:',
                        'enter-message'          => 'Wprowadź wiadomość',
                        'images'                 => 'Obraz:',
                        'no-record'              => 'Brak rekordów!',
                        'order-date'             => 'Data zamówienia:',
                        'order-details'          => 'Zamówione przedmioty dla RMA',
                        'order-id'               => 'ID zamówienia:',
                        'order-status'           => 'Status zamówienia:',
                        'order-total'            => 'Suma zamówienia:',
                        'request-on'             => 'Złożono wniosek w dniu:',
                        'resolution-type'        => 'Typ rozwiązania:',
                        'rma-status'             => 'Status RMA:',
                        'save-btn'               => 'Zapisz',
                        'send-message-btn'       => 'Wyślij wiadomość',
                        'send-message-success'   => 'Wiadomość została wysłana pomyślnie.',
                        'send-message'           => 'Wyślij wiadomość',
                        'status'                 => 'Status',
                        'title'                  => 'RMA',
                        'update-success'         => 'Status RMA został pomyślnie zaktualizowany.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Utwórz status RMA',
                        'title'      => 'Status RMA',

                        'datagrid' => [
                            'created-at'          => 'Utworzono dnia',
                            'delete-success'      => 'Status RMA został pomyślnie usunięty.',
                            'disabled'            => 'Nieaktywny',
                            'enabled'             => 'Aktywny',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Wybrany status RMA został pomyślnie usunięty.',
                            'reason-error'        => 'Status RMA jest używany w RMA.',
                            'reason'              => 'Status RMA',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Dodaj nowy status RMA',
                        'reason'       => 'Status RMA',
                        'save-btn'     => 'Zapisz status RMA',
                        'status'       => 'Status',
                        'success'      => 'Status RMA został pomyślnie utworzony.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edytuj status RMA',
                        'mass-update-success' => 'Wybrany status RMA został pomyślnie zaktualizowany.',
                        'reason'              => 'Status RMA',
                        'save-btn'            => 'Zapisz status RMA',
                        'status'              => 'Status',
                        'success'             => 'Status RMA został pomyślnie zaktualizowany.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Powody',
                        'create-btn' => 'Utwórz powód RMA',

                        'datagrid' => [
                            'created-at'          => 'Utworzono',
                            'delete-success'      => 'Powód usunięty pomyślnie.',
                            'disabled'            => 'Nieaktywny',
                            'enabled'             => 'Aktywny',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Wybrane dane zostały pomyślnie usunięte.',
                            'reason-error'        => 'Powód jest używany w RMA.',
                            'reason'              => 'Powód',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Dodaj nowy powód',
                        'reason'       => 'Powód',
                        'save-btn'     => 'Zapisz powód',
                        'status'       => 'Status',
                        'success'      => 'Powód został pomyślnie utworzony.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edytuj powód',
                        'mass-update-success' => 'Wybrane powody zostały pomyślnie zaktualizowane.',
                        'reason'              => 'Powód',
                        'save-btn'            => 'Zapisz powód',
                        'status'              => 'Status',
                        'success'             => 'Powód został pomyślnie zaktualizowany.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Dodaj nowe pole',
                        'title'      => 'Pola niestandardowe RMA',

                        'datagrid' => [
                            'created-at'          => 'Utworzono',
                            'delete-success'      => 'Pola niestandardowe zostały pomyślnie usunięte.',
                            'disabled'            => 'Nieaktywne',
                            'enabled'             => 'Aktywne',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Wybrane dane zostały pomyślnie usunięte',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nowe Pole Niestandardowe',
                        'save-btn'     => 'Zapisz Pole Niestandardowe',
                        'status'       => 'Status',
                        'success'      => 'Pole niestandardowe zostało pomyślnie utworzone.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edytuj Pole Niestandardowe',
                        'mass-update-success' => 'Wybrane pola niestandardowe zostały pomyślnie zaktualizowane.',
                        'reason'              => 'Pole Niestandardowe',
                        'save-btn'            => 'Zapisz Pole Niestandardowe',
                        'status'              => 'Status',
                        'success'             => 'Pole niestandardowe zostało pomyślnie zaktualizowane.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Utwórz Zasady RMA',
                        'title'      => 'Zasady RMA',

                        'datagrid' => [
                            'delete-success'      => 'Zasady RMA zostały pomyślnie usunięte.',
                            'disabled'            => 'Nieaktywne',
                            'enabled'             => 'Aktywne',
                            'exchange-period'     => 'Okres Wymiany (dni)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Wybrane dane zostały pomyślnie usunięte.',
                            'reason'              => 'Zasady',
                            'return-period'       => 'Okres Zwrotu (dni)',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Dodaj Nowe Zasady RMA',
                        'reason'             => 'Zasady RMA',
                        'resolutions-period' => 'Okres Rozwiązań',
                        'rule-description'   => 'Opis Zasad',
                        'rule-details'       => 'Szczegóły Zasad',
                        'rules-title'        => 'Tytuł Zasad',
                        'save-btn'           => 'Zapisz Zasady RMA',
                        'status'             => 'Status RMA',
                        'success'            => 'Zasady RMA zostały pomyślnie utworzone.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Edytuj Zasady RMA',
                        'mass-update-success' => 'Wybrane zasady RMA zostały pomyślnie zaktualizowane.',
                        'reason'              => 'Zasady RMA',
                        'save-btn'            => 'Zaktualizuj Zasady RMA',
                        'status'              => 'Status',
                        'success'             => 'Zasady RMA zostały pomyślnie zaktualizowane.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA zostało pomyślnie utworzone.',
                    'create-title'             => 'Utwórz RMA',
                    'email'                    => 'E-mail',
                    'image'                    => 'Zdjęcie',
                    'invalid-order-id'         => 'Nieprawidłowe ID zamówienia',
                    'mismatch'                 => 'Nieprawidłowe ID zamówienia lub e-mail',
                    'new-rma'                  => 'Nowe RMA',
                    'order-id'                 => 'ID zamówienia',
                    'quantity'                 => 'Ilość',
                    'reason'                   => 'Powód',
                    'rma-already-exist'        => 'RMA już istnieje',
                    'rma-not-available-quotes' => 'Przedmiot niedostępny do RMA',
                    'save-btn'                 => 'Zapisz',
                    'search'                   => '--Wybierz--',
                    'validate'                 => 'Walidacja',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA zostało pomyślnie utworzone',
                    'rma-created-message'  => 'Wniosek RMA jest dostępny dla produktu o ilości :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Usuń',
            'edit'        => 'Edytuj',
            'mass-delete' => 'Masowe usuwanie',
            'mass-update' => 'Masowa aktualizacja',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Dostarczono',
            'menu-name'    => 'RMA',
            'offer'        => 'Otrzymaj DO 40% RABATU przy pierwszym zamówieniu',
            'rma-qty'      => 'Ilość RMA',
            'shop-now'     => 'KUP TERAZ',
            'submit-req'   => 'Złóż wniosek',
            'title'        => 'RMA',
            'undelivered'  => 'Niedostarczono',

            'create' => [
                'cancel'                   => 'Anuluj',
                'create-btn'               => 'Zapisz',
                'enter-order-id'           => 'Wprowadź identyfikator zamówienia',
                'heading'                  => 'Nowe żądanie RMA',
                'exchange-window'          => 'Okno wymiany',
                'image'                    => 'Zdjęcie',
                'images'                   => 'Zdjęcia',
                'information'              => 'Dodatkowe informacje',
                'item-ordered'             => 'Zamówiony przedmiot',
                'no-record'                => 'Brak rekordów!',
                'not-allowed'              => 'RMA nie jest dozwolone dla zamówień oczekujących',
                'order-status'             => 'Status zamówienia',
                'orders'                   => 'Zamówienia',
                'price'                    => 'Cena',
                'product-name'             => 'Nazwa produktu',
                'product'                  => 'Produkt',
                'quantity'                 => 'Ilość',
                'reason'                   => 'Powód',
                'reopen-request'           => 'Ponownie otwórz żądanie',
                'resolution'               => 'Wybierz rozwiązanie',
                'return-window'            => 'Okno Zwrotu',
                'rma-not-available-quotes' => 'Produkt niedostępny do RMA',
                'save'                     => 'Zapisz',
                'search-order'             => 'Wyszukaj zamówienie',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Zamknij RMA:',
                'order-status' => 'Status zamówienia:',
                'rma-status'   => 'Status RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Anuluj',
                'create-btn'               => 'Zapisz',
                'enter-order-id'           => 'Wprowadź identyfikator zamówienia',
                'heading'                  => 'Nowe żądanie RMA',
                'image'                    => 'Zdjęcie',
                'images'                   => 'Zdjęcia',
                'information'              => 'Dodatkowe informacje',
                'item-ordered'             => 'Zamówiony przedmiot',
                'not-allowed'              => 'RMA nie jest dozwolone dla zamówień oczekujących',
                'order-status'             => 'Status zamówienia',
                'orders'                   => 'Zamówienia',
                'price'                    => 'Cena',
                'product-name'             => 'Nazwa produktu',
                'product'                  => 'Produkt',
                'quantity'                 => 'Ilość',
                'reason'                   => 'Powód',
                'reopen-request'           => 'Ponownie otwórz żądanie',
                'resolution'               => 'Wybierz rozwiązanie',
                'rma-not-available-quotes' => 'Produkt niedostępny do RMA',
                'save'                     => 'Zapisz',
                'search-order'             => 'Wyszukaj zamówienie',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Złóż nowe żądanie RMA',
                'delete'  => 'Usuń',
                'edit'    => 'Edytuj',
                'guest'   => 'Panel RMA dla gości',
                'heading' => 'Panel RMA dla gości',
                'update'  => 'Aktualizuj',
                'view'    => 'Wyświetl',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Utwórz',
            'delete'  => 'Usuń',
            'edit'    => 'Edytuj',
            'guest'   => 'Panel RMA dla gości',
            'heading' => 'RMA',
            'update'  => 'Aktualizuj',
            'view'    => 'Wyświetl',
        ],

        'validation' => [
            'close-rma'     => 'Potwierdź',
            'information'   => 'Dodatkowe informacje',
            'order-id'      => 'Wybór zamówienia',
            'order-status'  => 'Status zamówienia',
            'orders'        => 'Zamówienia',
            'resolution'    => 'Rozwiązanie',
            'select-orders' => 'Wybierz zamówienie',
        ],

        'conversation-texts' => [
            'by'        => 'Przez',
            'customer'  => 'Klient',
            'no-record' => 'Brak rekordów!',
            'on'        => 'Na',
            'seller'    => 'Sprzedawca',
        ],

        'default-option' => [
            'others'              => 'Inne',
            'please-select-value' => 'Wybierz wartość',
            'select-order-status' => 'Wybierz status zamówienia',
            'select-order'        => 'Wybierz zamówienie',
            'select-quantity'     => 'Wybierz ilość',
            'select-reason'       => 'Wybierz powód',
            'select-resolution'   => 'Wybierz rozwiązanie',
            'select-seller'       => 'Wybierz sprzedawcę',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Dodatkowe informacje:',
            'admin'                   => 'Administrator',
            'cancel-order'            => 'Anuluj zamówienie',
            'change-rma-status'       => 'Zmień status RMA',
            'close-rma'               => 'Zamknij RMA:',
            'conversations'           => 'Rozmowy',
            'guest'                   => 'Gość',
            'heading'                 => 'Szczegóły RMA',
            'images'                  => 'Zdjęcia:',
            'items-request'           => 'Przedmiot(y) żądane do RMA',
            'items-requested-for-rma' => 'Przedmiot(y) żądane do RMA',
            'order-id'                => 'ID zamówienia:',
            'refund-details'          => 'Szczegóły zwrotu',
            'refund-offline-btn'      => 'Zwrot offline',
            'refundable-amount'       => 'Kwota do zwrotu',
            'resolution-type'         => 'Typ rozwiązania:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Zapisz',
            'send-message-btn'        => 'Wyślij',
            'send-message'            => 'Wyślij wiadomość',
            'status-details'          => 'Szczegóły statusu',
            'status-quotes'           => 'Proszę zgodzić się, aby oznaczyć jako rozwiązane',
            'status-reopen'           => 'Zaznacz, aby ponownie otworzyć',
            'status'                  => 'Status',
            'term'                    => 'Zgoda na oznaczenie pola jest wymagana',
            'you'                     => 'Administrator',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Dodatkowe informacje:',
            'admin'                  => 'Administrator',
            'close-rma'              => 'Zamknij RMA',
            'conversations'          => 'Rozmowy',
            'guest'                  => 'Ty',
            'images'                 => 'Zdjęcia',
            'items-request'          => 'Przedmiot(y) żądane do RMA',
            'order-id'               => ' ID zamówienia:',
            'refund-offline-btn'     => 'Zwrot offline',
            'resolution-type'        => 'Typ rozwiązania:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Zapisz',
            'send-message-btn'       => 'Wyślij',
            'send-message'           => 'Wyślij wiadomość',
            'status-details'         => 'Szczegóły statusu',
            'status-quotes'          => 'Proszę zgodzić się, aby oznaczyć jako rozwiązane.',
            'status'                 => 'Status',
            'term'                   => 'Zgoda na oznaczenie pola jest wymagana',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Pełna kwota',
            'order-status' => 'Status zamówienia:',
            'request-on'   => 'Zażądano dnia:',
            'rma-status'   => 'Status RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Status administratora:',
            'close-rma'               => 'Zamknij RMA',
            'consignment-no'          => 'Numer przesyłki:',
            'enter-message'           => 'Wprowadź wiadomość',
            'full-amount'             => 'Pełna kwota',
            'order-details'           => 'Szczegóły zamówienia',
            'order-status'            => 'Status zamówienia:',
            'partial-amount'          => 'Częściowa kwota',
            'refundable-amount'       => 'Kwota do zwrotu:',
            'request-on'              => 'Zażądano dnia:',
            'rma-status'              => 'Status RMA:',
            'seller'                  => 'Sprzedawca',
            'total-refundable-amount' => 'Całkowita kwota do zwrotu:',
        ],

        'table-heading' => [
            'image'           => 'Obraz',
            'order-qty'       => 'Ilość zamówienia',
            'price'           => 'Cena',
            'product-name'    => 'Nazwa produktu',
            'reason'          => 'Powód',
            'resolution-type' => 'Typ rozwiązania',
            'rma-qty'         => 'Ilość RMA',
            'sku'             => 'SKU',
        ],

        'guest-users' => [
            'button-text' => 'Zaloguj się',
            'email'       => 'E-mail',
            'heading'     => 'Panel logowania gości',
            'logout'      => 'Wylogowanie gościa',
            'order-id'    => 'ID zamówienia',
            'title'       => 'Logowanie gości',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Dodatkowe Informacje:',
            'greeting'               => 'Złożyłeś nowe żądanie RMA dla zamówienia :order_id.',
            'heading'                => 'Zażądanie RMA',
            'hello'                  => 'Szanowna :name',
            'order-id'               => 'ID Zamówienia:',
            'order-status'           => 'Status Zamówienia:',
            'requested-rma-product'  => 'Żądany Produkt RMA:',
            'resolution-type'        => 'Typ Rozwiązania:',
            'rma-id'                 => 'ID RMA:',
            'summary'                => 'Podsumowanie RMA zamówienia',
            'thank-you'              => 'Dziękujemy',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nazwa Produktu',
            'qty'          => 'Ilość',
            'reason'       => 'Powód',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'Szanowna :name,',
            'message' => 'Wiadomość',
            'process' => 'Twoje żądanie zwrotu jest w trakcie realizacji.',
            'quotes'  => 'Masz nową wiadomość od Kupującego',
            'solved'  => 'Status RMA został zmieniony na Rozwiązany przez klienta.',
        ],

        'seller-conversation' => [
            'heading' => 'Szanowna :name',
            'message' => 'Wiadomość',
            'quotes'  => 'Jest nowa wiadomość od administratora',
            'title'   => 'Otrzymano wiadomość!',
        ],

        'status' => [
            'heading'       => 'Szanowna :name',
            'quotes'        => 'Twój status RMA został zmieniony przez Sprzedającego',
            'rma-id'        => 'ID RMA',
            'status-change' => 'Status :id został zmieniony przez Sprzedającego',
            'status'        => 'Status',
            'title'         => 'Aktualizacja Statusu!',
            'your-rma-id'   => 'Twoje ID RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Akceptuj',
            'awaiting'                 => 'Oczekujące',
            'canceled'                 => 'Anulowano',
            'declined'                 => 'Odrzucony',
            'dispatched-package'       => 'Wysłane paczka',
            'item-canceled'            => 'Anulowany przedmiot',
            'not-received-package-yet' => 'Jeszcze nie otrzymane paczki',
            'pending'                  => 'Oczekujący',
            'processing'               => 'Przetwarzanie',
            'received-package'         => 'Otrzymane paczka',
            'solved'                   => 'Rozwiązany',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA zostało odrzucone przez Administratora.',
            'declined-buyer'  => 'RMA zostało odrzucone przez Kupującego.',
            'solved-by-admin' => 'RMA zostało rozwiązane przez Administratora.',
            'solved'          => 'RMA zostało rozwiązane.',
            
        ],
    ],

    'response' => [
        'already-cancel'    => 'Status RMA został już anulowany.',
        'cancel-success'    => 'Status RMA został pomyślnie anulowany.',
        'create-success'    => 'Żądanie zostało pomyślnie utworzone.',
        'creation-error'    => 'Status RMA nie może zostać zaktualizowany, ponieważ faktura za to zamówienie nie została wystawiona.',
        'permission-denied' => 'Jesteś zalogowany',
        'rma-disabled'      => 'RMA jest wyłączone dla tego produktu',
        'send-message'      => ':name zostało pomyślnie wysłane.',
        'update-success'    => ':name zostało pomyślnie zaktualizowane.',
        'please-select-the-item' => 'Proszę wybrać przedmiot',
    ],
];