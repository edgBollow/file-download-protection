<?php


# Load WordPress
require_once( 'wp-load.php' );

# Exit if no "file" parameter
$qv_file = $_GET[ 'file' ];
if ( ! isset( $qv_file ) ) exit;

# Check if user logged in
if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url() );
	exit;
}

# Define file path
$dir = wp_upload_dir();
$basedir = $dir[ 'basedir' ] . '/protected/';
$file = $basedir . $qv_file;

# Check if valid file
if ( ! $basedir || ! is_file( $file ) ) {
	wp_safe_redirect( home_url() );
	exit;
}

# Check file and prepare it
$mime = wp_check_filetype( $file );

if ( $mime[ 'type' ] == false ) {
	$mime[ 'type' ] = mime_content_type( $file );
}

header( 'Content-Type: ' . $mime[ 'type' ] );

# File name fixes
$filename = $qv_file;

if ( str_contains( $qv_file, '/' ) ) {
	$filename = substr( $qv_file, strrpos( $qv_file, '/' ) + 1 );
}

# Remove comment for following line of code to ensure that file should be downloaded directly
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

# Serve file
readfile( $file );
exit;
s
