<?php
/**
#  Copyright 2003-2015 Opmantek Limited (www.opmantek.com)
#
#  ALL CODE MODIFICATIONS MUST BE SENT TO CODE@OPMANTEK.COM
#
#  This file is part of Open-AudIT.
#
#  Open-AudIT is free software: you can redistribute it and/or modify
#  it under the terms of the GNU Affero General Public License as published
#  by the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.
#
#  Open-AudIT is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU Affero General Public License for more details.
#
#  You should have received a copy of the GNU Affero General Public License
#  along with Open-AudIT (most likely in a file named LICENSE).
#  If not, see <http://www.gnu.org/licenses/>
#
#  For further information on Open-AudIT or for a license other than AGPL please see
#  www.opmantek.com or email contact@opmantek.com
#
# *****************************************************************************
*
* @category  Controller
* @package   Open-AudIT
* @author    Mark Unwin <marku@opmantek.com>
* @copyright 2014 Opmantek
* @license   http://www.gnu.org/licenses/agpl-3.0.html aGPL v3
* @version   2.1
* @link      http://www.open-audit.org
*/

/**
* Base Object Summaries.
*
* @access   public
* @category Object
* @package  Open-AudIT
* @author   Mark Unwin <marku@opmantek.com>
* @license  http://www.gnu.org/licenses/agpl-3.0.html aGPL v3
* @link     http://www.open-audit.org
 */
class Summaries extends MY_Controller
{
    /**
    * Constructor
    *
    * @access    public
    */
    public function __construct()
    {
        parent::__construct();

        $temp = @$this->uri->segment(1);
        if (empty($temp)) {
            redirect('summaries');
        }
        $this->load->model('m_summaries');
        inputRead();
        $this->output->url = $this->config->item('oa_web_index');
        return;
    }

    /**
    * Index that is unused
    *
    * @access public
    * @return NULL
    */
    public function index()
    {
        return;
    }

    /**
    * Our remap function to override the inbuilt controller->method functionality
    *
    * @access public
    * @return NULL
    */
    public function _remap()
    {
        $this->{$this->{'response'}->{'meta'}->{'action'}}();
        return;
    }

    /**
    * Process the supplied data and create a new object
    *
    * @access public
    * @return NULL
    */
    public function create()
    {
        include 'include_create.php';
        return;
    }

    /**
    * Read a single object
    *
    * @access public
    * @return NULL
    */
    public function read()
    {
        $tables_temp = $this->db->list_tables();
        $tables = array();
        for ($i=0; $i < count($tables_temp); $i++) {
            $table = new stdClass();
            $table->type = 'table';
            $table->id = '';
            $table->attributes = new stdClass();
            $table->attributes->name = $tables_temp[$i];
            $tables[] = $table;
            unset($table);
        }
        $this->response->included = array_merge($this->response->included, $tables);
        include 'include_read.php';
        return;
    }

    /**
    * Process the supplied data and update an existing object
    *
    * @access public
    * @return NULL
    */
    public function update()
    {
        include 'include_update.php';
        return;
    }

    /**
    * Delete an existing object
    *
    * @access public
    * @return NULL
    */
    public function delete()
    {
        include 'include_delete.php';
        return;
    }

    /**
    * Collection of objects
    *
    * @access public
    * @return NULL
    */
    public function collection()
    {
        if ($this->response->meta->format == 'screen') {
            $this->response->included = array_merge($this->response->included, $this->m_summaries->read_sub_resource());
        }
        include 'include_collection.php';
        return;
    }

    /**
    * Supply a HTML form for the user to create an object
    *
    * @access public
    * @return NULL
    */
    public function create_form()
    {
        $tables_temp = $this->db->list_tables();
        $tables = array();
        for ($i=0; $i < count($tables_temp); $i++) {
            $table = new stdClass();
            $table->type = 'table';
            $table->id = '';
            $table->attributes = new stdClass();
            $table->attributes->name = $tables_temp[$i];
            $tables[] = $table;
            unset($table);
        }
        $this->response->included = array_merge($this->response->included, $tables);
        include 'include_create_form.php';
        return;
    }

    /**
    * Supply a HTML form for the user to update an object
    *
    * @access public
    * @return NULL
    */
    public function update_form()
    {
        $tables_temp = $this->db->list_tables();
        $tables = array();
        for ($i=0; $i < count($tables_temp); $i++) {
            $table = new stdClass();
            $table->type = 'table';
            $table->id = '';
            $table->attributes = new stdClass();
            $table->attributes->name = $tables_temp[$i];
            $tables[] = $table;
            unset($table);
        }
        $this->response->included = array_merge($this->response->included, $tables);
        include 'include_update_form.php';
        return;
    }

    /**
    * Supply a HTML form for the user to update an object
    *
    * @access public
    * @return NULL
    */
    public function execute()
    {
        $this->response->data = $this->m_summaries->execute();
        output();
        return;
    }

    /**
    * Supply a HTML form for the user to upload a collection of objects in CSV
    *
    * @access public
    * @return NULL
    */
    public function import_form()
    {
        $this->load->model('m_database');
        $this->response->data = $this->m_database->read('summaries');
        include 'include_import_form.php';
        return;
    }

    /**
    * Process the supplied data and create a new object
    *
    * @access public
    * @return NULL
    */
    public function import()
    {
        include 'include_import.php';
        return;
    }
}
// End of file summaries.php
// Location: ./controllers/summaries.php
