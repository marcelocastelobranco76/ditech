{{-- \resources\views\reservas\index.blade.php --}}

@extends('layouts.app')

@section('content')
      

        <div class="container">

            <h1>Lista de reservas</h1>Exemplo de horário vago: Das 16:00:00 às 17:00:00
	  
          
	  <!--Div com mensagens do sistema -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                          @if (Auth::user()->is_admin)<td>ID</td>@endif
            	         <td>RESERVADO PARA</td>
			 <td>DATA</td>
                         <td>SALA</td>
						 <td>DESCRIÇÃO</td>
						 <td>HORÁRIOS VAGOS</td>
						 <td>AÇÕES</td>
						
		      	
                    </tr>
                </thead>
                <tbody>
                  @foreach($reservas as $key => $value)
			   
						  <?php $dataReserva =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("d/m/Y");?>
						  <?php $horaInicio =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("H:i:s");?>
					      <?php $horaFim =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_fim)->format("H:i:s");?>


			                    <tr>
			                         @if (Auth::user()->is_admin)<td  width="2%">{{ $value->id}}</td>@endif
			                        
						  <td  width="10%">{{ $value->name}}</td>
						  <td>{{ $dataReserva}} - das {{$horaInicio}} às {{$horaFim}}</td>		
			            	          <td  width="7%">{{ $value->nome}}</td>
						  <td width="10%">{{ $value->descricao}}
						  </td>
					          <td width="20%"> 

						
						<?php
							$i = 0; 
							for ($i = 8; $i <= 19; $i++){  
														
							    if($i!=8 || $i!=9){
								     if( $i!=substr($horaInicio,0,2) && $i!=substr($horaFim,0,2)) {	
									echo '<p style="background-color:lightgreen">'.$i.':00';
							             }
								    if( $i==substr($horaInicio,0,2) && $i==substr($horaFim,0,2)) {	
									echo '<p style="background-color:red">'.$i.':00';
							             }		
							    }	
							}


						?>
									
						
							
						
						

					</td>
						  
					        
			                       
			                        

						
				
						                  
							   
						
						 			<td width="16%">
			                          @if (Auth::user()->id == $value->user_id)
							
     {{ Form::open(array('style' =>'margin-top: 1%', 'url' => '/reservas/' . $value->id, 'onsubmit' => 'return ConfirmaDelete()')) }}
			                                    {{ Form::hidden('_method', 'DELETE') }}
			                                   {!! Form::submit('Remover', ['class' => 'btn btn-danger']) !!}
			                                   {{ Form::close() }}

			               			
			                @endif
			               
			                        </td>
						
					
			                    </tr>
                @endforeach
                </tbody>
            </table>
                    
                        {{ $reservas->links() }}
			
                  
                   </div>
@endsection
