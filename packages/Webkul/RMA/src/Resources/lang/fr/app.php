<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Autoriser une nouvelle demande de RMA pour une commande en attente',
                        'allow-rma-for-digital-product'       => 'Autoriser le RMA pour les produits numériques',
                        'default-allow-days'                  => 'Jours autorisés par défaut',
                        'enable'                              => 'Activer le RMA',
                        'info'                                => 'Le RMA fait partie du processus de retour d\'un produit à une entreprise pour obtenir un remboursement, un remplacement ou une réparation.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'La fonctionnalité de RMA permet de gérer les situations où un client retourne des articles pour réparation et entretien, ou pour un remboursement ou un remplacement.',
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
                    'rma-title'        => 'Tous les RMA',
                    'reason-title'     => 'Raisons',
                    'create-rma-title' => 'Créer un RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Tous les RMA',

                        'datagrid' => [
                            'id'        => 'ID RMA',
                            'order-ref' => 'Référence de la commande',
                            'status'    => 'Statut',
                            'create'    => 'Créé à',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID de la commande :',
                        'request-on'             => 'Demandé le :',
                        'customer'               => 'Client :',
                        'resolution-type'        => 'Type de résolution :',
                        'additional-information' => 'Informations supplémentaires :',
                        'images'                 => 'Image :',
                        'order-details'          => 'Détails de la commande',
                        'status'                 => 'Statut',
                        'rma-status'             => 'Statut du RMA :',
                        'order-status'           => 'Statut de la commande :',
                        'change-status'          => 'Changer de statut',
                        'conversations'          => 'Conversations',
                        'save-btn'               => 'Enregistrer',
                        'send-message'           => 'Envoyer un message',
                        'enter-message'          => 'Saisissez le message',
                        'send-message-btn'       => 'Envoyer un message',
                        'send-message-success'   => 'Message envoyé avec succès.',
                        'update-success'         => 'Statut du RMA mis à jour avec succès.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Raisons',
                        'create-btn' => 'Créer une raison RMA',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Raison',
                            'status'              => 'Statut',
                            'created-at'          => 'Créé à',
                            'enabled'             => 'Activé',
                            'disabled'            => 'Désactivé',
                            'delete-success'      => 'Raison supprimée avec succès.',
                            'mass-delete-success' => 'Suppression de masse RMA réussie.',
                            'reason-error'        => 'La raison est utilisée dans le RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Ajouter une nouvelle raison',
                        'save-btn'       => 'Enregistrer la raison',
                        'reason'         => 'Raison',
                        'status'         => 'Statut',
                        'create-success' => 'Raison créée avec succès.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Modifier la raison',
                        'save-btn'            => 'Enregistrer la raison',
                        'reason'              => 'Raison',
                        'status'              => 'Statut',
                        'mass-update-success' => 'Raisons sélectionnées mises à jour avec succès.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Créer un RMA',
                    'order-id'          => 'ID de la commande',
                    'email'             => 'Email',
                    'validate'          => 'Valider',
                    'rma-already-exist' => 'Le RMA existe déjà',
                    'mismatch'          => 'ID de commande et email ne correspondent pas',
                    'invalid-order-id'  => 'ID de commande invalide',
                    'quantity'          => 'Quantité',
                    'reason'            => 'Raison',
                    'save-btn'          => 'Enregistrer',
                    'create-success'    => 'RMA créé avec succès.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'Retour RMA',
            'offer'        => 'Obtenez jusqu\'à 40% de réduction sur votre 1ère commande',
            'shop-now'     => 'ACHETER MAINTENANT',

            'create' => [
                'heading'                  => 'Nouvelle demande de RMA',
                'create-btn'               => 'Enregistrer',
                'orders'                   => 'Commandes',
                'resolution'               => 'Sélectionner une résolution',
                'item-ordered'             => 'Article commandé',
                'images'                   => 'Images',
                'information'              => 'Informations supplémentaires',
                'order-status'             => 'Statut de la commande',
                'product'                  => 'Produit',
                'sku'                      => 'SKU',
                'price'                    => 'Prix',
                'search-order'             => 'Rechercher une commande',
                'enter-order-id'           => 'Entrer l\'ID de la commande',
                'not-allowed'              => 'Le RMA n\'est pas autorisé pour la commande en attente',
                'image'                    => 'Image',
                'quantity'                 => 'Quantité',
                'reason'                   => 'Raison',
                'rma-not-available-quotes' => 'Article non disponible pour le RMA',
                'product-name'             => 'Nom du produit',
                'reopen-request'           => 'Rouvrir la demande',
                'save'                     => 'Enregistrer',
                'cancel'                   => 'Annuler',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'Statut du RMA :',
                'order-status' => 'Statut de la commande :',
                'close-rma'    => 'Fermer le RMA :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Nouvelle demande de RMA',
                'create-btn'               => 'Enregistrer',
                'orders'                   => 'Commandes',
                'resolution'               => 'Sélectionner une résolution',
                'item-ordered'             => 'Article commandé',
                'images'                   => 'Images',
                'information'              => 'Informations supplémentaires',
                'order-status'             => 'Statut de la commande',
                'product'                  => 'Produit',
                'sku'                      => 'SKU',
                'price'                    => 'Prix',
                'search-order'             => 'Rechercher une commande',
                'enter-order-id'           => 'Entrer l\'ID de la commande',
                'not-allowed'              => 'Le RMA n\'est pas autorisé pour la commande en attente',
                'image'                    => 'Image',
                'quantity'                 => 'Quantité',
                'reason'                   => 'Raison',
                'rma-not-available-quotes' => 'Article non disponible pour le RMA',
                'product-name'             => 'Nom du produit',
                'reopen-request'           => 'Rouvrir la demande',
                'save'                     => 'Enregistrer',
                'cancel'                   => 'Annuler',
                'reopen-request'           => 'Rouvrir la demande',
            ],

            'index' => [
                'create'  => 'Demander un nouveau RMA',
                'heading' => 'Panneau RMA client',
                'view'    => 'Voir',
                'edit'    => 'Modifier',
                'delete'  => 'Supprimer',
                'update'  => 'Mettre à jour',
                'guest'   => 'Panneau RMA invité',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Demander un nouveau RMA',
            'heading' => 'Panneau RMA client',
            'view'    => 'Voir',
            'edit'    => 'Modifier',
            'delete'  => 'Supprimer',
            'update'  => 'Mettre à jour',
            'guest'   => 'Panneau RMA invité',
        ],

        'validation' => [
            'orders'       => 'Commandes',
            'resolution'   => 'Résolution',
            'information'  => 'Informations supplémentaires',
            'order-status' => 'Statut de la commande',
            'order-id'     => 'Sélection de commande',
            'close-rma'    => 'Confirmer',
        ],

        'conversation-texts' => [
            'by'       => 'Par',
            'seller'   => 'Vendeur',
            'customer' => 'Client',
            'on'       => 'Sur',
        ],

        'default-option' => [
            'please-select-value' => 'Veuillez sélectionner une valeur',
            'select-quantity'     => 'Sélectionner la quantité',
            'select-reason'       => 'Sélectionner une raison',
            'others'              => 'Autres',
            'select-order-status' => 'Sélectionner le statut de la commande',
            'select-resolution'   => 'Sélectionner une résolution',
            'select-seller'       => 'Sélectionner un vendeur',
            'select-order'        => 'Sélectionner une commande',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Invité',
            'heading'                 => 'Détails du RMA',
            'status'                  => 'Statut',
            'order-id'                => ' ID de la commande :',
            'refund-details'          => 'Détails du remboursement',
            'resolution-type'         => 'Type de résolution :',
            'additional-information'  => 'Informations supplémentaires :',
            'change-rma-status'       => 'Changer le statut du RMA',
            'save-btn'                => 'Enregistrer',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Envoyer',
            'items-requested-for-rma' => 'Article(s) demandé(s) pour RMA',
            'refund-offline-btn'      => 'Remboursement hors ligne',
            'send-message'            => 'Envoyer un message',
            'conversations'           => 'Conversations',
            'cancel-order'            => 'Annuler la commande',
            'status-details'          => 'Détails du statut',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Veuillez accepter pour le marquer comme résolu.',
            'close-rma'               => 'Fermer le RMA :',
            'images'                  => 'Images',
            'items-request'           => 'Article(s) demandé(s) pour RMA',
            'refundable-amount'       => 'Montant remboursable',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Type de résolution :',
            'guest'                  => 'Vous',
            'status'                 => 'Statut',
            'order-id'               => ' ID de la commande :',
            'additional-information' => 'Informations supplémentaires :',
            'save-btn'               => 'Enregistrer',
            'send-message-btn'       => 'Envoyer',
            'refund-offline-btn'     => 'Remboursement hors ligne',
            'send-message'           => 'Envoyer un message',
            'conversations'          => 'Conversations',
            'status-details'         => 'Détails du statut',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Veuillez accepter pour le marquer comme résolu.',
            'close-rma'              => 'Fermer le RMA',
            'images'                 => 'Images',
            'items-request'          => 'Article(s) demandé(s) pour RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Statut du RMA :',
            'order-status' => 'Statut de la commande :',
            'full-amount'  => 'Montant total',
            'request-on'   => 'Demandé le :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Fermer le RMA',
            'rma-status'              => 'Statut du RMA :',
            'admin-status'            => 'Statut de l\'admin :',
            'order-status'            => 'Statut de la commande :',
            'consignment-no'          => 'Numéro de suivi :',
            'refundable-amount'       => 'Montant remboursable :',
            'full-amount'             => 'Montant total',
            'partial-amount'          => 'Montant partiel',
            'total-refundable-amount' => 'Montant total remboursable :',
            'enter-message'           => 'Entrer un message',
            'request-on'              => 'Demandé le :',
            'seller'                  => 'Vendeur',
            'order-details'           => 'Détails de la commande',
        ],

        'table-heading' => [
            'product-name' => 'Nom du produit',
            'sku'          => 'SKU',
            'price'        => 'Prix',
            'qty'          => 'Qté',
            'reason'       => 'Raison',
        ],

        'guest-users' => [
            'heading'     => 'Panneau de connexion invité',
            'order-id'    => 'ID de la commande',
            'email'       => 'Email',
            'button-text' => 'Connexion',
            'title'       => 'Connexion invité',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Demande de RMA',
            'hello'                  => 'Cher :name',
            'greeting'               => 'Vous avez demandé un nouveau RMA pour la commande :order_id.',
            'rma-id'                 => 'ID RMA :',
            'summary'                => 'Résumé du RMA de la commande',
            'order-id'               => 'ID de la commande :',
            'order-status'           => 'Statut de la commande :',
            'resolution-type'        => 'Type de résolution :',
            'additional-information' => 'Informations supplémentaires :',
            'thank-you'              => 'Merci',
            'requested-rma-product'  => 'Produit demandé pour le RMA :',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nom du produit',
            'sku'          => 'Sku',
            'qty'          => 'Qté',
            'reason'       => 'Raison',
        ],

        'customer-conversation' => [
            'heading' => 'Cher :name,',
            'quotes'  => 'Il y a un nouveau message de l\'acheteur',
            'message' => 'Message',
        ],

        'seller-conversation' => [
            'heading' => 'Cher :name',
            'quotes'  => 'Il y a un nouveau message du vendeur',
            'message' => 'Message',
            'title'   => 'Message reçu !',
        ],

        'status' => [
            'heading'       => 'Cher :name',
            'quotes'        => 'Le statut de votre RMA a été modifié par le vendeur',
            'rma-id'        => 'ID RMA',
            'your-rma-id'   => 'Votre ID RMA',
            'status-change' => ':id a modifié le statut',
            'status'        => 'Statut',
            'title'         => 'Statut mis à jour !',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'En attente',
            'processing'               => 'En cours de traitement',
            'item-canceled'            => 'Article annulé',
            'solved'                   => 'Résolu',
            'declined'                 => 'Refusé',
            'received-package'         => 'Colis reçu',
            'dispatched-package'       => 'Colis expédié',
            'not-received-package-yet' => 'Colis non reçu',
            'accept'                   => 'Accepter',
        ],

        'status-quotes' => [
            'declined-admin'  => 'Le RMA est refusé par l\'admin.',
            'declined-buyer'  => 'Le RMA est refusé par l\'acheteur.',
            'solved'          => 'Le RMA est résolu.',
            'solved-by-admin' => 'Le RMA est résolu par l\'admin.',
        ],
    ],

    'response' => [
        'create-success' => ':name créé avec succès.',
        'send-message'   => ':name envoyé avec succès.',
        'update-success' => ':name mis à jour avec succès.',
    ],
];
