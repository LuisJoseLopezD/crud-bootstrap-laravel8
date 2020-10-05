	{{ $Modo=='crear' ? 'Agregar empleado' : 'Modificar empleado' }}

<br></br>

<div class="form-group">

	<label class="control-label" for="Nombre">{{'Nombre'}}</label>
	<input class="form-control" type="text" name="Nombre" id="Nombre" 
	value="{{ isset($empleado->Nombre) ? $empleado->Nombre: '' }}">

</div>

<div class="form-group">	

	<label class="control-label" for="ApellidoPaterno">{{'Apellido Paterno'}}</label>
	<input class="form-control" type="text" name="ApellidoPaterno" id="ApellidoPaterno" 
	value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno: '' }}">

</div>

<div class="form-group">	

	<label class="form-group" for="ApellidoMaterno">{{'Apellido Materno'}}</label>
	<input class="form-control" type="text" name="ApellidoMaterno" id="ApellidoMaterno" 
	value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno: '' }}">

</div>	

<div class="form-group">	

	<label class="form-group" for="Correo">{{'Correo'}}</label>
	<input class="form-control" type="email" name="Correo" id="Correo" 
	value="{{ isset($empleado->Correo) ? $empleado->Correo: '' }}">

</div>	

	<label for="Foto">{{'Foto'}}</label>
	
	@if(isset($empleado->Foto))
	<br/>
	<img class="img-thumbnail img-fluid" width='100px' src="{{ asset('storage').'/'.$empleado->Foto}}" alt="">
	<br/>
	@endif

	<input class="form-control" type="file" name="Foto" id="Foto" 
	value="{{ isset($empleado->Foto) ? $empleado->Foto: '' }}">
	<br/>

	<input class="btn btn-success" type="submit" value="{{ $Modo=='crear' ? 'Agregar' : 'Modificar' }}">	

	<a class="btn btn-primary" href="{{ url('empleados')}}">Regresar</a>