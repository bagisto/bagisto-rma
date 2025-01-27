<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Middag',
                        'all-products'                        => 'Alle producten',
                        'all-status'                          => 'Alle statussen',
                        'allow-new-request-for-pending-order' => 'Sta een nieuw RMA-verzoek toe voor een lopende bestelling',
                        'allow-rma-for-digital-product'       => 'Sta RMA toe voor digitaal product',
                        'allowed-file-extension'              => 'Toegestane bestandsextensie',
                        'allowed-file-types'                  => 'Selecteer alleen de bestandstypen ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'Gescheiden door komma’s. Bijvoorbeeld: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Sta een nieuw RMA-verzoek toe voor geannuleerd verzoek',
                        'allowed-request-declined-request'    => 'Sta een nieuw RMA-verzoek toe voor afgewezen verzoek',
                        'allowed-rma-for-product'             => 'Sta RMA toe voor product',
                        'cancel-items'                        => 'Annuleer items',
                        'complete'                            => 'Voltooid',
                        'current-order-quantity'              => 'Huidige bestelhoeveelheid',
                        'days-info'                           => 'Het aantal dagen waarbinnen de klant een RMA kan aanvragen na het plaatsen van een bestelling.',
                        'default-allow-days'                  => 'Standaard toegestane dagen',
                        'enable'                              => 'Schakel RMA in',
                        'evening'                             => 'Avond',
                        'exchange'                            => 'Ruilen',
                        'info'                                => 'RMA is onderdeel van het proces van het retourneren van een product aan een bedrijf om een terugbetaling, vervanging of reparatie te ontvangen.',
                        'morning'                             => 'Ochtend',
                        'new-rma-message-to-customer'         => 'Nieuw RMA-bericht aan klant',
                        'no'                                  => 'Nee',
                        'open'                                => 'Open',
                        'package-condition'                   => 'Pakketconditie',
                        'packed'                              => 'Verpakt',
                        'print-page'                          => 'Pagina afdrukken', 
                        'product-already-raw'                 => 'Product bevindt zich al in RMA.',
                        'product-delivery-status'             => 'Productleverstatus',
                        'resolution-type'                     => 'Oplossingstype',
                        'return-pickup-address'               => 'Retour ophaaladres',
                        'return-pickup-time'                  => 'Retour ophaaltijd',
                        'return-policy'                       => 'Retourbeleid',
                        'return'                              => 'Retourneren',
                        'select-allowed-order-status'         => 'Selecteer toegestane orderstatus',
                        'specific-products'                   => 'Specifieke producten',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Ja',

                        'setting' => [
                            'info'  => 'De RMA-functionaliteit maakt het mogelijk om situaties te behandelen waarin een klant artikelen retourneert voor reparatie en onderhoud, of voor terugbetaling of vervanging.',
                            'read'  => 'Beleid lezen',
                            'terms' => 'Ik heb het retourbeleid gelezen en geaccepteerd.', 
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
                    'create-rma-title' => 'RMA aanmaken',
                    'reason-title'     => 'Redenen',
                    'rma-title'        => 'Alle RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Alle RMA',

                        'datagrid' => [
                            'create'        => 'Aangemaakt op',
                            'customer-name' => 'Klantnaam',
                            'id'            => 'RMA ID',
                            'order-ref'     => 'Bestelreferentie',
                            'order-status'  => 'Bestelstatus',
                            'rma-status'    => 'RMA Status',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Bijlagen toevoegen',
                        'additional-information' => 'Aanvullende informatie:',
                        'attachment'             => 'Bijlage',
                        'change-status'          => 'Status wijzigen',
                        'confirm-print'          => 'Klik op OK om de RMA af te drukken',
                        'conversations'          => 'Gesprekken',
                        'customer-details'       => 'Klantgegevens',
                        'customer-email'         => 'Klant e-mail:',
                        'customer'               => 'Klant:',
                        'enter-message'          => 'Bericht invoeren',
                        'images'                 => 'Afbeelding:',
                        'no-record'              => 'Geen record gevonden!',
                        'order-date'             => 'Besteldatum:',
                        'order-details'          => 'Aangevraagde artikel(en) voor RMA',
                        'order-id'               => 'Bestel-ID:',
                        'order-status'           => 'Bestelstatus:',
                        'order-total'            => 'Totaal bestelling:',
                        'request-on'             => 'Aangevraagd op:',
                        'resolution-type'        => 'Oplossingstype:',
                        'rma-status'             => 'RMA-status:',
                        'save-btn'               => 'Opslaan',
                        'send-message-btn'       => 'Bericht verzenden',
                        'send-message-success'   => 'Bericht succesvol verzonden.',
                        'send-message'           => 'Bericht verzenden',
                        'status'                 => 'Status',
                        'title'                  => 'RMA',
                        'update-success'         => 'RMA-status succesvol bijgewerkt.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'RMA-status maken',
                        'title'      => 'RMA-status',

                        'datagrid' => [
                            'created-at'          => 'Gemaakt op',
                            'delete-success'      => 'RMA-status succesvol verwijderd.',
                            'disabled'            => 'Inactief',
                            'enabled'             => 'Actief',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Geselecteerde RMA-status succesvol verwijderd.',
                            'reason-error'        => 'RMA-status wordt gebruikt in RMA.',
                            'reason'              => 'RMA-status',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nieuwe RMA-status toevoegen',
                        'reason'       => 'RMA-status',
                        'save-btn'     => 'RMA-status opslaan',
                        'status'       => 'Status',
                        'success'      => 'RMA-status succesvol aangemaakt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA-status bewerken',
                        'mass-update-success' => 'Geselecteerde RMA-status succesvol bijgewerkt.',
                        'reason'              => 'RMA-status',
                        'save-btn'            => 'RMA-status opslaan',
                        'status'              => 'Status',
                        'success'             => 'RMA-status succesvol bijgewerkt.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Redenen',
                        'create-btn' => 'RMA Reden aanmaken',

                        'datagrid' => [
                            'created-at'          => 'Aangemaakt op',
                            'delete-success'      => 'Reden succesvol verwijderd.',
                            'disabled'            => 'Inactief',
                            'enabled'             => 'Actief',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Geselecteerde gegevens succesvol verwijderd.',
                            'reason-error'        => 'Reden wordt gebruikt in RMA.',
                            'reason'              => 'Reden',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nieuwe Reden toevoegen',
                        'reason'       => 'Reden',
                        'save-btn'     => 'Reden opslaan',
                        'status'       => 'Status',
                        'success'      => 'Reden succesvol aangemaakt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Reden bewerken',
                        'mass-update-success' => 'Geselecteerde redenen succesvol bijgewerkt.',
                        'reason'              => 'Reden',
                        'save-btn'            => 'Reden opslaan',
                        'status'              => 'Status',
                        'success'             => 'Reden succesvol bijgewerkt.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Nieuw veld toevoegen',
                        'title'      => 'RMA Aangepaste Velden',

                        'datagrid' => [
                            'created-at'          => 'Gemaakt op',
                            'delete-success'      => 'Aangepaste velden succesvol verwijderd.',
                            'disabled'            => 'Inactief',
                            'enabled'             => 'Actief',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Geselecteerde gegevens succesvol verwijderd',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nieuw Aangepast Veld',
                        'save-btn'     => 'Aangepast veld opslaan',
                        'status'       => 'Status',
                        'success'      => 'Aangepast veld succesvol aangemaakt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Aangepast veld bewerken',
                        'mass-update-success' => 'Geselecteerde aangepaste velden succesvol bijgewerkt.',
                        'reason'              => 'Aangepast Veld',
                        'save-btn'            => 'Aangepast veld opslaan',
                        'status'              => 'Status',
                        'success'             => 'Aangepast veld succesvol bijgewerkt.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Maak RMA-regels',
                        'title'      => 'RMA-regels',

                        'datagrid' => [
                            'delete-success'      => 'RMA-regels succesvol verwijderd.',
                            'disabled'            => 'Inactief',
                            'enabled'             => 'Actief',
                            'exchange-period'     => 'Ruilperiode (dagen)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Geselecteerde gegevens succesvol verwijderd.',
                            'reason'              => 'Regels',
                            'return-period'       => 'Retourperiode (dagen)',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Nieuwe RMA-regels toevoegen',
                        'reason'             => 'RMA-regels',
                        'rule-description'   => 'Regelbeschrijving',
                        'rule-details'       => 'Regelgegevens',
                        'resolutions-period' => 'Oplossingsperiode',
                        'rules-title'        => 'Regels Titel',
                        'save-btn'           => 'RMA-regels opslaan',
                        'status'             => 'RMA-status',
                        'success'            => 'RMA-regels succesvol aangemaakt.',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA-regels bewerken',
                        'mass-update-success' => 'Geselecteerde RMA-regels succesvol bijgewerkt.',
                        'reason'              => 'RMA-regels',
                        'save-btn'            => 'RMA-regels bijwerken',
                        'status'              => 'Status',
                        'success'             => 'RMA-regels succesvol bijgewerkt.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA succesvol aangemaakt.',
                    'create-title'             => 'RMA aanmaken',
                    'email'                    => 'E-mail',
                    'image'                    => 'Afbeelding',
                    'invalid-order-id'         => 'Ongeldige bestel-ID',
                    'mismatch'                 => 'Bestel-ID en e-mail komen niet overeen',
                    'new-rma'                  => 'Nieuwe RMA',
                    'order-id'                 => 'Bestel-ID',
                    'quantity'                 => 'Aantal',
                    'reason'                   => 'Reden',
                    'rma-already-exist'        => 'RMA bestaat al',
                    'rma-not-available-quotes' => 'Item niet beschikbaar voor RMA',
                    'save-btn'                 => 'Opslaan',
                    'search'                   => '--Selecteer--',
                    'validate'                 => 'Valideren',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA is succesvol aangemaakt',
                    'rma-created-message'  => 'Een RMA-aanvraag is beschikbaar voor het product met een hoeveelheid van :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Verwijderen',
            'edit'        => 'Bewerken',
            'mass-delete' => 'Massa verwijderen',
            'mass-update' => 'Massa bijwerken',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Geleverd',
            'menu-name'    => 'RMA',
            'offer'        => 'Tot 40% KORTING op je eerste bestelling',
            'rma-qty'      => 'RMA Aantal',
            'shop-now'     => 'SHOP NU',
            'submit-req'   => 'Verzoek indienen',
            'title'        => 'RMA',
            'undelivered'  => 'Niet geleverd',

            'create' => [
                'cancel'                   => 'Annuleren',
                'create-btn'               => 'Opslaan',
                'enter-order-id'           => 'Voer Bestel-ID in',
                'heading'                  => 'Nieuw RMA-verzoek',
                'exchange-window'          => 'Ruilvenster',
                'image'                    => 'Afbeelding',
                'images'                   => 'Afbeeldingen',
                'information'              => 'Aanvullende Informatie',
                'item-ordered'             => 'Besteld Item',
                'no-record'                => 'Geen Records Gevonden!',
                'not-allowed'              => 'RMA is niet toegestaan voor bestellingen in afwachting',
                'order-status'             => 'Bestelstatus',
                'orders'                   => 'Bestellingen',
                'price'                    => 'Prijs',
                'product-name'             => 'Productnaam',
                'product'                  => 'Product',
                'quantity'                 => 'Hoeveelheid',
                'reason'                   => 'Reden',
                'reopen-request'           => 'Heropen Verzoek',
                'resolution'               => 'Selecteer Oplossing',
                'return-window'            => 'Retourvenster',
                'rma-not-available-quotes' => 'Item niet beschikbaar voor RMA',
                'save'                     => 'Opslaan',
                'search-order'             => 'Zoek Bestelling',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Sluit RMA:',
                'order-status' => 'Bestelstatus:',
                'rma-status'   => 'RMA Status:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Annuleren',
                'create-btn'               => 'Opslaan',
                'enter-order-id'           => 'Voer Bestel-ID in',
                'heading'                  => 'Nieuw RMA-verzoek',
                'image'                    => 'Afbeelding',
                'images'                   => 'Afbeeldingen',
                'information'              => 'Aanvullende Informatie',
                'item-ordered'             => 'Besteld Item',
                'not-allowed'              => 'RMA is niet toegestaan voor bestellingen in afwachting',
                'order-status'             => 'Bestelstatus',
                'orders'                   => 'Bestellingen',
                'price'                    => 'Prijs',
                'product-name'             => 'Productnaam',
                'product'                  => 'Product',
                'quantity'                 => 'Hoeveelheid',
                'reason'                   => 'Reden',
                'reopen-request'           => 'Heropen Verzoek',
                'resolution'               => 'Selecteer Oplossing',
                'rma-not-available-quotes' => 'Item niet beschikbaar voor RMA',
                'save'                     => 'Opslaan',
                'search-order'             => 'Zoek Bestelling',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Nieuw RMA aanvragen',
                'delete'  => 'Verwijderen',
                'edit'    => 'Bewerken',
                'guest'   => 'Gast RMA Paneel',
                'heading' => 'Gast RMA Paneel',
                'update'  => 'Bijwerken',
                'view'    => 'Bekijken',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Creëren',
            'delete'  => 'Verwijderen',
            'edit'    => 'Bewerken',
            'guest'   => 'Gast RMA Paneel',
            'heading' => 'RMA',
            'update'  => 'Bijwerken',
            'view'    => 'Bekijken',
        ],

        'validation' => [
            'close-rma'     => 'Bevestigen',
            'information'   => 'Aanvullende Informatie',
            'order-id'      => 'Bestelling Selectie',
            'order-status'  => 'Bestelstatus',
            'orders'        => 'Bestellingen',
            'resolution'    => 'Oplossing',
            'select-orders' => 'Selecteer Bestelling',
        ],

        'conversation-texts' => [
            'by'        => 'Door',
            'customer'  => 'Klant',
            'no-record' => 'Geen Records Gevonden!',
            'on'        => 'Op',
            'seller'    => 'Verkoper',
        ],

        'default-option' => [
            'others'              => 'Anders',
            'please-select-value' => 'Selecteer Waarde',
            'select-order-status' => 'Selecteer Bestelstatus',
            'select-order'        => 'Selecteer Bestelling',
            'select-quantity'     => 'Selecteer Hoeveelheid',
            'select-reason'       => 'Selecteer Reden',
            'select-resolution'   => 'Selecteer Oplossing',
            'select-seller'       => 'Selecteer Verkoper',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Aanvullende Informatie:',
            'admin'                   => 'Beheerder',
            'cancel-order'            => 'Bestelling Annuleren',
            'change-rma-status'       => 'Wijzig RMA-status',
            'close-rma'               => 'RMA Sluiten:',
            'conversations'           => 'Gesprekken',
            'guest'                   => 'Gast',
            'heading'                 => 'RMA Details',
            'images'                  => 'Afbeeldingen:',
            'items-request'           => 'Artikel(en) aangevraagd voor RMA',
            'items-requested-for-rma' => 'Artikel(en) aangevraagd voor RMA',
            'order-id'                => 'Bestel-ID:',
            'refund-details'          => 'Terugbetalingsgegevens',
            'refund-offline-btn'      => 'Offline Terugbetaling',
            'refundable-amount'       => 'Terug te betalen Bedrag',
            'resolution-type'         => 'Oplossing Type:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Opslaan',
            'send-message-btn'        => 'Verzenden',
            'send-message'            => 'Bericht Verzenden',
            'status-details'          => 'Status Details',
            'status-quotes'           => 'Gelieve akkoord te gaan om het als opgelost te markeren',
            'status-reopen'           => 'Controleer om opnieuw te openen',
            'status'                  => 'Status',
            'term'                    => 'Akkoord markeringsveld is verplicht',
            'you'                     => 'Beheerder',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Aanvullende Informatie:',
            'admin'                  => 'Beheerder',
            'close-rma'              => 'RMA Sluiten',
            'conversations'          => 'Gesprekken',
            'guest'                  => 'Jij',
            'images'                 => 'Afbeeldingen',
            'items-request'          => 'Artikel(en) aangevraagd voor RMA',
            'order-id'               => ' Bestel-ID:',
            'refund-offline-btn'     => 'Offline Terugbetaling',
            'resolution-type'        => 'Oplossing Type:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Opslaan',
            'send-message-btn'       => 'Verzenden',
            'send-message'           => 'Bericht Verzenden',
            'status-details'         => 'Status Details',
            'status-quotes'          => 'Gelieve akkoord te gaan om het als opgelost te markeren.',
            'status'                 => 'Status',
            'term'                   => 'Akkoord markeringsveld is verplicht',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Volledig Bedrag',
            'order-status' => 'Bestelstatus:',
            'request-on'   => 'Aanvraag Op:',
            'rma-status'   => 'RMA Status:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Beheerder Status:',
            'close-rma'               => 'RMA Sluiten',
            'consignment-no'          => 'Zending Nummer:',
            'enter-message'           => 'Voer Bericht In',
            'full-amount'             => 'Volledig Bedrag',
            'order-details'           => 'Bestelgegevens',
            'order-status'            => 'Bestelstatus:',
            'partial-amount'          => 'Gedeeltelijk Bedrag',
            'refundable-amount'       => 'Terugbetalingsbedrag:',
            'request-on'              => 'Aanvraag Op:',
            'rma-status'              => 'RMA Status:',
            'seller'                  => 'Verkoper',
            'total-refundable-amount' => 'Totaal Terug te Betalen Bedrag:',
        ],
        
        'table-heading' => [
            'image'           => 'Afbeelding',
            'product-name'    => 'Productnaam',
            'sku'             => 'SKU',
            'price'           => 'Prijs',
            'rma-qty'         => 'RMA Hoeveelheid',
            'order-qty'       => 'Bestelhoeveelheid',
            'resolution-type' => 'Oplossingstype',
            'reason'          => 'Reden',
        ],

        'guest-users' => [
            'button-text' => 'Inloggen',
            'email'       => 'E-mail',
            'heading'     => 'Gast Login Paneel',
            'logout'      => 'Gast afmelden',
            'order-id'    => 'Bestel-ID',
            'title'       => 'Gast Login',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Aanvullende informatie:',
            'greeting'               => 'U heeft een nieuwe RMA aangevraagd voor bestelling :order_id.',
            'heading'                => 'RMA Aanvraag',
            'hello'                  => 'Beste :name',
            'order-id'               => 'Bestelnummer:',
            'order-status'           => 'Bestelstatus:',
            'requested-rma-product'  => 'Gevraagd product voor RMA:',
            'resolution-type'        => 'Oplossingstype:',
            'rma-id'                 => 'RMA ID:',
            'summary'                => 'Samenvatting van de RMA van de bestelling',
            'thank-you'              => 'Bedankt',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Productnaam',
            'qty'          => 'Aantal',
            'reason'       => 'Reden',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'Beste :name,',
            'message' => 'Bericht',
            'quotes'  => 'Er is een nieuw bericht van de koper',
            'process' => 'Uw retourverzoek wordt verwerkt.',
            'solved'  => 'De RMA-status is door de klant gewijzigd naar Opgelost.',
        ],

        'seller-conversation' => [
            'heading' => 'Beste :name',
            'message' => 'Bericht',
            'quotes'  => 'Er is een nieuw bericht van de beheerder',
            'title'   => 'Bericht ontvangen!',
        ],

        'status' => [
            'heading'       => 'Beste :name',
            'quotes'        => 'Uw RMA-status is gewijzigd door de verkoper',
            'rma-id'        => 'RMA ID',
            'status-change' => ':id status is gewijzigd door de verkoper',
            'status'        => 'Status',
            'title'         => 'Status bijgewerkt!',
            'your-rma-id'   => 'Uw RMA ID',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Accepteren',
            'awaiting'                 => 'In afwachting',
            'canceled'                 => 'Geannuleerd',
            'declined'                 => 'Afgewezen',
            'dispatched-package'       => 'Pakket verzonden',
            'item-canceled'            => 'Item geannuleerd',
            'not-received-package-yet' => 'Pakket nog niet ontvangen',
            'pending'                  => 'In afwachting',
            'processing'               => 'Verwerking',
            'received-package'         => 'Pakket ontvangen',
            'solved'                   => 'Opgelost',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA is afgewezen door de beheerder.',
            'declined-buyer'  => 'RMA is afgewezen door de koper.',
            'solved-by-admin' => 'RMA is opgelost door de beheerder.',
            'solved'          => 'RMA is opgelost.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA-status is al geannuleerd.',
        'cancel-success'    => 'RMA-status is succesvol geannuleerd.', 
        'create-success'    => 'Verzoek succesvol aangemaakt.',
        'permission-denied' => 'U bent ingelogd',
        'rma-disabled'      => 'RMA is uitgeschakeld voor dit product',
        'send-message'      => ':name succesvol verzonden.',
        'update-success'    => ':name succesvol bijgewerkt.',
        'creation-error'    => 'De RMA-status kan niet worden bijgewerkt omdat de factuur voor deze bestelling niet is aangemaakt.',
    ],
];