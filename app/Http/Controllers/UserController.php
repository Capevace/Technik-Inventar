<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.all', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Role::all();
        $userSelf = false;

        return view('users.edit', compact('user', 'roles', 'userSelf'));
    }

    public function create()
    {
        $roles = \App\Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email',
            'role' => 'required|integer|min:1',
            'password' => 'required|string|max:255|confirmed'
        ]);

        $input = $request->input();

        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->save();

        $role = \App\Role::find($input['role']);
        if (!is_null($role)) {
            $user->attachRole($role);
        } else {
            $user->delete();
            return response()->alertBack('Rolle nicht gefunden.', 'warning');
        }

        return response()->alertBack('Nutzer "' . $user->name . '" wurde hinzugefügt.', 'success');
    }

    public function change($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'integer|min:1'
        ]);

        $input = $request->input();
        $user = User::findOrFail($id);
        $user->name = $input['name'];
        $user->email = $input['email'];

        if (array_key_exists('role', $input)) {
            $role = \App\Role::findOrFail($input['role']);

            $user->detachAllRoles();
            $user->attachRole($role);
        }

        $user->save();

        return response()->alertBack('Nutzer wurde bearbeitet.', 'success');
    }

    public function changePassword($id, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|max:255|confirmed'
        ]);

        $input = $request->input();
        $user = User::findOrFail($id);
        $user->password = bcrypt($input['password']);
        $user->save();

        return response()->alertBack('Das Passwort wurde geändert.', 'success');
    }

	public function delete($id)
	{
		if ($id == 1)
			return response()->alertBack('Der Leiter-Account kann nicht gelöscht werden.', 'warning');
		User::findOrFail($id)->delete();

		return response()->alertBack('Nutzer wurde gelöscht.', 'success');
	}
}
