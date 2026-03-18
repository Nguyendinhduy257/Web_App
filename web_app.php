<?php
/*
Plugin Name: Web App Sinh Viên
Description: Quản lý sinh viên
Version: 1.0
Author: Duy
*/

function web_app_menu(){
    add_menu_page(
        'Quản lý sinh viên',
        'Quản lý sinh viên',
        'manage_options',
        'web_app',
        'web_app_page'
    );
}

add_action('admin_menu','web_app_menu');

function web_app_page(){
    include plugin_dir_path(__FILE__) . 'login.php';
}
