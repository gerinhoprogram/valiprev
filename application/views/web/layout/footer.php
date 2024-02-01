<?php $sistema = info_header_footer();?>
<footer style="height: 300px; background-color: #ccc">
<p>footer</p>

    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info text-center">
                        <p>© <?php echo date('Y'); ?><a target="_blank" rel="noopener noreferrer" href="<?= $sistema->sistema_link_site ?>" title="<?= $sistema->sistema_link_site ?>" aria-label="<?= $sistema->sistema_link_site ?>"> NCW Brasil</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


</body>


</html>


<script>
    const BASE_URL = '<?php echo base_url() ?>';
</script>


<?php if (isset($scripts)) : ?>

    <?php foreach ($scripts as $script) : ?>

        <script defer src="<?= base_url('public/restrita/' . $script); ?>"></script>

    <?php endforeach; ?>

<?php endif; ?>

<script defer src="<?= base_url('public/web/assets/js/script.js'); ?>"></script>
