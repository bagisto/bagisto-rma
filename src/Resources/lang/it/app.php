<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Pomeriggio',
                        'all-products'                        => 'Tutti i prodotti',
                        'all-status'                          => 'Tutti gli stati',
                        'allow-new-request-for-pending-order' => 'Consenti nuova richiesta RMA per ordine in sospeso',
                        'allow-rma-for-digital-product'       => 'Consenti RMA per prodotto digitale',
                        'allowed-file-extension'              => 'Estensione del file consentita',
                        'allowed-file-types'                  => 'Si prega di selezionare solo i tipi di file ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'Separato da virgole. Ad esempio: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Consenti nuova richiesta RMA per richiesta annullata',
                        'allowed-request-declined-request'    => 'Consenti nuova richiesta RMA per richiesta rifiutata',
                        'allowed-rma-for-product'             => 'Consenti RMA per prodotto',
                        'cancel-items'                        => 'Annulla articoli',
                        'complete'                            => 'Completo',
                        'current-order-quantity'              => 'Quantità ordine attuale',
                        'days-info'                           => 'Il numero di giorni entro i quali il cliente può richiedere un RMA dopo aver effettuato un ordine.',
                        'default-allow-days'                  => 'Giorni consentiti predefiniti',
                        'enable'                              => 'Abilita RMA',
                        'evening'                             => 'Sera',
                        'exchange'                            => 'Scambio',
                        'info'                                => 'RMA fa parte del processo di restituzione di un prodotto a un\'azienda per ricevere un rimborso, una sostituzione o una riparazione.',
                        'morning'                             => 'Mattina',
                        'new-rma-message-to-customer'         => 'Nuovo messaggio RMA per il cliente',
                        'no'                                  => 'No',
                        'open'                                => 'Aperto',
                        'package-condition'                   => 'Condizione del pacchetto',
                        'packed'                              => 'Imballato',
                        'print-page'                          => 'Stampa pagina',
                        'product-already-raw'                 => 'Il prodotto è già in RMA.',
                        'product-delivery-status'             => 'Stato della consegna del prodotto',
                        'resolution-type'                     => 'Tipo di risoluzione',
                        'return-pickup-address'               => 'Indirizzo di ritiro del reso',
                        'return-pickup-time'                  => 'Orario di ritiro del reso',
                        'return-policy'                       => 'Politica di reso',
                        'return'                              => 'Restituzione',
                        'select-allowed-order-status'         => 'Seleziona stato dell\'ordine consentito',
                        'specific-products'                   => 'Prodotti specifici',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Sì',

                        'setting' => [
                            'info'  => 'La funzionalità RMA consente di gestire situazioni in cui un cliente restituisce articoli per riparazione e manutenzione, o per rimborso o sostituzione.',
                            'read'  => 'Leggi la politica', 
                            'terms' => 'Ho letto e accettato la politica di reso.', 
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
                    'create-rma-title' => 'Crea RMA',
                    'reason-title'     => 'Motivi',
                    'rma-title'        => 'Tutte le RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Tutte le RMA',

                        'datagrid' => [
                            'create'        => 'Creato il',
                            'customer-name' => 'Nome Cliente',
                            'id'            => 'ID RMA',
                            'order-ref'     => 'Riferimento Ordine',
                            'order-status'  => 'Stato Ordine',
                            'rma-status'    => 'Stato RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Aggiungi allegati',
                        'additional-information' => 'Informazioni aggiuntive:',
                        'attachment'             => 'Allegato',
                        'change-status'          => 'Cambia stato',
                        'confirm-print'          => 'Fare clic su OK per stampare l’RMA',
                        'conversations'          => 'Conversazioni',
                        'customer-details'       => 'Dettagli cliente',
                        'customer-email'         => 'Email cliente:',
                        'customer'               => 'Cliente:',
                        'enter-message'          => 'Inserisci messaggio',
                        'images'                 => 'Immagine:',
                        'no-record'              => 'Nessun record trovato!',
                        'order-date'             => 'Data ordine:',
                        'order-details'          => 'Articolo(i) richiesto(i) per RMA',
                        'order-id'               => 'ID ordine:',
                        'order-status'           => 'Stato dell\'ordine:',
                        'order-total'            => 'Totale ordine:',
                        'request-on'             => 'Richiesto il:',
                        'resolution-type'        => 'Tipo di risoluzione:',
                        'rma-status'             => 'Stato RMA:',
                        'save-btn'               => 'Salva',
                        'send-message-btn'       => 'Invia messaggio',
                        'send-message-success'   => 'Messaggio inviato con successo.',
                        'send-message'           => 'Invia messaggio',
                        'status'                 => 'Stato',
                        'title'                  => 'RMA',
                        'update-success'         => 'Stato RMA aggiornato con successo.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Crea Stato RMA',
                        'title'      => 'Stato RMA',

                        'datagrid' => [
                            'created-at'          => 'Creato il',
                            'delete-success'      => 'Stato RMA eliminato con successo.',
                            'disabled'            => 'Inattivo',
                            'enabled'             => 'Attivo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Stato RMA selezionato eliminato con successo.',
                            'reason-error'        => 'Stato RMA utilizzato in RMA.',
                            'reason'              => 'Stato RMA',
                            'status'              => 'Stato',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Aggiungi Nuovo Stato RMA',
                        'reason'       => 'Stato RMA',
                        'save-btn'     => 'Salva Stato RMA',
                        'status'       => 'Stato',
                        'success'      => 'Stato RMA creato con successo.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifica Stato RMA',
                        'mass-update-success' => 'Stato RMA selezionato aggiornato con successo.',
                        'reason'              => 'Stato RMA',
                        'save-btn'            => 'Salva Stato RMA',
                        'status'              => 'Stato',
                        'success'             => 'Stato RMA aggiornato con successo.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Motivi',
                        'create-btn' => 'Crea Motivo RMA',

                        'datagrid' => [
                            'created-at'          => 'Creato il',
                            'delete-success'      => 'Motivo eliminato con successo.',
                            'disabled'            => 'Disattivo',
                            'enabled'             => 'Attivo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dati selezionati eliminati con successo',
                            'reason-error'        => 'Il motivo è utilizzato in RMA.',
                            'reason'              => 'Motivo',
                            'status'              => 'Stato',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Aggiungi Nuovo Motivo',
                        'reason'       => 'Motivo',
                        'save-btn'     => 'Salva Motivo',
                        'status'       => 'Stato',
                        'success'      => 'Motivo creato con successo.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifica Motivo',
                        'mass-update-success' => 'Motivi selezionati aggiornati con successo.',
                        'reason'              => 'Motivo',
                        'save-btn'            => 'Salva Motivo',
                        'status'              => 'Stato',
                        'success'             => 'Motivo aggiornato con successo.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Aggiungi nuovo campo',
                        'title'      => 'Campi personalizzati RMA',

                        'datagrid' => [
                            'created-at'          => 'Creato il',
                            'delete-success'      => 'Campi personalizzati eliminati con successo.',
                            'disabled'            => 'Inattivo',
                            'enabled'             => 'Attivo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dati selezionati eliminati con successo',
                            'status'              => 'Stato',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nuovo campo personalizzato',
                        'save-btn'     => 'Salva campo personalizzato',
                        'status'       => 'Stato',
                        'success'      => 'Campo personalizzato creato con successo.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifica campo personalizzato',
                        'mass-update-success' => 'Campi personalizzati selezionati aggiornati con successo.',
                        'reason'              => 'Campo personalizzato',
                        'save-btn'            => 'Salva campo personalizzato',
                        'status'              => 'Stato',
                        'success'             => 'Campo personalizzato aggiornato con successo.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Crea Regole RMA',
                        'title'      => 'Regole RMA',

                        'datagrid' => [
                            'delete-success'      => 'Regole RMA eliminate con successo.',
                            'disabled'            => 'Inattivo',
                            'enabled'             => 'Attivo',
                            'exchange-period'     => 'Periodo di Scambio (giorni)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dati selezionati eliminati con successo.',
                            'reason'              => 'Regole',
                            'return-period'       => 'Periodo di Restituzione (giorni)',
                            'status'              => 'Stato',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Aggiungi Nuove Regole RMA',
                        'reason'             => 'Regole RMA',
                        'rule-description'   => 'Descrizione delle Regole',
                        'rule-details'       => 'Dettagli delle Regole',
                        'resolutions-period' => 'Periodo di Risoluzione',
                        'rules-title'        => 'Titolo delle Regole',
                        'save-btn'           => 'Salva Regole RMA',
                        'status'             => 'Stato RMA',
                        'success'            => 'Regole RMA create con successo.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifica Regole RMA',
                        'mass-update-success' => 'Regole RMA selezionate aggiornate con successo.',
                        'reason'              => 'Regole RMA',
                        'save-btn'            => 'Aggiorna Regole RMA',
                        'status'              => 'Stato',
                        'success'             => 'Regole RMA aggiornate con successo.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA creato con successo.',
                    'create-title'             => 'Crea RMA',
                    'email'                    => 'Email',
                    'image'                    => 'Immagine',
                    'invalid-order-id'         => 'ID Ordine non valido',
                    'mismatch'                 => 'ID Ordine ed Email non corrispondono',
                    'new-rma'                  => 'Nuova RMA',
                    'order-id'                 => 'ID Ordine',
                    'quantity'                 => 'Quantità',
                    'reason'                   => 'Motivo',
                    'rma-already-exist'        => 'RMA già esistente',
                    'rma-not-available-quotes' => 'Articolo non disponibile per RMA',
                    'save-btn'                 => 'Salva',
                    'search'                   => '--Seleziona--',
                    'validate'                 => 'Convalida',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA è stato creato',
                    'rma-created-message'  => 'Una richiesta di RMA è disponibile per il prodotto con una quantità di :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Elimina',
            'edit'        => 'Modifica',
            'mass-delete' => 'Eliminazione di massa',
            'mass-update' => 'Aggiornamento di massa',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Consegnato',
            'menu-name'    => 'RMA',
            'offer'        => 'Fino al 40% di SCONTO sul tuo primo ordine',
            'rma-qty'      => 'Quantità RMA',
            'shop-now'     => 'COMPRA ORA',
            'submit-req'   => 'Invia richiesta',
            'title'        => 'RMA',
            'undelivered'  => 'Non consegnato',

            'create' => [
                'cancel'                   => 'Annulla',
                'create-btn'               => 'Salva',
                'enter-order-id'           => 'Inserisci ID Ordine',
                'heading'                  => 'Nuova Richiesta RMA',
                'exchange-window'          => 'Finestra di scambio',
                'image'                    => 'Immagine',
                'images'                   => 'Immagini',
                'information'              => 'Informazioni Aggiuntive',
                'item-ordered'             => 'Articolo Ordinato',
                'no-record'                => 'Nessun Record Trovato!',
                'not-allowed'              => 'RMA non consentita per ordine in sospeso',
                'order-status'             => 'Stato Ordine',
                'orders'                   => 'Ordini',
                'price'                    => 'Prezzo',
                'product-name'             => 'Nome Prodotto',
                'product'                  => 'Prodotto',
                'quantity'                 => 'Quantità',
                'reason'                   => 'Motivo',
                'reopen-request'           => 'Riapri Richiesta',
                'resolution'               => 'Seleziona Risoluzione',
                'return-window'            => 'Finestra di Reso',
                'rma-not-available-quotes' => 'Articolo non disponibile per RMA',
                'save'                     => 'Salva',
                'search-order'             => 'Cerca Ordine',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Chiudi RMA:',
                'order-status' => 'Stato Ordine:',
                'rma-status'   => 'Stato RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Annulla',
                'create-btn'               => 'Salva',
                'enter-order-id'           => 'Inserisci ID Ordine',
                'heading'                  => 'Nuova Richiesta RMA',
                'image'                    => 'Immagine',
                'images'                   => 'Immagini',
                'information'              => 'Informazioni Aggiuntive',
                'item-ordered'             => 'Articolo Ordinato',
                'not-allowed'              => 'RMA non consentita per ordine in sospeso',
                'order-status'             => 'Stato Ordine',
                'orders'                   => 'Ordini',
                'price'                    => 'Prezzo',
                'product-name'             => 'Nome Prodotto',
                'product'                  => 'Prodotto',
                'quantity'                 => 'Quantità',
                'reason'                   => 'Motivo',
                'reopen-request'           => 'Riapri Richiesta',
                'resolution'               => 'Seleziona Risoluzione',
                'rma-not-available-quotes' => 'Articolo non disponibile per RMA',
                'save'                     => 'Salva',
                'search-order'             => 'Cerca Ordine',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Richiedi nuovo RMA',
                'delete'  => 'Elimina',
                'edit'    => 'Modifica',
                'guest'   => 'Pannello RMA Ospite',
                'heading' => 'Pannello RMA Ospite',
                'update'  => 'Aggiorna',
                'view'    => 'Visualizza',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Crea',
            'delete'  => 'Elimina',
            'edit'    => 'Modifica',
            'guest'   => 'Pannello RMA Ospite',
            'heading' => 'RMA',
            'update'  => 'Aggiorna',
            'view'    => 'Visualizza',
        ],

        'validation' => [
            'close-rma'     => 'Conferma',
            'information'   => 'Informazioni Aggiuntive',
            'order-id'      => 'Selezione Ordine',
            'order-status'  => 'Stato Ordine',
            'orders'        => 'Ordini',
            'resolution'    => 'Risoluzione',
            'select-orders' => 'Seleziona Ordine',
        ],

        'conversation-texts' => [
            'by'        => 'Da',
            'customer'  => 'Cliente',
            'no-record' => 'Nessun Record Trovato!',
            'on'        => 'Il',
            'seller'    => 'Venditore',
        ],

        'default-option' => [
            'others'              => 'Altro',
            'please-select-value' => 'Seleziona un Valore',
            'select-order-status' => 'Seleziona Stato Ordine',
            'select-order'        => 'Seleziona Ordine',
            'select-quantity'     => 'Seleziona Quantità',
            'select-reason'       => 'Seleziona Motivo',
            'select-resolution'   => 'Seleziona Risoluzione',
            'select-seller'       => 'Seleziona Venditore',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Informazioni Aggiuntive:',
            'admin'                   => 'Admin',
            'cancel-order'            => 'Annulla Ordine',
            'change-rma-status'       => 'Cambia Stato RMA',
            'close-rma'               => 'Chiudi RMA:',
            'conversations'           => 'Conversazioni',
            'guest'                   => 'Ospite',
            'heading'                 => 'Dettagli RMA',
            'images'                  => 'Immagini:',
            'items-request'           => 'Articoli Richiesti per RMA',
            'items-requested-for-rma' => 'Articoli Richiesti per RMA',
            'order-id'                => 'ID Ordine:',
            'refund-details'          => 'Dettagli Rimborso',
            'refund-offline-btn'      => 'Rimborso Offline',
            'refundable-amount'       => 'Importo Rimborsabile',
            'resolution-type'         => 'Tipo Risoluzione:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Salva',
            'send-message-btn'        => 'Invia',
            'send-message'            => 'Invia Messaggio',
            'status-details'          => 'Dettagli Stato',
            'status-quotes'           => 'Accetta per segnare come risolto',
            'status-reopen'           => 'Seleziona per riaprire',
            'status'                  => 'Stato',
            'term'                    => 'Accetta campo di marcatura è obbligatorio',
            'you'                     => 'Admin',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Informazioni Aggiuntive:',
            'admin'                  => 'Admin',
            'close-rma'              => 'Chiudi RMA',
            'conversations'          => 'Conversazioni',
            'guest'                  => 'Tu',
            'images'                 => 'Immagini',
            'items-request'          => 'Articoli Richiesti per RMA',
            'order-id'               => ' ID Ordine:',
            'refund-offline-btn'     => 'Rimborso Offline',
            'resolution-type'        => 'Tipo Risoluzione:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Salva',
            'send-message-btn'       => 'Invia',
            'send-message'           => 'Invia Messaggio',
            'status-details'         => 'Dettagli Stato',
            'status-quotes'          => 'Accetta per segnare come risolto.',
            'status'                 => 'Stato',
            'term'                   => 'Accetta campo di marcatura è obbligatorio',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Importo Completo',
            'order-status' => 'Stato Ordine:',
            'request-on'   => 'Richiesta Il:',
            'rma-status'   => 'Stato RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Stato Admin:',
            'close-rma'               => 'Chiudi RMA',
            'consignment-no'          => 'Numero Spedizione:',
            'enter-message'           => 'Inserisci Messaggio',
            'full-amount'             => 'Importo Completo',
            'order-details'           => 'Dettagli Ordine',
            'order-status'            => 'Stato Ordine:',
            'partial-amount'          => 'Importo Parziale',
            'refundable-amount'       => 'Importo Rimborsabile:',
            'request-on'              => 'Richiesta Il:',
            'rma-status'              => 'Stato RMA:',
            'seller'                  => 'Venditore',
            'total-refundable-amount' => 'Importo Totale Rimborsabile:',
        ],

        'table-heading' => [
            'image'           => 'Immagine',
            'product-name'    => 'Nome del prodotto',
            'sku'             => 'SKU',
            'price'           => 'Prezzo',
            'rma-qty'         => 'Quantità RMA',
            'order-qty'       => 'Quantità dell\'ordine',
            'resolution-type' => 'Tipo di risoluzione',
            'reason'          => 'Motivo',
        ],

        'guest-users' => [
            'button-text' => 'Accedi',
            'email'       => 'Email',
            'heading'     => 'Pannello Accesso Ospite',
            'logout'      => 'Logout ospite',
            'order-id'    => 'ID Ordine',
            'title'       => 'Accesso Ospite',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Informazioni aggiuntive :',
            'greeting'               => 'Hai richiesto un nuovo RMA per l\'ordine :order_id.',
            'heading'                => 'Richiesta RMA',
            'hello'                  => 'Gentile :name',
            'order-id'               => 'ID Ordine :',
            'order-status'           => 'Stato dell\'ordine :',
            'requested-rma-product'  => 'Prodotto richiesto per l\'RMA:',
            'resolution-type'        => 'Tipo di risoluzione :',
            'rma-id'                 => 'ID RMA :',
            'summary'                => 'Riepilogo RMA dell\'ordine',
            'thank-you'              => 'Grazie',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nome Prodotto',
            'qty'          => 'Qtà',
            'reason'       => 'Motivo',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'Gentile :name,',
            'message' => 'Messaggio',
            'quotes'  => 'C\'è un nuovo messaggio dall\'acquirente',
            'process' => 'La tua richiesta di reso è in fase di elaborazione.',
            'solved'  => 'Lo stato RMA è stato cambiato in Risolto dal cliente.', 
        ],

        'seller-conversation' => [
            'heading' => 'Gentile :name',
            'message' => 'Messaggio',
            'quotes'  => 'C’è un nuovo messaggio dall’amministratore',
            'title'   => 'Messaggio Ricevuto!',
        ],

        'status' => [
            'heading'       => 'Gentile :name',
            'quotes'        => 'Il tuo stato RMA è stato modificato dal venditore',
            'rma-id'        => 'ID RMA',
            'status-change' => ':id stato è stato modificato dal venditore',
            'status'        => 'Stato',
            'title'         => 'Aggiornamento Stato!',
            'your-rma-id'   => 'Il tuo ID RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Accetta',
            'awaiting'                 => 'In attesa',
            'canceled'                 => 'Annullato',
            'declined'                 => 'Declinato',
            'dispatched-package'       => 'Pacchetto Spedito',
            'item-canceled'            => 'Articolo Annullato',
            'not-received-package-yet' => 'Pacchetto non ancora ricevuto',
            'pending'                  => 'In sospeso',
            'processing'               => 'In lavorazione',
            'received-package'         => 'Pacchetto Ricevuto',
            'solved'                   => 'Risolto',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA è stato declinato dall\'amministratore.',
            'declined-buyer'  => 'RMA è stato declinato dall\'acquirente.',
            'solved-by-admin' => 'RMA è stato risolto dall\'amministratore.',
            'solved'          => 'RMA è stato risolto.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'Lo stato RMA è già stato annullato.',
        'cancel-success'    => 'Lo stato RMA è stato annullato con successo.',
        'create-success'    => 'Richiesta creata con successo.',
        'creation-error'    => 'Lo stato RMA non può essere aggiornato perché la fattura per questo ordine non è stata creata.', 
        'permission-denied' => 'Sei connesso',
        'rma-disabled'      => 'RMA è disabilitato per questo prodotto',
        'send-message'      => ':name inviato con successo.',
        'update-success'    => ':name aggiornato con successo.',
        'please-select-the-item' => 'Si prega di selezionare l’articolo',

    ],
];