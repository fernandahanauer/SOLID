<?php

//SPR - Uma classe deve ser responsável por fazer apenas um trabalho.
interface Remuneravel
{
    public function remuneracao();
}

class ContratoClt implements Remuneravel
{
    public function remuneracao()
    {
        //...
    }
}

class Estagio implements Remuneravel
{
    public function remuneracao()
    {
        //...
    }
}

class FolhaDePagamento
{
    protected $saldo;
    
    public function calcular(Remuneravel $funcionario)
    {
        $this->saldo = $funcionario->remuneracao();
    }
}


//OCP - Você deve ser capaz de estender um comportamento de uma classe, sem modificá-lo.
//LSP - Uma subclasse deve ser substituível por sua superclasse
class NomeCandidato
{
    public function getNome()
    {
        echo 'nome';
    }
}

class SobrenomeCandidato extends NomeCandidato 
{ 
    public function getNome()
    {
        echo 'sobrenome';
    }
}

$objeto1 = new NomeCandidato;
$objeto2 = new SobrenomeCandidato;

function imprimeNome(NomeCandidato $objeto)
{
    return $objeto->getNome();
}

imprimeNome($objeto1); // Nome
imprimeNome($objeto2); // Sobrenome


// ISP - Os clientes não devem ser forçados a depender de interfaces que não usam.
interface Funcionario
{
    public function getCargo();
    public function calculaSalario();
}
interface FuncionarioCeletista extends Funcionario
{
    public function calcula13o();
}
interface FuncionarioEstagiario extends Funcionario
{
    public function setInstituicaoEnsino();
}
class Gerente implements FuncionarioCeletista
{
    public function getCargo()
    {
        return "Gerente";
    }
    public function calculaSalario()
    {
        //logica para calculo salário
    }
    public function calcula13o()
    {
        //logica para calculo do 13
    }
}
class Programador implements FuncionarioCeletista
{
    public function getCargo()
    {
        return "Programador";
    }
    public function calculaSalario()
    {
        //logica para calculo salário
    }
    public function calcula13o()
    {
        //logica para calculo do 13
    }
}



//DIP - Dependa de uma abstração e não de uma implementação.
interface iMail
{
    public function enviar($mensagem);
}

class MailSMTP implements iMail
{
    public function enviar($mensagem)
    {
        //logica de envio
    }
}

class MailAmazon implements iMail
{
    public function enviar($mensagem)
    {
        //logica de envio
    }
}

class MailMarketing
{
    protected $mail;

    public function __construct(iMail $mail)
    {
        $this->mail = $mail;
    }

    public function enviar(Cliente $cliente)
    {
        $mensagem = $this->getConteudoEmailPorCliente($cliente);
        $this->mail->enviar($mensagem);
    }

    private function getConteudoEmailPorCliente($cliente)
    {
        //logica de elaboração de conteúdo
    }
}

?>