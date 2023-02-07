<?php
namespace App\Constants;

class PermissionConstant
{
    const NAME = 'Permission';

    const COLUMN_ID         = 'id';
    const COLUMN_NAME       = 'name';
    const COLUMN_GUARD_NAME = 'guard_name';

    const MSG_CREATED           = 'Permission created successfully';
    const MSG_DELETED           = 'Permission deleted successfully';
    const MSG_UPDATED           = 'Permission updated successfully';
    const MSG_CREATED_FAILED    = 'Permission created failed';
    const MSG_DELETED_FAILED    = 'Permission deleted failed';
    const MSG_UPDATED_FAILED    = 'Permission updated failed';


    const ARRAY_PERMISSIONS = [
        'read_post'         => 'Read Post',
        'create_post'       => 'Create Post',
        'update_post'       => 'Update Post',
        'delete_post'       => 'Delete Post',
        'read_user'         => 'Read User',
        'create_user'       => 'Create User',
        'update_user'       => 'Update User',
        'delete_user'       => 'Delete User',
        'read_role'         => 'Read Role',
        'update_role'       => 'Update Role',
        'create_role'       => 'Create Role',
        'delete_role'       => 'Delete Role',
        'read_permission'   => 'Read Permission',
        'create_permission' => 'Create Permission',
        'update_permission' => 'Update Permission',
        'delete_permission' => 'Delete Permisison'
    ];
}