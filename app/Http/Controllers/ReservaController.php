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
       $reservas = DB::table('reservas')
       ->join('users', 'users.id', '=', 'reservas.user_id')
       ->join('salas', 'salas.id', '=', 'reservas.sala_id')
       ->select('salas.nome', 'users.name','reservas.user_id','reservas.id', 'reservas.descricao', 'reservas.hora_inicio', 'reservas.hora_fim')
       ->paginate(2);

	/**Carrega a visualização e mostra as reservas **/
          return view('reservas.index', compact('reservas'));
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
        'descricao' => 'required', 
	'hora_inicio' => 'required',
	'hora_fim' => 'required'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa as informações **/

        if ($validator->fails()) {
		
            return Redirect::to('reservas/cadastrar')
                ->withErrors($validator);
        } else {

		
		
		/**Um usuário não pode reservar mais de 1 sala no mesmo período **/
		 		    
	   $verificaReservaUsuario = DB::select('SELECT * FROM reservas WHERE user_id = :user_id AND hora_inicio = :hora_inicio AND hora_fim = :hora_fim AND sala_id != :sala_id AND reservado = :reservado', ['user_id' => Auth::user()->id,
'sala_id'=>Input::get('id'), 
'hora_inicio'=>date('Y-m-d H:i:s', strtotime(Input::get('data').''.Input::get('hora_inicio'))), 
'hora_fim'=>date('Y-m-d H:i:s', strtotime(Input::get('data').''.Input::get('hora_fim'))), 'reservado' => 1]);

	$countReservaUsuario = count($verificaReservaUsuario);

	
			if( $countReservaUsuario == 1 ) {

			    Session::flash('message', 'Você não pode reservar mais de 1 sala no mesmo período. Favor selecione outro período.');
			    return Redirect::to('reservas/');

			}if( $countReservaUsuario == 0 ){
				
					    /** Cria o objeto Reserva, pega as informações vindas da tela de cadastro e salva **/
					   	    $reserva = new Reserva; 
						    $reserva->user_id  = Auth::user()->id;	
						    $reserva->sala_id  = Input::get('id');

						    $reserva->descricao  = Input::get('descricao');	

						    $dataReserva = Input::get('data');

						    $horaInicio = Input::get('hora_inicio');
						    
						    $horaFim = Input::get('hora_fim');	
						   
						    $reserva->hora_inicio = date('Y-m-d H:i:s', strtotime($dataReserva.''.$horaInicio));
							
						    $reserva->hora_fim = date('Y-m-d H:i:s', strtotime($dataReserva.''.$horaFim));	 
						    				 	
					    	    $reserva->save();

						    /** Mostra mensagem de sucesso e redireciona para a index **/
						   Session::flash('message', 'Sala reservada com sucesso. ');
						    return Redirect::to('reservas/');
			   }	
			
		
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
   public function edit($id)
    {
        /** Encontra a reserva pelo id e pelo id do usuário **/

	$user_id = Auth::user()->id;
        $reserva = DB::select('SELECT * FROM reservas WHERE id = :id AND user_id = :user_id', ['id' => $id, 'user_id' => $user_id]);

        /** Mostra o formulário de edição e passa a reserva que será editada **/
        return view('reservas.edit', compact('reserva'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
     public function update($id)
    {
        /** Validação **/
       
       $regras = array(
        'descricao' => 'required', 
	'hora_inicio' => 'required',
	'hora_fim' => 'required'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa **/
        if ($validator->fails()) {
            return Redirect::to('reservas/' . $id . '/editar')
                ->withErrors($validator);
        } else {
          
	    /** Salva **/
	    $user_id = Auth::user()->id;	
            $reserva = DB::select('SELECT * FROM reservas WHERE id = :id AND user_id = :user_id', ['id' => $id, 'user_id' => $user_id]);
	    
	    $dataReserva = Input::get('data');

            $horaInicio = Input::get('hora_inicio');
	    
            $horaFim = Input::get('hora_fim');
            
	    $reserva[0]->descricao = Input::get('descricao');
	    $reserva[0]->hora_inicio = date('Y-m-d H:i:s', strtotime($dataReserva.''.$horaInicio));
	    $reserva[0]->hora_fim = date('Y-m-d H:i:s', strtotime($dataReserva.''.$horaFim));	
          
	    $reservaDescricao = $reserva[0]->descricao;
	    $reservaHoraInicio = $reserva[0]->hora_inicio;
	    $reservaHoraFim = $reserva[0]->hora_fim; 	   			

            DB::update('UPDATE reservas SET descricao = ?, hora_inicio = ?, hora_fim = ? WHERE id = ? AND user_id = ?',[$reservaDescricao,$reservaHoraInicio,$reservaHoraFim,$id,$user_id]);

            /** Redireciona **/
            Session::flash('message', 'Reserva atualizada com sucesso');
            return Redirect::to('reservas');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {

	$reserva = DB::select('SELECT * FROM reservas WHERE id = :id AND user_id = :user_id', ['id' => $id, 'user_id' => Auth::user()->id]);
        DB::delete('DELETE FROM reservas WHERE id = :id AND user_id = :user_id', ['id' => $id, 'user_id' => Auth::user()->id]);
  

        Session::flash('message', 'Reserva removida com sucesso');
        return Redirect::to('reservas');

    }
}
