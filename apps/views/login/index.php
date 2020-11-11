<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Village Assistance - Login</title>
        <link href="<?= BASE_URL; ?>dist/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                            <form action="<?= BASE_URL ?>login/auth" method="POST">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Village Assistance</h3></div>
                                    <div class="card-body">
                                        
                                            <div class="form-group">
                                                <label class="small mb-1" for="nokk">No KK</label>
                                                <input class="form-control py-4" id="nokk" name="nokk" type="text" placeholder="Masukan nomor kartu keluarga" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Masukan password" />
                                            </div>
                                            <?php 
                                              if(!empty($_SESSION['message']))
                                              {
                                                echo $_SESSION['message'];
                                              } 
                                            ?>
                                        
                                    </div>
                                    <div class="card-footer col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary col-sm-12 ml-auto">Login</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jofan firdaus <?= date('Y') ?></div>
                            <div>
                            <div class="text-muted">Village Assistance </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= BASE_URL;  ?>dist/js/scripts.js"></script>
    </body>
</html>
