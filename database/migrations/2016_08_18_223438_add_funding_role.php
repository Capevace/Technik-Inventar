<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Permission;
use App\Role;


class AddFundingRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Fund permissions
        $manageFunds = new Permission();
        $manageFunds->name = 'manage-funds';
        $manageFunds->display_name = 'Gelder verwalten';
        $manageFunds->description = 'Gelder verwalten';
        $manageFunds->save();

        Role::findOrFail(1)->attachPermissions([$manageFunds]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permission = Permission::where('name', 'manage-funds');
        if ($permission != null) {
          Role::findOrFail(1)->detachPermission($permission);
          $permission->delete();
        }
    }
}
