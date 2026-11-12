<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\agid\service\models\base
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

namespace open20\agid\service\models\base;

use Yii;

/**
 * This is the base-model class for table "agid_service_documenti_mm".
 *
 * @property integer $id
 * @property integer $documenti_id
 * @property integer $agid_service_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \open20\agid\service\models\AgidService $agidService
 * @property \open20\amos\documenti\models\Documenti $documenti
 */
abstract class AgidServiceDocumentiMm extends \open20\amos\core\record\Record
{
    public $isSearch = false;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agid_service_documenti_mm';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documenti_id', 'agid_service_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['agid_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => \open20\agid\service\models\AgidService::className(), 'targetAttribute' => ['agid_service_id' => 'id']],
            [['documenti_id'], 'exist', 'skipOnError' => true, 'targetClass' => \open20\amos\documenti\models\Documenti::className(), 'targetAttribute' => ['documenti_id' => 'id']],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('agid-service', 'ID'),
            'documenti_id' => Yii::t('agid-service', 'Documenti'),
            'agid_service_id' => Yii::t('agid-service', 'Service'),
            'created_at' => Yii::t('agid-service', 'Created at'),
            'updated_at' => Yii::t('agid-service', 'Updated at'),
            'deleted_at' => Yii::t('agid-service', 'Deleted at'),
            'created_by' => Yii::t('agid-service', 'Created at'),
            'updated_by' => Yii::t('agid-service', 'Updated by'),
            'deleted_by' => Yii::t('agid-service', 'Deleted by'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgidService()
    {
        return $this->hasOne(\open20\agid\service\models\AgidService::className(), ['id' => 'agid_service_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumenti()
    {
        return $this->hasOne(\open20\amos\documenti\models\Documenti::className(), ['id' => 'documenti_id']);
    }
}
