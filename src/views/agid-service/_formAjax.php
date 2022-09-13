<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\agid\service\views\agid-service
 * @category   CategoryName
 */

use kartik\builder\Form;

/**
 * @var yii\web\View $this
 * @var open20\agid\service\models\AgidService $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<?= $this->render('_form', [
    'model' => $model,
    'fid' => (NULL !== (filter_input(INPUT_GET, 'fid'))) ? filter_input(INPUT_GET, 'fid') : '',
    'dataField' => (NULL !== (filter_input(INPUT_GET, 'dataField'))) ? filter_input(INPUT_GET, 'dataField') : '',
    'dataEntity' => (NULL !== (filter_input(INPUT_GET, 'dataEntity'))) ? filter_input(INPUT_GET, 'dataEntity') : '',
    'class' => 'dynamicCreation'
]) ?>