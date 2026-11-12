<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   svilupposostenibile\enti
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

use yii\db\Migration;


class m201123_163600_create_agid_service_related_service_mm_table extends Migration
{

    public function up()
    {
        $this->createTable('agid_service_related_service_mm', [

            // PK
            'id' => $this->primaryKey(),

            // COLUMNS field to be FK
            'agid_service_id' => $this->integer()->null()->defaultValue(null)->comment('Agid Service'),
            'agid_related_service_id' => $this->integer()->null()->defaultValue(null)->comment('Agid Related Service'),

            // TIMESTAMP fields
            'created_at' => $this->dateTime()->defaultValue(null)->comment('Created at'),
            'updated_at' => $this->dateTime()->defaultValue(null)->comment('Updated at'),
            'deleted_at' => $this->dateTime()->defaultValue(null)->comment('Deleted at'),
            'created_by' => $this->integer(11)->defaultValue(null)->comment('Created at'),
            'updated_by' => $this->integer(11)->defaultValue(null)->comment('Updated by'),
            'deleted_by' => $this->integer(11)->defaultValue(null)->comment('Deleted by'),

                 
    
        ]);

        // addForeignKey
        $this->addForeignKey(
            'fk-agid-service-id',
            'agid_service_related_service_mm',
            'agid_service_id',
            'agid_service',
            'id',
            'SET NULL'
        );

        // addForeignKey
        $this->addForeignKey(
            'fk-agid-related-service-id',
            'agid_service_related_service_mm',
            'agid_related_service_id',
            'agid_service',
            'id',
            'SET NULL'
        );
    }

    public function down()
    {

       // Drop Table 
       $this->dropTable('agid_service_related_service_mm');
    }
}
