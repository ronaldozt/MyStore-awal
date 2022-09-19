<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
</head>
<body style="margin:50px;">
    <h1>LIST OF EMPLOYEES</h1>
    <br>
    <a href="create.php" class="btn btn-primary" role="button">New Client</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- awal PHP -->
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
            $sql = "SELECT * FROM employees";
            $result = $connection->query($sql);
            //cek query nya jalan atau tidak
            if(!$result){
                die("Invalid query : " . $connection -> error);
            }
            // print semua data dari db per baris
            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["first_name"] . "</td>
                <td>" . $row["last_name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["phone"] . "</td>
                <td>" . $row["address"] . "</td>
                <td>
                    <a class = 'btn btn-primary btn-sm' href='edit.php?id=$row[id]'>Update</a>
                    <a class = 'btn btn-danger btn-sm' href='delete.php?id=$row[id]'>Delete</a>
                </td>
            </tr>";
            }

            ?>
            <!-- akhir PHP -->
        </tbody>
    </table>
</body>
</html>