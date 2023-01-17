<div>
    <h1 class="text-center">BIENVENIDO AL SISTEMA DE REGISTRO DE FOLDERS</h1>
    <div class="container">
        <div class="form-group d-flex">
            <button class="btn btn-outline-primary" wire:click="ActivarModal">AGREGAR REGISTRO</button>
            <input class="form-control mx-1" wire:model="busquedaTexto" type="text" placeholder="BUSCA A LA PERSONA">
        </div>
    </div>
    @if($modalV)
        <div class="container">
            <form class="row g-3 justify-content-center align-items-center"  wire:submit.prevent="GuardarRegistro">
                <div class="col-12">
                    <h1 class="form-label">DATOS PERSONALES</h1>
                </div>
                <div class="col-md-2">
                  <label for="validationDefault01" class="form-label">Carnet de Identidad</label>
                  <input type="text" class="form-control" id="validationDefault01" wire:model="ci" wire:keyup="busquedaUsuario" placeholder="INGRESA EL CARNET DE IDENTIDAD" required>
                </div>
                <div class="col-md-2">
                  <label for="validationDefault02" class="form-label">NOMBRE</label>
                  <input type="text" class="form-control" id="validationDefault02" wire:model="nombre" placeholder="INGRESA EL NOMBRE" required>
                </div>
                <div class="col-md-3">
                  <label for="validationDefault03" class="form-label">APELLIDO PATERNO</label>
                  <input type="text" class="form-control" id="validationDefault03" wire:model="apellidopaterno" placeholder="INGRESA EL APELLIDO PATERNO">
                </div>
                <div class="col-md-3">
                  <label for="validationDefault04" class="form-label">APELLIDO MATERNO</label>
                  <input type="text" class="form-control" id="validationDefault04" wire:model="apellidomaterno" placeholder="INGRESA EL APELLIDO MATERNO">
                </div>
                <div class="col-md-2">
                  <label for="validationDefault05" class="form-label">NUMERO DE CELULAR</label>
                  <input type="number" class="form-control" id="validationDefault05" wire:model="celular" min="0">
                </div>


              <div class="col-12">
                  <h1 class="form-label">DATOS DEL FOLDER</h1>
              </div>
              <div class="col-md-4">
                <label for="validationDefault06" class="form-label">NUMERO DE FOLDER</label>
                <input type="number" min="0" class="form-control" id="validationDefault06" wire:model="numeroFolder" placeholder="INGRESA EL NÚMERO DE FOLDER" required>
              </div>
              <div class="col-md-4">
                <label for="validationDefault07" class="form-label">DESCRIPCIÓN DEL FOLDER</label>
                <input type="text" class="form-control" id="validationDefault07" wire:model="Objeto" placeholder="INGRESA LA DESCRIPCIÓN DEL FOLDER" required>
              </div>
              <div class="col-md-4">
                <label for="validationDefault08" class="form-label">FECHA DE INGRESO DEL FOLDER</label>
                <input type="date" class="form-control" id="validationDefault08" wire:model="fechaIngreso" required>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">GUARDAR REGISTRO</button>
                <button class="btn btn-danger"  type="button" wire:click="DesactivarModal">Cerrar Formulario</button>
              </div>
            </form>
        </div>
    @endif

    {{--table--}}
    <div class="container mt-4">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">C.I.</th>
            <th scope="col">NOMBRES</th>
            <th scope="col">APELLIDO PAT.</th>
            <th scope="col">APELLIDO MAT.</th>
            <th scope="col">CELULAR</th>
            <th scope="col">N° DE FOLDER</th>
            <th scope="col">DESCRIP. DEL FOLDER</th>
            <th scope="col">FECHA DE INGRESO DEL FOLDER</th>
            <th scope="col">FECHA DE SALIDA DEL FOLDER</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
          <tbody>
            @php
                  $cont = 1;   
              @endphp
            @forelse ($personas as $persona)
              @php
                if($cont == 10){
                  break;
                }
              @endphp
              @foreach ($persona->folder as $folder)
                <tr>
                  <td>{{$folder->persona->ci}}</td>
                  <td>{{$folder->persona->nombre}}</td>
                  <td>{{$folder->persona->apellidopaterno}}</td>
                  <td>{{$folder->persona->apellidomaterno}}</td>
                  <td>{{$folder->persona->celular}}</td>
                  <td>{{$folder->numero_folder}}</td>
                  <td>{{$folder->Objeto}}</td>
                  <td>{{$folder->fecha_ingreso}}</td>
                  @if($folder->fecha_salida == null)
                    <td>
                        {{--input fecha--}}
                        <input type="date" wire:model="fechaSalida" wire:change="SalidaFolder({{$folder->id}})" class="mb-2">
                    </td>
                  @else
                    <td>{{$folder->fecha_salida}}
                        <button class="btn btn-danger" wire:click="SalidaEliminarFolder({{$folder->id}})"><i class="fas fa-trash"></i></button>
                    </td>
                  @endif
                  <td class="">
                      <button class="col-5 text-center btn btn-outline-primary" wire:click="Editar({{$folder->id}})"> <i class="fas fa-edit"></i> </button>
                      <button class="col-5 text-center btn btn-outline-danger" wire:click="Eliminar({{$folder->id}})"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              @endforeach
              @php
                $cont++;
              @endphp
            @empty
                <tr>
                    <td colspan="11" class="text-center">No hay registros</td>
                </tr>
            @endforelse
          </tbody>
      </table>
      {{--links--}}
    </div>
    {{--pa--}}
    <div class="container">
      <div class="row">
        <div class="col-12">
          {{$personas->links()}}
        </div>
      </div>
    </div>
    <div>
  </div>
</div>