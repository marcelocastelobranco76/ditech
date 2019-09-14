# DITECH
# Gestão de salas de reunião
<p>Funcionalidades do sistema:
<p>● Possuir cadastro de usuários (crud)
<p>● Possuir cadastro de salas (crud)
<p>● Login de usuários
<p>● O sistema deve possuir uma interface em html.
<p>● Reserva de salas por usuários
<p>● Após logado, usuário poderá efetuar reserva de salas.
<p>● Deverá possuir uma visualização de todas as salas e os horários vagos e
ocupados.
<p>● Um usuário não pode reservar mais de 1 sala no mesmo período
<p>● 1 sala não pode estar reservado por mais de 1 usuário no mesmo período,
simultaneamente.
<p>● As reservas de salas tem duração de 1 hora, ou seja, posso reservar a sala
as 14:00, e ela estará “bloqueada” para reserva até o próximo horário 15:00.
<p>● Deverá ser possível a remoção da reserva de uma sala apenas pelo próprio
reservante.
# 
<p> O sistema utiliza MySQL como RDBMS.
<p> Para rodar o sistema localmente, siga os passos a seguir:
<p> .Clonar o sistema : git clone https://github.com/marcelocastelobranco76/ditech.git
<p> .Renomear o arquivo .env.example para .env e colocar as credencias de acesso do seu banco de dados
<p> .Rodar o comando php artisan migrate para criar as tabelas no seu banco de dados
<p> .Fazer login como o administrador do sistema (login: admin:ditech.com.br e senha: 12345678)
<p> .Cadastrar usuários


