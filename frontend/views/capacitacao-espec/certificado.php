<?php

$this->title = 'Gerar Certificado';

?>

<div class="capacitacao-espec-pdf">


    <div class="pdf-group">
        <button class="btn btn-primary" onclick="window.location.href='<?= \yii\helpers\Url::to(['/capacitacao-espec/certificado', 'id' => $id, 'pdf' => true]) ?>'"></button>
    </div>

</div>