<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace EffortEstimate\Controller;

/**
 * Description of DetailController
 *
 * @author dannyvandersluijs
 */
class DetailController
{
    private $params;

    public function __construct($params = array())
    {
        $this->params = $params;
    }

    public function executeAction()
    {
        $query = sprintf(
            'SELECT * FROM %s WHERE bug_id = %s',
            plugin_table('efforts'),
            (int) $this->params['bug']
        );
        $results = db_query($query);
        $row = db_fetch_array($results);
        $effortEstimateHours = $row['effort_estimate'];
        
        include __DIR__ . '/../../../view/details.phtml';
    }

    public function formAction()
    {
        include __DIR__ . '/../../../view/form.phtml';
    }

    public function setAction()
    {
        $query = sprintf(
            'INSERT INTO %s VALUES (DEFAULT, %s, %s, %s, NOW())',
            plugin_table('efforts'),
            (int) $this->params['bug'],
            auth_get_current_user_id(),
            gpc_get_int('effortEstimateHours')
        );

        if(!db_query($query)){
           trigger_error( ERROR_DB_QUERY_FAILED, ERROR );
        }
    }
}
