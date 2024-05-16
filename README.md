## Kurulum
- İlk olarak composer ile paketlerimiz yüklüyoruz
```
composer install
```
- .env.example dosyamızı .env ismi ile kopyalıyoruz.
- Mysql DB bilgilerimizi güncelliyoruz.
- Migration işlemlerimizi yaparak tablolarımızı oluşturuyoruz
```
php artisan migarete
```
- Sonrasında Seeder ile örnek user ve vehicle verilerini insert ediyoruz.
```
php artisan db:seed
```
-Artık proje çalışmaya hazır oldu. Projeyi çalıştırarak. Servisler kullanılmaya başlanabilir.
```
php artisan serve
```

## Kullanım
- Endpointler için Postman verilerini aşağıdaki urlden import edebilirsiniz.<br>
[Postman Collenction](https://api.postman.com/collections/6414947-e58a0216-7122-46de-a98b-e81ce4de4b60?access_key=PMAT-01HY1EY68T61SRG254GM2B93PP)<br>
[Postman Dokümantasyon](https://documenter.getpostman.com/view/6414947/2sA3JT1dDo)

- Seeder işlemleri ile aşağıdaki kullanıcı oluşturmuştuk. Bu kullanıcı ile token alabiliriz.
```
Email: admin@test.com
Password: admin
```
- Kullanımda Araçlar için `Vehicle` , Personeller için `User` Araçları personellere zimmet yapmak için `VehicleAssignment` altındaki verileri kullanacağız.
- Araç ve Personeller için Seeder ile biz örnek datalar oluşturmuştuk. Fakat yeni datalar oluşturmak için POST endpointleri kullanbiliriz.
- Araçlara zimmet atamak için Assignment endpointlerini kullanabiliriz. Bu endpointler seçili araca göre atanmaktadır.
- Ayrıca Postman dökümantasyonunda endpointler için kısa açıklamalar ile anlatmaya çalıştım.
