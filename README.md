# Musteri Panel Skeleton

Bu depo, müşteri ve proje yönetimi için basit bir PHP örneği sunar. Bootstrap ile oluşturulmuş arayüzde temel CRUD işlemleri gerçekleştirilebilir. Son güncellemelerle tüm sayfalarda ortak bir gezinme menüsü ve kayıt düzenleme/silme özellikleri eklendi.

## Özellikler
- Örnek yönetici hesabı ile giriş yapabilirsiniz (`admin@example.com` / `password`)
- Müşteri, proje, görev, gelir ve gider kayıtlarını listeleyin
- Bu kayıtları ekleyin, düzenleyin veya silin
- Panel ana sayfasında toplam sayılar ve tutarlar özetlenir

## Kurulum
1. `config/database.php` dosyasında veritabanı bilgilerinizi düzenleyin.
2. `schema.sql` dosyasını MySQL veritabanınıza aktarın. Bu işlem varsayılan olarak `admin@example.com` / `password` bilgileriyle bir yönetici hesabı oluşturur.
3. Projeyi PHP çalıştırabilen bir sunucuya kopyalayın ve kök dizini `public` klasörüne yönlendirin.

## Sınırlamalar
- Gelişmiş yetkilendirme, raporlama veya PDF çıktısı gibi özellikler henüz bulunmamaktadır.
