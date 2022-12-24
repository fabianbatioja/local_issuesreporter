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
 * Display information about issues created
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_issuesreporter\form\create_form;

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');
require_once($CFG->libdir . '/filelib.php');

$cmid = required_param('cmid', PARAM_INT);
$returnurl = optional_param('returnurl', null,PARAM_URL);

require_login();
$context = context_module::instance($cmid);
require_capability('local/issuesreporter:createissues', $context);

if (empty($returnurl)) {
    list($course, $cm) = get_course_and_cm_from_cmid($cmid);
    $returnurl = new moodle_url('/course/view.php', ['id' => $course->id]);
}

$title = get_string('pluginname', 'local_issuesreporter');
$PAGE->set_url('/local/issuesreporter/index.php', array('instanceid' => $cmid));
$PAGE->set_pagelayout('standard');
$PAGE->set_context(context_system::instance());
$PAGE->set_title($title);

$mform = new create_form(null, array('cmid' => $cmid, 'returnurl' => $returnurl));
if ($mform->is_cancelled()) {
    redirect($returnurl);
} else if ($fromform = $mform->get_data()) {
    local_issuesreporter_create_issue($fromform);
    \core\notification::success(get_string('successcreation', 'local_issuesreporter'));
    redirect($returnurl);
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('issuesreporter:createissues', 'local_issuesreporter'));
$mform->display();
echo $OUTPUT->footer();
