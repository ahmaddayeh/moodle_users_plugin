````markdown
# Course User Export Plugin for Moodle

## Overview

The **Course User Export Plugin** allows administrators to export courses and the users enrolled in them through a web service endpoint. This plugin provides a simple way to retrieve course details and user information in a structured format.

## Features

- Retrieve a list of all courses available in Moodle.

- Export details of enrolled users for each course.

- Support for basic email format validation and modification.

## Requirements

- Moodle version **3.5** or higher.

- PHP version **7.2** or higher.

- Database: MySQL, PostgreSQL, or other supported by Moodle.

## Installation

### Step 1: Download the Plugin

1\. Download the plugin from the [repository](link-to-your-repository) or clone it from GitHub.

```bash

git clone https://github.com/your-repo/course_user_export.git

```

### Step 2: Place the Plugin in the Moodle Directory

1\. Copy the plugin folder into the Moodle `local` directory.

```bash

cp -r course_user_export /path/to/moodle/local/

```

### Step 3: Install the Plugin

1\. Navigate to your Moodle site as an administrator.

2\. Go to **Site administration** > **Plugins** > **Install plugins**.

3\. Follow the prompts to complete the installation.

### Step 4: Enable the Web Service

1\. Go to **Site administration** > **Plugins** > **Web services** > **Manage protocols**.

2\. Enable the desired protocols (e.g., **REST**, **SOAP**).

3\. Go to **Site administration** > **Plugins** > **Web services** > **External services**.

4\. Create a new external service or use an existing one.

5\. Add the `local_course_user_export_get_courses_and_users` function to the external service.

### Step 5: Set Up User Access

1\. Create a user or use an existing user that requires access to the web service.

2\. Assign the user to the external service by going to **Site administration** > **Plugins** > **Web services** > **External services** > **Manage tokens**.

3\. Generate a token for the user to authenticate the API requests.

## Usage

To use the web service, send a request to the following endpoint:
````

POST /webservice/rest/server.php

````

### Parameters

- `wstoken`: The token generated for the user.

- `wsfunction`: `local_course_user_export_get_courses_and_users`.

- `moodlewsrestformat`: `json`.

### Example Request

```bash

curl -X POST 'https://your-moodle-site/webservice/rest/server.php'

--data 'wstoken=your_token&wsfunction=local_course_user_export_get_courses_and_users&moodlewsrestformat=json'

````

### Example Response

```json
{
  "courses": [
    {
      "course_id": 1,

      "course_name": "Course Name",

      "enrolled_users": [
        {
          "id": 2,

          "username": "username",

          "email": "user@example.com",

          "firstname": "First",

          "lastname": "Last"
        }
      ]
    }
  ]
}
```

## Troubleshooting

- If you encounter issues during installation, ensure that the plugin folder structure is correct and that all required files are present.

- Check the Moodle logs for any error messages that might provide clues.

- If you receive an "Invalid response" error, ensure that the emails in your user records are valid and correctly formatted.

## Contributing

If you wish to contribute to this plugin, please fork the repository and submit a pull request.

## License

This plugin is licensed under the [GNU General Public License](http://www.gnu.org/licenses/).

## Author

- **Your Name**

- **Your Email**

```

### Instructions for Customization

- **Repository Link**: Replace `link-to-your-repository` with the actual URL of your plugin's repository.

- **GitHub Clone URL**: Ensure the URL in the clone command is correct.

- **Token Example**: Update `your_token` with a sample token for testing.

- **Author Section**: Fill in your name and email address.

### Saving the Document

- Save the content above as `README.md` in your plugin's root directory.

Let me know if you need any further modifications or additions!
```
