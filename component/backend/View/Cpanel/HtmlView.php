<?php
/**
 * @package overload
 * @author Nicholas K. Dionysopoulos <nicholas@akeebabackup.com>. Modified by George Wilson
 * @license GNU GPL v3 or later
 * @version 1.0
 */

namespace Wilsonge\Component\Overload\Administrator\View\Cpanel;

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null) {
		ToolbarHelper::title(Text::_('COM_OVERLOAD_TITLE'));

		$script = <<<ENDSCRIPT
window.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('overload-cats').addEventListener('change', recalc);
    document.getElementById('overload-depth').addEventListener('change', recalc);
    document.getElementById('overload-articles').addEventListener('change', recalc);
    document.getElementById('overload-start').addEventListener('click', overload_start);
});

function recalc()
{
	var cats = document.getElementById('overload-cats').value;
	var depth = document.getElementById('overload-depth').value;
	var articles = document.getElementById('overload-articles').value;
	
	var totalcats = 0;
	var totalarticles = 0;
	
	for(i=depth; i>0; i--) {
		totalcats += Math.pow(cats,i);
	}
	
	totalarticles = totalcats * articles;

	document.getElementById('overload-projected-articles').innerHTML = '<b>' + totalarticles + '</b>';
}

/** @var The AJAX proxy URL */
var ajax_url = "";

function overload_start()
{
	var cats = document.getElementById('overload-cats').value;
	var depth = document.getElementById('overload-depth').value;
	var articles = document.getElementById('overload-articles').value;
	var articlesstate = document.getElementById('overload-articles-state').value;

	var data = 'categories='+cats+'&depth='+depth+'&articles='+articles+'&articlesstate='+articlesstate+'&task=process.start&option=com_overload';
	
	document.getElementById('overload-wrapper').style.display = "none";
	document.getElementById('overload-results-wrapper').style.display = "block";
	var responseData = {};

    Joomla.request({
        url: ajax_url + '?' + data,
        method: 'GET',
        onSuccess: (response) => {
			try {
				responseData = JSON.parse(response);
			} catch(err) {
				alert(response);
				return;
			}

			overload_process(responseData);
        },
        onError: (xhr) => {
			var message = 'AJAX Loading Error: '+xhr.statusText;
			alert(message);
        }
    });
	
	return false;
}

function overload_process(msg)
{
	document.getElementById('overload-results-donecats').textContent = msg.donecats;
	document.getElementById('overload-results-totalcats').textContent = msg.totalcats;
	document.getElementById('overload-results-article').textContent = msg.article;
	document.getElementById('overload-results-articles').textContent = msg.articles;

	if(msg.done) {
		alert('All done!');
		return;
	} else {
		var responseData = {};

	    Joomla.request({
	        url: ajax_url + '?option=com_overload&task=process.resume',
	        method: 'GET',
	        onSuccess: (response) => {
				try {
					responseData = JSON.parse(response);
				} catch(err) {
					alert(response);
					return;
				}
	
				overload_process(responseData);
	        },
	        onError: (xhr) => {
				var message = 'AJAX Loading Error: '+xhr.statusText;
				alert(message);
	        }
	    });
	}
}

ENDSCRIPT;
		Factory::getDocument()->addScriptDeclaration($script);

		parent::display($tpl);
	}
}
