<?php
 // Filename: /module/Blog/config/module.config.php
 return array(
     'db' => array(
         'driver'         => 'Pdo',
         'username'       => 'root',  //I know keeping the details in git is poor form but its only on my local machine
         'password'       => '', 
         'dsn'            => 'mysql:dbname=blog;host=localhost',
         'driver_options' => array(
             \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
         )
     ),

     'service_manager' => array(
         'factories' => array(
             'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',
             'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
             'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
         )
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             __DIR__ . '/../view',
         ),
     ),	
     'controllers' => array(
         'factories' => array(
             'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory'
         )
     ),
     'router' => array(
         'routes' => array(
             'blog' => array(
                 'type' => 'literal',
                 'options' => array(
                     'route'    => '/blog',
                     'defaults' => array(
                         'controller' => 'Blog\Controller\List',
                         'action'     => 'index',
                     ),
                 ),
                 'may_terminate' => true,
                 'child_routes'  => array(
                     'detail' => array(
                         'type' => 'segment',
                         'options' => array(
                             'route'    => '/:id',
                             'defaults' => array(
                                 'action' => 'detail'
                             ),
                             'constraints' => array(
                                 'id' => '[1-9]\d*'
                             )
                         )
                     )
                 )
             )
         )
     )
 );
