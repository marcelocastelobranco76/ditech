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

class ReservaController extends Controller
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
       $reservas = DB::table('reservas')->join('salas', 'reservas.sala_id', '=', 'salas.id')->select('reservas.*', 'salas.nome','salas.descricao')->paginate(2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**Carrega no select drop down todas as salas cadastradas **/

	$salas = Sala::pluck('nome', 'id')->all();
        return view('reservas.create')->with(compact('salas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
   
    {
        /** Validação **/
        
        $regras = array(
	'hora_inicio' => 'required',
	'hora_fim' => 'required'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa as informações **/

        if ($validator->fails()) {
		
            return Redirect::to('reservas/cadastrar')
                ->withErrors($validator);
        } else {
		
            /** Cria o objeto Reserva, pega as informações vindas da tela de cadastro e salva **/

            $reserva = new Reserva; 
	    $reserva->user_id  = Auth::user()->id;	
            $reserva->sala_id  = Input::get('id');
	   
	    $reserva->hora_inicio = date('HH:MI:SS',strtotime(Input::get('hora_inicio')));
		
	    $reserva->hora_fim = date('HH:MI:SS',strtotime(Input::get('hora_fim')));	 
	    				 	
            $reserva->save();

            /** Mostra mensagem de sucesso e redireciona para a index **/
            Session::flash('message', 'Sala reservada com sucesso. ');
            return Redirect::to('reservas/cadastrar');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
