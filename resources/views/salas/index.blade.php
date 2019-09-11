{{-- \resources\views\salas\index.blade.php --}}

@extends('layouts.app')

@section('content')
      

        <div class="container">

            <h1>Lista de salas</h1>
	     @if (Auth::user()->is_admin)<p><a href="{{ url('admin/salas/cadastrar') }}"> Cadastrar salas</a>@endif
            <!--Div com mensagens do sistema -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                          @if (Auth::user()->is_admin)<td>ID</td>@endif
            	         <td>NOME</td>
                         <td>DESCRIÇÃO</td>
            	          @if (Auth::user()->is_admin)<td >AÇÕES</td>@endif
                    </tr>
                </thead>
                <tbody>
                  @foreach($salas as $key => $value)
                    <tr>
                         @if (Auth::user()->is_admin)<td  width="2%">{{ $value->id}}</td>@endif
                        <td  width="5%">{{ $value->nome}}</td>
            	          <td  width="20%">{{ $value->descricao}}</td>
                        
                        <!-- Ações : Editar e excluir salas - Essas ações apenas os administradores podem executar. -->
                         @if (Auth::user()->is_admin)
			 <td width="10%">
                             <a class="btn btn-info pull-left" style="margin-right: 13px;" href="{{ URL::to('/admin/salas/' . $value->id . '/editar') }}">Editar</a>
                
                            <!-- Edita a sala (utiliza o método encontrado em GET /salas/{id}/editar --> 
                                {{ Form::open(array('style' =>'margin-left: 45%;margin-top: 1%', 'url' => '/admin/salas/' . $value->id, 'onsubmit' => 'return ConfirmaDelete()')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                   {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
                                {{ Form::close() }}

               
                
               
                        </td>
			 @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
                    
                        {{ $salas->links() }}
			
                  
                   </div>
@endsection

