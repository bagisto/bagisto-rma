<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'sales' => [
                    'rma' => [
                        'afternoon'                           => 'Öğleden Sonra',
                        'all-products'                        => 'Tüm Ürünler',
                        'all-status'                          => 'Tüm Durumlar',
                        'allow-new-request-for-pending-order' => 'Bekleyen sipariş için yeni RMA talebine izin ver',
                        'allow-rma-for-digital-product'       => 'Dijital ürün için RMA\'ya izin ver',
                        'allowed-file-extension'              => 'İzin verilen dosya uzantısı',
                        'allowed-file-types'                  => 'Lütfen yalnızca ' . core()->getConfigData('sales.rma.setting.allowed-file-extension') . ' dosya türlerini seçin',
                        'allowed-info'                        => 'Virgülle ayrılmış. Örneğin: jpg,jpeg,pdf', 
                        'allowed-request-cancelled-request'   => 'İptal edilen talep için yeni RMA talebine izin ver',
                        'allowed-request-declined-request'    => 'Reddedilen talep için yeni RMA talebine izin ver',
                        'allowed-rma-for-product'             => 'Ürün için RMA\'ya izin ver',
                        'cancel-items'                        => 'Ürünleri İptal Et',
                        'complete'                            => 'Tamamlandı',
                        'current-order-quantity'              => 'Güncel Sipariş Miktarı',
                        'days-info'                           => 'Müşterinin sipariş verdikten sonra bir RMA talep edebileceği gün sayısı.',
                        'default-allow-days'                  => 'Varsayılan izin verilen günler',
                        'enable'                              => 'RMA\'yı etkinleştir',
                        'evening'                             => 'Akşam',
                        'exchange'                            => 'Değişim',
                        'info'                                => 'RMA, bir ürünü iade ederek geri ödeme, değiştirme veya onarım almak için yapılan işlemin bir parçasıdır.',
                        'morning'                             => 'Sabah',
                        'new-rma-message-to-customer'         => 'Müşteriye Yeni RMA Mesajı',
                        'no'                                  => 'Hayır',
                        'open'                                => 'Açık',
                        'package-condition'                   => 'Paket Durumu',
                        'packed'                              => 'Paketlendi',
                        'print-page'                          => 'Sayfayı Yazdır',
                        'product-already-raw'                 => 'Ürün zaten RMA\'da.',
                        'product-delivery-status'             => 'Ürün Teslimat Durumu',
                        'resolution-type'                     => 'Çözüm Türü',
                        'return-pickup-address'               => 'İade Alma Adresi',
                        'return-pickup-time'                  => 'İade Alma Zamanı',
                        'return-policy'                       => 'İade Politikası',
                        'return'                              => 'İade',
                        'select-allowed-order-status'         => 'İzin verilen sipariş durumunu seçin',
                        'specific-products'                   => 'Belirli Ürünler',
                        'title'                               => 'RMA',
                        'yes'                                 => 'Evet',

                        'setting' => [
                            'info'  => 'RMA işlevselliği, bir müşterinin ürünleri onarım ve bakım için geri gönderdiği veya geri ödeme veya değişim için geri gönderdiği durumları ele almaya olanak tanır.',
                            'read'  => 'Politikayı oku',
                            'terms' => 'İade politikasını okudum ve kabul ettim.',
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
                    'create-rma-title' => 'İade Talebi Oluştur',
                    'reason-title'     => 'Sebepler',
                    'rma-title'        => 'Tüm İade Talepleri',
                ],

                'all-rma' => [
                    'index' => [
                        'title' => 'Tüm İade Talepleri',

                        'datagrid' => [
                            'create'        => 'Oluşturulma Tarihi',
                            'customer-name' => 'Müşteri Adı',
                            'id'            => 'İade ID',
                            'order-ref'     => 'Sipariş Referansı',
                            'order-status'  => 'Sipariş Durumu',
                            'rma-status'    => 'İade Durumu',
                        ],
                    ],

                    'view' => [
                        'add-attachments'        => 'Ekleri Ekle',
                        'additional-information' => 'Ek Bilgiler:',
                        'attachment'             => 'Ek',
                        'change-status'          => 'Durumu Değiştir',
                        'confirm-print'          => 'RMA’yı yazdırmak için Tamam’a tıklayın',
                        'conversations'          => 'Konuşmalar',
                        'customer-details'       => 'Müşteri Detayları',
                        'customer-email'         => 'Müşteri E-postası:',
                        'customer'               => 'Müşteri:',
                        'enter-message'          => 'Mesaj Girin',
                        'images'                 => 'Resim:',
                        'no-record'              => 'Kayıt Bulunamadı!',
                        'order-date'             => 'Sipariş Tarihi:',
                        'order-details'          => 'RMA için Talep Edilen Ürün(ler)',
                        'order-id'               => 'Sipariş Kimliği:',
                        'order-status'           => 'Sipariş Durumu:',
                        'order-total'            => 'Sipariş Toplamı:',
                        'request-on'             => 'İstek Tarihi:',
                        'resolution-type'        => 'Çözüm Türü:',
                        'rma-status'             => 'RMA Durumu:',
                        'save-btn'               => 'Kaydet',
                        'send-message-btn'       => 'Mesaj Gönder',
                        'send-message-success'   => 'Mesaj başarıyla gönderildi.',
                        'send-message'           => 'Mesaj Gönder',
                        'status'                 => 'Durum',
                        'title'                  => 'RMA',
                        'update-success'         => 'RMA durumu başarıyla güncellendi.',
                        'view-title'             => 'RMA',
                    ],
                ],

                'rma-status' => [
                    'index' => [
                        'create-btn' => 'RMA Durumu Oluştur',
                        'title'      => 'RMA Durumu',

                        'datagrid' => [
                            'created-at'          => 'Oluşturulma Tarihi',
                            'delete-success'      => 'RMA durumu başarıyla silindi.',
                            'disabled'            => 'Etkin değil',
                            'enabled'             => 'Etkin',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Seçilen RMA durumu başarıyla silindi.',
                            'reason-error'        => 'RMA durumu RMA\'da kullanılıyor.',
                            'reason'              => 'RMA Durumu',
                            'status'              => 'Durum',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Yeni RMA Durumu Ekle',
                        'reason'       => 'RMA Durumu',
                        'save-btn'     => 'RMA Durumunu Kaydet',
                        'status'       => 'Durum',
                        'success'      => 'RMA durumu başarıyla oluşturuldu.',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA Durumunu Düzenle',
                        'mass-update-success' => 'Seçilen RMA durumu başarıyla güncellendi.',
                        'reason'              => 'RMA Durumu',
                        'save-btn'            => 'RMA Durumunu Kaydet',
                        'status'              => 'Durum',
                        'success'             => 'RMA durumu başarıyla güncellendi.',
                    ],
                ],

                'reasons' => [
                    'index' => [
                        'create-btn' => 'İade Sebebi Oluştur',
                        'title'      => 'Sebepler',

                        'datagrid' => [
                            'created-at'          => 'Oluşturulma Tarihi',
                            'delete-success'      => 'Sebep başarıyla silindi.',
                            'disabled'            => 'Pasif',
                            'enabled'             => 'Aktif',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Seçilen veriler başarıyla silindi.',
                            'reason-error'        => 'Bu sebep bir iade işleminde kullanılıyor.',
                            'reason'              => 'Sebep',
                            'status'              => 'Durum',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Yeni Sebep Ekle',
                        'reason'       => 'Sebep',
                        'save-btn'     => 'Sebep Kaydet',
                        'status'       => 'Durum',
                        'success'      => 'Sebep başarıyla oluşturuldu.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Sebebi Düzenle',
                        'mass-update-success' => 'Seçilen sebepler başarıyla güncellendi.',
                        'reason'              => 'Sebep',
                        'save-btn'            => 'Sebep Kaydet',
                        'status'              => 'Durum',
                        'success'             => 'Sebep başarıyla güncellendi.',
                    ],
                ],

                'custom-field' => [
                    'index' => [
                        'create-btn' => 'Yeni Alan Ekle',
                        'title'      => 'RMA Özel Alanlar',

                        'datagrid' => [
                            'created-at'          => 'Oluşturulma Tarihi',
                            'delete-success'      => 'Özel alanlar başarıyla silindi.',
                            'disabled'            => 'Devre Dışı',
                            'enabled'             => 'Aktif',
                            'id'                  => 'ID',
                            'mass-delete-success' => 'Seçilen veriler başarıyla silindi',
                            'status'              => 'Durum',
                        ],
                    ],

                    'create' => [
                        'create-title' => 'Yeni Özel Alan',
                        'save-btn'     => 'Özel Alanı Kaydet',
                        'status'       => 'Durum',
                        'success'      => 'Özel alan başarıyla oluşturuldu.',
                    ],

                    'edit' => [
                        'edit-title'          => 'Özel Alanı Düzenle',
                        'mass-update-success' => 'Seçilen özel alanlar başarıyla güncellendi.',
                        'reason'              => 'Özel Alan',
                        'save-btn'            => 'Özel Alanı Kaydet',
                        'status'              => 'Durum',
                        'success'             => 'Özel alan başarıyla güncellendi.',
                    ],
                ],

                'rules' => [
                    'index' => [
                        'create-btn' => 'RMA Kuralları Oluştur',
                        'title'      => 'RMA Kuralları',

                        'datagrid' => [
                            'delete-success'      => 'RMA kuralları başarıyla silindi.',
                            'disabled'            => 'Devre Dışı',
                            'enabled'             => 'Etkin',
                            'exchange-period'     => 'Değişim Süresi (gün)',
                            'id'                  => 'Kimlik',
                            'mass-delete-success' => 'Seçili veriler başarıyla silindi.',
                            'reason'              => 'Kurallar',
                            'return-period'       => 'İade Süresi (gün)',
                            'status'              => 'Durum',
                        ],
                    ],

                    'create' => [
                        'create-title'       => 'Yeni RMA Kuralları Ekle',
                        'reason'             => 'RMA Kuralları',
                        'resolutions-period' => 'Çözüm Süresi',
                        'rule-description'   => 'Kural Açıklaması',
                        'rule-details'       => 'Kural Detayları',
                        'rules-title'        => 'Kural Başlığı',
                        'save-btn'           => 'RMA Kurallarını Kaydet',
                        'status'             => 'RMA Durumu',
                        'success'            => 'RMA kuralları başarıyla oluşturuldu.',
                    ],

                    'edit' => [
                        'edit-title'          => 'RMA Kurallarını Düzenle',
                        'mass-update-success' => 'Seçili RMA kuralları başarıyla güncellendi.',
                        'reason'              => 'RMA Kuralları',
                        'save-btn'            => 'RMA Kurallarını Güncelle',
                        'status'              => 'Durum',
                        'success'             => 'RMA kuralları başarıyla güncellendi.',
                    ],
                ],

                'create-rma' => [
                    'create-success'           => 'İade Talebi başarıyla oluşturuldu.',
                    'create-title'             => 'İade Talebi Oluştur',
                    'email'                    => 'E-posta',
                    'image'                    => 'Görsel',
                    'invalid-order-id'         => 'Geçersiz sipariş ID',
                    'mismatch'                 => 'Sipariş ID ve e-posta uyuşmuyor',
                    'new-rma'                  => 'Yeni İade Talebi',
                    'order-id'                 => 'Sipariş ID',
                    'quantity'                 => 'Miktar',
                    'reason'                   => 'Sebep',
                    'rma-already-exist'        => 'Bu İade Talebi zaten mevcut',
                    'rma-not-available-quotes' => 'Bu ürün için İade Talebi mümkün değil',
                    'save-btn'                 => 'Kaydet',
                    'search'                   => '--Seçiniz--',
                    'validate'                 => 'Doğrula',
                ],
            ],

            'invoice' => [
                'create' => [
                    'rma_has_been_created' => 'İade Talebi başarıyla oluşturuldu',
                    'rma-created-message'  => ':qty miktarındaki ürün için bir RMA talebi mevcuttur'
                ],
            ],
        ],

        'acl' => [
            'delete'      => 'Sil',
            'edit'        => 'Düzenle',
            'mass-delete' => 'Toplu Sil',
            'mass-update' => 'Toplu Güncelle',
            'title'       => 'RMA',
        ],
    ],

    'shop' => [
        'customer' => [
            'delivered'    => 'Teslim Edildi',
            'menu-name'    => 'Ürün İadesi',
            'offer'        => 'İlk siparişinizde %40 a varan İNDİRİM',
            'rma-qty'      => 'RMA Miktarı',
            'shop-now'     => 'ŞİMDİ ALIŞVERİŞ YAP',
            'submit-req'   => 'Talebi gönder',
            'title'        => 'Ürün İadesi',
            'undelivered'  => 'Teslim Edilmedi',

            'create' => [
                'cancel'                   => 'İptal',
                'create-btn'               => 'Kaydet',
                'enter-order-id'           => 'Sipariş Kimliği Girin',
                'heading'                  => 'Yeni İade Talebi',
                'exchange-window'          => 'Değişim Penceresi',
                'image'                    => 'Resim',
                'images'                   => 'Resimler',
                'information'              => 'Ek Bilgiler',
                'item-ordered'             => 'Sipariş Edilen Ürün',
                'no-record'                => 'Kayıt Bulunamadı!',
                'not-allowed'              => 'Bekleyen siparişler için ürün iadesi yapılamaz',
                'order-status'             => 'Sipariş Durumu',
                'orders'                   => 'Siparişler',
                'price'                    => 'Fiyat',
                'product-name'             => 'Ürün Adı',
                'product'                  => 'Ürün',
                'quantity'                 => 'Miktar',
                'reason'                   => 'Neden',
                'reopen-request'           => 'Talebi Tekrar Aç',
                'resolution'               => 'Çözünürlük Seçin',
                'return-window'            => 'İade Penceresi',
                'rma-not-available-quotes' => 'Ürün iade için uygun değil',
                'save'                     => 'Kaydet',
                'search-order'             => 'Sipariş Ara',
                'sku'                      => 'Stok Kodu (SKU)',
            ],
        ],

        'guest' => [
            'view' => [
                'close-rma'    => 'Ürün İadesini Kapat:',
                'order-status' => 'Sipariş Durumu:',
                'rma-status'   => 'Ürün İade Durumu:',
                'title'        => 'Ürün İadesi',
            ],

            'create' => [
                'cancel'                   => 'İptal',
                'create-btn'               => 'Kaydet',
                'enter-order-id'           => 'Sipariş Kimliği Girin',
                'heading'                  => 'Yeni İade Talebi',
                'image'                    => 'Resim',
                'images'                   => 'Resimler',
                'information'              => 'Ek Bilgiler',
                'item-ordered'             => 'Sipariş Edilen Ürün',
                'not-allowed'              => 'Bekleyen siparişler için ürün iadesi yapılamaz',
                'order-status'             => 'Sipariş Durumu',
                'orders'                   => 'Siparişler',
                'price'                    => 'Fiyat',
                'product-name'             => 'Ürün Adı',
                'product'                  => 'Ürün',
                'quantity'                 => 'Miktar',
                'reason'                   => 'Neden',
                'reopen-request'           => 'Talebi Tekrar Aç',
                'resolution'               => 'Çözünürlük Seçin',
                'rma-not-available-quotes' => 'Ürün iade için uygun değil',
                'save'                     => 'Kaydet',
                'search-order'             => 'Sipariş Ara',
                'sku'                      => 'Stok Kodu (SKU)',
                'title'                    => 'Ürün İadesi',
            ],

            'index' => [
                'create'  => 'Yeni İade Talebi Oluştur',
                'delete'  => 'Sil',
                'edit'    => 'Düzenle',
                'guest'   => 'Misafir İade Paneli',
                'heading' => 'Misafir İade Paneli',
                'update'  => 'Güncelle',
                'view'    => 'Görüntüle',
            ],
        ],

        'customer-rma-index' => [
            'create'  => 'Oluştur',
            'delete'  => 'Sil',
            'edit'    => 'Düzenle',
            'guest'   => 'Misafir İade Paneli',
            'heading' => 'Ürün İadesi',
            'update'  => 'Güncelle',
            'view'    => 'Görüntüle',
        ],

        'validation' => [
            'close-rma'     => 'Onayla',
            'information'   => 'Ek Bilgiler',
            'order-id'      => 'Sipariş Seçimi',
            'order-status'  => 'Sipariş Durumu',
            'orders'        => 'Siparişler',
            'resolution'    => 'Çözünürlük',
            'select-orders' => 'Sipariş Seçin',
        ],

        'conversation-texts' => [
            'by'        => 'Tarafından',
            'customer'  => 'Müşteri',
            'no-record' => 'Kayıt Bulunamadı!',
            'on'        => 'Üzerinde',
            'seller'    => 'Satıcı',
        ],

        'default-option' => [
            'others'              => 'Diğer',
            'please-select-value' => 'Lütfen Değer Seçin',
            'select-order-status' => 'Sipariş Durumu Seçin',
            'select-order'        => 'Sipariş Seçin',
            'select-quantity'     => 'Miktar Seçin',
            'select-reason'       => 'Neden Seçin',
            'select-resolution'   => 'Çözünürlük Seçin',
            'select-seller'       => 'Satıcı Seçin',
        ],

        'view-customer-rma' => [
            'additional-information'  => 'Ek Bilgiler:',
            'admin'                   => 'Yönetici',
            'cancel-order'            => 'Siparişi İptal Et',
            'change-rma-status'       => 'Ürün İade Durumunu Değiştir',
            'close-rma'               => 'Ürün İadesini Kapat:',
            'conversations'           => 'Konuşmalar',
            'guest'                   => 'Misafir',
            'heading'                 => 'Ürün İade Detayları',
            'images'                  => 'Resimler:',
            'items-request'           => 'İade İstenen Ürün(ler)',
            'items-requested-for-rma' => 'İade İstenen Ürün(ler)',
            'order-id'                => 'Sipariş ID:',
            'refund-details'          => 'İade Detayları',
            'refund-offline-btn'      => 'Çevrimdışı İade',
            'refundable-amount'       => 'İade Edilebilir Miktar',
            'resolution-type'         => 'Çözünürlük Türü:',
            'rma'                     => 'Ürün İade',
            'save-btn'                => 'Kaydet',
            'send-message-btn'        => 'Gönder',
            'send-message'            => 'Mesaj Gönder',
            'status-details'          => 'Durum Detayları',
            'status-quotes'           => 'Çözüldü olarak işaretlemek için lütfen kabul edin',
            'status-reopen'           => 'Tekrar açmak için işaretleyin',
            'status'                  => 'Durum',
            'term'                    => 'İşaret alanı kabul edilmelidir',
            'you'                     => 'Yönetici',
        ],

        'view-guest-rma' => [
            'additional-information' => 'Ek Bilgiler:',
            'admin'                  => 'Yönetici',
            'close-rma'              => 'Ürün İadesini Kapat',
            'conversations'          => 'Konuşmalar',
            'guest'                  => 'Siz',
            'images'                 => 'Resimler',
            'items-request'          => 'İade İstenen Ürün(ler)',
            'order-id'               => ' Sipariş ID:',
            'refund-offline-btn'     => 'Çevrimdışı İade',
            'resolution-type'        => 'Çözünürlük Türü:',
            'rma'                    => 'Ürün İade',
            'save-btn'               => 'Kaydet',
            'send-message-btn'       => 'Gönder',
            'send-message'           => 'Mesaj Gönder',
            'status-details'         => 'Durum Detayları',
            'status-quotes'          => 'Çözüldü olarak işaretlemek için lütfen kabul edin.',
            'status'                 => 'Durum',
            'term'                   => 'İşaret alanı kabul edilmelidir',
        ],

        'view-guest-rma-content' => [
            'full-amount'  => 'Tam Miktar',
            'order-status' => 'Sipariş Durumu:',
            'request-on'   => 'Talep Tarihi:',
            'rma-status'   => 'Ürün İade Durumu:',
        ],

        'view-customer-rma-content' => [
            'admin-status'            => 'Yönetici Durumu:',
            'close-rma'               => 'Ürün İadesini Kapat',
            'consignment-no'          => 'Sevkiyat Numarası:',
            'enter-message'           => 'Mesaj Girin',
            'full-amount'             => 'Tam Miktar',
            'order-details'           => 'Sipariş Detayları',
            'order-status'            => 'Sipariş Durumu:',
            'partial-amount'          => 'Kısmi Miktar',
            'refundable-amount'       => 'İade Edilebilir Miktar:',
            'request-on'              => 'Talep Tarihi:',
            'rma-status'              => 'Ürün İade Durumu:',
            'seller'                  => 'Satıcı',
            'total-refundable-amount' => 'Toplam İade Edilebilir Miktar:',
        ],

        'table-heading' => [
            'image'           => 'Görüntü',
            'order-qty'       => 'Sipariş Miktarı',
            'price'           => 'Fiyat',
            'product-name'    => 'Ürün Adı',
            'reason'          => 'Sebep',
            'resolution-type' => 'Çözüm Türü',
            'rma-qty'         => 'RMA Miktarı',
            'sku'             => 'Stok Kodu',
        ],

        'guest-users' => [
            'button-text' => 'Giriş Yap',
            'email'       => 'E-posta',
            'heading'     => 'Misafir Giriş Paneli',
            'logout'      => 'Misafir Çıkışı',
            'order-id'    => 'Sipariş ID',
            'title'       => 'Misafir Giriş',
        ],
    ],

    'mail' => [
        'customer-rma-create' => [
            'additional-information' => 'Ek Bilgi:',
            'greeting'               => 'Siparişiniz için yeni bir RMA talebi oluşturdunuz: :order_id.',
            'heading'                => 'RMA Talebi',
            'hello'                  => 'Sayın :name',
            'order-id'               => 'Sipariş ID:',
            'order-status'           => 'Sipariş Durumu:',
            'requested-rma-product'  => 'RMA için Talep Edilen Ürün:',
            'resolution-type'        => 'Çözüm Türü:',
            'rma-id'                 => 'RMA ID:',
            'summary'                => 'Siparişin RMA Özeti',
            'thank-you'              => 'Teşekkür ederiz',
        ],

        'customer-data-table-heading' => [
            'product-name' => 'Ürün Adı',
            'qty'          => 'Miktar',
            'reason'       => 'Neden',
            'sku'          => 'Stok Kodu (SKU)',
        ],

        'customer-conversation' => [
            'heading' => 'Sayın :name,',
            'message' => 'Mesaj',
            'process' => 'İade talebiniz işleniyor.',
            'quotes'  => 'Alıcıdan yeni bir mesaj var',
            'solved'  => 'RMA durumu müşteri tarafından Çözüldü olarak değiştirildi.',
        ],

        'seller-conversation' => [
            'heading' => 'Sayın :name',
            'message' => 'Mesaj',
            'quotes'  => 'Yönetici’den yeni bir mesaj var',
            'title'   => 'Mesaj Alındı!',
        ],

        'status' => [
            'heading'       => 'Sayın :name',
            'quotes'        => 'RMA durumunuz satıcı tarafından değiştirildi',
            'rma-id'        => 'RMA ID',
            'status-change' => ':id durumu satıcı tarafından değiştirildi',
            'status'        => 'Durum',
            'title'         => 'Durum Güncellendi!',
            'your-rma-id'   => 'Sizin RMA ID',
        ],
    ],

    'status' => [
        'status-name' => [
            'accept'                   => 'Kabul Et',
            'awaiting'                 => 'Beklemede',
            'canceled'                 => 'İptal Edildi',
            'declined'                 => 'Reddedildi',
            'dispatched-package'       => 'Paket Gönderildi',
            'item-canceled'            => 'Ürün İptal Edildi',
            'not-received-package-yet' => 'Paket Henüz Alınmadı',
            'pending'                  => 'Beklemede',
            'processing'               => 'İşleniyor',
            'received-package'         => 'Paket Alındı',
            'solved'                   => 'Çözüldü',
        ],

        'status-quotes' => [
            'declined-admin'  => 'RMA yönetici tarafından reddedildi.',
            'declined-buyer'  => 'RMA alıcı tarafından reddedildi.',
            'solved-by-admin' => 'RMA yönetici tarafından çözüldü.',
            'solved'          => 'RMA çözüldü.',
        ],
    ],

    'response' => [
        'already-cancel'    => 'RMA durumu zaten iptal edilmiştir.',
        'cancel-success'    => 'RMA durumu başarıyla iptal edildi.',
        'create-success'    => 'İstek başarıyla oluşturuldu.',
        'creation-error'    => 'RMA durumu güncellenemiyor çünkü bu sipariş için fatura oluşturulmamış.',
        'permission-denied' => 'Giriş yaptınız',
        'rma-disabled'      => 'Bu ürün için RMA devre dışı bırakıldı',
        'send-message'      => ':name başarıyla gönderildi.',
        'update-success'    => ':name başarıyla güncellendi.',
    ],
];