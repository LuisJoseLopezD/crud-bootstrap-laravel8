<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //Nos permite borrar info de la carpeta storage

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleados::paginate(1); //paginacion
        return view('empleados.index',$datos); //A donde retorna la paginacion
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create'); //Ruta donde se crea el usuario
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation
        $campos = [
        'Nombre' => 'required|string|max:100',
        'ApellidoPaterno' => 'required|string|max:100',
        'ApellidoMaterno' => 'required|string|max:100',
        'Correo' => 'required|email',
        'Foto' => 'required|max:1000|mimes:jpeg,png,jpg'
        ];

        $MensajeValidacion = ["required"=>'El :attribute es requerido'];
        //Attribute se refiere a los nombres

        $this->validate($request,$campos,$MensajeValidacion); 
        
        // $datosEmpleado=request()->all();

        $datosEmpleado=request()->except('_token');

        if($request->hasFile('Foto')){

            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
            // guardar la foto
        }

        Empleados::insert($datosEmpleado);

        // return response()->json($datosEmpleado);
        return redirect('empleados')->with('Mensaje','Empleado agregado'); 
        //rediccionar a empleados con la variable mensaje
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Recepcionamos el id
    {
        $empleado = Empleados::findOrFail($id); //Lo buscamos
        return view('empleados.edit',compact('empleado')); //redireccionar
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $datosEmpleado=request()->except(['_token','_method']);

        if($request->hasFile('Foto')){

            $empleado = Empleados::findOrFail($id); //Lo buscamos para la info antigua

            Storage::delete('public/'.$empleado->Foto); //Borramos la foto para almanacenar la nueva

            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public'); // guardar la foto
        }

        Empleados::where('id','=',$id)->update($datosEmpleado); // update donde id es igual a id
        
        // $empleado = Empleados::findOrFail($id); //Lo buscamos para la info actual
        // return view('empleados.edit',compact('empleado')); //redireccionar

        return redirect('empleados')->with('Mensaje','Empleado modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Eliminar registro de la base de datos
    {

        $empleado = Empleados::findOrFail($id); //Lo buscamos info antigua

        if(Storage::delete('public/'.$empleado->Foto)){
            Empleados::destroy($id); 
            // Con el método destroy borramos el registro pasandole el parámetro id
        }
        
        return redirect('empleados')->with('Mensaje','Empleado eliminado');; 
        // Y ahora redireccionamos a la vista empleados

    }
}
