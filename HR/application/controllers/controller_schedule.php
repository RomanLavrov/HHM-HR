<?php

class Controller_Schedule extends Controller
{

	function action_index()
	{
		$this->view->generate('schedule_view.php', 'template_view.php');
	}
}