<?php
/**************************************************************************
 * Objetivo: responsavel de manipular os dados dentro   BD 
 *              (insert,update,select e delete)
 * 
 * Autor: Gean
 * Data:11/03/2022
 * Versão: 1.0
 * 
 *************************************************************************/
//impor
require_once('conexaoMySql.php');
 //função para realizar o insert no BD
function insertContato($dadosContato){

    //abre a conexão com o BD
    $conexao = conexaoMysql();
    $sql = "insert into tblcontatos
        (nome,
        telefone,
        celular,
        email,
        obs)
    values
    ('".$dadosContato["nome"]."',
    '".$dadosContato["telefone"]."',
    '".$dadosContato["celular"]."',
    '".$dadosContato["email"]."',
    '".$dadosContato["obs"]."');";
    //executa o script no BD
        //Validação para verificar  se o script sql esta correto
    if(mysqli_query($conexao, $sql))
    {
        //validação para ver se al inha for gravada no bd 
        if(mysqli_affected_rows($conexao))
        {
            return true;
            }
            else{
                return false;
            }
        }else
        return false;
    }

//função para realizar update no BD
function updateContato(){

}
//função para realizar delete no BD
function deleteContato(){

}
//função para listar todos os contatos do BD
function selectAllContatos(){
    //Abre as conexão com o BD
    $conexao = conexaoMysql();
    //Script para listar todos os dados no BD
    $sql = "select * from tblcontatos";
    //Executa o script sql no BD e guarda o retorno dos dados, se houver 
    $result = mysqli_query($conexao, $sql);
    //valida se o BD retornou os registro
    if($result){
        //mysqli_fetch_assoc() - permite converter os dados do BD em array de manipulação no PHP
        //Nesta, repetição estamos, convertendo os dados do BD em um Array ($rsDados) , além de
        // o proprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a repetição
        while($rsDados = mysqli_fetch_assoc($result)){
            //Criar um array com os dados BD
                $arryDados = array(
                    "nome" => $rsDados['nome'],
                    "telefone" => $rsDados['telefone'],
                    "celular" => $rsDados['celular'],
                    "email" => $rsDados['email'],
                    "obs" => $rsDados['obs']  
                );
            $cont++;
            }
            return $arryDados
    }
}
?>