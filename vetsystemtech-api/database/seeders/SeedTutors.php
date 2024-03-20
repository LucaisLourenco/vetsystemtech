<?php

namespace Database\Seeders;

use App\Models\Tutor\Tutor;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SeedTutors extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $nome = $this->gerarNomes();
            $email = $this->gerarEmail($nome);
            $cpf = $this->gerarCPF();
            $genero = $this->verificarGenero($nome);
            $username = $this->gerarUsername($nome);
            $aniversario = $this->gerarAniversario();

            $tutor = (new Tutor())->fill([
                'name' => $nome,
                'username' => $username,
                'cpf' => $cpf,
                'role_id' => 2,
                'gender_id' => $genero,
                'email' => $email,
                'birth' => $aniversario,
                'password' => Hash::make('senha@1234'),
                'active' => 1
            ]);
        }

        $tutor->insertIfDoesNotExist();
    }

    protected function gerarNomes()
    {
        $primeirosNomes = array(
            'João', 'Maria', 'José', 'Ana', 'Pedro', 'Carla', 'Antônio', 'Mariana',
            'Francisco', 'Luana', 'Carlos', 'Fernanda', 'Paulo', 'Beatriz', 'Rafael',
            'Juliana', 'Daniel', 'Cristina', 'Lucas', 'Camila', 'Diego', 'Isabela',
            'Eduardo', 'Patrícia', 'André', 'Larissa', 'Marcos', 'Natália', 'Felipe',
            'Vanessa', 'Roberto', 'Aline', 'Leonardo', 'Gabriela', 'Guilherme', 'Tatiane',
            'Luiz', 'Amanda', 'Gustavo', 'Daniela', 'Ricardo', 'Laura', 'Marcelo', 'Bianca',
            'Fábio', 'Fernanda', 'Vinícius', 'Renata', 'Rodrigo', 'Thaís', 'Rafael', 'Lívia',
            'Arthur', 'Caroline', 'Diego', 'Cintia', 'Matheus', 'Priscila', 'Victor', 'Andressa',
            'Alexandre', 'Isadora', 'Josué', 'Lígia', 'Hugo', 'Valéria', 'Cássio', 'Raquel',
            'Nathan', 'Bruna', 'Emanuel', 'Helena', 'Márcio', 'Cristiane', 'Sérgio', 'Talita',
            'Leandro', 'Débora', 'Caio', 'Nathália', 'Luciano', 'Vitória', 'Júlio', 'Sabrina',
            'Wagner', 'Rita', 'Felipe', 'Silvana'
        );

        $sobrenomes = array(
            'Silva', 'Santos', 'Oliveira', 'Souza', 'Pereira', 'Rodrigues', 'Ferreira', 'Almeida',
            'Costa', 'Martins', 'Araújo', 'Lima', 'Gomes', 'Barbosa', 'Ribeiro', 'Alves',
            'Pinto', 'Melo', 'Carvalho', 'Nunes', 'Cardoso', 'Vieira', 'Cavalcanti', 'Freitas',
            'Correia', 'Mendes', 'Dias', 'Castro', 'Campos', 'Ramos', 'Andrade', 'Fernandes',
            'Garcia', 'Torres', 'Coelho', 'Correa', 'Lopes', 'Leal', 'Rocha', 'Moura',
            'Duarte', 'Sousa', 'Barros', 'Nascimento', 'Borges', 'Moraes', 'Siqueira', 'Teixeira',
            'Farias', 'Machado', 'Azevedo', 'Reis', 'Monteiro', 'Marques', 'Magalhães', 'Dantas',
            'Lemos', 'Sales', 'Peixoto', 'Gonçalves', 'Tavares', 'Cunha', 'Jesus', 'Fonseca',
            'Caldeira', 'Padilha', 'Gusmão', 'Vargas', 'Franco', 'Aguiar', 'Silveira', 'Dantas',
            'Lins', 'Rocha', 'Miranda', 'Motta', 'Brito', 'Domingues', 'Mattos', 'Aragão',
            'Bandeira', 'Barreto', 'Gouveia', 'Mendonça', 'Xavier', 'Pacheco', 'Pereira', 'Figueiredo',
            'Peçanha', 'Pestana', 'Cruz', 'Pontes', 'Neves', 'Teles', 'Lacerda', 'Pinheiro',
            'Lobato', 'Soares', 'Braga', 'Valente', 'Fagundes', 'Telles', 'Nóbrega', 'Muniz'
        );

        // Escolher aleatoriamente um primeiro nome e um sobrenome
        $primeiroNome = $primeirosNomes[array_rand($primeirosNomes)];
        $sobrenome = $sobrenomes[array_rand($sobrenomes)];

        // Retornar o nome completo
        return $primeiroNome . ' ' . $sobrenome;
    }

    protected function gerarEmail($nomeCompleto)
    {
        // Obter o primeiro nome e o sobrenome do nome completo
        $primeiroNome = $nomeCompleto[0];
        $sobrenome = $nomeCompleto[1];

        // Converter o nome para minúsculas e substituir espaços por underscores
        $primeiroNome = strtolower($primeiroNome);
        $sobrenome = strtolower($sobrenome);

        // Formatar o endereço de e-mail
        $email = $primeiroNome . '.' . $sobrenome . '@exemplo.com';

        return $email;
    }

    protected function gerarCPF()
    {
        $noveDigitos = "";
        for ($i = 0; $i < 9; $i++) {
            $noveDigitos .= mt_rand(0, 9);
        }

        $digitos1 = 0;
        $digitos2 = 0;

        // Cálculo do primeiro dígito verificador
        for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
            $digitos1 += $noveDigitos[$i] * $j;
        }

        $resto = $digitos1 % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;

        // Adicionando o primeiro dígito verificador aos nove primeiros dígitos
        $noveDigitos .= $dv1;

        // Cálculo do segundo dígito verificador
        for ($i = 0, $j = 11; $i < 10; $i++, $j--) {
            $digitos2 += $noveDigitos[$i] * $j;
        }

        $resto = $digitos2 % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;

        // Adicionando o segundo dígito verificador ao CPF completo
        $cpf = $noveDigitos . $dv2;

        return $cpf;
    }

    function verificarGenero($nome)
    {
        // Lista de nomes e seus gêneros associados
        $primeiroNome = explode(' ', $nome)[0];

        $nomes = array(
            'João' => 1, 'Maria' => 2, 'José' => 1, 'Ana' => 2,
            'Pedro' => 1, 'Carla' => 2, 'Antônio' => 1, 'Mariana' => 2,
            'Francisco' => 1, 'Luana' => 2, 'Carlos' => 1, 'Fernanda' => 2,
            'Paulo' => 1, 'Beatriz' => 2, 'Rafael' => 1, 'Juliana' => 2,
            'Daniel' => 1, 'Cristina' => 2, 'Lucas' => 1, 'Camila' => 2,
            'Diego' => 1, 'Isabela' => 2, 'Eduardo' => 1, 'Patrícia' => 2,
            'André' => 1, 'Larissa' => 2, 'Marcos' => 1, 'Natália' => 2,
            'Felipe' => 1, 'Vanessa' => 2, 'Roberto' => 1, 'Aline' => 2,
            'Leonardo' => 1, 'Gabriela' => 2, 'Guilherme' => 1, 'Tatiane' => 2,
            'Luiz' => 1, 'Amanda' => 2, 'Gustavo' => 1, 'Daniela' => 2,
            'Ricardo' => 1, 'Laura' => 2, 'Marcelo' => 1, 'Bianca' => 2,
            'Fábio' => 1, 'Fernanda' => 2, 'Vinícius' => 1, 'Renata' => 2,
            'Rodrigo' => 1, 'Thaís' => 2, 'Rafael' => 1, 'Lívia' => 2,
            'Arthur' => 1, 'Caroline' => 2, 'Diego' => 1, 'Cintia' => 2,
            'Matheus' => 1, 'Priscila' => 2, 'Victor' => 1, 'Andressa' => 2,
            'Alexandre' => 1, 'Isadora' => 2, 'Josué' => 1, 'Lígia' => 2,
            'Hugo' => 1, 'Valéria' => 2, 'Cássio' => 1, 'Raquel' => 2,
            'Nathan' => 1, 'Bruna' => 2, 'Emanuel' => 1, 'Helena' => 2,
            'Márcio' => 1, 'Cristiane' => 2, 'Sérgio' => 1, 'Talita' => 2,
            'Leandro' => 1, 'Débora' => 2, 'Caio' => 1, 'Nathália' => 2,
            'Luciano' => 1, 'Vitória' => 2, 'Júlio' => 1, 'Sabrina' => 2,
            'Wagner' => 1, 'Rita' => 2, 'Felipe' => 1, 'Silvana' => 2
        );

        // Verificar se o nome está na lista e retornar o gênero correspondente
        if (array_key_exists($primeiroNome, $nomes)) {
            return $nomes[$primeiroNome];
        } else {
            // Se o nome não estiver na lista, retornar 0
            return 3;
        }
    }

    protected function gerarUsername($nomeCompleto)
    {
        // Obter o primeiro nome e o último nome
        $nomes = explode(' ', $nomeCompleto);
        $primeiroNome = $nomes[0];
        $ultimoNome = end($nomes);

        // Remover caracteres especiais e espaços
        $primeiroNome = preg_replace("/[^A-Za-z0-9]/", '', $primeiroNome);
        $ultimoNome = preg_replace("/[^A-Za-z0-9]/", '', $ultimoNome);

        // Gerar o username concatenando o primeiro nome e o último nome com um ponto no meio
        $username = strtolower($primeiroNome . '.' . $ultimoNome);

        return $username;
    }


    protected function gerarAniversario()
    {
        // Gerar um ano aleatório entre 1950 e 2005
        $ano = rand(1950, 2005);

        // Gerar um mês aleatório entre 1 e 12
        $mes = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);

        // Gerar um dia aleatório entre 1 e 28 (considerando fevereiro)
        $dia = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

        // Concatenar e retornar a data de aniversário no formato 'YYYY-MM-DD'
        return "$ano-$mes-$dia";
    }
}
