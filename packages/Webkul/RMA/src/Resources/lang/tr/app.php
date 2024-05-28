<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'allow-new-request-for-pending-order' => 'Bekleyen siparişler için yeni rma isteğine izin ver',
                        'allow-rma-for-digital-product'       => 'Dijital ürünler için rma izni ver',
                        'default-allow-days'                  => 'Varsayılan izin verilen günler',
                        'enable'                              => 'Rma\'yı etkinleştir',
                        'info'                                => 'RMA, bir ürünü işletmeye iade etmek, para iadesi, değişim veya onarım almak için sürecin bir parçasıdır.',
                        'title'                               => 'RMA',

                        'setting' => [
                            'info'  => 'RMA işlevselliği, müşterilerin bakım ve onarım için ürünleri iade etmesi, para iadesi veya değişim alma durumlarını yönetmelerini sağlar.',
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
                    'rma-title'        => 'Tüm RMA',
                    'reason-title'     => 'Nedenler',
                    'create-rma-title' => 'RMA Oluştur',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Tüm RMA',

                        'datagrid' => [
                            'id'        => 'RMA Kimliği',
                            'order-ref' => 'Sipariş Referansı',
                            'status'    => 'Durum',
                            'create'    => 'Oluşturulma Tarihi',
                        ],
                    ],

                    'view' => [
                        'title'                  => 'RMA',
                        'view-title'             => 'RMA',
                        'order-id'               => ' Sipariş Kimliği :',
                        'request-on'             => 'Talep Tarihi :',
                        'customer'               => 'Müşteri :',
                        'resolution-type'        => 'Çözüm Tipi :',
                        'additional-information' => 'Ek Bilgiler :',
                        'images'                 => 'Resim :',
                        'order-details'          => 'Sipariş Detayları',
                        'status'                 => 'Durum',
                        'rma-status'             => 'RMA Durumu :',
                        'order-status'           => 'Sipariş Durumu :',
                        'change-status'          => 'Durumu Değiştir',
                        'conversations'          => 'Sohbetler',
                        'save-btn'               => 'Kaydet',
                        'send-message'           => 'Mesaj Gönder',
                        'enter-message'          => 'Mesaj Girin',
                        'send-message-btn'       => 'Mesaj Gönder',
                        'send-message-success'   => 'Mesaj başarıyla gönderildi.',
                        'update-success'         => 'RMA durumu başarıyla güncellendi.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'title'      => 'Nedenler',
                        'create-btn' => 'RMA Nedeni Oluştur',

                        'datagrid' => [
                            'id'                  => 'ID',
                            'reason'              => 'Neden',
                            'status'              => 'Durum',
                            'created-at'          => 'Oluşturulma Tarihi',
                            'enabled'             => 'Etkin',
                            'disabled'            => 'Devre Dışı',
                            'delete-success'      => 'Neden başarıyla silindi.',
                            'mass-delete-success' => 'RMA toplu silme başarılı.',
                            'reason-error'        => 'Neden RMA\'da kullanılıyor.',
                        ],
                    ],

                    'create' => [
                        'create-title'   => 'Yeni Neden Ekle',
                        'save-btn'       => 'Neden Kaydet',
                        'reason'         => 'Neden',
                        'status'         => 'Durum',
                        'create-success' => 'Neden başarıyla oluşturuldu.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Neden Düzenle',
                        'save-btn'            => 'Neden Kaydet',
                        'reason'              => 'Neden',
                        'status'              => 'Durum',
                        'mass-update-success' => 'Seçili nedenler başarıyla güncellendi.',
                    ],
                ],

                'create-rma' => [
                    'create-title'      => 'RMA Oluştur',
                    'order-id'          => 'Sipariş Kimliği',
                    'email'             => 'E-posta',
                    'validate'          => 'Doğrula',
                    'rma-already-exist' => 'RMA zaten mevcut',
                    'mismatch'          => 'Sipariş Kimliği ve e-posta uyuşmazlığı',
                    'invalid-order-id'  => 'Geçersiz sipariş kimliği',
                    'quantity'          => 'Miktar',
                    'reason'            => 'Neden',
                    'save-btn'          => 'Kaydet',
                    'create-success'    => 'Rma başarıyla oluşturuldu.',
                ],
            ],
        ],
    ],

    'shop' => [
        'customer' => [
            'menu-name'    => 'RMA',
            'title'        => 'RMA',
            'header-title' => 'RMA İade',
            'offer'        => 'İlk siparişinizde %40\'A KADAR İNDİRİM ALIN',
            'shop-now'     => '��İMDİ AL',

            'create' => [
                'heading'                  => 'Yeni RMA İsteği',
                'create-btn'               => 'Kaydet',
                'orders'                   => 'Siparişler',
                'resolution'               => 'Çözüm Tipini Seçin',
                'item-ordered'             => 'Sipariş Edilen Ürün',
                'images'                   => 'Resimler',
                'information'              => 'Ek Bilgiler',
                'order-status'             => 'Sipariş Durumu',
                'product'                  => 'Ürün',
                'sku'                      => 'SKU',
                'price'                    => 'Fiyat',
                'search-order'             => 'Sipariş Ara',
                'enter-order-id'           => 'Sipariş Kimliği Girin',
                'not-allowed'              => 'Bekleyen siparişler için RMA isteği yapılamaz',
                'image'                    => 'Resim',
                'quantity'                 => 'Miktar',
                'reason'                   => 'Neden',
                'rma-not-available-quotes' => 'RMA için ürün mevcut değil',
                'product-name'             => 'Ürün Adı',
                'reopen-request'           => 'İsteği Yeniden Aç',
                'save'                     => 'Kaydet',
                'cancel'                   => 'İptal',
            ],

        ],

        'guest' => [
            'view' => [
                'title'        => 'RMA',
                'rma-status'   => 'RMA Durumu :',
                'order-status' => 'Sipariş Durumu :',
                'close-rma'    => 'RMA Kapat :',
            ],

            'create' => [
                'title'                    => 'RMA',
                'heading'                  => 'Yeni RMA İsteği',
                'create-btn'               => 'Kaydet',
                'orders'                   => 'Siparişler',
                'resolution'               => 'Çözüm Tipini Seçin',
                'item-ordered'             => 'Sipariş Edilen Ürün',
                'images'                   => 'Resimler',
                'information'              => 'Ek Bilgiler',
                'order-status'             => 'Sipariş Durumu',
                'product'                  => 'Ürün',
                'sku'                      => 'SKU',
                'price'                    => 'Fiyat',
                'search-order'             => 'Sipariş Ara',
                'enter-order-id'           => 'Sipariş Kimliği Girin',
                'not-allowed'              => 'Bekleyen siparişler için RMA isteği yapılamaz',
                'image'                    => 'Resim',
                'quantity'                 => 'Miktar',
                'reason'                   => 'Neden',
                'rma-not-available-quotes' => 'RMA için ürün mevcut değil',
                'product-name'             => 'Ürün Adı',
                'reopen-request'           => 'İsteği Yeniden Aç',
                'save'                     => 'Kaydet',
                'cancel'                   => 'İptal',
                'reopen-request'           => 'İsteği Yeniden Aç',
            ],

            'index' => [
                'create'  => 'Yeni RMA İsteği Oluştur',
                'heading' => 'Müşteri RMA Paneli',
                'view'    => 'Görüntüle',
                'edit'    => 'Düzenle',
                'delete'  => 'Sil',
                'update'  => 'Güncelle',
                'guest'   => 'Misafir RMA Paneli',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Yeni RMA İsteği Oluştur',
            'heading' => 'Müşteri RMA Paneli',
            'view'    => 'Görüntüle',
            'edit'    => 'Düzenle',
            'delete'  => 'Sil',
            'update'  => 'Güncelle',
            'guest'   => 'Misafir RMA Paneli',
        ],

        'validation' => [
            'orders'       => 'Siparişler',
            'resolution'   => 'Çözüm',
            'information'  => 'Ek Bilgiler',
            'order-status' => 'Sipariş Durumu',
            'order-id'     => 'Sipariş Seçimi',
            'close-rma'    => 'Onayla',
        ],

        'conversation-texts' => [
            'by'       => 'Tarafından',
            'seller'   => 'Satıcı',
            'customer' => 'Müşteri',
            'on'       => 'Tarihinde',
        ],

        'default-option' => [
            'please-select-value' => 'Lütfen Değer Seçin',
            'select-quantity'     => 'Miktar Seçin',
            'select-reason'       => 'Neden Seçin',
            'others'              => 'Diğerleri',
            'select-order-status' => 'Sipariş Durumu Seçin',
            'select-resolution'   => 'Çözüm Tipi Seçin',
            'select-seller'       => 'Satıcı Seçin',
            'select-order'        => 'Sipariş Seçin',
        ],

        'view-customer-rma' => [
            'rma'                     => 'RMA',
            'guest'                   => 'Misafir',
            'heading'                 => 'RMA Detayları',
            'status'                  => 'Durum',
            'order-id'                => ' Sipariş Kimliği :',
            'refund-details'          => 'Para İade Detayları',
            'resolution-type'         => 'Çözüm Tipi :',
            'additional-information'  => 'Ek Bilgiler :',
            'change-rma-status'       => 'RMA Durumunu Değiştir',
            'save-btn'                => 'Kaydet',
            'you'                     => 'Yönetici',
            'send-message-btn'        => 'Gönder',
            'items-requested-for-rma' => 'RMA İçin İstek Edilen Ürün(ler)',
            'refund-offline-btn'      => 'Çevrimdışı Para İadesi',
            'send-message'            => 'Mesaj Gönder',
            'conversations'           => 'Sohbetler',
            'cancel-order'            => 'Siparişi İptal Et',
            'status-details'          => 'Durum Detayları',
            'admin'                   => 'Yönetici',
            'status-quotes'           => 'Lütfen çözülmüş olarak işaretlemek için onaylayın.',
            'close-rma'               => 'RMA Kapat :',
            'images'                  => 'Resimler',
            'items-request'           => 'RMA İçin İstek Edilen Ürün(ler)',
            'refundable-amount'       => 'Para İade Edilebilir Miktar',
        ],

        'view-guest-rma' => [
            'rma'                    => 'RMA',
            'resolution-type'        => 'Çözüm Tipi :',
            'guest'                  => 'Sen',
            'status'                 => 'Durum',
            'order-id'               => ' Sipariş Kimliği :',
            'additional-information' => 'Ek Bilgiler :',
            'save-btn'               => 'Kaydet',
            'send-message-btn'       => 'Gönder',
            'refund-offline-btn'     => 'Çevrimdışı Para İadesi',
            'send-message'           => 'Mesaj Gönder',
            'conversations'          => 'Sohbetler',
            'status-details'         => 'Durum Detayları',
            'admin'                  => 'Yönetici',
            'status-quotes'          => 'Lütfen çözülmüş olarak işaretlemek için onaylayın.',
            'close-rma'              => 'RMA Kapat',
            'images'                 => 'Resimler',
            'items-request'          => 'RMA İçin İstek Edilen Ürün(ler)',
        ],

        'view-guest-rma-content' => [
            'rma-status'   => 'RMA Durumu :',
            'order-status' => 'Sipariş Durumu :',
            'full-amount'  => 'Tam Miktar',
            'request-on'   => 'Talep Tarihi :',
        ],

        'view-customer-rma-content' => [
            'close-rma'               => 'RMA Kapat',
            'rma-status'              => 'RMA Durumu :',
            'admin-status'            => 'Yönetici Durumu:',
            'order-status'            => 'Sipariş Durumu :',
            'consignment-no'          => 'Gönderi Numarası:',
            'refundable-amount'       => 'Para İade Edilebilir Miktar:',
            'full-amount'             => 'Tam Miktar',
            'partial-amount'          => 'Kısmi Miktar',
            'total-refundable-amount' => 'Toplam Para İade Edilebilir Miktar:',
            'enter-message'           => 'Mesaj Girin',
            'request-on'              => 'Talep Tarihi :',
            'seller'                  => 'Satıcı',
            'order-details'           => 'Sipariş Detayları',
        ],

        'table-heading' => [
            'product-name' => 'Ürün Adı',
            'sku'          => 'SKU',
            'price'        => 'Fiyat',
            'qty'          => 'Miktar',
            'reason'       => 'Neden',
        ],

        'guest-users' => [
            'heading'     => 'Misafir Giriş Paneli',
            'order-id'    => 'Sipariş Kimliği',
            'email'       => 'E-posta',
            'button-text' => 'Giriş',
            'title'       => 'Misafir Giriş',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'heading'                => 'RMA İsteği',
            'hello'                  => 'Sayın :name',
            'greeting'               => ':order_id siparişi için yeni bir RMA talebinde bulundunuz.',
            'rma-id'                 => 'RMA Kimliği :',
            'summary'                => 'Siparişin RMA Özeti',
            'order-id'               => 'Sipariş Kimliği :',
            'order-status'           => 'Sipariş Durumu :',
            'resolution-type'        => 'Çözüm Tipi :',
            'additional-information' => 'Ek Bilgiler :',
            'thank-you'              => 'Teşekkür ederiz',
            'requested-rma-product'  => 'İstek Edilen RMA Ürünü:',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Ürün Adı',
            'sku'          => 'SKU',
            'qty'          => 'Miktar',
            'reason'       => 'Neden',
        ],

        'customer-conversation' => [
            'heading' => 'Sayın :name,',
            'quotes'  => 'Alıcıdan yeni bir mesaj var',
            'message' => 'Mesaj',
        ],

        'seller-conversation' => [
            'heading' => 'Sayın :name',
            'quotes'  => 'Satıcıdan yeni bir mesaj var',
            'message' => 'Mesaj',
            'title'   => 'Mesaj Alındı!',
        ],

        'status' => [
            'heading'       => 'Sayın :name',
            'quotes'        => 'Satıcı tarafından RMA durumu değiştirildi',
            'rma-id'        => 'RMA Kimliği',
            'your-rma-id'   => 'RMA Kimliğiniz',
            'status-change' => ':id durumu Satıcı tarafından değiştirildi',
            'status'        => 'Durum',
            'title'         => 'Durum Güncellendi!',
        ],
    ],

    'status' => [
        'status-name' => [
            'pending'                  => 'Beklemede',
            'processing'               => 'İşleniyor',
            'item-canceled'            => 'Ürün İptal Edildi',
            'solved'                   => 'Çözüldü',
            'declined'                 => 'Reddedildi',
            'received-package'         => 'Paket Alındı',
            'dispatched-package'       => 'Paket Gönderildi',
            'not-received-package-yet' => 'Paket henüz alınmadı',
            'accept'                   => 'Kabul Et',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA yönetici tarafından reddedildi.',
            'declined-buyer'  => 'RMA alıcı tarafından reddedildi.',
            'solved'          => 'RMA çözüldü.',
            'solved-by-admin' => 'RMA yönetici tarafından çözüldü.',
        ],
    ],

    'response' => [
        'create-success'    => ':name başarıyla oluşturuldu.',
        'send-message'      => ':name başarıyla gönderildi.',
        'update-success'    => ':name başarıyla güncellendi.',
        'permission-denied' => 'Giriş yapılmışsınız',
    ],
];
