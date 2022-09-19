<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook</title>
</head>
<body style="margin:50px;">
    <h1>LOGBOOK KEGIATAN TENAGA PENDIDIK</h1>
    <br>
    <a href="addActivity" class="btn btn-primary btn-sm">Add Activity</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Surat</th>
                <th>Penerima</th>
                <th>Pengirim</th>
                <th>No.Surat</th>
                <th>Kode Unit</th>
                <th>Subjek</th>
                <th>Tahun</th>
                <th>Perihal</th>
                <th>Nama</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "mystore";
            // membuat koneksi
            $connection = new mysqli($servername, $username, $password, $database);
            // mengecek koneksi
            if ($connection -> connect_error){
                die("Connection failed : ". $connection -> connect_error);
            }
            //membaca tabel dari db
            $sql = "SELECT * FROM surat";
            $result = $connection->query($sql);
            //cek query nya jalan atau tidak
            if(!$result){
                die("Invalid query : " . $connection -> error);
            }
            // print semua data dari db per baris
            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td>" . $row["No"] . "</td>
                <td>" . $row["Tanggal Surat"] . "</td>
                <td>" . $row["Penerima"] . "</td>
                <td>" . $row["Pengirim"] . "</td>
                <td>" . $row["No.Surat"] . "</td>
                <td>" . $row["Kode Unit"] . "</td>
                <td>" . $row["Subjek"] . "</td>
                <td>" . $row["Tahun"] . "</td>
                <td>" . $row["Perihal"] . "</td>
                <td>" . $row["Nama"] . "</td>
                <td>" . $row["Link"] . "</td>
                <td>
                    <a class = 'btn btn-primary btn-sm' href='edit'>EDIT</a>
                    <a class = 'btn btn-danger btn-sm' href='delete'>DELETE</a>
                </td>
            </tr>";
            }

            ?>
        </tbody>
    </table>
</body>
</html>