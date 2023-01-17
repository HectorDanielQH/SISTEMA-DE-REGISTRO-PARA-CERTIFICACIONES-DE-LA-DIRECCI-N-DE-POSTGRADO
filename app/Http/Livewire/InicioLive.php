<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Folder;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\WithPagination;

class InicioLive extends Component
{
    use WithPagination;
    //paginator usar


    protected $paginationTheme = 'bootstrap';

    public $busquedaTexto;
    public $modalV=false;
    public $ci,$nombre,$apellidopaterno,$apellidomaterno,$celular=0;
    public $numeroFolder=0,$Objeto,$fechaIngreso,$fechaSalida;
    public function render()
    {
        $personas=Persona::where('ci','like','%'.$this->busquedaTexto.'%')
        ->orWhere('nombre','like','%'.$this->busquedaTexto.'%')
        ->orWhere('apellidopaterno','like','%'.$this->busquedaTexto.'%')
        ->orWhere('apellidomaterno','like','%'.$this->busquedaTexto.'%')
        ->orWhere('celular','like','%'.$this->busquedaTexto.'%')
        ->paginate(5);
        return view('livewire.inicio-live',compact('personas'));
    }

    public function busquedaUsuario()
    {
        $persona = Persona::where('ci',$this->ci)->first();
        if($persona){
            $this->nombre=$persona->nombre;
            $this->apellidopaterno=$persona->apellidopaterno;
            $this->apellidomaterno=$persona->apellidomaterno;
            $this->celular=$persona->celular;
        }else{
            $this->nombre='';
            $this->apellidopaterno='';
            $this->apellidomaterno='';
            $this->celular=0;
        }
    }
    public function SalidaFolder($id)
    {
        $folder=Folder::find($id);
        //fecha actual
        $folder->fecha_salida=date('Y-m-d');
        $folder->save();
       //$this->modalV=false;
    }

    public function SalidaEliminarFolder($id)
    {
        $folder=Folder::find($id);
        $folder->fecha_salida=null;
        $folder->save();
    }

    public function GuardarRegistro()
    {
        Persona::updateOrCreate(['ci'=>$this->ci],[
            'ci'=>$this->ci,
            'nombre'=>$this->nombre,
            'apellidopaterno'=>$this->apellidopaterno,
            'apellidomaterno'=>$this->apellidomaterno,
            'celular'=>$this->celular,
        ]);
        Folder::Create([
            'numero_folder'=>$this->numeroFolder,
            'Objeto'=>$this->Objeto,
            'fecha_ingreso'=>$this->fechaIngreso,
            'fecha_salida'=>null,
            'ci'=>$this->ci,
        ]);
    }
    public function ActivarModal()
    {
        $this->modalV=true;
    }
    public function DesactivarModal()
    {
        $this->modalV=false;
    }
    public function Editar($id)
    {
        $folder=Folder::find($id);
        $this->numeroFolder=$folder->numero_folder;
        $this->Objeto=$folder->Objeto;
        $this->fechaIngreso=$folder->fecha_ingreso;
        $this->fechaSalida=$folder->fecha_salida;
        $this->ci=$folder->ci;
        $this->nombre=$folder->persona->nombre;
        $this->apellidopaterno=$folder->persona->apellidopaterno;
        $this->apellidomaterno=$folder->persona->apellidomaterno;
        $this->celular=$folder->persona->celular;
        $this->modalV=true;
    }
    public function Eliminar($id)
    {
        $folder=Folder::find($id);
        $folder->delete();
    }
}
