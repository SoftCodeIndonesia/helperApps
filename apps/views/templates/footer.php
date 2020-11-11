</main>
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
        <script>
            var base_url = "<?= BASE_URL; ?>";
        </script>
        <script src="<?= BASE_URL; ?>assets/js/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= BASE_URL; ?>dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= BASE_URL; ?>dist/assets/demo/chart-area-demo.js"></script>
        <script src="<?= BASE_URL; ?>dist/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?= BASE_URL; ?>dist/assets/demo/datatables-demo.js"></script>
        <?php if(!empty($data['js'])) : ?>
        <?php foreach($data['js'] as $js) : ?>
        <script src="<?= BASE_URL; ?>assets/js/<?= $js ?>"></script>
        <?php endforeach; ?>
        <?php endif; ?>
        
    </body>
</html>
