<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Toestaan van nieuwe RMA-aanvraag voor in behandeling zijnde bestelling',
                        'allow-rma-for-digital-product'       => 'RMA toestaan voor digitaal product',
                        'default-allow-days'                  => 'Standaard toegestane dagen',
                        'enable'                              => 'RMA inschakelen',
                        'info'                                => 'RMA is een proces waarbij producten worden geretourneerd voor terugbetaling, ruiling of reparatie.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'De RMA-functionaliteit verwerkt situaties waarin klanten producten retourneren voor reparatie, onderhoud, terugbetaling of ruiling.',
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
                    'rma-title'        => 'Alle RMA\'s',
                    'reason-title'     => 'Reden',
                    'create-rma-title' => 'RMA aanmaken',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Alle RMA\'s',

                        'datagrid' => [
                            'id'        => 'RMA ID',
                            'order-ref' => 'Bestellingsreferentie',
                            'status'    => 'Status',
                            'create'    => 'Aanmaakdatum',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' Bestellings-ID:',
                        'request-on'             => 'Aangevraagd op:',
                        'customer'               => 'Klant:',
                        'resolution-type'        => 'Oplossingstype:',
                        'additional-information' => 'Aanvullende informatie:',
                        'images'                 => 'Afbeeldingen:',
                        'order-details'          => 'Bestellingsdetails',
                        'status'                 => 'Status',
                        'rma-status'             => 'RMA-status:',
                        'order-status'           => 'Bestelstatus:',
                        'change-status'          => 'Status wijzigen',
                        'conversations'          => 'Gesprekken',
                        'save-btn'               => 'Opslaan',
                        'send-message'           => 'Bericht versturen',
                        'enter-message'          => 'Voer een bericht in',
                        'send-message-btn'       => 'Bericht versturen',
                        'send-message-success'   => 'Bericht succesvol verzonden.',
                        'update-success'         => 'RMA-status succesvol bijgewerkt.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Redenen',
                        'create-btn' => 'Reden voor RMA aanmaken',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Reden',
                            'status'              => 'Status',
                            'created-at'          => 'Aanmaakdatum',
                            'enabled'             => 'Ingeschakeld',
                            'disabled'            => 'Uitgeschakeld',
                            'delete-success'      => 'Reden succesvol verwijderd.',
                            'mass-delete-success' => 'RMA succesvol verwijderd.',
                            'reason-error'        => 'Reden wordt gebruikt in RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Nieuwe reden toevoegen',
                        'save-btn'       => 'Opslaan',
                        'reason'         => 'Reden',
                        'status'         => 'Status',
                        'create-success' => 'Reden succesvol aangemaakt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Reden bewerken',
                        'save-btn'            => 'Opslaan',
                        'reason'              => 'Reden',
                        'status'              => 'Status',
                        'mass-update-success' => 'Geselecteerde redenen succesvol bijgewerkt.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'RMA aanmaken',
                    'order-id'          => 'Bestellings-ID',
                    'email'             => 'E-mail',
                    'validate'          => 'Valideren',
                    'rma-already-exist' => 'RMA bestaat al',
                    'mismatch'          => 'Bestellings-ID komt niet overeen met e-mail',
                    'invalid-order-id'  => 'Ongeldige bestellings-ID',
                    'quantity'          => 'Hoeveelheid',
                    'reason'            => 'Reden',
                    'save-btn'          => 'Opslaan',
                    'create-success'    => 'RMA succesvol aangemaakt.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA Retouren',
            'offer'        => 'Krijg tot 40% korting op je eerste bestelling',
            'shop-now'     => 'Nu winkelen',

            'create' => [
                'heading'                  => 'Nieuw RMA-verzoek',
                'create-btn'               => 'Opslaan',
                'orders'                   => 'Bestellingen',
                'resolution'               => 'Oplossing selecteren',
                'item-ordered'             => 'Besteld item',
                'images'                   => 'Afbeeldingen',
                'information'              => 'Aanvullende informatie',
                'order-status'             => 'Bestelstatus',
                'product'                  => 'Product',
                'sku'                      => 'SKU',
                'price'                    => 'Prijs',
                'search-order'             => 'Zoek bestelling',
                'enter-order-id'           => 'Voer bestellings-ID in',
                'not-allowed'              => 'RMA niet toegestaan voor in behandeling zijnde bestellingen',
                'image'                    => 'Afbeelding',
                'quantity'                 => 'Hoeveelheid',
                'reason'                   => 'Reden',
                'rma-not-available-quotes' => 'Product is niet RMA-beschikbaar',
                'product-name'             => 'Productnaam',
                'reopen-request'           => 'Verzoek heropenen',
                'save'                     => 'Opslaan',
                'cancel'                   => 'Annuleren',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMA-status:',
                'order-status' => 'Bestelstatus:',
                'close-rma'    => 'RMA sluiten:',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Nieuw RMA-verzoek',
                'create-btn'               => 'Opslaan',
                'orders'                   => 'Bestellingen',
                'resolution'               => 'Oplossing selecteren',
                'item-ordered'             => 'Besteld item',
                'images'                   => 'Afbeeldingen',
                'information'              => 'Aanvullende informatie',
                'order-status'             => 'Bestelstatus',
                'product'                  => 'Product',
                'sku'                      => 'SKU',
                'price'                    => 'Prijs',
                'search-order'             => 'Zoek bestelling',
                'enter-order-id'           => 'Voer bestellings-ID in',
                'not-allowed'              => 'RMA niet toegestaan voor in behandeling zijnde bestellingen',
                'image'                    => 'Afbeelding',
                'quantity'                 => 'Hoeveelheid',
                'reason'                   => 'Reden',
                'rma-not-available-quotes' => 'Product is niet RMA-beschikbaar',
                'product-name'             => 'Productnaam',
                'reopen-request'           => 'Verzoek heropenen',
                'save'                     => 'Opslaan',
                'cancel'                   => 'Annuleren',
                'reopen-request'           => 'Verzoek heropenen',
            ],

            'index' => [
                'create'  => 'Nieuw RMA-verzoek indienen',
                'heading' => 'Klant-RMA-paneel',
                'view'    => 'Weergave',
                'edit'    => 'Bewerken',
                'delete'  => 'Verwijderen',
                'update'  => 'Bijwerken',
                'guest'   => 'Gast-RMA-paneel',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Nieuw RMA-verzoek indienen',
            'heading' => 'Klant-RMA-paneel',
            'view'    => 'Weergave',
            'edit'    => 'Bewerken',
            'delete'  => 'Verwijderen',
            'update'  => 'Bijwerken',
            'guest'   => 'Gast-RMA-paneel',
        ],

        'validation' => [
            'orders'       => 'Bestellingen',
            'resolution'   => 'Oplossing',
            'information'  => 'Aanvullende informatie',
            'order-status' => 'Bestelstatus',
            'order-id'     => 'Bestelling selecteren',
            'close-rma'    => 'Bevestigen',
        ],

        'conversation-texts' => [
            'by'       => 'Door',
            'seller'   => 'Verkoper',
            'customer' => 'Klant',
            'on'       => 'Op',
        ],

        'default-option' => [
            'please-select-value' => 'Selecteer waarde',
            'select-quantity'     => 'Selecteer hoeveelheid',
            'select-reason'       => 'Selecteer reden',
            'others'              => 'Anders',
            'select-order-status' => 'Selecteer bestelstatus',
            'select-resolution'   => 'Selecteer oplossing',
            'select-seller'       => 'Selecteer verkoper',
            'select-order'        => 'Selecteer bestelling',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Gast',
            'heading'                 => 'RMA-details',
            'status'                  => 'Status',
            'order-id'                => 'Bestellings-ID:',
            'refund-details'          => 'Terugbetalingsdetails',
            'resolution-type'         => 'Oplossingstype:',
            'additional-information'  => 'Aanvullende informatie:',
            'change-rma-status'       => 'RMA-status wijzigen',
            'save-btn'                => 'Opslaan',
            'you'                     => 'Beheerder',
            'send-message-btn'        => 'Verzenden',
            'items-requested-for-rma' => 'Voor RMA aangevraagde items',
            'refund-offline-btn'      => 'Offline terugbetaling',
            'send-message'            => 'Bericht versturen',
            'conversations'           => 'Gesprekken',
            'cancel-order'            => 'Bestelling annuleren',
            'status-details'          => 'Statusdetails',
            'admin'                   => 'Beheerder',
            'status-quotes'           => 'Ga akkoord om als opgelost te markeren.',
            'close-rma'               => 'RMA sluiten:',
            'images'                  => 'Afbeeldingen',
            'items-request'           => 'Aangevraagde RMA-items',
            'refundable-amount'       => 'Restitueerbaar bedrag',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Oplossingstype:',
            'guest'                  => 'Gast',
            'status'                 => 'Status',
            'order-id'               => 'Bestellings-ID:',
            'additional-information' => 'Aanvullende informatie:',
            'save-btn'               => 'Opslaan',
            'send-message-btn'       => 'Verzenden',
            'refund-offline-btn'     => 'Offline terugbetaling',
            'send-message'           => 'Bericht versturen',
            'conversations'          => 'Gesprekken',
            'status-details'         => 'Statusdetails',
            'admin'                  => 'Beheerder',
            'status-quotes'          => 'Ga akkoord om als opgelost te markeren.',
            'close-rma'              => 'RMA sluiten',
            'images'                 => 'Afbeeldingen',
            'items-request'          => 'Aangevraagde RMA-items',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMA-status:',
            'order-status' => 'Bestelstatus:',
            'full-amount'  => 'Volledig bedrag',
            'request-on'   => 'Aangevraagd op:',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'RMA sluiten',
            'rma-status'              => 'RMA-status:',
            'admin-status'            => 'Beheerderstatus:',
            'order-status'            => 'Bestelstatus:',
            'consignment-no'          => 'Zendingnr.:',
            'refundable-amount'       => 'Restitueerbaar bedrag:',
            'full-amount'             => 'Volledig bedrag',
            'partial-amount'          => 'Gedeeltelijk bedrag',
            'total-refundable-amount' => 'Totaal restitueerbaar bedrag:',
            'enter-message'           => 'Bericht invoeren',
            'request-on'              => 'Aangevraagd op:',
            'seller'                  => 'Verkoper',
            'order-details'           => 'Bestellingsdetails',
        ],

        'table-heading' => [
            'product-name' => 'Productnaam',
            'sku'          => 'SKU',
            'price'        => 'Prijs',
            'qty'          => 'Aantal',
            'reason'       => 'Reden',
        ],

        'guest-users' => [
            'heading'     => 'Gastinlogpaneel',
            'order-id'    => 'Bestellings-ID',
            'email'       => 'E-mail',
            'button-text' => 'Inloggen',
            'title'       => 'Gastinloggen',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA-verzoek',
            'hello'                  => 'Beste :name,',
            'greeting'               => 'Er is een nieuw RMA-verzoek voor bestelling :order_id ingediend.',
            'rma-id'                 => 'RMA-ID:',
            'summary'                => 'Samenvatting van RMA van bestelling',
            'order-id'               => 'Bestellings-ID:',
            'order-status'           => 'Bestelstatus:',
            'resolution-type'        => 'Oplossingstype:',
            'additional-information' => 'Aanvullende informatie:',
            'thank-you'              => 'Bedankt',
            'requested-rma-product'  => 'Gevraagd RMA-product:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Productnaam',
            'sku'          => 'SKU',
            'qty'          => 'Aantal',
            'reason'       => 'Reden',
        ],

        'customer-conversation' => [
            'heading' => 'Beste :name,',
            'quotes'  => 'Er is een nieuw bericht van de koper',
            'message' => 'Bericht',
        ],

        'seller-conversation' => [
            'heading' => 'Beste :name,',
            'quotes'  => 'Er is een nieuw bericht van de verkoper',
            'message' => 'Bericht',
            'title'   => 'Bericht ontvangen!',
        ],

        'status' => [
            'heading'       => 'Beste :name,',
            'quotes'        => 'Uw RMA-status is gewijzigd door de verkoper',
            'rma-id'        => 'RMA-identificatie',
            'your-rma-id'   => 'Uw RMA-identificatie',
            'status-change' => 'Status van :id is gewijzigd door de verkoper',
            'status'        => 'Status',
            'title'         => 'Status is bijgewerkt!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'In afwachting',
            'processing'               => 'Verwerking',
            'item-canceled'            => 'Item geannuleerd',
            'solved'                   => 'Opgelost',
            'declined'                 => 'Afgewezen',
            'received-package'         => 'Pakket ontvangen',
            'dispatched-package'       => 'Pakket verzonden',
            'not-received-package-yet' => 'Pakket nog niet ontvangen',
            'accept'                   => 'Accepteren',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA is afgewezen door de beheerder.',
            'declined-buyer'  => 'RMA is afgewezen door de koper.',
            'solved'          => 'RMA is opgelost.',
            'solved-by-admin' => 'RMA is opgelost door de beheerder.',
        ],
    ],

    'response' => [
        'create-success' => ':name succesvol aangemaakt.',
        'send-message'   => ':name succesvol verzonden.',
        'update-success' => ':name succesvol bijgewerkt.',
    ],
];
