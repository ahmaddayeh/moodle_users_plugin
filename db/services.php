<?php
$functions = [
    'local_course_user_export_get_courses_and_users' => [
        'classname' => 'local_course_user_export_external',
        'methodname' => 'get_courses_and_users',
        'classpath' => 'local/course_user_export/externallib.php',
        'description' => 'Retrieve all courses and enrolled users.',
        'type' => 'read',
        'ajax' => true
    ]
];

$services = [
    'Course and User Export Service' => [
        'functions' => ['local_course_user_export_get_courses_and_users'],
        'restrictedusers' => 0,
        'enabled' => 1,
    ]
];
