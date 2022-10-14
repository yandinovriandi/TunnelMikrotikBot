
 



![Xnapper-2022-10-14-18 15 44](https://user-images.githubusercontent.com/17920675/195839490-e0f32909-bf12-4110-801e-02b6f5f6f963.png)
![Xnapper-2022-10-14-18 25 20](https://user-images.githubusercontent.com/17920675/195839506-6aa1acea-5c8d-4964-a053-594c827f0f8b.png)
![Xnapper-2022-10-14-18 15 16](https://user-images.githubusercontent.com/17920675/195839511-fc9e69da-6882-4189-9fc6-c57ad637a2ba.png)
![Xnapper-2022-10-14-18 16 16](https://user-images.githubusercontent.com/17920675/195839513-bf404e5b-08e5-4904-b600-8732ed50b4a4.png)
![Xnapper-2022-10-14-18 17 33](https://user-images.githubusercontent.com/17920675/195839517-f12e021c-71db-4733-b0a2-e80e4a11847e.png)
![Xnapper-2022-10-14-18 17 55](https://user-images.githubusercontent.com/17920675/195839521-82a0272e-d3aa-42a4-a0e6-7763049908de.png)
![Xnapper-2022-10-14-18 18 47](https://user-images.githubusercontent.com/17920675/195839527-dc36b08a-a8c6-48d1-b2fc-2db9544817ac.png)
![Xnapper-2022-10-14-18 14 07](https://user-images.githubusercontent.com/17920675/195839529-1bf767aa-881e-4d17-9b6f-93005727f387.png)
![Xnapper-2022-10-14-18 19 27](https://user-images.githubusercontent.com/17920675/195839534-78f57e87-386e-49e9-a55e-8b9a5e0d967e.png)
![Xnapper-2022-10-14-18 23 14](https://user-images.githubusercontent.com/17920675/195839537-48ecc6f3-3f38-4b6f-9b85-a0e8f746a364.png)
![Xnapper-2022-10-14-18 24 20](https://user-images.githubusercontent.com/17920675/195839539-909de88b-4d7f-45f2-ae89-760b40855a47.png)
![Xnapper-2022-10-14-18 14 37](https://user-images.githubusercontent.com/17920675/195839541-296c5a50-c571-48c4-a3f1-f3e6e822916a.png)
![laravelmikrotikapi2](https://user-images.githubusercontent.com/17920675/195839545-839bad42-f7f1-44a4-a01b-789b0d66262f.png)
![laravelmikrotikapi1](https://user-images.githubusercontent.com/17920675/195839551-b2996c93-0a9a-4c6d-b286-ec3fc6f59132.png)





```bash
git clone https://github.com/yandinovriandi/TunnelMikrotikBot.git

cd TunnelMikrotikBot
```

Instal semua PHP dependency dengan menjalankan perintah berikut ini

```bash
composer install
```

Jangan lupa untuk menginstall semua node package yang kita butuhkan seperti:

```bash
npm install && npm run build
```

Jika ingin dikembangkan, bisa dengan menjalankan

```bash
npm run dev
```

Buat 1 file dengan nama `.env` kemudian silakan copy semua yang ada di dalam file `.env.example` ke dalam file `.env`. Kemudian buka terminal kembali untuk generasi key baru.
atau bisa dengan perintah

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

Buat 1 database, dan sesuaikan namanya dengan konfirgurasi yang ada di file `.env`.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tunnelmikrotikbot
DB_USERNAME=root
DB_PASSWORD=
```

```bash
MIKROTIK_HOST=192.168.88.1
MIKROTIK_USER=admin
MIKROTIK_PASS=
MIKROTIK_PORT=8728
```

Setelah itu, jalankan perintah berikut pada terminal Anda.

```bash
php artisan migrate:fresh
```

Setelah itu, jalankan `artisan serve` untuk memulai laravel nya.
Jika kita coba untuk mendaftarkan pengguna baru, harusnya akan muncul error seperti:

```bash
Connection could not be established with host
```

Itu hanya karena kita perlu mengkonfigurasi email nya seperti:

```bash
MAIL_MAILER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@company.com"
MAIL_FROM_NAME="${APP_NAME}"
```

jika terasa lambat saat load tunnel, silahkan load data dari database jangan dari mikrotik.

jika saat daftar user dan verifikasi email tidak ingin menunggu aktif kan queue.

jika tabel jobs belum ada silahkan buat dulu

```bash
php artisan queue:work
```

Aplikasi ini saya buat sambil belajar di https:://parsinta.com

silahkan anda kalau ma belajar laravel juga kunjungi parsinta.
Silakan kembangkan dan jangan lupa stars nya.
