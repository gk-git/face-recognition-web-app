<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'door-key' => 'Door key',		],	],
		'user-actions' => [		'title' => 'User actions',		'created_at' => 'Time',		'fields' => [			'user' => 'User',			'action' => 'Action',			'action-model' => 'Action model',			'action-id' => 'Action id',		],	],
		'doors' => [		'title' => 'Doors',		'created_at' => 'Time',		'fields' => [			'door-key' => 'Door key',			'location' => 'Location',		],	],
		'stautus' => [		'title' => 'Stautus',		'created_at' => 'Time',		'fields' => [			'status' => 'Status',			'action-open' => 'Action open',			'action-black' => 'Action black',			'action-wait' => 'Action wait',			'action-else' => 'Action else',			'door' => 'Door',		],	],
		'pasts' => [		'title' => 'Pasts',		'created_at' => 'Time',		'fields' => [			'action' => 'Action',			'door' => 'Door',			'intruder' => 'Intruder',			'user' => 'User',		],	],
	'qa_create' => 'Δημιουργία',
	'qa_save' => 'Αποθήκευση',
	'qa_edit' => 'Επεξεργασία',
	'qa_view' => 'Εμφάνιση',
	'qa_update' => 'Ενημέρωησ',
	'qa_list' => 'Λίστα',
	'qa_no_entries_in_table' => 'Δεν υπάρχουν δεδομένα στην ταμπέλα',
	'custom_controller_index' => 'index προσαρμοσμένου controller.',
	'qa_logout' => 'Αποσύνδεση',
	'qa_add_new' => 'Προσθήκη νέου',
	'qa_are_you_sure' => 'Είστε σίγουροι;',
	'qa_back_to_list' => 'Επιστροφή στην λίστα',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Διαγραφή',
	'quickadmin_title' => 'AULS',
];