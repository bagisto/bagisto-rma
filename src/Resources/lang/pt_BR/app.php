<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Tarde',
                        'all-products'                        => 'Todos os produtos',
                        'all-status'                          => 'Todos os status',
                        'allow-new-request-for-pending-order' => 'Permitir nova solicitação de RMA para pedido pendente',
                        'allow-rma-for-digital-product'       => 'Permitir RMA para produto digital',
                        'allowed-file-extension'              => 'Extensão de arquivo permitida',
                        'allowed-file-types'                  => 'Por favor, selecione apenas os tipos de arquivo ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'), 
                        'allowed-info'                        => 'Separado por vírgulas. Por exemplo: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Permitir nova solicitação de RMA para solicitação cancelada',
                        'allowed-request-declined-request'    => 'Permitir nova solicitação de RMA para solicitação recusada',
                        'allowed-rma-for-product'             => 'Permitir RMA para produto',
                        'cancel-items'                        => 'Cancelar itens',
                        'complete'                            => 'Completo',
                        'current-order-quantity'              => 'Quantidade atual do pedido',
                        'days-info'                           => 'O número de dias dentro dos quais o cliente pode solicitar um RMA após fazer um pedido.',
                        'default-allow-days'                  => 'Dias permitidos por padrão',
                        'enable'                              => 'Habilitar RMA',
                        'evening'                             => 'Noite',
                        'exchange'                            => 'Troca',
                        'info'                                => 'RMA faz parte do processo de devolução de um produto a uma empresa para receber um reembolso, substituição ou reparo.',
                        'morning'                             => 'Manhã',
                        'new-rma-message-to-customer'         => 'Nova mensagem de RMA para o cliente',
                        'no'                                  => 'Não',
                        'open'                                => 'Aberto',
                        'package-condition'                   => 'Condição do pacote',
                        'packed'                              => 'Embalado',
                        'print-page'                          => 'Imprimir Página',
                        'product-already-raw'                 => 'Produto já está no RMA.',
                        'product-delivery-status'             => 'Status da entrega do produto',
                        'resolution-type'                     => 'Tipo de resolução',
                        'return-pickup-address'               => 'Endereço de coleta de devolução',
                        'return-pickup-time'                  => 'Hora da coleta de devolução',
                        'return-policy'                       => 'Política de devolução',
                        'return'                              => 'Retorno',
                        'select-allowed-order-status'         => 'Selecione o status do pedido permitido',
                        'specific-products'                   => 'Produtos específicos',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Sim',

                        'setting' => [
                            'info'  => 'A funcionalidade de RMA permite lidar com situações em que um cliente devolve itens para reparo e manutenção, ou para reembolso ou substituição.',
                            'read'  => 'Ler política',
                            'terms' => 'Li e aceitei a política de devolução.',
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
                    'rma-title'        => 'Todos os RMAs',
                    'reason-title'     => 'Motivos',
                    'create-rma-title' => 'Criar RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Todos os RMAs',

                        'datagrid' => [
                            'id'            => 'ID do RMA',
                            'order-ref'     => 'Referência do Pedido',
                            'customer-name' => 'Nome do Cliente',
                            'rma-status'    => 'Status do RMA',
                            'order-status'  => 'Status do Pedido',
                            'create'        => 'Criado em',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Adicionar anexos',
                        'additional-information' => 'Informações adicionais:',
                        'attachment'             => 'Anexo',
                        'change-status'          => 'Alterar status',
                        'confirm-print'          => 'Clique em OK para imprimir o RMA',
                        'conversations'          => 'Conversas',
                        'customer-details'       => 'Detalhes do cliente',
                        'customer-email'         => 'Email do cliente:',
                        'customer'               => 'Cliente:',
                        'enter-message'          => 'Inserir mensagem',
                        'images'                 => 'Imagem:',
                        'no-record'              => 'Nenhum registro encontrado!',
                        'order-date'             => 'Data do pedido:',
                        'order-details'          => 'Item(ns) solicitado(s) para RMA',
                        'order-id'               => 'ID do pedido:',
                        'order-status'           => 'Status do pedido:',
                        'order-total'            => 'Total do pedido:',
                        'request-on'             => 'Solicitação em:',
                        'resolution-type'        => 'Tipo de resolução:',
                        'rma-status'             => 'Status do RMA:',
                        'save-btn'               => 'Salvar',
                        'send-message-btn'       => 'Enviar mensagem',
                        'send-message-success'   => 'Mensagem enviada com sucesso.',
                        'send-message'           => 'Enviar mensagem',
                        'status'                 => 'Status',
                        'title'                  => 'RMA',
                        'update-success'         => 'Status do RMA atualizado com sucesso.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Criar Status de RMA',
                        'title'      => 'Status de RMA',

                        'datagrid' => [
                            'created-at'          => 'Criado em',
                            'delete-success'      => 'Status de RMA excluído com sucesso.',
                            'disabled'            => 'Inativo',
                            'enabled'             => 'Ativo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Status de RMA selecionado excluído com sucesso.',
                            'reason-error'        => 'Status de RMA está sendo usado em RMA.',
                            'reason'              => 'Status de RMA',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Adicionar Novo Status de RMA',
                        'reason'       => 'Status de RMA',
                        'save-btn'     => 'Salvar Status de RMA',
                        'status'       => 'Status',
                        'success'      => 'Status de RMA criado com sucesso.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Status de RMA',
                        'mass-update-success' => 'Status de RMA selecionado atualizado com sucesso.',
                        'reason'              => 'Status de RMA',
                        'save-btn'            => 'Salvar Status de RMA',
                        'status'              => 'Status',
                        'success'             => 'Status de RMA atualizado com sucesso.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Motivos',
                        'create-btn' => 'Criar Motivo de RMA',

                        'datagrid' => [
                            'created-at'          => 'Criado em',
                            'delete-success'      => 'Motivo excluído com sucesso.',
                            'disabled'            => 'Inativo',
                            'enabled'             => 'Ativo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dados selecionados excluídos com sucesso.',
                            'reason-error'        => 'O motivo está sendo usado em RMA.',
                            'reason'              => 'Motivo',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Adicionar Novo Motivo',
                        'reason'       => 'Motivo',
                        'save-btn'     => 'Salvar Motivo',
                        'status'       => 'Status',
                        'success'      => 'Motivo criado com sucesso.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Motivo',
                        'mass-update-success' => 'Motivos selecionados atualizados com sucesso.',
                        'reason'              => 'Motivo',
                        'save-btn'            => 'Salvar Motivo',
                        'status'              => 'Status',
                        'success'             => 'Motivo atualizado com sucesso.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Adicionar Novo Campo',
                        'title'      => 'Campos Personalizados RMA',

                        'datagrid' => [
                            'created-at'          => 'Criado em',
                            'delete-success'      => 'Campos personalizados excluídos com sucesso.',
                            'disabled'            => 'Inativo',
                            'enabled'             => 'Ativo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dados selecionados excluídos com sucesso',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Novo Campo Personalizado',
                        'save-btn'     => 'Salvar Campo Personalizado',
                        'status'       => 'Status',
                        'success'      => 'Campo personalizado criado com sucesso.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Campo Personalizado',
                        'mass-update-success' => 'Campos personalizados selecionados atualizados com sucesso.',
                        'reason'              => 'Campo Personalizado',
                        'save-btn'            => 'Salvar Campo Personalizado',
                        'status'              => 'Status',
                        'success'             => 'Campo personalizado atualizado com sucesso.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Criar Regras RMA',
                        'title'      => 'Regras RMA',

                        'datagrid' => [
                            'delete-success'      => 'Regras RMA excluídas com sucesso.',
                            'disabled'            => 'Inativo',
                            'enabled'             => 'Ativo',
                            'exchange-period'     => 'Período de Troca (dias)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Dados selecionados excluídos com sucesso.',
                            'reason'              => 'Regras',
                            'return-period'       => 'Período de Retorno (dias)',
                            'status'              => 'Status',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Adicionar Novas Regras RMA',
                        'reason'             => 'Regras RMA',
                        'resolutions-period' => 'Período de Resoluções',
                        'rule-description'   => 'Descrição das Regras',
                        'rule-details'       => 'Detalhes das Regras',
                        'rules-title'        => 'Título das Regras',
                        'save-btn'           => 'Salvar Regras RMA',
                        'status'             => 'Status RMA',
                        'success'            => 'Regras RMA criadas com sucesso.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Regras RMA',
                        'mass-update-success' => 'Regras RMA selecionadas atualizadas com sucesso.',
                        'reason'              => 'Regras RMA',
                        'save-btn'            => 'Atualizar Regras RMA',
                        'status'              => 'Status',
                        'success'             => 'Regras RMA atualizadas com sucesso.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA criado com sucesso.',
                    'create-title'             => 'Criar RMA',
                    'email'                    => 'E-mail',
                    'image'                    => 'Imagem',
                    'invalid-order-id'         => 'ID do Pedido inválido',
                    'mismatch'                 => 'ID do Pedido e e-mail não correspondem',
                    'new-rma'                  => 'Novo RMA',
                    'order-id'                 => 'ID do Pedido',
                    'quantity'                 => 'Quantidade',
                    'reason'                   => 'Motivo',
                    'rma-already-exist'        => 'RMA já existe',
                    'rma-not-available-quotes' => 'Item não disponível para RMA',
                    'save-btn'                 => 'Salvar',
                    'search'                   => '--Selecione--',
                    'validate'                 => 'Validar',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'RMA foi criado com sucesso',
                    'rma-created-message'  => 'Uma solicitação de RMA está disponível para o produto com uma quantidade de :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Excluir',
            'edit'        => 'Editar',
            'mass-delete' => 'Excluir em Massa',
            'mass-update' => 'Atualizar em Massa',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Entregue',
            'menu-name'    => 'RMA',
            'offer'        => 'GANHE ATÉ 40% DE DESCONTO no seu primeiro pedido',
            'rma-qty'      => 'Quantidade RMA',
            'shop-now'     => 'COMPRE AGORA',
            'submit-req'   => 'Enviar pedido',
            'title'        => 'RMA',
            'undelivered'  => 'Não entregue',

            'create' => [
                'cancel'                   => 'Cancelar',
                'create-btn'               => 'Salvar',
                'enter-order-id'           => 'Digite o ID do Pedido',
                'heading'                  => 'Novo Pedido de RMA',
                'exchange-window'          => 'Janela de troca',
                'image'                    => 'Imagem',
                'images'                   => 'Imagens',
                'information'              => 'Informações Adicionais',
                'item-ordered'             => 'Item Pedido',
                'no-record'                => 'Nenhum registro encontrado!',
                'not-allowed'              => 'RMA não permitido para pedidos pendentes',
                'order-status'             => 'Status do Pedido',
                'orders'                   => 'Pedidos',
                'price'                    => 'Preço',
                'product-name'             => 'Nome do Produto',
                'product'                  => 'Produto',
                'quantity'                 => 'Quantidade',
                'reason'                   => 'Motivo',
                'reopen-request'           => 'Reabrir Solicitação',
                'resolution'               => 'Selecione a Resolução',
                'return-window'            => 'Janela de Devolução',
                'rma-not-available-quotes' => 'Item não disponível para RMA',
                'save'                     => 'Salvar',
                'search-order'             => 'Buscar Pedido',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Fechar RMA:',
                'order-status' => 'Status do Pedido:',
                'rma-status'   => 'Status do RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Cancelar',
                'create-btn'               => 'Salvar',
                'enter-order-id'           => 'Digite o ID do Pedido',
                'heading'                  => 'Novo Pedido de RMA',
                'image'                    => 'Imagem',
                'images'                   => 'Imagens',
                'information'              => 'Informações Adicionais',
                'item-ordered'             => 'Item Pedido',
                'not-allowed'              => 'RMA não permitido para pedidos pendentes',
                'order-status'             => 'Status do Pedido',
                'orders'                   => 'Pedidos',
                'price'                    => 'Preço',
                'product-name'             => 'Nome do Produto',
                'product'                  => 'Produto',
                'quantity'                 => 'Quantidade',
                'reason'                   => 'Motivo',
                'reopen-request'           => 'Reabrir Solicitação',
                'resolution'               => 'Selecione a Resolução',
                'rma-not-available-quotes' => 'Item não disponível para RMA',
                'save'                     => 'Salvar',
                'search-order'             => 'Buscar Pedido',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Solicitar novo RMA',
                'delete'  => 'Excluir',
                'edit'    => 'Editar',
                'guest'   => 'Painel RMA para Convidados',
                'heading' => 'Painel RMA para Convidados',
                'update'  => 'Atualizar',
                'view'    => 'Ver',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Criar',
            'delete'  => 'Excluir',
            'edit'    => 'Editar',
            'guest'   => 'Painel RMA para Convidados',
            'heading' => 'RMA',
            'update'  => 'Atualizar',
            'view'    => 'Ver',
        ],

        'validation' => [
            'close-rma'     => 'Confirmar',
            'information'   => 'Informações Adicionais',
            'order-id'      => 'Seleção de Pedido',
            'order-status'  => 'Status do Pedido',
            'orders'        => 'Pedidos',
            'resolution'    => 'Resolução',
            'select-orders' => 'Selecione o Pedido',
        ],

        'conversation-texts' => [
            'by'        => 'Por',
            'customer'  => 'Cliente',
            'no-record' => 'Nenhum registro encontrado!',
            'on'        => 'Em',
            'seller'    => 'Vendedor',
        ],

        'default-option' => [
            'others'              => 'Outros',
            'please-select-value' => 'Selecione um Valor',
            'select-order-status' => 'Selecione o Status do Pedido',
            'select-order'        => 'Selecione o Pedido',
            'select-quantity'     => 'Selecione a Quantidade',
            'select-reason'       => 'Selecione o Motivo',
            'select-resolution'   => 'Selecione a Resolução',
            'select-seller'       => 'Selecione o Vendedor',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Informações Adicionais:',
            'admin'                   => 'Administrador',
            'cancel-order'            => 'Cancelar Pedido',
            'change-rma-status'       => 'Alterar Status do RMA',
            'close-rma'               => 'Fechar RMA:',
            'conversations'           => 'Conversas',
            'guest'                   => 'Convidado',
            'heading'                 => 'Detalhes do RMA',
            'images'                  => 'Imagens:',
            'items-request'           => 'Item(s) Solicitado(s) para RMA',
            'items-requested-for-rma' => 'Item(s) Solicitado(s) para RMA',
            'order-id'                => 'ID do Pedido:',
            'refund-details'          => 'Detalhes do Reembolso',
            'refund-offline-btn'      => 'Reembolso Offline',
            'refundable-amount'       => 'Valor Reembolsável',
            'resolution-type'         => 'Tipo de Resolução:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Salvar',
            'send-message-btn'        => 'Enviar',
            'send-message'            => 'Enviar Mensagem',
            'status-details'          => 'Detalhes do Status',
            'status-quotes'           => 'Por favor, concorde para marcar como resolvido',
            'status-reopen'           => 'Marque para reabrir',
            'status'                  => 'Status',
            'term'                    => 'Concordância com o campo de marcação é necessária',
            'you'                     => 'Administrador',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Informações Adicionais:',
            'admin'                  => 'Administrador',
            'close-rma'              => 'Fechar RMA',
            'conversations'          => 'Conversas',
            'guest'                  => 'Você',
            'images'                 => 'Imagens',
            'items-request'          => 'Item(s) Solicitado(s) para RMA',
            'order-id'               => ' ID do Pedido:',
            'refund-offline-btn'     => 'Reembolso Offline',
            'resolution-type'        => 'Tipo de Resolução:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Salvar',
            'send-message-btn'       => 'Enviar',
            'send-message'           => 'Enviar Mensagem',
            'status-details'         => 'Detalhes do Status',
            'status-quotes'          => 'Por favor, concorde para marcar como resolvido.',
            'status'                 => 'Status',
            'term'                   => 'Concordância com o campo de marcação é necessária',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Valor Total',
            'order-status' => 'Status do Pedido:',
            'request-on'   => 'Solicitado em:',
            'rma-status'   => 'Status do RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Status do Administrador:',
            'close-rma'               => 'Fechar RMA',
            'consignment-no'          => 'Número do Consignado:',
            'enter-message'           => 'Digite a Mensagem',
            'full-amount'             => 'Valor Total',
            'order-details'           => 'Detalhes do Pedido',
            'order-status'            => 'Status do Pedido:',
            'partial-amount'          => 'Valor Parcial',
            'refundable-amount'       => 'Valor Reembolsável:',
            'request-on'              => 'Solicitado em:',
            'rma-status'              => 'Status do RMA:',
            'seller'                  => 'Vendedor',
            'total-refundable-amount' => 'Valor Total Reembolsável:',
        ],

        'table-heading' => [
            'image'           => 'Imagem',
            'order-qty'       => 'Quantidade do pedido',
            'price'           => 'Preço',
            'product-name'    => 'Nome do produto',
            'reason'          => 'Motivo',
            'resolution-type' => 'Tipo de resolução',
            'rma-qty'         => 'Quantidade RMA',
            'sku'             => 'SKU',
        ],

        'guest-users' => [
            'button-text' => 'Entrar',
            'email'       => 'E-mail',
            'heading'     => 'Painel de Login para Convidados',
            'logout'      => 'Logout de visitante',
            'order-id'    => 'ID do Pedido',
            'title'       => 'Login de Convidados',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Informações Adicionais:',
            'greeting'               => 'Você solicitou um novo RMA para o pedido :order_id.',
            'heading'                => 'Pedido de RMA',
            'hello'                  => 'Prezado(a) :name',
            'order-id'               => 'ID do Pedido:',
            'order-status'           => 'Status do Pedido:',
            'requested-rma-product'  => 'Produto solicitado para RMA:',
            'resolution-type'        => 'Tipo de Resolução:',
            'rma-id'                 => 'ID do RMA:',
            'summary'                => 'Resumo do RMA do Pedido',
            'thank-you'              => 'Obrigado',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nome do Produto',
            'qty'          => 'Quantidade',
            'reason'       => 'Motivo',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'Prezado(a) :name,',
            'message' => 'Mensagem',
            'process' => 'Sua solicitação de devolução está em andamento.',
            'quotes'  => 'Há uma nova mensagem do comprador',
            'solved'  => 'O status do RMA foi alterado para Resolvido pelo cliente.',
        ],

        'seller-conversation' => [
            'heading' => 'Prezado(a) :name',
            'message' => 'Mensagem',
            'quotes'  => 'Há uma nova mensagem do administrador',
            'title'   => 'Mensagem Recebida!',
        ],

        'status' => [
            'heading'       => 'Prezado(a) :name',
            'quotes'        => 'O status do seu RMA foi alterado pelo vendedor',
            'rma-id'        => 'ID do RMA',
            'status-change' => ':id teve seu status alterado pelo vendedor',
            'status'        => 'Status',
            'title'         => 'Status Atualizado!',
            'your-rma-id'   => 'Seu ID do RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Aceitar',
            'awaiting'                 => 'Aguardando',
            'canceled'                 => 'Cancelado',
            'declined'                 => 'Recusado',
            'dispatched-package'       => 'Pacote Enviado',
            'item-canceled'            => 'Item Cancelado',
            'not-received-package-yet' => 'Ainda não recebido o pacote',
            'pending'                  => 'Pendente',
            'processing'               => 'Processando',
            'received-package'         => 'Pacote Recebido',
            'solved'                   => 'Resolvido',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA foi recusado pelo administrador.',
            'declined-buyer'  => 'RMA foi recusado pelo comprador.',
            'solved-by-admin' => 'RMA foi resolvido pelo administrador.',
            'solved'          => 'RMA foi resolvido.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'O status do RMA já foi cancelado.',
        'cancel-success'    => 'Status de RMA cancelado com sucesso.',
        'create-success'    => 'Solicitação criada com sucesso.',
        'creation-error'    => 'O status do RMA não pode ser atualizado, pois a fatura para este pedido não foi criada.',
        'permission-denied' => 'Você está logado',
        'rma-disabled'      => 'RMA está desativado para este produto',
        'send-message'      => ':name enviado com sucesso.',
        'update-success'    => ':name atualizado com sucesso.',
    ],
];