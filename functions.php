<?php


#region File download protection
function shortcodes_edg_file_download_protection_url() {
	$dir = wp_upload_dir();
	return $dir[ 'baseurl' ] . '/protected/';
}
add_shortcode( 'edg-file-download-protection-url', 'shortcodes_edg_file_download_protection_url' );
#endregion File download protection
