<?php

return [
                    ['label' => 'Geral', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Login', 'url' => ['user/login'], 'visible' => Yii::$app->user->isGuest],
                     [
                        'label' => 'Usuários',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                                      
                                        ['label' => 'Administrar', 'url' => ['/user/admin/index']],
                                        ['label' => 'Conta', 'url' => ['/user/settings/account']],
                                        ['label' => 'Redes', 'url' => ['/user/settings/networks']],
                                        
                                   
                                   ]
                         ],
                     [
                        'label' => 'Permissões',
                        'icon' => 'fa fa-lock',
                        'url' => '#',
                        'items' => [
                                      
                                        
                                        ['label' => 'Permissões', 'url' => ['/rbac/permission']],
                                         ['label' => 'Papéis', 'url' => ['/rbac/role']],
                                        ['label' => 'Atribuições', 'url' => ['/rbac/assignment']],
                                        
                                   
                                   ]
                         ],
                   
                
            ];