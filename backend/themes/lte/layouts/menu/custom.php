<?php

return [
                    ['label' => 'Geral', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                     [
                        'label' => 'Usuários',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                                      
                                        ['label' => 'Admin', 'url' => ['/user/admin/index']],
                                        ['label' => 'Account', 'url' => ['/user/settings/account']],
                                        ['label' => 'Network', 'url' => ['/user/settings/networks']],
                                        
                                   
                                   ]
                         ],
                     [
                        'label' => 'Permissões',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                                      
                                        ['label' => 'Papéis', 'url' => ['/rbac/role']],
                                        ['label' => 'Permissões', 'url' => ['/rbac/permission']],
                                        ['label' => 'Atribuições', 'url' => ['/rbac/assignment']],
                                        
                                   
                                   ]
                         ],
                   
                
            ];