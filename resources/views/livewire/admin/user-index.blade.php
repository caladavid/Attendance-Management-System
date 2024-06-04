<div>
    <div class="card">
        <div class="card-header">
            <h4 class="d-flex justify-content-between py-2">Empleados
                <a class="btn btn-primary" href="{{ route("admin.users.create")}}">Agregar departamento</a>
            </h4>
            <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
        </div>
        @if($users->count())
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Número de teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Dia de ingreso</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                    <tr>
                        <th width="10px">{{ $user->id }}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Carbon\Carbon::parse($user->joining_date)->format("d-m-Y") }}</td>
                        <td width="10px">
                            <a href="{{ route("admin.users.edit", $user) }}" class="btn btn-primary" type="submit"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td width="10px">
                            <form method="post" action="{{ route("admin.users.destroy", $user) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar este empleado?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$users->links()}}
        </div>

        @else

        <div class="card-body">
            <strong>No hay registros</strong>
        </div>

        @endif
    </div>
</div>