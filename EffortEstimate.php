<?php

class EffortEstimatePlugin extends MantisPlugin
{
	public function register()
	{
		$this->name = 'EffortEstimate';
		$this->description = 'Effort estimate plugin allows you to estimate the effort on the issues';
		$this->page = '';

		$this->version = '1.0.1';
		$this->requires = array('MantisCore' => '1.2.0');

		$this->author = 'Danny van der Sluijs';
		$this->contact = 'danny.vandersluijs@icloud.com';
		$this->url = 'http://dannyvandersluijs.nl';
	}

	public function hooks()
	{
		return array(
            'EVENT_VIEW_BUG_DETAILS' => 'EffortDetails',
            'EVENT_REPORT_BUG_FORM' => 'EffortForm',
            'EVENT_UPDATE_BUG_FORM' => 'EfforForm',
            'EVENT_REPORT_BUG' => 'SetEffort'
        );
	}

	public function EffortDetails($event, $bug)
	{
        $controller = new EffortEstimate\Controller\DetailController(array('bug' => $bug));
        $controller->executeAction();
	}

    public function EffortForm($event, $bug)
	{
        $controller = new EffortEstimate\Controller\DetailController();
        $controller->formAction();
	}

    public function SetEffort($event, $bug)
	{
        $controller = new EffortEstimate\Controller\DetailController(array('bug' => $bug));
        $controller->setAction();
	}

	public function init()
	{
        include __DIR__ . '/src/EffortEstimate/Controller/DetailController.php';
	}

	public function schema()
	{
		return array(
			array(
				'CreateTableSQL',
				array(
					plugin_table('efforts'),
					'id I NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
					bug_id I DEFAULT NULL UNSIGNED,
					user_id I DEFAULT NULL UNSIGNED,
					effort_estimate F(15,3) DEFAULT NULL,
					timestamp T DEFAULT NULL'
				)
			)
		);
	}
}
