<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
	'router' => array(
		'routes' => array(
			'userauth' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/userauth[/:action][/:param1][/:param2][/:param3]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					//'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserAuth\Controller\UserAuth',
						'action' => 'index',
					),
				),
			),
			'other_userauth' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/userauths',
					'defaults' => array(
						'__NAMESPACE__' => 'UserAuth\Controller',
						'controller' => 'UserAuth',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/[:controller[/:action][/:param1][/:param2][/:param3]]',
							'constraints' => array(
							//'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
							//'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
				),
			),
		),
	),
	'translator' => array(
		'locale' => 'en_US',
		'translation_file_patterns' => array(
			array(
				'type' => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern' => '%s.mo',
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'UserAuth\Controller\UserAuth' => 'UserAuth\Controller\UserAuthController',
			'UserAuth\Controller\Success' => 'UserAuth\Controller\SuccessController',
		),
	),
	'doctrine' => array(
		'driver' => array(
			'odm_default' => array(
				'drivers' => array(
					'UserAuth\Document' => 'userauth'
				)
			),
			'userauth' => array(
				'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					'module/UserAuth/src/UserAuth/Document'
				)
			)
		),
	),
	'asset_manager' => array(
		'resolver_configs' => array(
			'paths' => array(
				'userauth' => __DIR__ . '/../assets',
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'userauth' => __DIR__ . '/../view',
		),
		'strategies' => array(
			'ViewJsonStrategy',
		),
	),
	// Placeholder for console routes
	'console' => array(
		'router' => array(
			'routes' => array(
			),
		),
	),
);
