<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
                    'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=test4migomby',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                    ),  
//			'fixture'=>array(
//				'class'=>'system.test.CDbFixtureManager',
//			),
		),
	)
);
