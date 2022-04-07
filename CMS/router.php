<?php
    /**************************************************************************************
     * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela Wiew
     *     (Dados de um form, listagem de dados, ação de excluir ou atualizar).
     *      Esse arquivo será responsável por encaminhar as solicitações para a Controller.
     * Autora: Florbela
     * Data: 07/04/2022
     * Versão: 1.0
     **************************************************************************************/

     $action = (string) null;
     $component = (string) null;

     //Validação para verificar se a requisição é um POST 
     if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
        
         //Recebendo dados via URL para saber quem está solicitando e qual ação será realizada
         $component = strtoupper($_GET['component']);
         $action = strtoupper($_GET['action']);

         //Estrutura condicional para validar quem está solicitando algo para o Router
         switch ($component) {
             case 'CONTATOS';

             //Import da controller Contatos
             require_once('controller/controllerContatos.php');

             //Verificando o tipo de ação
             if($action == 'DELETAR') {
                /*Recebe o id do registro que deverá ser excluído, que foi enviado 
                pela url no link da imagem do excluir que foi acionado na index*/
                $idcontato = $_GET['id'];

                //Chama a função de excluir na controller
                $resposta = excluirContato($idcontato);

                //Retorna se a exclusão deu certo ou não
                if(is_bool($resposta)){
                    if($resposta) {
                        echo("<script>alert('Registro excluído com sucesso!'); window.location.href = 'dashboard-contatos.php' </script>");
                    }
                } elseif(is_array($resposta)) {
                    echo("<script>alert('". $resposta["message"] ."'); window.location.href = 'dashboard-contatos.php' </script>");
                }
             }
         }
     }
?>