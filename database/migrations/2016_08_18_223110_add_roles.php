<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Item;
use App\ItemType;
use App\Role;
use App\Permission;
use DB;

class AddRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Article permissions
        $viewArticles = new Permission();
        $viewArticles->name = 'view-items';
        $viewArticles->display_name = 'Artikel ansehen';
        $viewArticles->description = 'Artikel ansehen';
        $viewArticles->save();

        $editArticles = new Permission();
        $editArticles->name = 'edit-items';
        $editArticles->display_name = 'Artikel bearbeiten';
        $editArticles->description = 'Artikel bearbeiten';
        $editArticles->save();

        $createArticles = new Permission();
        $createArticles->name = 'create-items';
        $createArticles->display_name = 'Artikel erstellen';
        $createArticles->description = 'Artikel erstellen';
        $createArticles->save();

        $manageArticleTypes = new Permission();
        $manageArticleTypes->name = 'manage-item-types';
        $manageArticleTypes->display_name = 'Artikel-Kategorien verwalten';
        $manageArticleTypes->description = 'Artikel-Kategorien verwalten';
        $manageArticleTypes->save();

        $manageBrokenItems = new Permission();
        $manageBrokenItems->name = 'manage-broken-items';
        $manageBrokenItems->display_name = 'Defekte Artikel verwalten';
        $manageBrokenItems->description = 'Defekte Artikel verwalten';
        $manageBrokenItems->save();

        // Job permissions
        $viewJobs = new Permission();
        $viewJobs->name = 'view-jobs';
        $viewJobs->display_name = 'Auftrag ansehen';
        $viewJobs->description = 'Auftrag ansehen';
        $viewJobs->save();

        $editJobs = new Permission();
        $editJobs->name = 'edit-jobs';
        $editJobs->display_name = 'Auftrag bearbeiten';
        $editJobs->description = 'Auftrag bearbeiten';
        $editJobs->save();

        $createJobs = new Permission();
        $createJobs->name = 'create-jobs';
        $createJobs->display_name = 'Auftrag erstellen';
        $createJobs->description = 'Auftrag erstellen';
        $createJobs->save();

        $assignJobItems = new Permission();
        $assignJobItems->name = 'assign-job-items';
        $assignJobItems->display_name = 'Auftrags-Artikel zuweisen';
        $assignJobItems->description = 'Dem Auftrag können Artikel zugewiesen werden.';
        $assignJobItems->save();

        // User permissions
        $manageUsers = new Permission();
        $manageUsers->name = 'manage-users';
        $manageUsers->display_name = 'Nutzer verwalten';
        $manageUsers->description = 'Nutzer verwalten';
        $manageUsers->save();

        // Roles
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Leiter';
        $admin->description = 'Kann das Inventar, die Aufträge, die Gelder und die Nutzer verwalten.';
        $admin->save();

        $admin->attachPermissions([
            $viewArticles,
            $editArticles,
            $createArticles,
            $manageArticleTypes,
            $manageBrokenItems,
            $viewJobs,
            $editJobs,
            $createJobs,
            $assignJobItems,
            $manageUsers
        ]);

        $technician = new Role();
        $technician->name = 'technician';
        $technician->display_name = 'Techniker';
        $technician->description = 'Kann das Inventar und die Aufträge verwalten.';
        $technician->save();

        $technician->attachPermissions([
            $viewArticles,
            $editArticles,
            $createArticles,
            $manageArticleTypes,
            $manageBrokenItems,
            $viewJobs,
            $editJobs,
            $createJobs,
            $assignJobItems
        ]);

        $apprentice = new Role();
        $apprentice->name = 'apprentice';
        $apprentice->display_name = 'Schüler';
        $apprentice->description = 'Kann das Inventar ansehen, defekte Artikel verwalten und Aufträge verwalten.';
        $apprentice->save();

        $apprentice->attachPermissions([
            $viewArticles,
            $manageBrokenItems,
            $viewJobs,
            $editJobs,
            $createJobs,
            $assignJobItems
        ]);

		    $viewer = new Role();
        $viewer->name = 'viewer';
        $viewer->display_name = 'Benutzer';
        $viewer->description = 'Kann sich anmelden.';
        $viewer->save();

        $this->info("Technik Inventory successfully initialized.");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();


        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
