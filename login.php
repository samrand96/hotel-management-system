<?php
error_reporting(0);
require_once("model/dbconnection.php");
session_start();
if (($_SESSION["login"])) {
    header("Location: index.php");
}
$warning = "";
if (isset($_POST["username"])) {
    $username = htmlentities($_POST["username"]);
    $password = sha1($_POST["password"]);
    $search = $db->prepare("SELECT * FROM users WHERE username = ?");
    $search->bindParam(1, $username, PDO::ATTR_DEFAULT_STR_PARAM);

    if ($search->execute()) {
        if ($search->rowCount() == 1) {
            $result = $search->fetch(PDO::FETCH_ASSOC);
            $db_password = $result["password"];
            if ($db_password == $password) {
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["full_name"] = $result["full_name"];
                $_SESSION["username"] = $result["username"];
                $_SESSION["login"] = true;
                $_SESSION['is_admin'] = $result['permission']=='ADMIN'?TRUE:FALSE;

                //header("Location: index.php");
                echo "<script> window.location.href = 'index.php' </script>";
            } else {
                $warning = "Your password is wrong";
            }
        } else {
            $warning = "Your username is wrong";
        }
    } else {
        $warning = "There was encountered error";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Authentication - iHospitality</title>
        <link href="_assets/css/styles.css" rel="stylesheet" />
        <link href="_assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="_assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" name="username" type="text" placeholder="Enter username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2023 - Developed by <a href="https://www.samrand.me">Samrand Hassan</a>'s Team</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="_assets/js/jquery.min.js"></script>
        <script src="_assets/js/bootstrap.bundle.min.js"></script>
        <script src="_assets/js/scripts.js"></script>
        <script src="_assets/js/jquery.dataTables.min.js"></script>
        <script src="_assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="_assets/js/sweetalert2.js"></script>
    </body>
</html>
