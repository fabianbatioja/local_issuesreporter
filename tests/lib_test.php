<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Test for lib.php
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_issuesreporter;

use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Test for lib.php
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class lib_test extends \advanced_testcase{

    public function test_create_issue() {
        global $DB;
        $this->resetAfterTest();
        $course = $this->getDataGenerator()->create_course();
        $page = $this->getDataGenerator()->create_module('page', array('course' => $course->id));

        $summary = 'Lorem Ipsum';
        $description = 'In efficitur porta facilisis. Sed vel diam hendrerit, faucibus tellus pharetra, egestas lacus.';

        $data = new stdClass();
        $data->summary = $summary;
        $data->cmid = $page->cmid;
        $data->description_editor = [
            'text' => $description,
            'format' => 1
        ];

        local_issuesreporter_create_issue($data);
        $records = $DB->get_records('local_issuesreporter');
        $this->assertEquals(1, count($records));
        $record = current($records);
        $this->assertEquals($summary, $record->summary);
        $this->assertEquals($description, $record->description);
    }
}
