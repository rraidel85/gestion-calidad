<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'type_areas' => [
        'name' => 'Type Areas',
        'index_title' => 'TypeAreas List',
        'new_title' => 'New Type area',
        'create_title' => 'Create TypeArea',
        'edit_title' => 'Edit TypeArea',
        'show_title' => 'Show TypeArea',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'areas' => [
        'name' => 'Areas',
        'index_title' => 'Areas List',
        'new_title' => 'New Area',
        'create_title' => 'Create Area',
        'edit_title' => 'Edit Area',
        'show_title' => 'Show Area',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
            'type_area_id' => 'Type Area',
        ],
    ],

    'files' => [
        'name' => 'Files',
        'index_title' => 'Files List',
        'new_title' => 'New File',
        'create_title' => 'Create File',
        'edit_title' => 'Edit File',
        'show_title' => 'Show File',
        'inputs' => [
            'name' => 'Name',
            'file' => 'File',
            'category_id' => 'Category',
            'area_id' => 'Area',
            'user_id' => 'User',
        ],
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
