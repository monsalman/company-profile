# Dokumentasi API

Dokumentasi ini menjelaskan cara menggunakan API untuk mengambil data dari aplikasi company profile.

## Base URL

Semua endpoint API menggunakan prefix `/api`. Contoh:
- `http://localhost/company-profile/api/homepage`
- `http://localhost/company-profile/api/portfolios`

## Format Response

Semua endpoint mengembalikan data dalam format JSON dengan struktur:
```json
{
  "success": true,
  "data": { ... }
}
```

Jika terjadi error:
```json
{
  "success": false,
  "message": "Pesan error"
}
```

## Endpoint yang Tersedia

### 1. Homepage - Semua Data
Mengambil semua data untuk homepage (hero sliders, client sliders, service cards, retail services, portfolios, dan hero content).

**GET** `/api/homepage`

**Response:**
```json
{
  "success": true,
  "data": {
    "hero_sliders": [...],
    "client_sliders": [...],
    "service_cards": [...],
    "retail_services": [...],
    "portfolios": [...],
    "hero_content": {
      "title": "...",
      "description": "..."
    }
  }
}
```

---

### 2. Hero Sliders

#### Get All Hero Sliders
**GET** `/api/hero-sliders`

#### Get Single Hero Slider
**GET** `/api/hero-sliders/{id}`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "image": "http://localhost/company-profile/storage/hero-images/...",
      "order": 0,
      "is_active": true,
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

---

### 3. Client Sliders

#### Get All Client Sliders
**GET** `/api/client-sliders`

#### Get Single Client Slider
**GET** `/api/client-sliders/{id}`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "image": "http://localhost/company-profile/storage/client-sliders/...",
      "order": 0,
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

---

### 4. Hero Content
**GET** `/api/hero-content`

**Response:**
```json
{
  "success": true,
  "data": {
    "title": "Judul Hero",
    "description": "Deskripsi Hero"
  }
}
```

---

### 5. Service Cards

#### Get All Service Cards
**GET** `/api/service-cards`

#### Get Single Service Card
**GET** `/api/service-cards/{id}`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "image": "http://localhost/company-profile/storage/service-cards/...",
      "title": "Judul Service",
      "description": "Deskripsi Service",
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

---

### 6. Retail Services

#### Get All Retail Services
**GET** `/api/retail-services`

#### Get Single Retail Service
**GET** `/api/retail-services/{id}`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "image": "http://localhost/company-profile/storage/retail-services/...",
      "title": "Judul Retail Service",
      "description": "Deskripsi Retail Service",
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

---

### 7. Portfolios

#### Get All Portfolios
**GET** `/api/portfolios`

#### Get Single Portfolio by Slug
**GET** `/api/portfolios/{slug}`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Judul Portfolio",
      "description": "Deskripsi Portfolio",
      "image": "http://localhost/company-profile/storage/portfolios/...",
      "slug": "judul-portfolio",
      "created_at": "...",
      "updated_at": "..."
    }
  ]
}
```

---

### 8. Layanan

#### Get All Layanan
**GET** `/api/layanan`

#### Get Layanan by Key
**GET** `/api/layanan/{key}`

**Key yang tersedia:**
- `service_custom` - Layanan Custom
- `service_retail` - Layanan Retail

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "key": "service_custom",
      "title": "Judul Layanan",
      "description": "Deskripsi Layanan"
    }
  ]
}
```

---

### 9. Page Titles

#### Get All Page Titles
**GET** `/api/page-titles`

#### Get Page Title by Key
**GET** `/api/page-titles/{key}`

**Key yang tersedia:**
- `homepage` - Title untuk Homepage
- `login` - Title untuk Halaman Login
- `error_404` - Title untuk Halaman 404

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "key": "homepage",
      "value": "Judul Halaman"
    }
  ]
}
```

---

### 10. Profile Kami
**GET** `/api/profile-kami`

**Response:**
```json
{
  "success": true,
  "data": {
    "title": "Judul Profile",
    "description_1": "Deskripsi 1",
    "description_2": "Deskripsi 2"
  }
}
```

---

### 11. Visi Misi
**GET** `/api/visi-misi`

**Response:**
```json
{
  "success": true,
  "data": {
    "visi": "Visi perusahaan",
    "misi": "Misi perusahaan"
  }
}
```

---

## Contoh Penggunaan

### Menggunakan JavaScript (Fetch API)

```javascript
// Mengambil data homepage
fetch('http://localhost/company-profile/api/homepage')
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if (data.success) {
      console.log('Hero Sliders:', data.data.hero_sliders);
      console.log('Portfolios:', data.data.portfolios);
    }
  })
  .catch(error => console.error('Error:', error));

// Mengambil semua portfolios
fetch('http://localhost/company-profile/api/portfolios')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      data.data.forEach(portfolio => {
        console.log(portfolio.title);
      });
    }
  });

// Mengambil portfolio berdasarkan slug
fetch('http://localhost/company-profile/api/portfolios/nama-portfolio')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log(data.data);
    }
  });
```

### Menggunakan cURL

```bash
# Mengambil data homepage
curl http://localhost/company-profile/api/homepage

# Mengambil semua portfolios
curl http://localhost/company-profile/api/portfolios

# Mengambil portfolio berdasarkan slug
curl http://localhost/company-profile/api/portfolios/nama-portfolio
```

### Menggunakan PHP

```php
// Mengambil data homepage
$url = 'http://localhost/company-profile/api/homepage';
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['success']) {
    $heroSliders = $data['data']['hero_sliders'];
    $portfolios = $data['data']['portfolios'];
    // ... proses data
}
```

### Menggunakan Postman

Postman adalah tool yang sangat berguna untuk menguji dan mengembangkan API. Berikut langkah-langkahnya:

#### 0. Import Collection (Cara Cepat)

**File collection sudah tersedia!** Anda bisa langsung import file `Company_Profile_API.postman_collection.json`:

1. **Buka Postman**
2. **Klik "Import"** di pojok kiri atas
3. **Pilih tab "File"** → Klik "Upload Files"
4. **Pilih file**: `Company_Profile_API.postman_collection.json`
5. **Klik "Import"**

Setelah diimport:
- Semua endpoint sudah tersedia dalam collection "Company Profile API"
- Variable `base_url` sudah diset ke `http://localhost/company-profile`
- Anda bisa langsung klik "Send" untuk test endpoint

**Mengubah Base URL:**
- Klik ikon "Environments" di sidebar kiri
- Klik "Company Profile API" (atau collection yang diimport)
- Edit variable `base_url` sesuai kebutuhan
- Atau buat Environment baru dengan variable `base_url`

#### 1. Setup Awal (Jika Membuat Manual)

1. **Buka Postman** (download di https://www.postman.com/downloads/ jika belum punya)
2. **Buat Collection Baru** (opsional tapi disarankan):
   - Klik "New" → "Collection"
   - Beri nama: "Company Profile API"
   - Klik "Create"

#### 2. Membuat Request

**Cara 1: Request Baru**
- Klik "New" → "HTTP Request"
- Atau klik tombol "+" di tab baru

**Cara 2: Tambah ke Collection**
- Klik kanan pada Collection → "Add Request"
- Beri nama request, contoh: "Get Homepage"

#### 3. Konfigurasi Request

**Untuk GET Request (Mengambil Data):**

1. **Pilih Method**: Pilih `GET` dari dropdown (default)
2. **Masukkan URL**: 
   ```
   http://localhost/company-profile/api/homepage
   ```
   Atau endpoint lainnya:
   - `http://localhost/company-profile/api/portfolios`
   - `http://localhost/company-profile/api/service-cards`
   - `http://localhost/company-profile/api/hero-sliders`
   - dll.

3. **Headers** (opsional):
   - Klik tab "Headers"
   - Tambahkan header jika diperlukan:
     - `Accept: application/json`
     - `Content-Type: application/json`

4. **Klik "Send"** untuk mengirim request

#### 4. Contoh Request untuk Berbagai Endpoint

**A. Get Homepage (Semua Data)**
```
Method: GET
URL: http://localhost/company-profile/api/homepage
```

**B. Get All Portfolios**
```
Method: GET
URL: http://localhost/company-profile/api/portfolios
```

**C. Get Portfolio by Slug**
```
Method: GET
URL: http://localhost/company-profile/api/portfolios/nama-slug-portfolio
```
*Ganti `nama-slug-portfolio` dengan slug yang sebenarnya*

**D. Get Service Card by ID**
```
Method: GET
URL: http://localhost/company-profile/api/service-cards/1
```
*Ganti `1` dengan ID yang sebenarnya*

**E. Get Hero Content**
```
Method: GET
URL: http://localhost/company-profile/api/hero-content
```

**F. Get Visi Misi**
```
Method: GET
URL: http://localhost/company-profile/api/visi-misi
```

#### 5. Melihat Response

Setelah klik "Send", Anda akan melihat:

1. **Status Code**: Di bagian atas (200 OK, 404 Not Found, dll)
2. **Response Body**: Data JSON yang dikembalikan
3. **Response Time**: Waktu yang dibutuhkan untuk request
4. **Response Size**: Ukuran response

**Contoh Response yang Berhasil:**
```json
{
  "success": true,
  "data": {
    "hero_sliders": [
      {
        "id": 1,
        "image": "http://localhost/company-profile/storage/hero-images/...",
        "order": 0,
        "is_active": true
      }
    ],
    "portfolios": [...],
    ...
  }
}
```

**Contoh Response Error (404):**
```json
{
  "success": false,
  "message": "Portfolio tidak ditemukan"
}
```

#### 6. Tips Menggunakan Postman

**A. Environment Variables (Sangat Disarankan)**

Untuk menghindari mengetik URL berulang-ulang:

1. Klik ikon "Environments" di sidebar kiri
2. Klik "Create Environment"
3. Tambahkan variable:
   - **Variable Name**: `base_url`
   - **Initial Value**: `http://localhost/company-profile`
   - **Current Value**: `http://localhost/company-profile`
4. Klik "Save"
5. Pilih environment yang baru dibuat di dropdown kanan atas
6. Di URL request, gunakan: `{{base_url}}/api/homepage`

**B. Format JSON Response**

Postman secara otomatis akan memformat JSON dengan rapi. Jika tidak:
- Klik dropdown di sebelah "Body" → pilih "JSON"
- Atau install extension "JSON Formatter"

**C. Save Response**

- Klik "Save Response" untuk menyimpan response sebagai contoh
- Berguna untuk dokumentasi atau testing

**D. Collection Runner**

Untuk menjalankan multiple requests sekaligus:
1. Klik kanan pada Collection
2. Pilih "Run collection"
3. Pilih request yang ingin dijalankan
4. Klik "Run Company Profile API"

**E. Export Collection**

Untuk berbagi collection dengan tim:
1. Klik kanan pada Collection
2. Pilih "Export"
3. Pilih format (Collection v2.1 recommended)
4. Simpan file JSON

#### 7. Troubleshooting di Postman

**Problem: "Could not get any response"**
- Pastikan server Laravel berjalan
- Cek URL apakah benar
- Cek apakah ada firewall yang memblokir

**Problem: "404 Not Found"**
- Pastikan route API sudah terdaftar di `routes/api.php`
- Cek apakah `bootstrap/app.php` sudah dikonfigurasi dengan benar
- Pastikan URL endpoint benar

**Problem: Response kosong atau null**
- Cek apakah database sudah ada datanya
- Cek apakah model dan migration sudah benar

**Problem: CORS Error**
- Jika mengakses dari domain berbeda, tambahkan CORS middleware
- Atau gunakan Postman (tidak terpengaruh CORS)

#### 8. Contoh Collection Setup Lengkap

Buat request-request berikut dalam satu collection:

```
Company Profile API
├── Homepage
│   └── GET /api/homepage
├── Hero Sliders
│   ├── GET /api/hero-sliders
│   └── GET /api/hero-sliders/{id}
├── Client Sliders
│   ├── GET /api/client-sliders
│   └── GET /api/client-sliders/{id}
├── Portfolios
│   ├── GET /api/portfolios
│   └── GET /api/portfolios/{slug}
├── Service Cards
│   ├── GET /api/service-cards
│   └── GET /api/service-cards/{id}
├── Retail Services
│   ├── GET /api/retail-services
│   └── GET /api/retail-services/{id}
├── Hero Content
│   └── GET /api/hero-content
├── Layanan
│   ├── GET /api/layanan
│   └── GET /api/layanan/{key}
├── Page Titles
│   ├── GET /api/page-titles
│   └── GET /api/page-titles/{key}
├── Profile Kami
│   └── GET /api/profile-kami
└── Visi Misi
    └── GET /api/visi-misi
```

#### 9. Screenshot Referensi

Struktur URL di Postman:
```
[GET ▼] http://localhost/company-profile/api/homepage [Send]
```

Tab yang tersedia:
- **Params**: Untuk query parameters (jika ada)
- **Authorization**: Untuk autentikasi (tidak diperlukan untuk GET)
- **Headers**: Header HTTP
- **Body**: Body request (untuk POST/PUT, tidak untuk GET)
- **Pre-request Script**: Script sebelum request
- **Tests**: Script untuk test response

---

## Catatan Penting

1. **Base URL**: Ganti `http://localhost/company-profile` dengan URL domain Anda yang sebenarnya
2. **CORS**: Jika Anda mengakses API dari domain yang berbeda, Anda mungkin perlu mengkonfigurasi CORS
3. **Authentication**: Endpoint ini tidak memerlukan autentikasi untuk membaca data (GET requests)
4. **Image URLs**: Semua URL gambar sudah termasuk path lengkap dengan `asset('storage/...')`

---

## Error Handling

Jika resource tidak ditemukan, API akan mengembalikan status code 404 dengan format:

```json
{
  "success": false,
  "message": "Resource tidak ditemukan"
}
```

Contoh:
- `/api/portfolios/slug-yang-tidak-ada` → 404
- `/api/service-cards/999` → 404

