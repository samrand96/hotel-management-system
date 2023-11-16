                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2023 - Developed by <a href="https://www.samrand.me">Samrand Hassan</a>'s Team</div>
                            <div style="display: none;">
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
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
        <script type="text/javascript">
            var modelName = "model/<?= $fileName ?>.php";
        </script>
        <script src="controller/main.js?v=<?=md5_file('controller/main.js')?>"></script>
        <script src="controller/<?= $fileName ?>.js?v=<?= md5_file('controller/'.$fileName.'.js') ?>"></script>
        <?php require('modal.php'); ?>
    </body>
</html>
