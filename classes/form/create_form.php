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
 * Calss create_form
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_issuesreporter\form;
use moodle_exception;
use moodleform;

require_once ($CFG->dirroot.'/lib/formslib.php');

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/formslib.php');

/**
 * Class registration_form
 *
 * @package     local_issuesreporter
 * @copyright   2022 Fabian Batioja <fabianbatioja@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class create_form  extends moodleform {

    /**
     * Form definition.
     * @throws moodle_exception
     */
    public function definition() {
        $mform = $this->_form;
        $required = get_string('required');

        $mform->addElement('hidden', 'cmid', $this->_customdata['cmid']);
        $mform->setType('cmid', PARAM_INT);

        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);

        if (!empty($this->_customdata['returnurl'])) {
            $mform->addElement('hidden', 'returnurl', $this->_customdata['returnurl']);
            $mform->setType('returnurl', PARAM_URL);
        }

        $mform->addElement('text', 'summary', get_string('form:summary', 'local_issuesreporter'));
        $mform->setType('summary', PARAM_TEXT);
        $mform->addHelpButton('summary', 'form:summary', 'local_issuesreporter');
        $mform->addRule('summary', $required, 'required', null, 'client');

        $mform->addElement('editor', 'description_editor',
            get_string('form:description', 'local_issuesreporter'), null);
        $mform->setType('description_editor', PARAM_RAW);
        $mform->addHelpButton('description_editor', 'form:description', 'local_issuesreporter');
        $mform->addRule('description_editor', $required, 'required', null, 'client');

        $this->add_action_buttons(true, get_string('submit'));
    }
}
