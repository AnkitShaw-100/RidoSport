<?php

if (!function_exists('get_mobile_number')) {
    function get_mobile_number() {
        return '9810000349'; // Replace with your mobile number
    }
}


if (!function_exists('get_mobile_number1')) {
    function get_mobile_number1() {
        return '9212091484'; // Replace with your mobile number
    }
}

if (!function_exists('get_email_address')) {
    function get_email_address() {
        return 'desaninternational@yahoo.com'; // Replace with your email address
    }
}

if (!function_exists('get_text_address')) {
    function get_text_address() {
        return 'Desan International A2-39 , GD Steel Compound Near Ambika Steel Mill Industrial Area, Site IV Sahibabad, Ghaziabad - 201010, UP'; // Replace with your email address
    }
}

if (!function_exists('get_map_address')) {
    function get_map_address() {
        return 'https://maps.app.goo.gl/S3Ttb86VTQoANZEz9'; // Replace with your email address
    }
}
// <p>Contact us at: {{ get_email_address() }}</p>
// <p>Call us: {{ get_mobile_number() }}</p>

// // Example in a controller
// $email = get_email_address();
// $phone = get_mobile_number(); 