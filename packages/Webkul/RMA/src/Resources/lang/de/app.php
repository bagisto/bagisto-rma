<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Neue RMA-Anfrage für ausstehende Bestellung zulassen',
                        'allow-rma-for-digital-product'       => 'RMA für digitale Produkte zulassen',
                        'default-allow-days'                  => 'Standard erlaubte Tage',
                        'enable'                              => 'RMA aktivieren',
                        'info'                                => 'RMA ist Teil des Prozesses zur Rücksendung eines Produkts an ein Unternehmen, um eine Rückerstattung, Ersatz oder Reparatur zu erhalten.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'Die RMA-Funktionalität ermöglicht es, Situationen zu bewältigen, in denen ein Kunde Artikel zur Reparatur und Wartung zurücksendet oder zur Rückerstattung oder zum Ersatz zurücksendet.',
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
                    'rma-title'        => 'Alle RMA',
                    'reason-title'     => 'Gründe',
                    'create-rma-title' => 'RMA erstellen',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Alle RMA',

                        'datagrid' => [
                            'id'        => 'RMA-ID',
                            'order-ref' => 'Bestellreferenz',
                            'status'    => 'Status',
                            'create'    => 'Erstellt am',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' Bestell-ID :',
                        'request-on'             => 'Angefordert am :',
                        'customer'               => 'Kunde :',
                        'resolution-type'        => 'Auflösungstyp :',
                        'additional-information' => 'Zusätzliche Informationen :',
                        'images'                 => 'Bild :',
                        'order-details'          => 'Bestelldetails',
                        'status'                 => 'Status',
                        'rma-status'             => 'RMA-Status :',
                        'order-status'           => 'Bestellstatus :',
                        'change-status'          => 'Status ändern',
                        'conversations'          => 'Gespräche',
                        'save-btn'               => 'Speichern',
                        'send-message'           => 'Nachricht senden',
                        'enter-message'          => 'Nachricht eingeben',
                        'send-message-btn'       => 'Nachricht senden',
                        'send-message-success'   => 'Nachricht erfolgreich gesendet.',
                        'update-success'         => 'RMA-Status erfolgreich aktualisiert.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Gründe',
                        'create-btn' => 'RMA-Grund erstellen',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Grund',
                            'status'              => 'Status',
                            'created-at'          => 'Erstellt am',
                            'enabled'             => 'Aktiviert',
                            'disabled'            => 'Deaktiviert',
                            'delete-success'      => 'Grund erfolgreich gelöscht.',
                            'mass-delete-success' => 'RMA-Massenlöschung erfolgreich.',
                            'reason-error'        => 'Grund wird in RMA verwendet.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Neuen Grund hinzufügen',
                        'save-btn'       => 'Grund speichern',
                        'reason'         => 'Grund',
                        'status'         => 'Status',
                        'create-success' => 'Grund erfolgreich erstellt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Grund bearbeiten',
                        'save-btn'            => 'Grund speichern',
                        'reason'              => 'Grund',
                        'status'              => 'Status',
                        'mass-update-success' => 'Ausgewählte Gründe erfolgreich aktualisiert.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'RMA erstellen',
                    'order-id'          => 'Bestell-ID',
                    'email'             => 'E-Mail',
                    'validate'          => 'Überprüfen',
                    'rma-already-exist' => 'RMA existiert bereits',
                    'mismatch'          => 'Bestell-ID und E-Mail stimmen nicht überein',
                    'invalid-order-id'  => 'Ungültige Bestell-ID',
                    'quantity'          => 'Menge',
                    'reason'            => 'Grund',
                    'save-btn'          => 'Speichern',
                    'create-success'    => 'RMA erfolgreich erstellt.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA-Rückgabe',
            'offer'        => 'Bekommen Sie BIS ZU 40 % RABATT auf Ihre erste Bestellung',
            'shop-now'     => 'JETZT KAUFEN',

            'create' => [
                'heading'                  => 'Neue RMA-Anfrage',
                'create-btn'               => 'Speichern',
                'orders'                   => 'Bestellungen',
                'resolution'               => 'Auflösung wählen',
                'item-ordered'             => 'Bestelltes Produkt',
                'images'                   => 'Bilder',
                'information'              => 'Zusätzliche Informationen',
                'order-status'             => 'Bestellstatus',
                'product'                  => 'Produkt',
                'sku'                      => 'Sku',
                'price'                    => 'Preis',
                'search-order'             => 'Bestellung suchen',
                'enter-order-id'           => 'Bestell-ID eingeben',
                'not-allowed'              => 'RMA ist für ausstehende Bestellungen nicht erlaubt',
                'image'                    => 'Bild',
                'quantity'                 => 'Menge',
                'reason'                   => 'Grund',
                'rma-not-available-quotes' => 'Artikel nicht für RMA verfügbar',
                'product-name'             => 'Produktname',
                'reopen-request'           => 'Anfrage erneut öffnen',
                'save'                     => 'Speichern',
                'cancel'                   => 'Abbrechen',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMA-Status :',
                'order-status' => 'Bestellstatus :',
                'close-rma'    => 'RMA schließen :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Neue RMA-Anfrage',
                'create-btn'               => 'Speichern',
                'orders'                   => 'Bestellungen',
                'resolution'               => 'Auflösung wählen',
                'item-ordered'             => 'Bestelltes Produkt',
                'images'                   => 'Bilder',
                'information'              => 'Zusätzliche Informationen',
                'order-status'             => 'Bestellstatus',
                'product'                  => 'Produkt',
                'sku'                      => 'Sku',
                'price'                    => 'Preis',
                'search-order'             => 'Bestellung suchen',
                'enter-order-id'           => 'Bestell-ID eingeben',
                'not-allowed'              => 'RMA ist für ausstehende Bestellungen nicht erlaubt',
                'image'                    => 'Bild',
                'quantity'                 => 'Menge',
                'reason'                   => 'Grund',
                'rma-not-available-quotes' => 'Artikel nicht für RMA verfügbar',
                'product-name'             => 'Produktname',
                'reopen-request'           => 'Anfrage erneut öffnen',
                'save'                     => 'Speichern',
                'cancel'                   => 'Abbrechen',
                'reopen-request'           => 'Anfrage erneut öffnen',
            ],

            'index' => [
                'create'  => 'Neue RMA anfordern',
                'heading' => 'Kunden-RMA-Panel',
                'view'    => 'Ansehen',
                'edit'    => 'Bearbeiten',
                'delete'  => 'Löschen',
                'update'  => 'Aktualisieren',
                'guest'   => 'Gast-RMA-Panel',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Neue RMA anfordern',
            'heading' => 'Kunden-RMA-Panel',
            'view'    => 'Ansehen',
            'edit'    => 'Bearbeiten',
            'delete'  => 'Löschen',
            'update'  => 'Aktualisieren',
            'guest'   => 'Gast-RMA-Panel',
        ],

        'validation' => [
            'orders'       => 'Bestellungen',
            'resolution'   => 'Auflösung',
            'information'  => 'Zusätzliche Informationen',
            'order-status' => 'Bestellstatus',
            'order-id'     => 'Bestellauswahl',
            'close-rma'    => 'Bestätigen',
        ],

        'conversation-texts' => [
            'by'       => 'Von',
            'seller'   => 'Verkäufer',
            'customer' => 'Kunde',
            'on'       => 'Am',
        ],

        'default-option' => [
            'please-select-value' => 'Bitte Wert auswählen',
            'select-quantity'     => 'Menge auswählen',
            'select-reason'       => 'Grund auswählen',
            'others'              => 'Andere',
            'select-order-status' => 'Bestellstatus auswählen',
            'select-resolution'   => 'Auflösung auswählen',
            'select-seller'       => 'Verkäufer auswählen',
            'select-order'        => 'Bestellung auswählen',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Gast',
            'heading'                 => 'RMA-Details',
            'status'                  => 'Status',
            'order-id'                => ' Bestell-ID :',
            'refund-details'          => 'Rückerstattungsdetails',
            'resolution-type'         => 'Auflösungstyp :',
            'additional-information'  => 'Zusätzliche Informationen :',
            'change-rma-status'       => 'RMA-Status ändern',
            'save-btn'                => 'Speichern',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Senden',
            'items-requested-for-rma' => 'Artikel für RMA angefordert',
            'refund-offline-btn'      => 'Rückerstattung offline',
            'send-message'            => 'Nachricht senden',
            'conversations'           => 'Gespräche',
            'cancel-order'            => 'Bestellung stornieren',
            'status-details'          => 'Statusdetails',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Bitte stimmen Sie zu, um es als gelöst zu markieren.',
            'close-rma'               => 'RMA schließen :',
            'images'                  => 'Bilder',
            'items-request'           => 'Artikel für RMA angefordert',
            'refundable-amount'       => 'Erstattbarer Betrag',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Auflösungstyp :',
            'guest'                  => 'Sie',
            'status'                 => 'Status',
            'order-id'               => ' Bestell-ID :',
            'additional-information' => 'Zusätzliche Informationen :',
            'save-btn'               => 'Speichern',
            'send-message-btn'       => 'Senden',
            'refund-offline-btn'     => 'Rückerstattung offline',
            'send-message'           => 'Nachricht senden',
            'conversations'          => 'Gespräche',
            'status-details'         => 'Statusdetails',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Bitte stimmen Sie zu, um es als gelöst zu markieren.',
            'close-rma'              => 'RMA schließen',
            'images'                 => 'Bilder',
            'items-request'          => 'Artikel für RMA angefordert',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMA-Status :',
            'order-status' => 'Bestellstatus :',
            'full-amount'  => 'Voller Betrag',
            'request-on'   => 'Angefordert am :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'RMA schließen',
            'rma-status'              => 'RMA-Status :',
            'admin-status'            => 'Admin-Status:',
            'order-status'            => 'Bestellstatus :',
            'consignment-no'          => 'Frachtbriefnummer:',
            'refundable-amount'       => 'Erstattbarer Betrag:',
            'full-amount'             => 'Voller Betrag',
            'partial-amount'          => 'Teilbetrag',
            'total-refundable-amount' => 'Gesamterstattbarer Betrag:',
            'enter-message'           => 'Nachricht eingeben',
            'request-on'              => 'Angefordert am :',
            'seller'                  => 'Verkäufer',
            'order-details'           => 'Bestelldetails',
        ],

        'table-heading' => [
            'product-name' => 'Produktname',
            'sku'          => 'SKU',
            'price'        => 'Preis',
            'qty'          => 'Menge',
            'reason'       => 'Grund',
        ],

        'guest-users' => [
            'heading'     => 'Gast-Anmeldepanel',
            'order-id'    => 'Bestell-ID',
            'email'       => 'E-Mail',
            'button-text' => 'Anmelden',
            'title'       => 'Gast-Anmeldung',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA-Anfrage',
            'hello'                  => 'Sehr geehrte/r :name',
            'greeting'               => 'Sie haben eine neue RMA-Anfrage für Bestellung :order_id angefordert.',
            'rma-id'                 => 'RMA-ID :',
            'summary'                => 'Zusammenfassung der RMA der Bestellung',
            'order-id'               => 'Bestell-ID :',
            'order-status'           => 'Bestellstatus :',
            'resolution-type'        => 'Auflösungstyp :',
            'additional-information' => 'Zusätzliche Informationen :',
            'thank-you'              => 'Vielen Dank',
            'requested-rma-product'  => 'Angefordertes Produkt für RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Produktname',
            'sku'          => 'Sku',
            'qty'          => 'Menge',
            'reason'       => 'Grund',
        ],

        'customer-conversation' => [
            'heading' => 'Sehr geehrte/r :name,',
            'quotes'  => 'Es gibt eine neue Nachricht vom Käufer',
            'message' => 'Nachricht',
        ],

        'seller-conversation' => [
            'heading' => 'Sehr geehrte/r :name',
            'quotes'  => 'Es gibt eine neue Nachricht vom Verkäufer',
            'message' => 'Nachricht',
            'title'   => 'Nachricht erhalten!',
        ],

        'status' => [
            'heading'       => 'Sehr geehrte/r :name',
            'quotes'        => 'Ihr RMA-Status wurde vom Verkäufer geändert',
            'rma-id'        => 'RMA-ID',
            'your-rma-id'   => 'Ihre RMA-ID',
            'status-change' => ':id-Status wurde vom Verkäufer geändert',
            'status'        => 'Status',
            'title'         => 'Status aktualisiert!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Ausstehend',
            'processing'               => 'Verarbeitung',
            'item-canceled'            => 'Artikel storniert',
            'solved'                   => 'Gelöst',
            'declined'                 => 'Abgelehnt',
            'received-package'         => 'Paket erhalten',
            'dispatched-package'       => 'Paket versendet',
            'not-received-package-yet' => 'Paket noch nicht erhalten',
            'accept'                   => 'Akzeptieren',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA wurde vom Admin abgelehnt.',
            'declined-buyer'  => 'RMA wurde vom Käufer abgelehnt.',
            'solved'          => 'RMA wurde gelöst.',
            'solved-by-admin' => 'RMA wurde vom Admin gelöst.',
        ],
    ],

    'response' => [
        'create-success' => ':name wurde erfolgreich erstellt.',
        'send-message'   => ':name wurde erfolgreich gesendet.',
        'update-success' => ':name wurde erfolgreich aktualisiert.',
    ],
];
