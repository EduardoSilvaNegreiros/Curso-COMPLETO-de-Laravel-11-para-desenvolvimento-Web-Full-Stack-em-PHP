<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        // load user's notes
        $id = session('user.id');
        $notes = User::Find($id)->notes()->get()->toArray();



        // show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo "I'm creating a new note";
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        echo "I'm editing note with id = $id";
    }

    public function deleteNote($id)
    {

        $id = Operations::decryptId($id);
        echo "I'm deleting note with id = $id";
    }
}
