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
        $user->attachRole(Role::findOrFail(1));

        if (is_null(ItemType::find(1))) {
            $type = new ItemType;
            $type->name = 'Allgemein';
            $type->comment = 'Die Standard-Kategorie. Für Artikel, die nicht genauer definiert werden können.';
            $type->icon = 'archive';
            $type->save();
        }
    }
}
