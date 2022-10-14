```bash
git clone https://github.com/yandinovriandi/TunnelMikrotikBot.git 'TunnelMikrotikBot'
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
