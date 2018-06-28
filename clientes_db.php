<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientes_db
 *
 * @author Acer
 */
class clientes_db {
    # Variável que guarda a conexão PDO.
    protected static $db;
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        # Informações sobre o banco de dados:
        $db_host = "localhost";
        $db_nome = "avaliacao";
        $db_usuario = "root";
        $db_senha = "";
        $db_driver = "mysql";
        # Informações sobre o sistema:
        $sistema_titulo = "Avalicao";
        $sistema_email = "sergionj@bol.com.br";
        try
        {
            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            mail($sistema_email, "PDOException em $sistema_titulo", $e->getMessage());
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        }
    }
    # Método estático - acessível sem instanciação.
    public static function conexao()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db)
        {
            new clientes_db();
        }
        # Retorna a conexão.
        return self::$db;
    }
    
    public static function buscaCliente($Cliente)
    {
        $pdo = clientes_db::conexao();
        $result = $pdo->prepare('SELECT * FROM tbl_clientes as cli inner join tbl_categorias as cat on '
               . 'cat.cat_codigo = cli.cat_codigo '
                . 'where cli.cli_nome="'.$Cliente.'"');

        #$result = $pdo->prepare('SELECT * FROM tbl_clientes');


        $result->execute();
        
        $lista_json = array("objects_array" => array());
        foreach($result as $row){
            
            $obj = array (
                'cli_codigo' => $row['cli_codigo'],
                'cli_nome' => $row['cli_nome'],
                'cli_idade' => $row['cli_idade'],
                'cli_telefone' => $row['cli_telefone'],
                'cli_endereco' => $row['cli_endereco'],
                'cat_codigo' => $row['cat_codigo'],
                'cat_nome' => $row['cat_nome'],
                'cat_status' => $row['cat_status']
            );

            array_push($lista_json["objects_array"], $obj);
        }
        $dados = array($obj);
        $dados_json = json_encode($obj);
        
        
        return $dados_json;
    }
}
    