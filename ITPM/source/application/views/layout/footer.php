		                                    </div><!-- contentpanel -->
		                </div>
            </div><!-- mainwrapper -->
        </section>


		<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/pace.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/retina.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.cookies.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.Jcrop.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/custom.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {

                  jQuery(function(){

                    jQuery('#target').Jcrop({
                      aspectRatio: 1,
                      onSelect: updateCoords,
                      <?php $jcrop = $this->session->userdata('jcrop');if ($jcrop != '') { ?>
                        trueSize: [<?= $jcrop['width'] ?>,<?= $jcrop['height'] ?>]
                      <?php } ?>
                    });

                  });

                    function updateCoords(c){
                        jQuery('#btn_crop').prop('disabled',false);
                        jQuery('#x').val(c.x);
                        jQuery('#y').val(c.y);
                        jQuery('#w').val(c.w);
                        jQuery('#h').val(c.h);
                    };

            });
        </script>
    </body>
</html>