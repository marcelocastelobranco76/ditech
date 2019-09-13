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
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $usuarios = User::paginate(2);
        return view('usuarios.index', compact('usuarios'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
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
             'name.required' => 'Digite o nome do usuário',
            'email.required' => 'Digite o e-mail do usuário',
            'email.email' => 'Email inválido',
            'email.unique' => 'Email já existe no banco de dados',
            'password.required' => 'Informe a nova senha',
            'password.min' => 'A nova senha deve ter ao menos 06 caracteres'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa **/
        if ($validator->fails()) {
            return Redirect::to('admin/usuarios/create')
                ->withErrors($validator);
        } else {
            /** Salva **/
            $usuario = new User;
           $usuario->name = Input::get('name');
            $usuario->email = Input::get('email');
            $usuario->password = bcrypt(Input::get('password'));
           $usuario->save();

            /** Redireciona **/
            Session::flash('message', 'Usuário cadastrado com sucesso ');
            return Redirect::to('admin/usuarios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** Encontra o usuário pelo id **/
        $usuario = DB::select('SELECT * FROM users WHERE id = :id', ['id' => $id]);

        /** Mostra o formulário de edição e passa o usuário que será editado **/
        return view('usuarios.edit', compact('usuario'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update($id)
    {
        /** Validação **/
       
        $regras = array(
            'name.required' => 'Digite o nome do usuário',
            'email.required' => 'Digite o e-mail do usuário',
            'email.email' => 'Email inválido',
            'email.unique' => 'Email já existe no banco de dados',
            'password.required' => 'Informe a nova senha',
            'password.min' => 'A nova senha deve ter ao menos 06 caracteres'
        );
        $validator = Validator::make(Input::all(), $regras);

        /** Processa **/
        if ($validator->fails()) {
            return Redirect::to('admin/usuarios/' . $id . '/edit')
                ->withErrors($validator);
        } else {
          
	    /** Salva **/
            $usuario = DB::select('SELECT * FROM users WHERE id = :id', ['id' => $id]);

            $usuario[0]->name = Input::get('name');
	    $usuario[0]->email = Input::get('email');
	    $usuario[0]->password = Input::get('password');
          
	    $usuarioNome = $usuario[0]->name;
	    $usuarioEmail = $usuario[0]->email;
	    $usuarioSenha = bcrypt($usuario[0]->password);  	 			

            DB::update('UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?',[$usuarioNome,$usuarioEmail,$usuarioSenha,$id]);

            /** Redireciona **/
            Session::flash('message', 'Usuário atualizado com sucesso');
            return Redirect::to('admin/usuarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $usuario = DB::select('SELECT * FROM users WHERE id = :id', ['id' => $id]);
        DB::delete('DELETE FROM users WHERE id = :id', ['id' => $id]);
  

        Session::flash('message', 'Usuário excluído com sucesso');
        return Redirect::to('admin/usuarios');
    }
}

