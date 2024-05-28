<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Permitir novo pedido de RMA para pedido pendente',
                        'allow-rma-for-digital-product'       => 'Permitir RMA para produtos digitais',
                        'default-allow-days'                  => 'Dias permitidos padrão',
                        'enable'                              => 'Ativar RMA',
                        'info'                                => 'O RMA faz parte do processo de devolução de um produto a uma empresa para receber um reembolso, substituição ou reparo.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'A funcionalidade do RMA permite lidar com situações em que um cliente devolve itens para reparo e manutenção, ou para reembolso ou substituição.',
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
                    'rma-title'        => 'Todos os RMA',
                    'reason-title'     => 'Motivos',
                    'create-rma-title' => 'Criar RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Todos os RMA',

                        'datagrid' => [
                            'id'        => 'ID do RMA',
                            'order-ref' => 'Ref. do Pedido',
                            'status'    => 'Status',
                            'create'    => 'Criado em',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID do Pedido:',
                        'request-on'             => 'Solicitado em:',
                        'customer'               => 'Cliente:',
                        'resolution-type'        => 'Tipo de Resolução:',
                        'additional-information' => 'Informações Adicionais:',
                        'images'                 => 'Imagem:',
                        'order-details'          => 'Detalhes do Pedido',
                        'status'                 => 'Status',
                        'rma-status'             => 'Status do RMA:',
                        'order-status'           => 'Status do Pedido:',
                        'change-status'          => 'Alterar Status',
                        'conversations'          => 'Conversas',
                        'save-btn'               => 'Salvar',
                        'send-message'           => 'Enviar Mensagem',
                        'enter-message'          => 'Digite a mensagem',
                        'send-message-btn'       => 'Enviar Mensagem',
                        'send-message-success'   => 'Mensagem enviada com sucesso.',
                        'update-success'         => 'Status do RMA atualizado com sucesso.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Motivos',
                        'create-btn' => 'Criar Motivo de RMA',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Motivo',
                            'status'              => 'Status',
                            'created-at'          => 'Criado em',
                            'enabled'             => 'Ativado',
                            'disabled'            => 'Desativado',
                            'delete-success'      => 'Motivo excluído com sucesso.',
                            'mass-delete-success' => 'Exclusão em massa do RMA realizada com sucesso.',
                            'reason-error'        => 'O motivo é usado no RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Adicionar Novo Motivo',
                        'save-btn'       => 'Salvar Motivo',
                        'reason'         => 'Motivo',
                        'status'         => 'Status',
                        'create-success' => 'Motivo criado com sucesso.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Motivo',
                        'save-btn'            => 'Salvar Motivo',
                        'reason'              => 'Motivo',
                        'status'              => 'Status',
                        'mass-update-success' => 'Motivos selecionados atualizados com sucesso.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Criar RMA',
                    'order-id'          => 'ID do Pedido',
                    'email'             => 'E-mail',
                    'validate'          => 'Validar',
                    'rma-already-exist' => 'RMA já existe',
                    'mismatch'          => 'ID do pedido e e-mail não correspondem',
                    'invalid-order-id'  => 'ID do pedido inválido',
                    'quantity'          => 'Quantidade',
                    'reason'            => 'Motivo',
                    'save-btn'          => 'Salvar',
                    'create-success'    => 'RMA criado com sucesso.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'Devolução de RMA',
            'offer'        => 'Receba até 40% DE DESCONTO no seu 1º pedido',
            'shop-now'     => 'COMPRE AGORA',

            'create' => [
                'heading'                  => 'Novo Pedido de RMA',
                'create-btn'               => 'Salvar',
                'orders'                   => 'Pedidos',
                'resolution'               => 'Selecione a Resolução',
                'item-ordered'             => 'Item Pedido',
                'images'                   => 'Imagens',
                'information'              => 'Informações Adicionais',
                'order-status'             => 'Status do Pedido',
                'product'                  => 'Produto',
                'sku'                      => 'SKU',
                'price'                    => 'Preço',
                'search-order'             => 'Buscar Pedido',
                'enter-order-id'           => 'Digite o ID do Pedido',
                'not-allowed'              => 'RMA não é permitido para pedido pendente',
                'image'                    => 'Imagem',
                'quantity'                 => 'Quantidade',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Item não disponível para RMA',
                'product-name'             => 'Nome do Produto',
                'reopen-request'           => 'Reabrir Solicitação',
                'save'                     => 'Salvar',
                'cancel'                   => 'Cancelar',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'Status RMA:',
                'order-status' => 'Status do Pedido:',
                'close-rma'    => 'Fechar RMA:',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Novo Pedido de RMA',
                'create-btn'               => 'Salvar',
                'orders'                   => 'Pedidos',
                'resolution'               => 'Selecione a Resolução',
                'item-ordered'             => 'Item Pedido',
                'images'                   => 'Imagens',
                'information'              => 'Informações Adicionais',
                'order-status'             => 'Status do Pedido',
                'product'                  => 'Produto',
                'sku'                      => 'SKU',
                'price'                    => 'Preço',
                'search-order'             => 'Buscar Pedido',
                'enter-order-id'           => 'Digite o ID do Pedido',
                'not-allowed'              => 'RMA não é permitido para pedido pendente',
                'image'                    => 'Imagem',
                'quantity'                 => 'Quantidade',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Item não disponível para RMA',
                'product-name'             => 'Nome do Produto',
                'reopen-request'           => 'Reabrir Solicitação',
                'save'                     => 'Salvar',
                'cancel'                   => 'Cancelar',
                'reopen-request'           => 'Reabrir Solicitação',
            ],

            'index' => [
                'create'  => 'Solicitar novo RMA',
                'heading' => 'Painel de RMA do Cliente',
                'view'    => 'Ver',
                'edit'    => 'Editar',
                'delete'  => 'Excluir',
                'update'  => 'Atualizar',
                'guest'   => 'Painel de RMA do Visitante',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Solicitar novo RMA',
            'heading' => 'Painel de RMA do Cliente',
            'view'    => 'Ver',
            'edit'    => 'Editar',
            'delete'  => 'Excluir',
            'update'  => 'Atualizar',
            'guest'   => 'Painel de RMA do Visitante',
        ],

        'validation' => [
            'orders'       => 'Pedidos',
            'resolution'   => 'Resolução',
            'information'  => 'Informações Adicionais',
            'order-status' => 'Status do Pedido',
            'order-id'     => 'Seleção do Pedido',
            'close-rma'    => 'Confirmar',
        ],

        'conversation-texts' => [
            'by'       => 'Por',
            'seller'   => 'Vendedor',
            'customer' => 'Cliente',
            'on'       => 'Em',
        ],

        'default-option' => [
            'please-select-value' => 'Por favor, selecione o valor',
            'select-quantity'     => 'Selecionar Quantidade',
            'select-reason'       => 'Selecionar Motivo',
            'others'              => 'Outros',
            'select-order-status' => 'Selecionar Status do Pedido',
            'select-resolution'   => 'Selecionar Resolução',
            'select-seller'       => 'Selecionar Vendedor',
            'select-order'        => 'Selecionar Pedido',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Visitante',
            'heading'                 => 'Detalhes do RMA',
            'status'                  => 'Status',
            'order-id'                => ' ID do Pedido:',
            'refund-details'          => 'Detalhes do Reembolso',
            'resolution-type'         => 'Tipo de Resolução:',
            'additional-information'  => 'Informações Adicionais:',
            'change-rma-status'       => 'Alterar Status do RMA',
            'save-btn'                => 'Salvar',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Enviar',
            'items-requested-for-rma' => 'Item(s) Solicitado(s) para RMA',
            'refund-offline-btn'      => 'Reembolso Offline',
            'send-message'            => 'Enviar Mensagem',
            'conversations'           => 'Conversas',
            'cancel-order'            => 'Cancelar Pedido',
            'status-details'          => 'Detalhes do Status',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Por favor, concorde para marcá-lo como resolvido.',
            'close-rma'               => 'Fechar RMA:',
            'images'                  => 'Imagens',
            'items-request'           => 'Item(s) Solicitado(s) para RMA',
            'refundable-amount'       => 'Valor Reembolsável',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Tipo de Resolução:',
            'guest'                  => 'Você',
            'status'                 => 'Status',
            'order-id'               => ' ID do Pedido:',
            'additional-information' => 'Informações Adicionais:',
            'save-btn'               => 'Salvar',
            'send-message-btn'       => 'Enviar',
            'refund-offline-btn'     => 'Reembolso Offline',
            'send-message'           => 'Enviar Mensagem',
            'conversations'          => 'Conversas',
            'status-details'         => 'Detalhes do Status',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Por favor, concorde para marcá-lo como resolvido.',
            'close-rma'              => 'Fechar RMA',
            'images'                 => 'Imagens',
            'items-request'          => 'Item(s) Solicitado(s) para RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Status RMA:',
            'order-status' => 'Status do Pedido:',
            'full-amount'  => 'Valor Total',
            'request-on'   => 'Solicitado em:',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Fechar RMA',
            'rma-status'              => 'Status RMA:',
            'admin-status'            => 'Status do Admin:',
            'order-status'            => 'Status do Pedido:',
            'consignment-no'          => 'Número do Consignação:',
            'refundable-amount'       => 'Valor Reembolsável:',
            'full-amount'             => 'Valor Total',
            'partial-amount'          => 'Valor Parcial',
            'total-refundable-amount' => 'Valor Total Reembolsável:',
            'enter-message'           => 'Digite a Mensagem',
            'request-on'              => 'Solicitado em:',
            'seller'                  => 'Vendedor',
            'order-details'           => 'Detalhes do Pedido',
        ],

        'table-heading' => [
            'product-name' => 'Nome do Produto',
            'sku'          => 'SKU',
            'price'        => 'Preço',
            'qty'          => 'Quantidade',
            'reason'       => 'Motivo',
        ],

        'guest-users' => [
            'heading'     => 'Painel de Login do Visitante',
            'order-id'    => 'ID do Pedido',
            'email'       => 'E-mail',
            'button-text' => 'Login',
            'title'       => 'Login do Visitante',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Solicitação de RMA',
            'hello'                  => 'Prezado(a) :name',
            'greeting'               => 'Você solicitou um novo RMA para o pedido :order_id.',
            'rma-id'                 => 'ID do RMA:',
            'summary'                => 'Resumo do RMA do Pedido',
            'order-id'               => 'ID do Pedido:',
            'order-status'           => 'Status do Pedido:',
            'resolution-type'        => 'Tipo de Resolução:',
            'additional-information' => 'Informações Adicionais:',
            'thank-you'              => 'Obrigado',
            'requested-rma-product'  => 'Produto(s) Solicitado(s) para RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nome do Produto',
            'sku'          => 'Sku',
            'qty'          => 'Qty',
            'reason'       => 'Motivo',
        ],

        'customer-conversation' => [
            'heading' => 'Prezado(a) :name,',
            'quotes'  => 'Há uma nova mensagem do Comprador',
            'message' => 'Mensagem',
        ],

        'seller-conversation' => [
            'heading' => 'Prezado(a) :name',
            'quotes'  => 'Há uma nova mensagem do Vendedor',
            'message' => 'Mensagem',
            'title'   => 'Mensagem Recebida!',
        ],

        'status' => [
            'heading'       => 'Prezado(a) :name',
            'quotes'        => 'Seu status de RMA foi alterado pelo Vendedor',
            'rma-id'        => 'ID do RMA',
            'your-rma-id'   => 'Seu ID de RMA',
            'status-change' => ':id status foi alterado pelo Vendedor',
            'status'        => 'Status',
            'title'         => 'Status Atualizado!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Pendente',
            'processing'               => 'Processando',
            'item-canceled'            => 'Item Cancelado',
            'solved'                   => 'Resolvido',
            'declined'                 => 'Recusado',
            'received-package'         => 'Pacote Recebido',
            'dispatched-package'       => 'Pacote Despachado',
            'not-received-package-yet' => 'Ainda não recebeu o pacote',
            'accept'                   => 'Aceitar',
        ],

        'status-quotes' => [
            'declined-admin'  => 'O RMA foi recusado pelo Admin.',
            'declined-buyer'  => 'O RMA foi recusado pelo Comprador.',
            'solved'          => 'O RMA foi resolvido.',
            'solved-by-admin' => 'O RMA foi resolvido pelo admin.',
        ],
    ],

    'response' => [
        'create-success'    => ':name criado com sucesso.',
        'send-message'      => ':name enviado com sucesso.',
        'update-success'    => ':name atualizado com sucesso.',
        'permission-denied' => 'Você está logado',
    ],
];
