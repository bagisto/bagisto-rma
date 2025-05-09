<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Tarde',
                        'all-products'                        => 'Todos los productos',
                        'all-status'                          => 'Todos los estados',
                        'allow-new-request-for-pending-order' => 'Permitir nueva solicitud de RMA para pedido pendiente',
                        'allow-rma-for-digital-product'       => 'Permitir RMA para producto digital',
                        'allowed-file-extension'              => 'Extensión de archivo permitida',
                        'allowed-file-types'                  => 'Por favor, seleccione solo los tipos de archivo ' . core()->getConfigData('sales.rma.setting.allowed-file-extension'),
                        'allowed-info'                        => 'Separado por comas. Por ejemplo: jpg,jpeg,pdf',
                        'allowed-request-cancelled-request'   => 'Permitir nueva solicitud de RMA para solicitud cancelada',
                        'allowed-request-declined-request'    => 'Permitir nueva solicitud de RMA para solicitud rechazada',
                        'allowed-rma-for-product'             => 'Permitir RMA para producto',
                        'cancel-items'                        => 'Cancelar artículos',
                        'complete'                            => 'Completo',
                        'current-order-quantity'              => 'Cantidad de pedido actual',
                        'days-info'                           => 'El número de días dentro de los cuales el cliente puede solicitar un RMA después de realizar un pedido.',
                        'default-allow-days'                  => 'Días permitidos predeterminados',
                        'enable'                              => 'Habilitar RMA',
                        'evening'                             => 'Noche',
                        'exchange'                            => 'Intercambio',
                        'info'                                => 'RMA es parte del proceso de devolución de un producto a una empresa para recibir un reembolso, reemplazo o reparación.',
                        'morning'                             => 'Mañana',
                        'new-rma-message-to-customer'         => 'Nuevo mensaje de RMA al cliente',
                        'no'                                  => 'No',
                        'open'                                => 'Abierto',
                        'package-condition'                   => 'Condición del paquete',
                        'packed'                              => 'Empaquetado',
                        'print-page'                          => 'Imprimir página',
                        'product-already-raw'                 => 'El producto ya está en RMA.',
                        'product-delivery-status'             => 'Estado de entrega del producto',
                        'resolution-type'                     => 'Tipo de resolución',
                        'return-pickup-address'               => 'Dirección de recogida de devoluciones',
                        'return-pickup-time'                  => 'Hora de recogida de devoluciones',
                        'return-policy'                       => 'Política de devoluciones',
                        'return'                              => 'Devolver',
                        'select-allowed-order-status'         => 'Seleccionar estado de pedido permitido',
                        'specific-products'                   => 'Productos específicos',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Sí',

                        'setting' => [
                            'info'  => 'La funcionalidad de RMA permite manejar situaciones en las que un cliente devuelve artículos para reparación y mantenimiento, o para reembolso o reemplazo.',
                            'read'  => 'Leer la política',
                            'terms' => 'He leído y aceptado la política de devoluciones.', 
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
                    'create-rma-title' => 'Crear RMA',
                    'reason-title'     => 'Motivos',
                    'rma-title'        => 'Todas las RMA',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Todas las RMA',

                        'datagrid' => [
                            'create'        => 'Creado el',
                            'customer-name' => 'Nombre del Cliente',
                            'id'            => 'ID de RMA',
                            'order-ref'     => 'Referencia de Pedido',
                            'order-status'  => 'Estado del Pedido',
                            'rma-status'    => 'Estado de RMA',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Agregar adjuntos',
                        'additional-information' => 'Información adicional:',
                        'attachment'             => 'Adjunto',
                        'change-status'          => 'Cambiar estado',
                        'confirm-print'          => 'Haga clic en Aceptar para imprimir el RMA',
                        'conversations'          => 'Conversaciones',
                        'customer-details'       => 'Detalles del cliente',
                        'customer-email'         => 'Correo electrónico del cliente:',
                        'customer'               => 'Cliente:',
                        'enter-message'          => 'Escriba un mensaje',
                        'images'                 => 'Imagen:',
                        'no-record'              => '¡No se encontraron registros!',
                        'order-date'             => 'Fecha de la orden:',
                        'order-details'          => 'Artículo(s) solicitado(s) para RMA',
                        'order-id'               => 'ID de pedido:',
                        'order-status'           => 'Estado del pedido:',
                        'order-total'            => 'Total del pedido:',
                        'request-on'             => 'Solicitado el:',
                        'resolution-type'        => 'Tipo de resolución:',
                        'rma-status'             => 'Estado de RMA:',
                        'save-btn'               => 'Guardar',
                        'send-message-btn'       => 'Enviar mensaje',
                        'send-message-success'   => 'Mensaje enviado con éxito.',
                        'send-message'           => 'Enviar mensaje',
                        'status'                 => 'Estado',
                        'title'                  => 'RMA',
                        'update-success'         => 'Estado de RMA actualizado con éxito.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'Crear Estado de RMA',
                        'title'      => 'Estado de RMA',

                        'datagrid' => [
                            'created-at'          => 'Creado en',
                            'delete-success'      => 'Estado de RMA eliminado con éxito.',
                            'disabled'            => 'Inactivo',
                            'enabled'             => 'Activo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Estado de RMA seleccionado eliminado con éxito.',
                            'reason-error'        => 'El estado de RMA se usa en RMA.',
                            'reason'              => 'Estado de RMA',
                            'status'              => 'Estado',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Agregar Nuevo Estado de RMA',
                        'reason'       => 'Estado de RMA',
                        'save-btn'     => 'Guardar Estado de RMA',
                        'status'       => 'Estado',
                        'success'      => 'Estado de RMA creado con éxito.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Estado de RMA',
                        'mass-update-success' => 'Estado de RMA seleccionado actualizado con éxito.',
                        'reason'              => 'Estado de RMA',
                        'save-btn'            => 'Guardar Estado de RMA',
                        'status'              => 'Estado',
                        'success'             => 'Estado de RMA actualizado con éxito.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Motivos',
                        'create-btn' => 'Crear Motivo de RMA',

                        'datagrid' => [
                            'created-at'          => 'Creado el',
                            'delete-success'      => 'Motivo eliminado correctamente.',
                            'disabled'            => 'Inactivo',
                            'enabled'             => 'Activo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Datos seleccionados eliminados correctamente',
                            'reason-error'        => 'El motivo se utiliza en RMA.',
                            'reason'              => 'Motivo',
                            'status'              => 'Estado',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Agregar Nuevo Motivo',
                        'reason'       => 'Motivo',
                        'save-btn'     => 'Guardar Motivo',
                        'status'       => 'Estado',
                        'success'      => 'Motivo creado correctamente.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Motivo',
                        'mass-update-success' => 'Motivos seleccionados actualizados correctamente.',
                        'reason'              => 'Motivo',
                        'save-btn'            => 'Guardar Motivo',
                        'status'              => 'Estado',
                        'success'             => 'Motivo actualizado correctamente.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Agregar nuevo campo',
                        'title'      => 'Campos Personalizados de RMA',

                        'datagrid' => [
                            'created-at'          => 'Creado en',
                            'delete-success'      => 'Campos personalizados eliminados con éxito.',
                            'disabled'            => 'Inactivo',
                            'enabled'             => 'Activo',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Datos seleccionados eliminados con éxito',
                            'status'              => 'Estado',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Nuevo Campo Personalizado',
                        'save-btn'     => 'Guardar Campo Personalizado',
                        'status'       => 'Estado',
                        'success'      => 'Campo personalizado creado con éxito.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Campo Personalizado',
                        'mass-update-success' => 'Campos personalizados seleccionados actualizados con éxito.',
                        'reason'              => 'Campo Personalizado',
                        'save-btn'            => 'Guardar Campo Personalizado',
                        'status'              => 'Estado',
                        'success'             => 'Campo personalizado actualizado con éxito.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'Crear Reglas de RMA',
                        'title'      => 'Reglas de RMA',

                        'datagrid' => [
                            'delete-success'      => 'Reglas de RMA eliminadas con éxito.',
                            'disabled'            => 'Inactivo',
                            'enabled'             => 'Activo',
                            'exchange-period'     => 'Período de Intercambio (días)',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Datos seleccionados eliminados con éxito.',
                            'reason'              => 'Reglas',
                            'return-period'       => 'Período de Devolución (días)',
                            'status'              => 'Estado',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Agregar Nuevas Reglas de RMA',
                        'reason'             => 'Reglas de RMA',
                        'rule-description'   => 'Descripción de Reglas',
                        'rule-details'       => 'Detalles de Reglas',
                        'resolutions-period' => 'Período de Resoluciones',
                        'rules-title'        => 'Título de las Reglas',
                        'save-btn'           => 'Guardar Reglas de RMA',
                        'status'             => 'Estado de RMA',
                        'success'            => 'Reglas de RMA creadas con éxito.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Editar Reglas de RMA',
                        'mass-update-success' => 'Reglas de RMA seleccionadas actualizadas con éxito.',
                        'reason'              => 'Reglas de RMA',
                        'save-btn'            => 'Actualizar Reglas de RMA',
                        'status'              => 'Estado',
                        'success'             => 'Reglas de RMA actualizadas con éxito.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'RMA creado correctamente.',
                    'create-title'             => 'Crear RMA',
                    'email'                    => 'Correo Electrónico',
                    'image'                    => 'Imagen',
                    'invalid-order-id'         => 'ID de Pedido no válido',
                    'mismatch'                 => 'ID de Pedido y correo electrónico no coinciden',
                    'new-rma'                  => 'Nueva RMA',
                    'order-id'                 => 'ID de Pedido',
                    'quantity'                 => 'Cantidad',
                    'reason'                   => 'Motivo',
                    'rma-already-exist'        => 'La RMA ya existe',
                    'rma-not-available-quotes' => 'Artículo no disponible para RMA',
                    'save-btn'                 => 'Guardar',
                    'search'                   => '--Seleccionar--',
                    'validate'                 => 'Validar',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'La RMA ha sido creada',
                    'rma-created-message'  => 'Una solicitud de RMA está disponible para el producto con una cantidad de :qty'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Eliminar',
            'edit'        => 'Editar',
            'mass-delete' => 'Eliminar en Masa',
            'mass-update' => 'Actualizar en Masa',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Entregado',
            'menu-name'    => 'RMA',
            'offer'        => 'Obtén HASTA un 40% DE DESCUENTO en tu primer pedido',
            'rma-qty'      => 'Cantidad RMA',
            'shop-now'     => 'COMPRA AHORA',
            'submit-req'   => 'Enviar solicitud',
            'title'        => 'RMA',
            'undelivered'  => 'No entregado',

            'create' => [
                'cancel'                   => 'Cancelar',
                'create-btn'               => 'Guardar',
                'enter-order-id'           => 'Ingresar ID del pedido',
                'heading'                  => 'Nueva solicitud de RMA',
                'exchange-window'          => 'Ventana de cambio',
                'image'                    => 'Imagen',
                'images'                   => 'Imágenes',
                'information'              => 'Información adicional',
                'item-ordered'             => 'Artículo pedido',
                'no-record'                => '¡No se encontraron registros!',
                'not-allowed'              => 'RMA no está permitido para pedidos pendientes',
                'order-status'             => 'Estado del pedido',
                'orders'                   => 'Pedidos',
                'price'                    => 'Precio',
                'product-name'             => 'Nombre del producto',
                'product'                  => 'Producto',
                'quantity'                 => 'Cantidad',
                'reason'                   => 'Razón',
                'reopen-request'           => 'Reabrir solicitud',
                'resolution'               => 'Seleccionar resolución',
                'return-window'            => 'Ventana de Devolución',
                'rma-not-available-quotes' => 'Artículo no disponible para RMA',
                'save'                     => 'Guardar',
                'search-order'             => 'Buscar pedido',
                'sku'                      => 'SKU',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Cerrar RMA:',
                'order-status' => 'Estado del pedido:',
                'rma-status'   => 'Estado de RMA:',
                'title'        => 'RMA',
            ],

            'create' => [
                'cancel'                   => 'Cancelar',
                'create-btn'               => 'Guardar',
                'enter-order-id'           => 'Ingresar ID del pedido',
                'heading'                  => 'Nueva solicitud de RMA',
                'image'                    => 'Imagen',
                'images'                   => 'Imágenes',
                'information'              => 'Información adicional',
                'item-ordered'             => 'Artículo pedido',
                'not-allowed'              => 'RMA no está permitido para pedidos pendientes',
                'order-status'             => 'Estado del pedido',
                'orders'                   => 'Pedidos',
                'price'                    => 'Precio',
                'product-name'             => 'Nombre del producto',
                'product'                  => 'Producto',
                'quantity'                 => 'Cantidad',
                'reason'                   => 'Razón',
                'reopen-request'           => 'Reabrir solicitud',
                'resolution'               => 'Seleccionar resolución',
                'rma-not-available-quotes' => 'Artículo no disponible para RMA',
                'save'                     => 'Guardar',
                'search-order'             => 'Buscar pedido',
                'sku'                      => 'SKU',
                'title'                    => 'RMA',
            ],

            'index' => [
                'create'  => 'Solicitar nuevo RMA',
                'delete'  => 'Eliminar',
                'edit'    => 'Editar',
                'guest'   => 'Panel de RMA para invitados',
                'heading' => 'Panel de RMA de cliente',
                'update'  => 'Actualizar',
                'view'    => 'Ver',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Crear',
            'delete'  => 'Eliminar',
            'edit'    => 'Editar',
            'guest'   => 'Panel de RMA para invitados',
            'heading' => 'RMA',
            'update'  => 'Actualizar',
            'view'    => 'Ver',
        ],

        'validation' => [
            'close-rma'     => 'Confirmar',
            'information'   => 'Información adicional',
            'order-id'      => 'Selección de pedido',
            'order-status'  => 'Estado del pedido',
            'orders'        => 'Pedidos',
            'resolution'    => 'Resolución',
            'select-orders' => 'Seleccionar pedido',
        ],

        'conversation-texts' => [
            'by'        => 'Por',
            'customer'  => 'Cliente',
            'no-record' => '¡No se encontraron registros!',
            'on'        => 'El',
            'seller'    => 'Vendedor',
        ],

        'default-option' => [
            'others'              => 'Otros',
            'please-select-value' => 'Por favor seleccione un valor',
            'select-order-status' => 'Seleccionar estado del pedido',
            'select-order'        => 'Seleccionar pedido',
            'select-quantity'     => 'Seleccionar cantidad',
            'select-reason'       => 'Seleccionar razón',
            'select-resolution'   => 'Seleccionar resolución',
            'select-seller'       => 'Seleccionar vendedor',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Información adicional:',
            'admin'                   => 'Admin',
            'cancel-order'            => 'Cancelar pedido',
            'change-rma-status'       => 'Cambiar estado de RMA',
            'close-rma'               => 'Cerrar RMA:',
            'conversations'           => 'Conversaciones',
            'guest'                   => 'Invitado',
            'heading'                 => 'Detalles de RMA',
            'images'                  => 'Imágenes:',
            'items-request'           => 'Artículos solicitados para RMA',
            'items-requested-for-rma' => 'Artículos solicitados para RMA',
            'order-id'                => 'ID del pedido:',
            'refund-details'          => 'Detalles del reembolso',
            'refund-offline-btn'      => 'Reembolso fuera de línea',
            'refundable-amount'       => 'Cantidad reembolsable',
            'resolution-type'         => 'Tipo de resolución:',
            'rma'                     => 'RMA',
            'save-btn'                => 'Guardar',
            'send-message-btn'        => 'Enviar mensaje',
            'send-message'            => 'Enviar mensaje',
            'status-details'          => 'Detalles del estado',
            'status-quotes'           => 'Por favor, acepte marcarlo como resuelto',
            'status-reopen'           => 'Marque para reabrir',
            'status'                  => 'Estado',
            'term'                    => 'Campo de marca de acuerdo es requerido',
            'you'                     => 'Admin',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Información adicional:',
            'admin'                  => 'Admin',
            'close-rma'              => 'Cerrar RMA',
            'conversations'          => 'Conversaciones',
            'guest'                  => 'Tú',
            'images'                 => 'Imágenes',
            'items-request'          => 'Artículos solicitados para RMA',
            'order-id'               => 'ID del pedido:',
            'refund-offline-btn'     => 'Reembolso fuera de línea',
            'resolution-type'        => 'Tipo de resolución:',
            'rma'                    => 'RMA',
            'save-btn'               => 'Guardar',
            'send-message-btn'       => 'Enviar mensaje',
            'send-message'           => 'Enviar mensaje',
            'status-details'         => 'Detalles del estado',
            'status-quotes'          => 'Por favor, acepte marcarlo como resuelto.',
            'status'                 => 'Estado',
            'term'                   => 'Campo de marca de acuerdo es requerido',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Cantidad total',
            'order-status' => 'Estado del pedido:',
            'request-on'   => 'Solicitud en:',
            'rma-status'   => 'Estado de RMA:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Estado del administrador:',
            'close-rma'               => 'Cerrar RMA',
            'consignment-no'          => 'Número de envío:',
            'enter-message'           => 'Ingresar mensaje',
            'full-amount'             => 'Cantidad total',
            'order-details'           => 'Detalles del pedido',
            'order-status'            => 'Estado del pedido:',
            'partial-amount'          => 'Cantidad parcial',
            'refundable-amount'       => 'Cantidad reembolsable:',
            'request-on'              => 'Solicitud en:',
            'rma-status'              => 'Estado de RMA:',
            'seller'                  => 'Vendedor',
            'total-refundable-amount' => 'Cantidad total reembolsable:',
        ],

        'table-heading' => [
            'image'           => 'Imagen',
            'order-qty'       => 'Cantidad de pedido',
            'price'           => 'Precio',
            'product-name'    => 'Nombre del producto',
            'reason'          => 'Razón',
            'resolution-type' => 'Tipo de resolución',
            'rma-qty'         => 'Cantidad RMA',
            'sku'             => 'SKU',
        ],

        'guest-users' => [
            'button-text' => 'Iniciar sesión',
            'email'       => 'Correo electrónico',
            'heading'     => 'Panel de inicio de sesión para invitados',
            'logout'      => 'Cerrar sesión de invitado',
            'order-id'    => 'ID del pedido',
            'title'       => 'Inicio de sesión para invitados',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Información Adicional :',
            'greeting'               => 'Ha solicitado un nuevo RMA para la orden :order_id.',
            'heading'                => 'Solicitud de RMA',
            'hello'                  => 'Estimado/a :name',
            'order-id'               => 'ID de Orden :',
            'order-status'           => 'Estado de la Orden :',
            'requested-rma-product'  => 'Producto solicitado para RMA:',
            'resolution-type'        => 'Tipo de Resolución :',
            'rma-id'                 => 'ID de RMA :',
            'summary'                => 'Resumen del RMA de la orden',
            'thank-you'              => 'Gracias',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Nombre del Producto',
            'qty'          => 'Cantidad',
            'reason'       => 'Motivo',
            'sku'          => 'SKU',
        ],

        'customer-conversation' => [
            'heading' => 'Estimado/a :name,',
            'message' => 'Mensaje',
            'process' => 'Su solicitud de devolución está en proceso.',
            'quotes'  => 'Hay un nuevo mensaje del comprador',
            'solved'  => 'El estado de RMA ha sido cambiado a Resuelto por el cliente.',
        ],

        'seller-conversation' => [
            'heading' => 'Estimado/a :name',
            'message' => 'Mensaje',
            'quotes'  => 'Hay un nuevo mensaje del administrador',
            'title'   => '¡Mensaje recibido!',
        ],

        'status' => [
            'heading'       => 'Estimado/a :name',
            'quotes'        => 'El estado de su RMA ha sido cambiado por el vendedor',
            'rma-id'        => 'ID de RMA',
            'status-change' => 'El estado :id ha sido cambiado por el vendedor',
            'status'        => 'Estado',
            'title'         => '¡Estado Actualizado!',
            'your-rma-id'   => 'Su ID de RMA',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Aceptar',
            'awaiting'                 => 'En espera',
            'canceled'                 => 'Cancelado',
            'declined'                 => 'Declinado',
            'dispatched-package'       => 'Paquete Enviado',
            'item-canceled'            => 'Artículo Cancelado',
            'not-received-package-yet' => 'Aún no recibido el paquete',
            'pending'                  => 'Pendiente',
            'processing'               => 'Procesando',
            'received-package'         => 'Paquete Recibido',
            'solved'                   => 'Resuelto',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA ha sido declinado por el administrador.',
            'declined-buyer'  => 'RMA ha sido declinado por el comprador.',
            'solved-by-admin' => 'RMA ha sido resuelto por el administrador.',
            'solved'          => 'RMA ha sido resuelto.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'El estado de RMA ya ha sido cancelado.',
        'cancel-success'    => 'El estado de RMA ha sido cancelado con éxito.',
        'create-success'    => 'Solicitud creada con éxito.',
        'creation-error'    => 'El estado de RMA no se puede actualizar porque no se ha creado la factura para este pedido.',
        'permission-denied' => 'Ha iniciado sesión',
        'rma-disabled'      => 'RMA está deshabilitado para este producto',
        'send-message'      => ':name enviado/a exitosamente.',
        'update-success'    => ':name actualizado/a exitosamente.',
        'please-select-the-item' => 'Por favor seleccione el artículo',

    ],
];