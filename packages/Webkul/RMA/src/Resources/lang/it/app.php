<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Consenti nuovo richiesta di RMA per ordini in sospeso',
                        'allow-rma-for-digital-product'       => 'Consenti RMA per prodotti digitali',
                        'default-allow-days'                  => 'Giorni consentiti predefiniti',
                        'enable'                              => 'Abilita RMA',
                        'info'                                => 'RMA è parte del processo di restituzione di un prodotto a unazienda per ricevere un rimborso, una sostituzione o una riparazione.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'La funzionalità RMA consente di gestire situazioni in cui un cliente restituisce articoli per riparazioni e manutenzione, o per il rimborso o la sostituzione.',
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
                    'rma-title'        => 'Tutti gli Rma',
                    'reason-title'     => 'Ragioni',
                    'create-rma-title' => 'Crea Rma',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Tutti gli Rma',

                        'datagrid' => [
                            'id'        => 'ID RMA',
                            'order-ref' => 'Rif. ordine',
                            'status'    => 'Stato',
                            'create'    => 'Creato il',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID Ordine :',
                        'request-on'             => 'Richiesta il :',
                        'customer'               => 'Cliente :',
                        'resolution-type'        => 'Tipo di risoluzione :',
                        'additional-information' => 'Informazioni aggiuntive :',
                        'images'                 => 'Immagini :',
                        'order-details'          => 'Dettagli dell\'ordine',
                        'status'                 => 'Stato',
                        'rma-status'             => 'Stato RMA :',
                        'order-status'           => 'Stato dell\'ordine :',
                        'change-status'          => 'Cambia stato',
                        'conversations'          => 'Conversazioni',
                        'save-btn'               => 'Salva',
                        'send-message'           => 'Invia messaggio',
                        'enter-message'          => 'Inserisci messaggio',
                        'send-message-btn'       => 'Invia messaggio',
                        'send-message-success'   => 'Messaggio inviato con successo.',
                        'update-success'         => 'Stato Rma aggiornato con successo.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Ragioni',
                        'create-btn' => 'Crea motivo Rma',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Motivo',
                            'status'              => 'Stato',
                            'created-at'          => 'Creato il',
                            'enabled'             => 'Abilitato',
                            'disabled'            => 'Disabilitato',
                            'delete-success'      => 'Motivo eliminato con successo.',
                            'mass-delete-success' => 'Eliminazione di massa Rma riuscita.',
                            'reason-error'        => 'Il motivo è utilizzato in RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Aggiungi nuovo motivo',
                        'save-btn'       => 'Salva motivo',
                        'reason'         => 'Motivo',
                        'status'         => 'Stato',
                        'create-success' => 'Motivo creato con successo.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifica motivo',
                        'save-btn'            => 'Salva motivo',
                        'reason'              => 'Motivo',
                        'status'              => 'Stato',
                        'mass-update-success' => 'Motivi selezionati aggiornati con successo.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Crea Rma',
                    'order-id'          => 'ID ordine',
                    'email'             => 'Email',
                    'validate'          => 'Convalida',
                    'rma-already-exist' => 'RMA esiste già',
                    'mismatch'          => 'ID ordine ed email non corrispondono',
                    'invalid-order-id'  => 'ID ordine non valido',
                    'quantity'          => 'Quantità',
                    'reason'            => 'Motivo',
                    'save-btn'          => 'Salva',
                    'create-success'    => 'Rma creato con successo.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'Reso RMA',
            'offer'        => 'Ottieni FINO AL 40% DI SCONTO sul tuo primo ordine',
            'shop-now'     => 'ACQUISTA ORA',

            'create' => [
                'heading'                  => 'Nuova richiesta RMA',
                'create-btn'               => 'Salva',
                'orders'                   => 'Ordini',
                'resolution'               => 'Seleziona risoluzione',
                'item-ordered'             => 'Articolo ordinato',
                'images'                   => 'Immagini',
                'information'              => 'Informazioni aggiuntive',
                'order-status'             => 'Stato ordine',
                'product'                  => 'Prodotto',
                'sku'                      => 'Sku',
                'price'                    => 'Prezzo',
                'search-order'             => 'Cerca ordine',
                'enter-order-id'           => 'Inserisci ID ordine',
                'not-allowed'              => 'RMA non è consentito per ordini in sospeso',
                'image'                    => 'Immagine',
                'quantity'                 => 'Quantità',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Articolo non disponibile per RMA',
                'product-name'             => 'Nome del prodotto',
                'reopen-request'           => 'Richiedi la riapertura',
                'save'                     => 'Salva',
                'cancel'                   => 'Annulla',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'Stato RMA :',
                'order-status' => 'Stato ordine :',
                'close-rma'    => 'Chiudi RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Nuova richiesta RMA',
                'create-btn'               => 'Salva',
                'orders'                   => 'Ordini',
                'resolution'               => 'Seleziona risoluzione',
                'item-ordered'             => 'Articolo ordinato',
                'images'                   => 'Immagini',
                'information'              => 'Informazioni aggiuntive',
                'order-status'             => 'Stato ordine',
                'product'                  => 'Prodotto',
                'sku'                      => 'Sku',
                'price'                    => 'Prezzo',
                'search-order'             => 'Cerca ordine',
                'enter-order-id'           => 'Inserisci ID ordine',
                'not-allowed'              => 'RMA non è consentito per ordini in sospeso',
                'image'                    => 'Immagine',
                'quantity'                 => 'Quantità',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Articolo non disponibile per RMA',
                'product-name'             => 'Nome del prodotto',
                'reopen-request'           => 'Richiedi la riapertura',
                'save'                     => 'Salva',
                'cancel'                   => 'Annulla',
                'reopen-request'           => 'Richiedi la riapertura',
            ],

            'index' => [
                'create'  => 'Richiedi nuovo RMA',
                'heading' => 'Pannello cliente RMA',
                'view'    => 'Visualizza',
                'edit'    => 'Modifica',
                'delete'  => 'Elimina',
                'update'  => 'Aggiorna',
                'guest'   => 'Pannello RMA per ospiti',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Richiedi nuovo RMA',
            'heading' => 'Pannello cliente RMA',
            'view'    => 'Visualizza',
            'edit'    => 'Modifica',
            'delete'  => 'Elimina',
            'update'  => 'Aggiorna',
            'guest'   => 'Pannello RMA per ospiti',
        ],

        'validation' => [
            'orders'       => 'Ordini',
            'resolution'   => 'Risoluzione',
            'information'  => 'Informazioni aggiuntive',
            'order-status' => 'Stato ordine',
            'order-id'     => 'Selezione ordine',
            'close-rma'    => 'Conferma',
        ],

        'conversation-texts' => [
            'by'       => 'Di',
            'seller'   => 'Venditore',
            'customer' => 'Cliente',
            'on'       => 'Il',
        ],

        'default-option' => [
            'please-select-value' => 'Seleziona valore',
            'select-quantity'     => 'Seleziona quantità',
            'select-reason'       => 'Seleziona motivo',
            'others'              => 'Altro',
            'select-order-status' => 'Seleziona stato ordine',
            'select-resolution'   => 'Seleziona risoluzione',
            'select-seller'       => 'Seleziona venditore',
            'select-order'        => 'Seleziona ordine',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Ospite',
            'heading'                 => 'Dettagli RMA',
            'status'                  => 'Stato',
            'order-id'                => ' ID Ordine :',
            'refund-details'          => 'Dettagli rimborso',
            'resolution-type'         => 'Tipo di risoluzione :',
            'additional-information'  => 'Informazioni aggiuntive :',
            'change-rma-status'       => 'Cambia stato RMA',
            'save-btn'                => 'Salva',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Invia',
            'items-requested-for-rma' => 'Articolo(i) richiesto(i) per RMA',
            'refund-offline-btn'      => 'Rimborso offline',
            'send-message'            => 'Invia messaggio',
            'conversations'           => 'Conversazioni',
            'cancel-order'            => 'Annulla ordine',
            'status-details'          => 'Dettagli stato',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Si prega di accettare per contrassegnarlo come risolto.',
            'close-rma'               => 'Chiudi RMA :',
            'images'                  => 'Immagini',
            'items-request'           => 'Articolo(i) richiesto(i) per RMA',
            'refundable-amount'       => 'Importo rimborsabile',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Tipo di risoluzione :',
            'guest'                  => 'Tu',
            'status'                 => 'Stato',
            'order-id'               => ' ID Ordine :',
            'additional-information' => 'Informazioni aggiuntive :',
            'save-btn'               => 'Salva',
            'send-message-btn'       => 'Invia',
            'refund-offline-btn'     => 'Rimborso offline',
            'send-message'           => 'Invia messaggio',
            'conversations'          => 'Conversazioni',
            'status-details'         => 'Dettagli stato',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Si prega di accettare per contrassegnarlo come risolto.',
            'close-rma'              => 'Chiudi RMA',
            'images'                 => 'Immagini',
            'items-request'          => 'Articolo(i) richiesto(i) per RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Stato RMA :',
            'order-status' => 'Stato ordine :',
            'full-amount'  => 'Importo totale',
            'request-on'   => 'Richiesta il :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Chiudi RMA',
            'rma-status'              => 'Stato RMA :',
            'admin-status'            => 'Stato Admin:',
            'order-status'            => 'Stato ordine :',
            'consignment-no'          => 'Numero di spedizione:',
            'refundable-amount'       => 'Importo rimborsabile:',
            'full-amount'             => 'Importo totale',
            'partial-amount'          => 'Importo parziale',
            'total-refundable-amount' => 'Importo totale rimborsabile:',
            'enter-message'           => 'Inserisci messaggio',
            'request-on'              => 'Richiesta il :',
            'seller'                  => 'Venditore',
            'order-details'           => 'Dettagli ordine',
        ],

        'table-heading' => [
            'product-name' => 'Nome del prodotto',
            'sku'          => 'SKU',
            'price'        => 'Prezzo',
            'qty'          => 'Qtà',
            'reason'       => 'Motivo',
        ],

        'guest-users' => [
            'heading'     => 'Pannello di accesso ospite',
            'order-id'    => 'ID ordine',
            'email'       => 'Email',
            'button-text' => 'Login',
            'title'       => 'Accesso ospite',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Richiesta RMA',
            'hello'                  => 'Caro :name',
            'greeting'               => 'Hai richiesto un nuovo RMA per l\'ordine :order_id.',
            'rma-id'                 => 'ID RMA :',
            'summary'                => 'Riepilogo dell\'RMA dell\'ordine',
            'order-id'               => 'ID ordine :',
            'order-status'           => 'Stato ordine :',
            'resolution-type'        => 'Tipo di risoluzione :',
            'additional-information' => 'Informazioni aggiuntive :',
            'thank-you'              => 'Grazie',
            'requested-rma-product'  => 'Prodotto richiesto RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nome del prodotto',
            'sku'          => 'Sku',
            'qty'          => 'Qtà',
            'reason'       => 'Motivo',
        ],

        'customer-conversation' => [
            'heading' => 'Caro :name,',
            'quotes'  => 'C\'è un nuovo messaggio dal compratore',
            'message' => 'Messaggio',
        ],

        'seller-conversation' => [
            'heading' => 'Caro :name',
            'quotes'  => 'C\'è un nuovo messaggio dal venditore',
            'message' => 'Messaggio',
            'title'   => 'Messaggio ricevuto!',
        ],

        'status' => [
            'heading'       => 'Caro :name',
            'quotes'        => 'Il tuo stato RMA è stato modificato dal venditore',
            'rma-id'        => 'ID RMA',
            'your-rma-id'   => 'Il tuo ID RMA',
            'status-change' => 'Lo stato :id è stato modificato dal venditore',
            'status'        => 'Stato',
            'title'         => 'Stato aggiornato!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'In attesa',
            'processing'               => 'In elaborazione',
            'item-canceled'            => 'Articolo annullato',
            'solved'                   => 'Risolto',
            'declined'                 => 'Declinato',
            'received-package'         => 'Pacchetto ricevuto',
            'dispatched-package'       => 'Pacchetto spedito',
            'not-received-package-yet' => 'Pacchetto non ancora ricevuto',
            'accept'                   => 'Accetta',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA è stato declinato dall\'amministratore.',
            'declined-buyer'  => 'RMA è stato declinato dal compratore.',
            'solved'          => 'RMA risolto.',
            'solved-by-admin' => 'RMA risolto dall\'amministratore.',
        ],
    ],

    'response' => [
        'create-success' => ':name creato con successo.',
        'send-message'   => ':name inviato con successo.',
        'update-success' => ':name aggiornato con successo.',
    ],
];
