# PWEB-2_TUGAS-2
# Tentang Saya
<pre>
  Nama    : Meilita Ayu Nur Khasanah
  Kelas   : TI-2B
  NIM     : 230102038
</pre>

<h3>ERD</h3>

![erd](https://github.com/user-attachments/assets/f495f47d-7892-4a3d-b635-e882f1f44937)


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

<br><hr>
<h3>Code Tampilan</h3>

```php
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Courses Data</title>
    <?php
    // Mengkoneksikan dengan file koneksi.php yang berisi definisi kelas // Include koneksi.php yang berisi definisi kelas
      include('koneksi.php');
```

- Instansiasi Object dari Kelas 
```php
    // Instansiasi Object dari Kelas 
    $courses = new Courses();          // Object untuk tabel 'courses'
    $course_classes = new Course_classes(); // Object untuk tabel 'course_classes'
    $course_mtk = new CourseMtk();     // Object untuk kursus 'Matematika'
    $course_ip = new CourseIp();       // Object untuk kursus 'Ilmu Pengetahuan'
    $course_id = new CourseId();       // Object untuk kelas kursus dengan ID 1

 ```

- Menyimpan nilai pilihan untuk mengontrol data apa yang akan diambil dan ditampilkan.
  
```php
   // Menyimpan nilai pilihan untuk mengontrol data apa yang akan diambil dan ditampilkan. 
    $selected_option = 'all_courses';  // menunjukkan bahwa semua kursus akan ditampilkan secara default.
    $data = $courses->TampilData();    // mengambil data dari tabel courses dan menyimpannya ke dalam $data
```

- Cek apakah ada pilihan yang dikirim melalui form
  
```php
    // Cek apakah ada pilihan yang dikirim melalui form
    if (isset($_POST['data_select'])) {
        // Ambil nilai yang dipilih oleh pengguna
        $selected_option = $_POST['data_select'];
        // Pilih data berdasarkan nilai yang dipilih
        if ($selected_option == 'all_courses') {
            $data = $courses->TampilData(); // Ambil semua data kursus
        } elseif ($selected_option == 'all_classes') {
            $data = $course_classes->TampilData(); // Ambil semua data kelas kursus
        } elseif ($selected_option == 'matematika') {
            $data = $course_mtk->TampilData(); // Ambil data kursus Matematika
        } elseif ($selected_option == 'ilmu_pengetahuan') {
            $data = $course_ip->TampilData(); // Ambil data kursus Ilmu Pengetahuan
        } elseif ($selected_option == 'course_id_1') {
            $data = $course_id->TampilData(); // Ambil kelas kursus dengan ID = 1
        }
    }
    ?>
  </head>
```

-  Dropdown untuk data selection

```php

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Course Data
            </div>
            <div class="card-body">

              <!-- Dropdown for data selection -->
              <form method="POST" action="">
                <div class="form-group">
                  <label for="data_select">Select Data:</label>
                  <select class="form-control" id="data_select" name="data_select">
```

- Pilihan dropdown untuk memilih data yang ingin ditampilkan

 ```php

                    <!-- Pilihan dropdown untuk memilih data yang ingin ditampilkan -->
                    <option value="all_courses" <?php echo ($selected_option == 'all_courses') ? 'selected' : ''; ?>>All Courses</option>
                    <option value="all_classes" <?php echo ($selected_option == 'all_classes') ? 'selected' : ''; ?>>All Course Classes</option>
                    <option value="matematika" <?php echo ($selected_option == 'matematika') ? 'selected' : ''; ?>>Matematika</option>
                    <option value="ilmu_pengetahuan" <?php echo ($selected_option == 'ilmu_pengetahuan') ? 'selected' : ''; ?>>Ilmu Pengetahuan</option>
                    <option value="course_id_1" <?php echo ($selected_option == 'course_id_1') ? 'selected' : ''; ?>>Course Classes with Course ID = 1</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Show Data</button>
              </form>

              <!-- Data Table -->
              <h5 class="mt-4">Data</h5>
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <?php if ($selected_option == 'all_courses' || $selected_option == 'matematika' || $selected_option == 'ilmu_pengetahuan') { ?>
 ```

- Header tabel untuk data kursus

```php 
                      <!-- Header tabel untuk data kursus -->
                      <th scope="col">No.</th>
                      <th scope="col">ID</th>
                      <th scope="col">Code</th>
                      <th scope="col">Name</th>
                      <th scope="col">SKS</th>
                      <th scope="col">Hours</th>
                      <th scope="col">Meetings</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Updated At</th>
                      <th scope="col">Deleted At</th>
                    <?php } elseif ($selected_option == 'all_classes' || $selected_option == 'course_id_1') { ?>

```
- Header tabel untuk data kelas kursus

```php            
                      <!-- Header tabel untuk data kelas kursus -->
                      <th scope="col">Class ID</th>
                      <th scope="col">Student Class ID</th>
                      <th scope="col">Course ID</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Updated At</th>
                      <th scope="col">Deleted At</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
```

- Loop untuk menampilkan data dari database

```php
                  <?php 
                      $no = 1;
                      // Loop untuk menampilkan data dari database
                      foreach($data as $row) {
                  ?>
```

- Menampilkan data Courses

  ```php
                  <tr>
                    <?php if ($selected_option == 'all_courses' || $selected_option == 'matematika' || $selected_option == 'ilmu_pengetahuan') { ?>                                            
                      <!-- Tampilkan data kursus -->
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['id'] ?></td>
                      <td><?php echo $row['code'] ?></td>
                      <td><?php echo $row['name'] ?></td>
                      <td><?php echo $row['sks'] ?></td>
                      <td><?php echo $row['hours'] ?></td>
                      <td><?php echo $row['meeting'] ?></td>
                      <td><?php echo $row['created_at'] ?></td>
                      <td><?php echo $row['updated_at'] ?></td>
                      <td><?php echo $row['deleted_at'] ?></td>
                    <?php } elseif ($selected_option == 'all_classes' || $selected_option == 'course_id_1') { ?>

  ```
- Menampilkan data Course_classes

  ```php
                      <!-- Tampilkan data kelas kursus -->
                      <td><?php echo $row['id'] ?></td>
                      <td><?php echo $row['student_class_id'] ?></td>
                      <td><?php echo $row['course_id'] ?></td>
                      <td><?php echo $row['created_at'] ?></td>
                      <td><?php echo $row['updated_at'] ?></td>
                      <td><?php echo $row['deleted_at'] ?></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

```
    <!-- JavaScript for Bootstrap and DataTables -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      // Initialize DataTable
      $(document).ready(function () {
          $('#dataTable').DataTable();
      });
    </script>
  </body>
</html>
```



<h3>Database</h3>

![Database tabel](https://github.com/user-attachments/assets/061c46e6-1715-42f6-9320-18ca6e37291e)


![database_courses](https://github.com/user-attachments/assets/c0bdfdfe-118f-4f58-9aea-5b9070f89b0a)

![database_course_classes](https://github.com/user-attachments/assets/f840c2bc-3578-4364-bd1a-937bebbac340)


<h3>Authors</h3>
Meilita Ayu Nur Khasanah
