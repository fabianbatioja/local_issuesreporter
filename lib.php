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
use local_issuesreporter\event\issue_reported;

/**
 * Library of functions and constants for local_issuesreporter
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


function local_issuesreporter_create_issue($data) {
    global $USER, $DB;
    $context = context_module::instance($data->cmid);
    $data->timecreated = time();
    $data->contextid = $context->id;
    $data->userid = $USER->id;
    $data->description = $data->description_editor['text'];
    $data->descriptionformat = $data->description_editor['format'];
    $data->id = $DB->insert_record('local_issuesreporter', $data);
    $event = issue_reported::create(array('context' => $context, 'objectid' => $data->id));
    $event->trigger();
}

function local_issuesreporter_extend_navigation(global_navigation $navigation) {
    global $PAGE, $OUTPUT;

    if ($PAGE->context->contextlevel != CONTEXT_MODULE) {
        return;
    }
    $length = strlen('view');
    if (substr_compare($PAGE->pagetype, 'view', -$length) != 0) {
       return;
    }

    if (has_capability('local/issuesreporter:createissues', $PAGE->context)) {
        $cmid = $PAGE->context->instanceid;
        $urlparams = ['cmid' => $cmid, 'returnurl' => $PAGE->url];
        $editurl = new moodle_url('/local/issuesreporter/edit.php', $urlparams);
        $createlabel = get_string('reportissue', 'local_issuesreporter');
        $nodeissuesreporter = $navigation->add($createlabel, $editurl, navigation_node::TYPE_ACTIVITY,
            $createlabel, 'issuesreporter');
        $nodeissuesreporter->showinflatnavigation = true;

        if (get_config('local_issuesreporter', 'showheaderbutton')) {
            $htmlbutton = $OUTPUT->single_button($editurl, $createlabel);
            $PAGE->add_header_action($htmlbutton);
        }
    }
}

