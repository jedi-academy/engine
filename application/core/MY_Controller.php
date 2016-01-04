<?php

/**
 * Learn CodeIgniter
 *
 * A Webapp Development course, using CodeIgniter
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2008-2015, James L. Parry
 * Copyright (c) 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Learn CodeIgniter
 * @author	Jim Parry
 * @copyright	Copyright (c) 2008-2015, James L. Parry
 * @copyright	Copyright (c) 2015, British Columbia Institute of Technology
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://learn.codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 */
class Application extends CI_Controller {

	protected $data = array();	  // parameters for view components
	protected $id;				  // identifier for our content

	/**
	 * Constructor.
	 * Establish view parameters & set a couple up
	 */

	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->data['title'] = 'COMP4711 - Webapp Development';
		$this->errors = array();
	}

	/**
	 * Render this page
	 */
	function render()
	{
		if (!isset($this->data['pagetitle']))
			$this->data['pagetitle'] = $this->data['title'];

		// Massage the menubar
		$choices = $this->config->item('menu_choices');
		foreach ($choices['menudata'] as &$menuitem)
		{
			$menuitem['active'] = (ltrim($menuitem['link'], '/ ') == uri_string()) ? 'active' : '';
		}
		$this->data['menubar'] = $this->parser->parse('theme/menubar', $choices, true);

		$this->data['footerbar'] = $this->parser->parse('theme/menubar', $this->config->item('footer_choices'), true);
		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

		// title for all but the homepage
		$layout = empty($this->data['title']) ? 'jumbotitle' : 'title';
		$this->data['titleblock'] = $this->parser->parse('theme/' . $layout, $this->data, true);

		// finally, build the browser page!
		$this->data['data'] = &$this->data;
		$this->parser->parse('theme/template', $this->data);
	}

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */