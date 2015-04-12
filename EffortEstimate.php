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
		return array('EVENT_VIEW_BUG_DETAILS' => 'EffortDetails');
	}

	public function EffortDetails($p_event, $p_bug_id)
	{
		HtmlHelper::viewEffortEstimate($p_bug_id);
	}

	public function init() 
	{
		$t_path = config_get_global('plugin_path' ). plugin_get_current() . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR;
		set_include_path(get_include_path() . PATH_SEPARATOR . $t_path);
		require_once( 'HtmlHelper.php' );
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
					user_id I DEFAULT NULL UNSIGNED
					effort_estimate F(15, 3) DEFAULT NULL,
					timestamp T DEFAULT NULL'
				)
			)
		);
	}
}
