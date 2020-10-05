@extends('layouts.app')

@section('content')

<div class="container">

@if(Session::has('Mensaje')){{
	Session::get('Mensaje')
}}
@endif

<a href="{{ url('empleados/create')}}" class="btn btn-success">Agregar Empleado</a>
</br>
</br>

<table class="table table-light table-hover">
	
	<thead class="thead-light">
		<tr>
			<th>#</th>
			<th>Foto</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Acciones</th>
		</tr>
	</thead>

	<tbody>
		@foreach($empleados as $empleado)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>
				<img width='100px'
				src="{{ asset('storage').'/'.$empleado->Foto}}"
				class="img-thumbnail img-fluid"
				alt="">
				<!-- ese asset es agregar la ruta storage y comprobar que existan archivos ahí -->
			</td>
			<td>{{ $empleado->Nombre}} {{ $empleado->ApellidoPaterno}} {{ $empleado->ApellidoMaterno}}</td>
			<td>{{ $empleado->Correo}}</td>
			<td>

				<a href="{{ url('/empleados/'.$empleado->id.'/edit') }}" class="btn btn-warning">
					Editar
				</a>

				<form action="{{ url('/empleados/'.$empleado->id) }}" method="post" style="display: inline;">
					
					{{csrf_field() }}
					{{ method_field('DELETE')}}
					<button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">Borrar</button>

				</form>

			</td>
		</tr>
		@endforeach
	</tbody>

</table>

{{-- 
	ACTIVAR PAGINACION
	{{ $empleados->links() }} 
--}}

</div>

@endsection