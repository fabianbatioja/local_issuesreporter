# Error reporter #

This plugin allows students in a course to report errors. The plugin adds a button in the header of the module view page that can be configured to be displayed or not. Regardless of whether it is shown or not it adds an item to the navigation menu when in the module page view.

## GitHub Repository ##
https://github.com/fabianbatioja/local_issuesreporter

## Steps to test ##
- Create a course
- Create an activity within the course
- Enroll a user as a student
- Enter the module as a student
- Click on the Report an issue button
- Fill out the form
- Click submit

**Expected behavior:**

The user is redirected to the module view page and a notification appears indicating that the report was saved.

The report record is stored in the local_issuesreporter table. Also in the logstore_standard_log table the log of the log creation is stored.

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/local/issuesreporter

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2022 Fabian Batioja <fabianbatioja@gmail.com>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
