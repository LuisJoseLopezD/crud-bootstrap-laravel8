@extends('layouts.app')

@section('content')

<div class="container">

	<!-- Imprimiendo los errores si encuentra alguno en una lista -->

	@if(count($errors)>0)

	<div class="alert alert-danger" role="alert">
		
		<ul>
			@foreach($errors->all() as $error)

				<li> {{ $error}} </li>

			@endforeach
		</ul>

	</div>
	@endif

<form action="{{url('/empleados')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
	
	{{ csrf_field() }} 
	<!-- esa funcion de laravel es para la seguridad, protege los datos -->

	@include('empleados.form',['Modo'=>'crear']) 
	<!-- incluir el archivo form.blade.php -->



</form>

</div>

@endsection