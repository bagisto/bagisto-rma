<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Permitir nueva solicitud de RMA para pedidos pendientes',
                        'allow-rma-for-digital-product'       => 'Permitir RMA para productos digitales',
                        'default-allow-days'                  => 'Días permitidos por defecto',
                        'enable'                              => 'Activar RMA',
                        'info'                                => 'El RMA es parte del proceso de devolución de un producto a un negocio para recibir un reembolso, reemplazo o reparación.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'La funcionalidad de RMA permite manejar situaciones cuando un cliente devuelve artículos para reparación y mantenimiento, o para reembolso o reemplazo.',
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
                    'rma-title'        => 'Todos los RMA',
                    'reason-title'     => 'Motivos',
                    'create-rma-title' => 'Crear RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Todos los RMA',

                        'datagrid' => [
                            'id'        => 'ID de RMA',
                            'order-ref' => 'Ref. de Pedido',
                            'status'    => 'Estado',
                            'create'    => 'Creado en',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' ID de Pedido:',
                        'request-on'             => 'Solicitado el:',
                        'customer'               => 'Cliente:',
                        'resolution-type'        => 'Tipo de Resolución:',
                        'additional-information' => 'Información Adicional:',
                        'images'                 => 'Imágenes:',
                        'order-details'          => 'Detalles del Pedido',
                        'status'                 => 'Estado',
                        'rma-status'             => 'Estado de RMA:',
                        'order-status'           => 'Estado del Pedido:',
                        'change-status'          => 'Cambiar Estado',
                        'conversations'          => 'Conversaciones',
                        'save-btn'               => 'Guardar',
                        'send-message'           => 'Enviar Mensaje',
                        'enter-message'          => 'Introducir Mensaje',
                        'send-message-btn'       => 'Enviar Mensaje',
                        'send-message-success'   => 'Mensaje enviado correctamente.',
                        'update-success'         => 'Estado de RMA actualizado correctamente.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Motivos',
                        'create-btn' => 'Crear Motivo de RMA',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Motivo',
                            'status'              => 'Estado',
                            'created-at'          => 'Creado en',
                            'enabled'             => 'Habilitado',
                            'disabled'            => 'Deshabilitado',
                            'delete-success'      => 'Motivo eliminado correctamente.',
                            'mass-delete-success' => 'Eliminación masiva de RMA realizada correctamente.',
                            'reason-error'        => 'El motivo se está utilizando en RMA.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Agregar Nuevo Motivo',
                        'save-btn'       => 'Guardar Motivo',
                        'reason'         => 'Motivo',
                        'status'         => 'Estado',
                        'create-success' => 'Motivo creado correctamente.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Motivo',
                        'save-btn'            => 'Guardar Motivo',
                        'reason'              => 'Motivo',
                        'status'              => 'Estado',
                        'mass-update-success' => 'Los motivos seleccionados se actualizaron correctamente.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'Crear RMA',
                    'order-id'          => 'ID de Pedido',
                    'email'             => 'Email',
                    'validate'          => 'Validar',
                    'rma-already-exist' => 'El RMA ya existe',
                    'mismatch'          => 'ID de Pedido y email no coinciden',
                    'invalid-order-id'  => 'ID de Pedido no válido',
                    'quantity'          => 'Cantidad',
                    'reason'            => 'Motivo',
                    'save-btn'          => 'Guardar',
                    'create-success'    => 'RMA creado correctamente.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'Devolución de RMA',
            'offer'        => 'Obtén HASTA un 40% DE DESCUENTO en tu primer pedido',
            'shop-now'     => 'COMPRA AHORA',

            'create' => [
                'heading'                  => 'Nueva Solicitud de RMA',
                'create-btn'               => 'Guardar',
                'orders'                   => 'Pedidos',
                'resolution'               => 'Seleccionar Resolución',
                'item-ordered'             => 'Producto Pedido',
                'images'                   => 'Imágenes',
                'information'              => 'Información Adicional',
                'order-status'             => 'Estado del Pedido',
                'product'                  => 'Producto',
                'sku'                      => 'SKU',
                'price'                    => 'Precio',
                'search-order'             => 'Buscar Pedido',
                'enter-order-id'           => 'Introducir ID de Pedido',
                'not-allowed'              => 'No se permite RMA para pedidos pendientes',
                'image'                    => 'Imagen',
                'quantity'                 => 'Cantidad',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Artículo no disponible para RMA',
                'product-name'             => 'Nombre del Producto',
                'reopen-request'           => 'Reabrir Solicitud',
                'save'                     => 'Guardar',
                'cancel'                   => 'Cancelar',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'Estado de RMA:',
                'order-status' => 'Estado del Pedido:',
                'close-rma'    => 'Cerrar RMA:',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Nueva Solicitud de RMA',
                'create-btn'               => 'Guardar',
                'orders'                   => 'Pedidos',
                'resolution'               => 'Seleccionar Resolución',
                'item-ordered'             => 'Producto Pedido',
                'images'                   => 'Imágenes',
                'information'              => 'Información Adicional',
                'order-status'             => 'Estado del Pedido',
                'product'                  => 'Producto',
                'sku'                      => 'SKU',
                'price'                    => 'Precio',
                'search-order'             => 'Buscar Pedido',
                'enter-order-id'           => 'Introducir ID de Pedido',
                'not-allowed'              => 'No se permite RMA para pedidos pendientes',
                'image'                    => 'Imagen',
                'quantity'                 => 'Cantidad',
                'reason'                   => 'Motivo',
                'rma-not-available-quotes' => 'Artículo no disponible para RMA',
                'product-name'             => 'Nombre del Producto',
                'reopen-request'           => 'Reabrir Solicitud',
                'save'                     => 'Guardar',
                'cancel'                   => 'Cancelar',
                'reopen-request'           => 'Reabrir Solicitud',
            ],

            'index' => [
                'create'  => 'Solicitar nuevo RMA',
                'heading' => 'Panel de RMA de Cliente',
                'view'    => 'Ver',
                'edit'    => 'Editar',
                'delete'  => 'Eliminar',
                'update'  => 'Actualizar',
                'guest'   => 'Panel de RMA de Invitado',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Solicitar nuevo RMA',
            'heading' => 'Panel de RMA de Cliente',
            'view'    => 'Ver',
            'edit'    => 'Editar',
            'delete'  => 'Eliminar',
            'update'  => 'Actualizar',
            'guest'   => 'Panel de RMA de Invitado',
        ],

        'validation' => [
            'orders'       => 'Pedidos',
            'resolution'   => 'Resolución',
            'information'  => 'Información Adicional',
            'order-status' => 'Estado del Pedido',
            'order-id'     => 'Selección de Pedido',
            'close-rma'    => 'Confirmar',
        ],

        'conversation-texts' => [
            'by'       => 'Por',
            'seller'   => 'Vendedor',
            'customer' => 'Cliente',
            'on'       => 'En',
        ],

        'default-option' => [
            'please-select-value' => 'Por favor, selecciona un valor',
            'select-quantity'     => 'Seleccionar Cantidad',
            'select-reason'       => 'Seleccionar Motivo',
            'others'              => 'Otros',
            'select-order-status' => 'Seleccionar Estado del Pedido',
            'select-resolution'   => 'Seleccionar Resolución',
            'select-seller'       => 'Seleccionar Vendedor',
            'select-order'        => 'Seleccionar Pedido',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Invitado',
            'heading'                 => 'Detalles de RMA',
            'status'                  => 'Estado',
            'order-id'                => ' ID de Pedido:',
            'refund-details'          => 'Detalles de Reembolso',
            'resolution-type'         => 'Tipo de Resolución:',
            'additional-information'  => 'Información Adicional:',
            'change-rma-status'       => 'Cambiar Estado de RMA',
            'save-btn'                => 'Guardar',
            'you'                     => 'Admin',
            'send-message-btn'        => 'Enviar',
            'items-requested-for-rma' => 'Artículo(s) Solicitados para RMA',
            'refund-offline-btn'      => 'Reembolso Sin Conexión',
            'send-message'            => 'Enviar Mensaje',
            'conversations'           => 'Conversaciones',
            'cancel-order'            => 'Cancelar Pedido',
            'status-details'          => 'Detalles de Estado',
            'admin'                   => 'Admin',
            'status-quotes'           => 'Por favor, acepta para marcarlo como resuelto.',
            'close-rma'               => 'Cerrar RMA:',
            'images'                  => 'Imágenes',
            'items-request'           => 'Artículo(s) Solicitados para RMA',
            'refundable-amount'       => 'Cantidad Reembolsable',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Tipo de Resolución:',
            'guest'                  => 'Tú',
            'status'                 => 'Estado',
            'order-id'               => ' ID de Pedido:',
            'additional-information' => 'Información Adicional:',
            'save-btn'               => 'Guardar',
            'send-message-btn'       => 'Enviar',
            'refund-offline-btn'     => 'Reembolso Sin Conexión',
            'send-message'           => 'Enviar Mensaje',
            'conversations'          => 'Conversaciones',
            'status-details'         => 'Detalles de Estado',
            'admin'                  => 'Admin',
            'status-quotes'          => 'Por favor, acepta para marcarlo como resuelto.',
            'close-rma'              => 'Cerrar RMA',
            'images'                 => 'Imágenes',
            'items-request'          => 'Artículo(s) Solicitados para RMA',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'Estado de RMA:',
            'order-status' => 'Estado del Pedido:',
            'full-amount'  => 'Cantidad Total',
            'request-on'   => 'Solicitado el:',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'Cerrar RMA',
            'rma-status'              => 'Estado de RMA:',
            'admin-status'            => 'Estado de Admin:',
            'order-status'            => 'Estado del Pedido:',
            'consignment-no'          => 'Número de Envío:',
            'refundable-amount'       => 'Cantidad Reembolsable:',
            'full-amount'             => 'Cantidad Total',
            'partial-amount'          => 'Cantidad Parcial',
            'total-refundable-amount' => 'Cantidad Total Reembolsable:',
            'enter-message'           => 'Introducir Mensaje',
            'request-on'              => 'Solicitado el:',
            'seller'                  => 'Vendedor',
            'order-details'           => 'Detalles del Pedido',
        ],

        'table-heading' => [
            'product-name' => 'Nombre del Producto',
            'sku'          => 'SKU',
            'price'        => 'Precio',
            'qty'          => 'Cant.',
            'reason'       => 'Motivo',
        ],

        'guest-users' => [
            'heading'     => 'Panel de Inicio de Sesión de Invitado',
            'order-id'    => 'ID de Pedido',
            'email'       => 'Email',
            'button-text' => 'Iniciar Sesión',
            'title'       => 'Inicio de Sesión de Invitado',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'Solicitud de RMA',
            'hello'                  => 'Estimado/a :name',
            'greeting'               => 'Solicitaste un nuevo RMA para el pedido :order_id.',
            'rma-id'                 => 'ID de RMA:',
            'summary'                => 'Resumen del RMA del Pedido',
            'order-id'               => 'ID de Pedido:',
            'order-status'           => 'Estado del Pedido:',
            'resolution-type'        => 'Tipo de Resolución:',
            'additional-information' => 'Información Adicional:',
            'thank-you'              => 'Gracias',
            'requested-rma-product'  => 'Producto(s) Solicitado(s) para RMA:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nombre del Producto',
            'sku'          => 'SKU',
            'qty'          => 'Cant.',
            'reason'       => 'Motivo',
        ],

        'customer-conversation' => [
            'heading' => 'Estimado/a :name,',
            'quotes'  => 'Hay un nuevo mensaje del Comprador',
            'message' => 'Mensaje',
        ],

        'seller-conversation' => [
            'heading' => 'Estimado/a :name',
            'quotes'  => 'Hay un nuevo mensaje del Vendedor',
            'message' => 'Mensaje',
            'title'   => '¡Mensaje Recibido!',
        ],

        'status' => [
            'heading'       => 'Estimado/a :name',
            'quotes'        => 'Tu estado de RMA ha sido cambiado por el Vendedor',
            'rma-id'        => 'ID de RMA',
            'your-rma-id'   => 'Tu ID de RMA',
            'status-change' => ':id estado ha sido cambiado por el Vendedor',
            'status'        => 'Estado',
            'title'         => '¡Estado Actualizado!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Pendiente',
            'processing'               => 'Procesando',
            'item-canceled'            => 'Artículo Cancelado',
            'solved'                   => 'Resuelto',
            'declined'                 => 'Declinado',
            'received-package'         => 'Paquete Recibido',
            'dispatched-package'       => 'Paquete Despachado',
            'not-received-package-yet' => 'Aún no se ha recibido el paquete',
            'accept'                   => 'Aceptar',
        ],

        'status-quotes' => [
            'declined-admin'  => 'El RMA fue declinado por el Admin.',
            'declined-buyer'  => 'El RMA fue declinado por el Comprador.',
            'solved'          => 'El RMA está Resuelto.',
            'solved-by-admin' => 'El RMA fue resuelto por el admin.',
        ],
    ],

    'response' => [
        'create-success' => ':name creado correctamente.',
        'send-message'   => ':name enviado correctamente.',
        'update-success' => ':name actualizado correctamente.',
    ],
];
