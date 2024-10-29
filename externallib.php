<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

class local_course_user_export_external extends external_api {

    // Define the parameters for the function.
    public static function get_courses_and_users_parameters() {
        return new external_function_parameters(
            []
        );
    }

public static function get_courses_and_users() {
    global $DB;

    // Retrieve all courses
    $courses = $DB->get_records('course', null, '', 'id, fullname');
    $result = [];

    foreach ($courses as $course) {
        // Get the context for the course
        $context = context_course::instance($course->id);
        // Retrieve enrolled users for the course
        $enrolled_users = get_enrolled_users($context, '', 0, 'u.id, u.username, u.email, u.firstname, u.lastname');

        $user_data = []; // Initialize user_data for the current course

        foreach ($enrolled_users as $user) {
            $email = $user->email;

            // Check for invalid emails and replace them
            if (strpos($email, '@localhost') !== false) {
                $email = str_replace('@localhost', '@example.com', $email); // or any valid domain
            }

            $user_data[] = [
                'id' => (int) $user->id,
                'username' => $user->username,
                'email' => $email, // Use the modified email
                'firstname' => $user->firstname,
                'lastname' => $user->lastname
            ];
        }

        // Add course data and enrolled users to the result
        $result[] = [
            'course_id' => (int) $course->id,
            'course_name' => $course->fullname,
            'enrolled_users' => $user_data
        ];
    }

    return $result; // Return the populated result
}

    public static function get_courses_and_users_returns() {
        return new external_multiple_structure(
            new external_single_structure([
                'course_id' => new external_value(PARAM_INT, 'Course ID'),
                'course_name' => new external_value(PARAM_TEXT, 'Course Name'),
                'enrolled_users' => new external_multiple_structure(
                    new external_single_structure([
                        'id' => new external_value(PARAM_INT, 'User ID'),
                        'username' => new external_value(PARAM_TEXT, 'Username'),
                        'email' => new external_value(PARAM_EMAIL, 'User email'),
                        'firstname' => new external_value(PARAM_TEXT, 'First name'),
                        'lastname' => new external_value(PARAM_TEXT, 'Last name'),
                    ])
                ),
            ])
        );
    }
}
