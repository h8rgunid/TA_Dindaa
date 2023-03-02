<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('baby	') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800">
                                <?= $title ?>
                            </h1>
                        </div>
                    </div>
                    <hr>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php elseif ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header"><strong>Fill in the form!</strong></div>
                                <div class="card-body">
                                    <?php if (validation_errors()): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= validation_errors() ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
                                    <form action="<?= base_url('notifikasi/sendTele') ?>" id="form-send" method="POST">
                                        <?php if ($this->session->role == 'admin'): ?>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="tanggal"><strong>Jadwal Posyandu</strong></label>
                                                    <div>
                                                        <input type="date" name="tanggal" id="tanggal"
                                                            value="<?php echo date('Y-m-d'); ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-save"></i>&nbsp;&nbsp;Submit</button>
                                                <button type="reset" class="btn btn-danger"><i
                                                        class="fa fa-times"></i>&nbsp;&nbsp;Reset</button>
                                            </div>
                                        <? endif ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- load footer -->
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
    <script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#form-send').submit(function () {
            kirimPesan();
        });
        // https://api.telegram.org/bot5858463958:AAErL1oGP-d24ECBh8JiU8HGNPww4SkwzgU/sendMessage?chat_id=-783549932&text=halojuga&parse_mode=html
        function kirimPesan() {

            var tanggal = document.getElementById('tanggal');

            var gabungan = 'Tanggal Posyandu Terbaru adalah ' + tanggal.value;

            var token = '5858463958:AAErL1oGP-d24ECBh8JiU8HGNPww4SkwzgU'; // Ganti dengan token bot yang kamu buat
            var grup = '-1001870757823'; // Ganti dengan chat id dari bot yang kamu buat
            var urls = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${grup}&text=${gabungan}&parse_mode=html`;
            console.log(urls);
            $.ajax({
                url: urls,
                type: `POST`,
            })
        }
    </script>
</body>

</html>