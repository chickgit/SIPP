# SIPP

Sistem Informasi Penjadwalan Perkuliahan

## Getting Started

SIPP merupakan sistem yang dibuat khusus untuk otomatisasi penjadwalan perkuliahan STTI NIIT I-Tech dengan tambahan fleksibilitas penuh kepada admin dalam pembuatan penjadwalan perkuliahan.

### Prerequisites

Hal-hal yang diperlukan dalam menjalankan SIPP

```
XAMPP v3.2.2 or newer
MySQL 5.5 or newer
PHP 5.5.0 or newer
Web Browser with cookies and JavaScript enabled (like Chrome)
```

### Installing

Langkah-langkah yang diperlukan agar SIPP dapat berjalan.

Masukkan folder SIPP ke dalam htdocs XAMPP

```
...\xampp\htdocs\SIPP
```

Import file DB

```
dbapp.sql
IMPORT as 'dbapp'
```

Atur konfigurasi database

```
SIPP/application/config/database.php
...
'hostname' => 'localhost', 
'username' => 'root', //Disesuaikan dengan user apache
'password' => '', //Disesuaikan dengan user apache
'database' => 'dbapp',
...
```

Atur konfigurasi base_url

```
SIPP/application/config/config.php
$config['base_url'] = 'http://localhost/SIPP';
```

## Built With

* [Codeigniter](https://www.codeigniter.com/) - The web framework used 

## Authors

* **M Maisur R** - *Initial work* - [chickgit](https://github.com/chickgit)
