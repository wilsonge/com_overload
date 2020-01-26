<?php
/**
 * @package overload
 * @author Nicholas K. Dionysopoulos <nicholas@akeebabackup.com>. Modified by George Wilson
 * @license GNU GPL v3 or later
 * @version 1.0
 */

namespace Wilsonge\Component\Overload\Administrator\Controller;

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class StartController extends BaseController
{
	public function execute($task)
	{
		if(!in_array($task, array('cancel','save','apply')))
		{
			$task = 'edit';
		}

		parent::execute($task);
	}

	public function edit()
	{
		parent::edit();

		Factory::getApplication()->input->set('hidemainmenu', true);
	}
}
