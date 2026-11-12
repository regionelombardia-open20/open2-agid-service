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
use open20\amos\core\migration\AmosMigrationTableCreation;

use yii\db\Migration;

class m201106_172000_create_agid_person_documenti_mm_table extends Migration
{

    public function up()
    {
        /**
         * create table MM agid_person_organizational_unit_mm
         * and add only columns for foreign key
         */
        $this->createTable('agid_service_documenti_mm', [

            // PK
            'id' => $this->primaryKey(),

            // COLUMNS field to be FK
            'documenti_id' => $this->integer()->null()->defaultValue(null)->comment('Documenti'),
            'agid_service_id' => $this->integer()->null()->defaultValue(null)->comment('Agid service'),

            // timestamp fields
            'created_at' => $this->dateTime()->defaultValue(null)->comment('Created at'),
            'updated_at' => $this->dateTime()->defaultValue(null)->comment('Updated at'),
            'deleted_at' => $this->dateTime()->defaultValue(null)->comment('Deleted at'),
            'created_by' => $this->integer(11)->defaultValue(null)->comment('Created at'),
            'updated_by' => $this->integer(11)->defaultValue(null)->comment('Updated by'),
            'deleted_by' => $this->integer(11)->defaultValue(null)->comment('Deleted by'),
        ]);

        $this->addForeignKey('fk_agid_service_documenti', 'agid_service_documenti_mm', 'agid_service_id', 'agid_service', 'id');
        $this->addForeignKey('fk_documenti_agid_service', 'agid_service_documenti_mm', 'documenti_id', 'documenti', 'id');
    }


    public function down()
    {

       $this->dropTable('agid_service_documenti_unit_mm');
    }
}
