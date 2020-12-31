<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="<?= base_url() ?>assets/dist/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/plugin/sweetalert/sweetalert2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <?= $this->session->flashdata('message') ?>
                                    <div class="small mb-3 text-muted">Masukkan Email yang terdaftar sebagai verifikasi untuk pergantian password anda.</div>
                                    <form action="<?= site_url('lupaPassword') ?>" method="post">
                                        <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Email..." /></div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="<?= site_url('Auth') ?>">Return to login</a><button type="submit" class="btn btn-primary">Verifikasi</button></div>
                                    </form>
                                </div>
                                <!-- <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div> -->
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
                        <div class="text-muted">Copyright &copy; Archarios Lazaretto 2019</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/dist/plugin/jquery.validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/dist/plugin/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/distjs/scripts.js"></script>
    <?php if ($this->session->flashdata('logout')) : ?>
        <script>
            Swal.fire(
                'Logout!',
                '',
                'success'
            )
        </script>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $('#formSimpan').validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Inputan tidak boleh kosong"
                    },
                    password: {
                        required: "Inputan tidak boleh kosong"
                    }
                }
            });
        });
    </script>
</body>

</html>