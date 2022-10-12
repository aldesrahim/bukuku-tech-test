
## Bukuku Tech Test

### Instalasi
1. Jalankan `composer install`
2. Jalankan `npm i` dan `npm run dev`
3. Konfigurasi `.env` sesuai kebutuhan Anda
4. Jalankan `php artisan queue:work`
5. Jalankan `php artisan schedule:work`
6. Jalankan `php artisan storage:link`

#### Side Note
Ada sedikit improvisasi mengenai teknik penyimpanan hasil kurs nya, karena pada source ini dibuat se-dinamis mungkin agar kedepannya jika ingin menambahkan sumber kurs selain dari kursdollar.org menjadi tidak sulit dan mudah. Oleh karena itu improvisasi yang saya buat adalah menambahkan sumber data kurs pada nama file JSON.  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ketentuan: `rate-dd-mm-yyyy--hh-mm-ss.json`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;improvisasi: `sumber-data-rate-dd-mm-yyyy--hh-mm-ss.json`  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;contoh: `kurs-dollar-org-rate-12-10-2022--23-35-55.json`

Adapun improvisasi yang lain yaitu penambahan tombol `Refresh` pada halaman utama dan juga menampilkan daftar file kurs yang telah disimpan.
