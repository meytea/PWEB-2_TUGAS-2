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
