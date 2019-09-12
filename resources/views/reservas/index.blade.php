{{-- \resources\views\reservas\index.blade.php --}}

@extends('layouts.app')

@section('content')
      

        <div class="container">

            <h1>Lista de reservas</h1>
	   @if (Auth::user()->is_admin) <p><a href="{{ url('reservas/cadastrar') }}"> Cadastrar salas</a>@endif
            <!--Div com mensagens do sistema -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                          @if (Auth::user()->is_admin)<td>ID</td>@endif
            	         <td>QUEM RESERVOU</td>
                         <td>SALA</td>
			 <td>DESCRIÇÃO</td>
			 <td>DATA E HORÁRIO</td>
			 <td>HORÁRIOS VAGOS</td>	
            	      @if (Auth::user()->is_admin)<td >AÇÕES</td>@endif
                    </tr>
                </thead>
                <tbody>
                  @foreach($reservas as $key => $value)
			  <?php $dataReserva =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("m/d/Y");?>
			  <?php $horaInicio =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("H:i:s");?>
		          <?php $horaFim =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_fim)->format("H:i:s");?>

			



                    <tr>
                         @if (Auth::user()->is_admin)<td  width="2%">{{ $value->id}}</td>@endif
                        
			  <td  width="13%">{{ $value->name}}</td>
            	          <td  width="7%">{{ $value->nome}}</td>
			  <td width="15%">{{ $value->descricao}}</td>
		          <td width="18%"> {{$dataReserva}} <br/> Das {{$horaInicio}} às {{$horaFim}}</td>
			  <td colspan="2">

			<?php
				$i = 0; $j = 0;			
			  	for ($i = substr($horaInicio,0,2)+2; $i <= 22; $i++) {
				
					if ($i % 2 == 0 ) {
					    
					    echo '<p>'.$i.':00:00 &nbsp;&nbsp;às ';		
					}

				}?>
				<div style="margin-top:-143px;margin-left:90px">

				<?php for ($j = substr($horaFim,0,2)+2; $j <= 23; $j++) {
				
					if ($j % 2 != 0 ) {
					    
					    echo '<p>'.$j.':00:00';		
					}

				}		
				?>
				</div>




			</td>
		        
                        <!-- Ações : Editar e excluir reservas - Essas ações apenas os administradores podem executar. -->
                         @if (Auth::user()->is_admin)
			 <td width="10%">
                             <a class="btn btn-info pull-left" style="margin-right: 13px;" href="{{ URL::to('/reservas/' . $value->id . '/editar') }}">Editar</a>
                
                            <!-- Edita a sala (utiliza o método encontrado em GET /reservas/{id}/editar --> 
                                {{ Form::open(array('style' =>'margin-left: 45%;margin-top: 1%', 'url' => '/reservas/' . $value->id, 'onsubmit' => 'return ConfirmaDelete()')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                   {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
                                {{ Form::close() }}

               
                
               
                        </td>
			 @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
                    
                        {{ $reservas->links() }}
			
                  
                   </div>
@endsection
