{{-- \resources\views\usuarios\index.blade.php --}}

@extends('layouts.app')

@section('content')
      

        <div class="container">

            <h1>Lista de usuários</h1>
	   @if (Auth::user()->is_admin)<p><a href="{{ url('admin/usuarios/create') }}"> Cadastrar usuários</a>@endif
            <!--Div com mensagens do sistema -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                          <td>ID</td>
            	         <td>NOME</td>
                         <td>E-MAIL</td>
            	         <td >AÇÕES</td>
                    </tr>
                </thead>
                <tbody>
                  @foreach($usuarios as $key => $value)
                    <tr>
                         <td  width="2%">{{ $value->id}}</td>
                        <td  width="5%">{{ $value->name}}</td>
            	          <td  width="20%">{{ $value->email}}</td>
                        
                       
			 <td width="10%">
                             <a class="btn btn-info pull-left" style="margin-right: 13px;" href="{{ URL::to('/admin/usuarios/' . $value->id . '/edit') }}">Editar</a>
                
                            
                                {{ Form::open(array('style' =>'margin-left: 45%;margin-top: 1%', 'url' => '/admin/usuarios/' . $value->id, 'onsubmit' => 'return ConfirmaDelete()')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                   {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}
                                {{ Form::close() }}

               
                
               
                        </td>
			
                    </tr>
                @endforeach
                </tbody>
            </table>
                    
                        {{ $usuarios->links() }}
			
                  
                   </div>
@endsection

