<?php 
	$params =  array('options' => 
								array('SELECT' =>  array('name',
														 'firstname'
														),
									  'FROM'   => 'user',
									  'ORDER'  => 'DESC'
									  ),
					 'values'  => 
					 			$_user,
					);
	$users = UserMapper::getAll($params);
	print_log($users);