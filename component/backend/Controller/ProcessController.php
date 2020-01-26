<?php
/**
 * @package overload
 * @author Nicholas K. Dionysopoulos <nicholas@akeebabackup.com>. Modified by George Wilson
 * @license GNU GPL v3 or later
 * @version 1.0
 */

namespace Wilsonge\Component\Overload\Administrator\Controller;

defined('_JEXEC') or die();

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Factory;

class ProcessController extends BaseController
{
	public function start($cachable = false, $urlparams = false)
	{
		/** @var \Wilsonge\Component\Overload\Administrator\Model\ProcessModel $model */
		$model = $this->getModel();

		$model->setState('categories', $this->input->getInt('categories',3));
		$model->setState('depth',  $this->input->getInt('depth',3));
		$model->setState('articles', $this->input->getInt('articles', 1000));
		$model->setState('articlesstate', $this->input->getInt('articlesstate', 1));

		Log::add('Initializing content overload');
		Log::add('Categories: '.$model->getState('categories'), Log::DEBUG);
		Log::add('Depth: '.$model->getState('depth'), Log::DEBUG);
		Log::add('Articles: '.$model->getState('articles'), Log::DEBUG);
		Log::add('Articles state: '.$model->getState('articlesstate'), Log::DEBUG);

		$done = $model->start();

		echo json_encode(array(
			'done'			=> $done,
			'totalcats'		=> $model->getState('totalcats', 0),
			'donecats'		=> $model->getState('donecats', 0),
			'article'		=> $model->getState('startfromarticle', 0),
			'articles'		=> $model->getState('articles'),
			'articlesstate'	=> $model->getState('articlesstate')
		));

		Log::add('Preparing to sleep', Log::DEBUG);
		Log::add('Total categories: '.$model->getState('totalcats',0), Log::DEBUG);
		Log::add('Done categories: '.$model->getState('donecats',0), Log::DEBUG);
		Log::add('Total articles in category: '.$model->getState('articles',0), Log::DEBUG);
		Log::add('Resume from article: '.$model->getState('article',0), Log::DEBUG);
		Log::add('Going to sleep');

		Factory::getSession()->close();
		Factory::getApplication()->close();
	}

	public function resume($cachable = false, $urlparams = false)
	{
		Log::add('Waking up');

		/** @var \Wilsonge\Component\Overload\Administrator\Model\ProcessModel $model */
		$model = $this->getModel();
		$done = $model->resume();

		echo json_encode(array(
			'done'			=> $done,
			'totalcats'		=> $model->getState('totalcats', 0),
			'donecats'		=> $model->getState('donecats', 0),
			'article'		=> $model->getState('startfromarticle', 0),
			'articles'		=> $model->getState('articles'),
			'articlesstate'	=> $model->getState('articlesstate')
		));

		Log::add('Preparing to sleep', Log::DEBUG);
		Log::add('Total categories: '.$model->getState('totalcats',0), Log::DEBUG);
		Log::add('Done categories: '.$model->getState('donecats',0), Log::DEBUG);
		Log::add('Total articles in category: '.$model->getState('articles',0), Log::DEBUG);
		Log::add('Resume from article: '.$model->getState('article',0), Log::DEBUG);
		Log::add('Going to sleep');

		Factory::getSession()->close();
		Factory::getApplication()->close();
	}
}
