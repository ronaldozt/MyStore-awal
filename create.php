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

    $first_name = "";
    $last_name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $succesMessage = "";

    // mengecek apakah semua kolom terisi
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        do{
            if( empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($address) ) {
                $errorMessage = "All the fields are required";
                break;
            }

            // menambah client ke database
            $sql = "INSERT INTO employees (first_name, last_name, email, phone, address) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";
            $result = $connection->query($sql);

            // mengecek query berjalan benar atau tidak
            if(!$result){
                $errorMessage = "Invalid query : " . $connection->error;
                break;
            }

            // mengosongkan isi variabel jika selesai menambahkan data ke db
            $first_name = "";
            $last_name = "";
            $email = "";
            $phone = "";
            $address = "";

            $succesMessage = "Client added correctly";
            // jeda 2 detik sebelum ke homepage
            sleep(2);
            echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$succesMessage</strong>
                            <button type='button' class='btn-close' data-ds-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            header("location: index.php");
            exit;

        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
</head>

<body>
    <div class="container my-5">
        <h2>New Clients</h2>
        <br>
        <!-- menampilkan pesan gagal -->
        <?php 
            if (!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">First Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="off-set col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a href="index.php" class="btn btn-outline-primary" role="button">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</body>
</html>