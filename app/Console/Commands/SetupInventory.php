<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\User;
use App\Item;
use App\ItemType;
use App\Role;
use App\Permission;

class SetupInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:setup {user_pw : The password of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the inventory system, including making default categories, users and permissions.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $user = User::find(1);
        if (is_null($user)) {
            $user = new User;
            $user->name = 'Leiter';
            $user->email = 'joh.technik@gmail.com';
            $user->password = bcrypt($this->argument('user_pw'));
            $user->save();
        }

        if (is_null(ItemType::find(1))) {
            $type = new ItemType;
            $type->name = 'Allgemein';
            $type->comment = 'Die Standard-Kategorie. Für Artikel, die nicht genauer definiert werden können.';
            $type->icon = 'archive';
            $type->save();
        }

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
        $admin->description = 'Kann das Inventar, die Aufträge und die Nutzer verwalten.';
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
            $assignJobItems,
            $manageUsers
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

        $user->attachRole($admin);

        $this->info("Technik Inventory successfully initialized.");
    }
}
