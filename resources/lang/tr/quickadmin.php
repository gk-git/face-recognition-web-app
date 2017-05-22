<?php

return [
		'user-management' => [		'title' => 'User Management',		'created_at' => 'Time',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'created_at' => 'Time',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'created_at' => 'Time',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'door-key' => 'Door key',		],	],
		'user-actions' => [		'title' => 'User actions',		'created_at' => 'Time',		'fields' => [			'user' => 'User',			'action' => 'Action',			'action-model' => 'Action model',			'action-id' => 'Action id',		],	],
		'doors' => [		'title' => 'Doors',		'created_at' => 'Time',		'fields' => [			'door-key' => 'Door key',			'location' => 'Location',		],	],
		'stautus' => [		'title' => 'Stautus',		'created_at' => 'Time',		'fields' => [			'status' => 'Status',			'action-open' => 'Action open',			'action-black' => 'Action black',			'action-wait' => 'Action wait',			'action-else' => 'Action else',			'door' => 'Door',		],	],
		'pasts' => [		'title' => 'Pasts',		'created_at' => 'Time',		'fields' => [			'action' => 'Action',			'door' => 'Door',			'intruder' => 'Intruder',			'user' => 'User',		],	],
	'qa_create' => 'Oluştur',
	'qa_save' => 'Kaydet',
	'qa_edit' => 'Düzenle',
	'qa_view' => 'Görüntüle',
	'qa_update' => 'Güncelle',
	'qa_list' => 'Listele',
	'qa_no_entries_in_table' => 'Tabloda kayıt bulunamadı',
	'custom_controller_index' => 'Özel denetçi dizini.',
	'qa_logout' => 'Çıkış yap',
	'qa_add_new' => 'Yeni ekle',
	'qa_are_you_sure' => 'Emin misiniz?',
	'qa_back_to_list' => 'Listeye dön',
	'qa_dashboard' => 'Kontrol Paneli',
	'qa_delete' => 'Sil',
	'quickadmin_title' => 'AULS',
];