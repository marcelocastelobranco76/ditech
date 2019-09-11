<?php

namespace App\Http\Controllers;

use App\User;
use App\Sala;
use App\Reserva;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Validator;
use Input;
use Redirect;
use View;

class SalaController extends Controller
{
   
     public function __construct()
     {
	  $this->middleware('auth');
     }

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
    	$salas = Sala::paginate(2);
        return view('salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
    {
    	
        return view('salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        /** Validação **/
        
        $regras = array(
            'nome' => 'required',
	    'descricao' => 'required'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa **/
        if ($validator->fails()) {
            return Redirect::to('admin/salas/cadastrar')
                ->withErrors($validator);
        } else {
            /** Salva **/
            $sala = new Sala;
            $sala->nome = Input::get('nome');
	    $sala->descricao = Input::get('descricao');
            $sala->save();

            /** Redireciona **/
            Session::flash('message', 'Sala cadastrada com sucesso ');
            return Redirect::to('admin/salas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** Encontra a sala pelo id **/
        $sala = DB::select('SELECT * FROM salas WHERE id = :id', ['id' => $id]);

        /** Mostra o formulário de edição e passa a sala que será editada **/
        return view('salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        /** Validação **/
       
        $regras = array(
            'nome'  => 'required',
	    'descricao' => 'required'	
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa **/
        if ($validator->fails()) {
            return Redirect::to('admin/salas/' . $id . '/editar')
                ->withErrors($validator);
        } else {
          
	    /** Salva **/
            $sala = DB::select('SELECT * FROM salas WHERE id = :id', ['id' => $id]);

            $sala[0]->nome = Input::get('nome');
	    $sala[0]->descricao = Input::get('descricao');
          
	    $salaNome = $sala[0]->nome;
	    $salaDescricao = $sala[0]->descricao; 			

            DB::update('UPDATE salas SET nome = ?, descricao = ? WHERE id = ?',[$salaNome,$salaDescricao,$id]);

            /** Redireciona **/
            Session::flash('message', 'Sala atualizada com sucesso');
            return Redirect::to('admin/salas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {

	$sala = DB::select('SELECT * FROM salas WHERE id = :id', ['id' => $id]);
        DB::delete('DELETE FROM salas WHERE id = :id', ['id' => $id]);
  

        Session::flash('message', 'Sala excluída com sucesso');
        return Redirect::to('admin/salas');

    }

}
