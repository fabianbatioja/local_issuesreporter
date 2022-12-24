<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     local_issuesreporter
 * @category    admin
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_issuesreporter', get_string('pluginname', 'local_issuesreporter'));
    $ADMIN->add('localplugins', $settings);

    $choices = [
        new lang_string('no'),
        new lang_string('yes'),
    ];
    $settings->add(new admin_setting_configselect('local_issuesreporter/showheaderbutton',
        new lang_string('showheaderbutton', 'local_issuesreporter'),
        null, 1, $choices));
}
