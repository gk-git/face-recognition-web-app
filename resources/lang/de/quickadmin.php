<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'door-key' => 'Door key',		],	],
		'user-actions' => [		'title' => 'User actions',		'created_at' => 'Time',		'fields' => [			'user' => 'User',			'action' => 'Action',			'action-model' => 'Action model',			'action-id' => 'Action id',		],	],
		'doors' => [		'title' => 'Doors',		'created_at' => 'Time',		'fields' => [			'door-key' => 'Door key',			'location' => 'Location',		],	],
		'stautus' => [		'title' => 'Stautus',		'created_at' => 'Time',		'fields' => [			'status' => 'Status',			'action-open' => 'Action open',			'action-black' => 'Action black',			'action-wait' => 'Action wait',			'action-else' => 'Action else',			'door' => 'Door',		],	],
		'pasts' => [		'title' => 'Pasts',		'created_at' => 'Time',		'fields' => [			'action' => 'Action',			'door' => 'Door',			'intruder' => 'Intruder',			'user' => 'User',		],	],
	'qa_create' => 'Erstellen',
	'qa_save' => 'Speichern',
	'qa_edit' => 'Bearbeiten',
	'qa_view' => 'Betrachten',
	'qa_update' => 'Aktualisieren',
	'qa_list' => 'Listen',
	'qa_no_entries_in_table' => 'Keine Einträge in Tabelle',
	'custom_controller_index' => 'Custom controller index.',
	'qa_logout' => 'Abmelden',
	'qa_add_new' => 'Hinzufügen',
	'qa_are_you_sure' => 'Sind Sie sicher?',
	'qa_back_to_list' => 'Zurück zur Liste',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Löschen',
	'quickadmin_title' => 'AULS',
];