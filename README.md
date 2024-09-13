# PWEB-2_TUGAS-2
# Tentang Saya
<pre>
  Nama    : Meilita Ayu Nur Khasanah
  Kelas   : TI-2B
  NIM     : 230102038
</pre>

<ol>
  <li>Membuat View berbasis OOP, dengan mengambil data dari database MySQL</li>

  ```php
<?php

//Membuat Kelas Database dengan nama database sebagai parent class
class Database {
    private $host = "localhost"; // Nama host database
    private $username = "root"; // Username database
    private $password = ""; // Password database
    private $dbname = "course"; // Nama database yang dibuat
    public $conn;

    // Constructor untuk membuat koneksi ke database
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Cek apakah koneksi berhasil
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }
}

//Membuat Child Class Courses 
class Courses extends Database {
    // Mengambil semua data dari tabel 'courses'
    public function TampilData() {
        $query = "SELECT * FROM courses"; 
        $result = mysqli_query($this->conn, $query); // Menjalankan query
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row; //Menyimpan hasil querry dalam array
        }
        return $array;
    }
}

//Membuat Child Class Courses 
class Course_classes extends Database {
    public function TampilData() {
        $query = "SELECT * FROM course_classes";
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

// Membuat Subclasses turunan dari tabel courses (Polymorphism)
class CourseMtk extends Courses {
    public function TampilData() {
        $query = "SELECT * FROM courses WHERE name = 'Matematika'"; //Untuk menampilkan data pada tabel courses yang name nya Matematika
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

class CourseIp extends Courses {
    public function TampilData() {
        $query = "SELECT * FROM courses WHERE name = 'Ilmu Pengetahuan'"; //Untuk menampilkan data pada tabel courses yang name nya Ilmu Pengetahuan
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}


// Membuat Subclasses turunan dari tabel course_classes (Polymorphism)
class CourseId extends Course_classes {
    public function TampilData() {
        $query = "SELECT * FROM course_classes WHERE course_id = 1"; //Untuk menampilkan data pada tabel course_classes yang course_id nya 1
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}


?>

```

<hr><br>

  <li>Gunakan _construct sebagai tautan ke database</li>

  ```php

// Constructor untuk membuat koneksi ke database
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Cek apakah koneksi berhasil
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

```

- menggunakan konstruktor (__construct) dalam kelas Database untuk membuat koneksi ke database. Konstruktor ini dipanggil secara otomatis saat objek dari kelas dibuat dan bertugas untuk menginisialisasi koneksi database.
- Konstruktor membuat koneksi ke database MySQL dan memeriksa apakah koneksi berhasil. Jika tidak, koneksi gagal dan akan menghentikan eksekusi program dengan pesan error.

<hr><br>

<li>Menerapkan enkapsulasi sesuai dengan logika studi kasus</li>

```php
class Database {
    private $host = "localhost"; // Nama host database
    private $username = "root"; // Username database
    private $password = ""; // Password database
    private $dbname = "course"; // Nama database yang dibuat
    public $conn;

    // Constructor untuk membuat koneksi ke database
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
}
```

- Enkapsulasi dalam OOP menyembunyikan detail implementasi dan melindungi data internal. Dalam hal ini, variabel $host, $username, $password, dan $dbname adalah private, sehingga hanya dapat diakses dari dalam kelas Database.
- $conn adalah properti publik yang digunakan untuk menyimpan objek koneksi ke database (mysqli). Dengan menjadikannya publik, kelas Database mengizinkan akses ke objek koneksi ini dari luar kelas.

<hr><br>
<li>Membuat kelas turunan menggunakan konsep Inheritance</li>

  ```php
class Courses extends Database {
    // Mengambil semua data dari tabel 'courses'
    public function TampilData() {
        $query = "SELECT * FROM courses"; 
        $result = mysqli_query($this->conn, $query); // Menjalankan query
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row; //Menyimpan hasil querry dalam array
        }
        return $array;
    }
}

//Membuat Child Class Courses 
class Course_classes extends Database {
    public function TampilData() {
        $query = "SELECT * FROM course_classes";
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

```

- Inheritance  mewarisi sifat dan metode dari kelas lain (kelas induk). Dalam kasus ini, Courses dan Course_classes mewarisi dari Database dan menambahkan fungsionalitas tambahan untuk mengakses tabel spesifik.
- Kelas Courses dan Course_classes mewarisi koneksi database dari kelas Database dan menambahkan metode TampilData untuk mengakses data dari tabel courses dan course_classes.

<hr><br>

<li>Menerapkan polimorfisme untuk setidaknya 2 role sesuai dengan studi kasus</li>

  ```php
class Courses extends Database {
    // Mengambil semua data dari tabel 'courses'
    public function TampilData() {
        $query = "SELECT * FROM courses"; 
        $result = mysqli_query($this->conn, $query); // Menjalankan query
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row; //Menyimpan hasil querry dalam array
        }
        return $array;
    }
}

//Membuat Child Class Courses 
class Course_classes extends Database {
    public function TampilData() {
        $query = "SELECT * FROM course_classes";
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

// Membuat Subclasses turunan dari tabel courses (Polymorphism)
class CourseMtk extends Courses {
    public function TampilData() {
        $query = "SELECT * FROM courses WHERE name = 'Matematika'"; //Untuk menampilkan data pada tabel courses yang name nya Matematika
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

class CourseIp extends Courses {
    public function TampilData() {
        $query = "SELECT * FROM courses WHERE name = 'Ilmu Pengetahuan'"; //Untuk menampilkan data pada tabel courses yang name nya Ilmu Pengetahuan
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}


// Membuat Subclasses turunan dari tabel course_classes (Polymorphism)
class CourseId extends Course_classes {
    public function TampilData() {
        $query = "SELECT * FROM course_classes WHERE course_id = 1"; //Untuk menampilkan data pada tabel course_classes yang course_id nya 1
        $result = mysqli_query($this->conn, $query);
        $array = array();
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

```

- Polymorfisme memungkinkan metode yang sama untuk digunakan dengan cara yang berbeda berdasarkan objeknya. 
- Kelas CourseMtk dan CourseIp menimpa metode TampilData() dari Courses untuk mengambil data khusus berdasarkan nama kursus.
- CourseId menimpa metode TampilData() dari Course_classes untuk mengambil data berdasarkan course_id.
php

</ol>

<h3>Output Tampilan untuk Menampilkan Semua Data dari tabel Course</h3>

![All_courses](https://github.com/user-attachments/assets/d3aff05b-507a-4c5c-ada7-73fc2f187994)

<h3>Output Tampilan untuk Menampilkan Semua Data dari tabel Course Classes</h3>

![All_courses_classes](https://github.com/user-attachments/assets/6ebec1f8-bfa1-4473-9a57-d50a600e657a)

<h3>Output Tampilan untuk Menampilkan Semua Data dari tabel courses yang hanya menampilkan Course Name Matematika</h3>

![Matematika](https://github.com/user-attachments/assets/0e590e7a-bfe3-4229-8894-a41731f91c3a)

<h3>Output Tampilan untuk Menampilkan Semua Data dari tabel courses yang hanya menampilkan Course Name Ilmu Pengetahuan</h3>

![Ilmu_Pengetahuan](https://github.com/user-attachments/assets/9413bfc8-3604-42cb-9493-5ca0ea4c56e1)

<h3>Output Tampilan untuk Menampilkan Semua Data dari tabel Course Classes yang hanya menampilkan Course Id nya 1 </h3>

![Courses_classes_ID1](https://github.com/user-attachments/assets/5f2d08a3-290f-4cf6-8417-426985e386cb)


<h3>Authors</h3>
Meilita Ayu Nur Khasanah
