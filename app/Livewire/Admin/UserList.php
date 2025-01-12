<?php


namespace App\Livewire\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class UserList extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    //use WithFileUploads;
    public $user;
    public $userid;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    // public $open_edit = false;
    public $readyToLoad = false; //para controlar el preloader inicia en false

    // protected $listeners = ['render', 'delete'];
    //protected $listeners = ['render', 'delete'];
    //protected $listeners = ['eliminar' => 'delete', 'notify'];

    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
        //RESETEA la paginación, updating() cuando se cambia una de las propiedades  updatingSearch() cuando se cambia la propiedad search
    }

    public function loadUsers()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {
        $this->authorize('viewAny', User::class);//probaremos poniendo en el controlador

        if ($this->readyToLoad) {
            /*  $users = User::where('name', 'like', '%' .$this->search. '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant); */
            $users = User::where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $users = [];
        }
        return view('livewire.admin.user-list', compact('users'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function activar($userId)
    {
        $user = User::findOrFail($userId); // Buscar el usuario por ID
        $user->update(['state' => User::STATE_ACTIVE]); // Actualizar el estado a activo
    }

    public function desactivar($userId)
    {
        $user = User::findOrFail($userId); // Buscar el usuario por ID
        $user->update(['state' => User::STATE_INACTIVE]); // Actualizar el estado a inactivo
    }


    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        $this->emit('notify', [
            'message' => 'Usuario eliminado con éxito.',
            'type' => 'success',
        ]);
    }



 /*    public function confirmDelete($userId)
    {
        $this->emit('confirmDelete', $userId);
    } */



    /*  public function delete()
    {
        if ($this->userid) {
            $user = User::find($this->userid);
    
            if ($user) {
                $user->delete();
    
            
                $this->emit('notify', [
                    'message' => 'Usuario eliminado con éxito.',
                    'type' => 'success',
                ]);
            } else {
           
                $this->emit('notify', [
                    'message' => 'Usuario no encontrado.',
                    'type' => 'error',
                ]);
            }
        }
    } */

   

    public function confirmarEliminado($id)
    {
        $this->userid = $id;
        $this->dispatch('confirmareliminado');
        //$this->dispatch('confirmareliminado', message:'¿Estás seguro de eliminar?');
        /* $this->dispatch('confirmareliminado', [
            'message' => '¿Estás seguro de eliminar este usuario?',
        ]); */
    }


  /*   #[On('eliminar')]
    public function testEvent()
    {
        dd('Evento eliminar recibido');
    } */


    #[On('eliminar')] // Escucha el evento "eliminar"
    public function delete()
    {
        //$this->authorize('delete', $user);

        if ($this->userid) {
            $user = User::find($this->userid);
            $this->authorize('delete', $user);
            //dd($user);
            if ($user) {
                $user->delete();

                // Notifica éxito
                $this->dispatch('borrado', [
                    'message' => 'Usuario eliminado con éxito.',
                ]);
            } else {
                // Notifica error si el usuario no existe
                $this->dispatch('borrado', [
                    'message' => 'Usuario no encontrado.',
                    'type' => 'error',
                ]);
            }

            $this->reset('userid');
        }
    }





}
