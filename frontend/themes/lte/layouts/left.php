<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                </br>
                </br>
            </div>
            <div class="pull-left info">
                <p><?php if(!Yii::$app->user->isGuest){
                    echo Yii::$app->user->identity->username;
                }?></p>
            </div>
        </div>

            <?php
            $items = require('menu/custom.php');
        ?>
        <?php  //if(!Yii::$app->user->isGuest){
            common\helpers\RenderWidget::createRolesMenu($items);
        //}
        ?>

    </section>

</aside>
