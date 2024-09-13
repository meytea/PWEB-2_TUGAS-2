<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Courses Data</title>
    <?php
    // Include database and class definitions
    include('koneksi.php'); // Include koneksi.php yang berisi definisi kelas

    
    // Instantiate objects from classes
    $courses = new Courses();          // Object untuk tabel 'courses'
    $course_classes = new Course_classes(); // Object untuk tabel 'course_classes'
    $course_mtk = new CourseMtk();     // Object untuk kursus 'Matematika'
    $course_ip = new CourseIp();       // Object untuk kursus 'Ilmu Pengetahuan'
    $course_id = new CourseId();       // Object untuk kelas kursus dengan ID 1

    // Default data is all courses
    $selected_option = 'all_courses';  // Pilihan default
    $data = $courses->TampilData();    // Ambil data default (semua kursus)

    // Check for user selection Cek untu
    if (isset($_POST['data_select'])) {
        // Ambil nilai yang dipilih oleh pengguna
        $selected_option = $_POST['data_select'];
        // Pilih data berdasarkan nilai yang dipilih
        if ($selected_option == 'all_courses') {
            $data = $courses->TampilData(); // Amb il semua data kursus
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
                  <?php 
                      $no = 1;
                      // Loop untuk menampilkan data dari database
                      foreach($data as $row) {
                  ?>
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
