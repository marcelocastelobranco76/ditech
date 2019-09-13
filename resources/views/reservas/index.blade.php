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
						 <td>HORÁRIOS</td>
						 <td>AÇÕES</td>
						
		      	
                    </tr>
                </thead>
                <tbody>
                  @foreach($reservas as $key => $value)
			   
						  <?php $dataReserva =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("m/d/Y");?>
						  <?php $horaInicio =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_inicio)->format("H:i:s");?>
					      <?php $horaFim =  DateTime::createFromFormat("Y-m-d H:i:s",$value->hora_fim)->format("H:i:s");?>


			                    <tr>
			                         @if (Auth::user()->is_admin)<td  width="2%">{{ $value->id}}</td>@endif
			                        
						  <td  width="10%">{{ $value->name}}</td>
						  <td  width="6%">{{ $dataReserva}}</td>		
			            	          <td  width="7%">{{ $value->nome}}</td>
						  <td width="10%">{{ $value->descricao}}
						  </td>
					          <td width="20%"> 

						<p>Ocupados no dia <?php echo $dataReserva;?> :
						<?php 
							if($horaInicio == '08:00:00' || $horaInicio == '09:00:00' ) {
								$horaInicioExplode = explode(":",$horaInicio);
								$valorInicioExplode = str_replace('0','',$horaInicioExplode[0]);
								
								$i = 0;
								for ($i = 8; $i <= 19; $i++) {
							
								     if ($i == substr($horaInicio,0,2) || ($i == $valorInicioExplode)) {
								    
								    	echo '<p style="background-color:#F44336" >'.$i.':00';	
								    }
								}
							}
							if($horaInicio != '08:00:00' || $horaInicio !='09:00:00' ) {
								
								
								$i = 0;
								for ($i = 8; $i <= 19; $i++) {
							
								     if ($i == substr($horaInicio,0,2)) {
								    
								    	echo '<p style="background-color:#F44336" >'.$i.':00';	
								    }
								}
							}	
							if($horaFim == '08:00:00' || $horaFim == '09:00:00' ) {
								$horaFimExplode = explode(":",$horaFim);
								$valorFimExplode = str_replace('0','',$horaFimExplode[0]);
								$i = 0;
								for ($i = 8; $i <= 19; $i++) {
							
								     if ($i == substr($horaFim,0,2) || ($i == $valorFimExplode)) {
								    
								    	echo '<p style="background-color:#F44336" >'.$i.':00';	
								    }		
								}
							}
							
							
						 ?>
								
							
						<p>Vagos no dia <?php echo $dataReserva;?> :
						
						<?php  

							 $i = 0;
	if($horaInicio == '08:00:00' || $horaInicio == '09:00:00' || $horaFim == '08:00:00' || $horaFim == '09:00:00'  ) {
								
								$horaInicioExplode = explode(":",$horaInicio);
								$valorInicioExplode = str_replace('0','',$horaInicioExplode[0]);
								$horaFimExplode = explode(":",$horaFim);
								$valorFimExplode = str_replace('0','',$horaFimExplode[0]);
								
								for ($i = 8; $i <= 19; $i++) {
							
			if ($i != substr($horaInicio,0,2) && $i != $valorInicioExplode && $i != substr($horaFim,0,2) && $i != $valorFimExplode  ) {
								    
								    	echo '<p style="background-color:lightgreen" >'.$i.':00';	
								    }
								    
								}
							}	
							?>

					</td>
						  
					        
			                       
			                        

						
				
						                  
							      @if (Auth::user()->id == $value->user_id)
						
						 			<td width="16%">
			                       
							
     {{ Form::open(array('style' =>'margin-top: 1%', 'url' => '/reservas/' . $value->id, 'onsubmit' => 'return ConfirmaDelete()')) }}
			                                    {{ Form::hidden('_method', 'DELETE') }}
			                                   {!! Form::submit('Remover', ['class' => 'btn btn-danger']) !!}
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
