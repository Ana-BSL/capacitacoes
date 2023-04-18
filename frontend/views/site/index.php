<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Seja bem-vindo!</h1>

        <p class="lead">Inscreva-se já em uma de nossas capacitações</p>

        <p><a class="btn btn-lg btn-success" href="index.php/capacitacao-cad/create">Inscreva-se</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-sm-6" style="text-align: center; border: 1px solid #33335B; height: 200px">
                <h2>Capacitações</h2>

                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p> -->

                <p style="text-align: center;">
                    <a class="btn btn-default" href="http://localhost/projeto_capacitacoes/projetoModeloYii2/frontend/web/index.php/capacitacao-cad">
                        Ver tudo... &raquo;
                    </a>
                </p>

            </div>
            <div class="col-sm-6" style="text-align: center; border: 1px solid #33335B; height: 200px">
                <h2>Espectadores</h2>

                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p> -->

                <p style="text-align: center;"><a class="btn btn-default" href="http://localhost/projeto_capacitacoes/projetoModeloYii2/frontend/web/index.php/capacitacao-espec">Ver tudo... &raquo;</a></p>
            </div>
        </div>

    </div>
</div>