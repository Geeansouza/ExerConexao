<?php
/**************************************************************************
 * Objetivo: Arquivo responsavel por realizar upload de arquivos
 * 
 * Autor: Gean
 * Data:25/04/2022
 * Versão: 1.0
 * 
 *************************************************************************/
function uploadFile ($arrayFile)
{
    require_once('modulo/config.php');

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (string) null;
    $nameFile = (string) null;
    $tempFile = (string) null;
    
    //validação para identifcar se existe arquivo validor (Maior que zero e que tenha uma extensão)
    if($arquivo['size'] > 0 && $arquivo['type'] != "")
    {
        //Recupera o tamanho do arwyuvi que é em bytes e converte para kb(/1024)
        $sizeFile = $arquivo['size']/1024;

        //Recupera o tipo de arquivos
        $typeFile = $arquivo['type'];
        //Recupera o nome do arquivo
        $nameFile = $arquivo['name'];
    
        //Recupera o caminho do diretorio temporario que está o arquivo
        $tempFile = $arquivo['tmp_name'];
    
        //Validação para permitir o upload apenas de arquivos de no maximo 5mb
        if($sizeFile <= MAX_FILE_UPLOAD){
            
            if(in_array($typeFile, EXT_FILE_UPLOAD))
            {
                //separa somente a extensão do arquivo sem o nome
                $nome = pathinfo($nameFile,PATHINFO_FILENAME);

                $extensao = pathinfo($nameFile,PATHINFO_FILENAME);
                
                    //Existem diversos algoritimos para criptografia de dadis 
                    //md5()
                    //sha1()
                    //hash()
                    //md5 gerando uma criptografia de dados
                    //uniquid gerando um a sequencia numerica diferente tendo como base, configurações na maquina
                    //time() pega a hora minyti segundo que esta sendo feito o upload na foto
                $nomeCripty = md5($nome.uniqid(time()));
                //montamos novamnete com o nome do arquivo com a estensão.
                $foto = $nomeCripty.".".$extensao;
                
                if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto))
                {
                    return $foto;
                }
                else
                {
                    //envia o arquivo da pasta temporararia do pache para a pasta criada no projeto.
                    return array('idErro' => 13,
                    'message' => 'Não foi possivel mover arquivo para o servidor');
                }
            }
            else
            {
                return array('idErro' => 12,
                'message' => 'A extensão di arquivo selecionado não é permitido');
            }
        }else{
            return array('idErro' => 10,
             'message' => 'Tamanho de arquivo ínvalido noo upload.');
        }
    }
    else{
        return array('idErro' => 11,
         'message' => 'Não é possivel realizar o upload sem um arquivo selecionado');
    }
}
?>