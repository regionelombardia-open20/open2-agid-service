<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\agid-service
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

use open20\amos\core\migration\AmosMigrationWorkflow;


/**
 * Class m201106_144300_create_workflow_agid_service
 */
class m201106_144300_create_workflow_agid_service extends AmosMigrationWorkflow
{
    const AGID_SERVICE_WORKFLOW = 'AgidServiceWorkflow';

    
    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return \yii\helpers\ArrayHelper::merge(
            parent::setWorkflow(),
            $this->workflowConf(),
            $this->workflowStatusConf(),
            $this->workflowTransitionsConf(),
            $this->workflowMetadataConf()
        );
    }

    
    /**
     * In this method there are the new workflow configuration.
     * @return array
     */
    private function workflowConf()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW,
                'id' => self::AGID_SERVICE_WORKFLOW,
                'initial_status_id' => 'DRAFT'
            ],
        ];
    }


    /**
     * In this method there are the new workflow statuses configurations.
     * @return array
     */
    private function workflowStatusConf()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_STATUS,
                'id' => 'DRAFT',
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'label' => 'Bozza',
                'sort_order' => '0'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_STATUS,
                'id' => 'VALIDATED',
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'label' => 'Validato',
                'sort_order' => '1'
            ]
        ];
    }

    
    /**
     * In this method there are the new workflow status transitions configurations.
     * 
     * DRAFT -> VALIDATED
     * VALIDATED -> DRAFT
     * 
     * @return array
     */
    private function workflowTransitionsConf()
    {
        return [
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_TRANSITION,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'start_status_id' => 'DRAFT',
                'end_status_id' => 'VALIDATED'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_TRANSITION,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'start_status_id' => 'VALIDATED',
                'end_status_id' => 'DRAFT'
            ],
        ];
    }


    /**
     * In this method there are the new workflow metadata configurations.
     * @return array
     */
    private function workflowMetadataConf()
    {
        return [

            // "DRAFT" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'status_id' => 'DRAFT',
                'key' => 'description',
                'value' => 'Salva in Bozza'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'status_id' => 'DRAFT',
                'key' => 'buttonLabel',
                'value' => 'Salva in Bozza'
            ],

            // "VALIDATED" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'status_id' => 'VALIDATED',
                'key' => 'description',
                'value' => 'Valida'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => self::AGID_SERVICE_WORKFLOW,
                'status_id' => 'VALIDATED',
                'key' => 'buttonLabel',
                'value' => 'Valida'
            ],
        ];
    }

}