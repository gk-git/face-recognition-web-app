<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'door-key' => 'Door key',		],	],
		'user-actions' => [		'title' => 'User actions',		'created_at' => 'Time',		'fields' => [			'user' => 'User',			'action' => 'Action',			'action-model' => 'Action model',			'action-id' => 'Action id',		],	],
		'doors' => [		'title' => 'Doors',		'created_at' => 'Time',		'fields' => [			'door-key' => 'Door key',			'location' => 'Location',		],	],
		'stautus' => [		'title' => 'Stautus',		'created_at' => 'Time',		'fields' => [			'status' => 'Status',			'action-open' => 'Action open',			'action-black' => 'Action black',			'action-wait' => 'Action wait',			'action-else' => 'Action else',			'door' => 'Door',		],	],
		'pasts' => [		'title' => 'Pasts',		'created_at' => 'Time',		'fields' => [			'action' => 'Action',			'door' => 'Door',			'intruder' => 'Intruder',			'user' => 'User',		],	],
	'qa_create' => 'Criar',
	'qa_save' => 'Salvar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Visualizar',
	'qa_update' => 'Atualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'Sem entradas na tabela',
	'custom_controller_index' => 'Índice de Controller personalizado.',
	'qa_logout' => 'Sair',
	'qa_add_new' => 'Novo',
	'qa_are_you_sure' => 'Tem certeza?',
	'qa_back_to_list' => 'Voltar',
	'qa_dashboard' => 'Painel',
	'qa_delete' => 'Excluir',
	'quickadmin_title' => 'AULS',
];