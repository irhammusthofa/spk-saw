<?php

fs_add_assets_header('<link rel="stylesheet" href="'.fs_theme_path().'bower_components/select2/dist/css/select2.min.css">');
fs_add_assets_footer('<script src="'.fs_theme_path().'bower_components/select2/dist/js/select2.full.min.js"></script>');
fs_add_assets_footer('<script src="'.fs_theme_path().'bower_components/chart.js/Chart.js"></script>');
fs_add_assets_footer('<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>');

$script_footer = $this->load->view('grafik/script_footer2','',TRUE);
fs_add_assets_footer($script_footer);