<?php
class Painel
{
    public static $cargos = [
        '0' => 'Normal',
        '1' => 'Sub-administrador',
        '2' => 'Administrador'
    ];

    public static function generateSlug($str){
        if(empty($str)) return 'sem-titulo-' . uniqid();
        
        // Remove espaços extras e caracteres especiais do início e fim
        $str = trim($str);
        
        // Converte para minúsculas e remove acentos
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã|à)/', 'a', $str);
        $str = preg_replace('/(ê|é|è)/', 'e', $str);
        $str = preg_replace('/(í|ì)/', 'i', $str);
        $str = preg_replace('/(ó|ò|ô|õ|º)/', 'o', $str);
        $str = preg_replace('/(ú|ù)/', 'u', $str);
        $str = preg_replace('/(ç)/', 'c', $str);
        
        // Remove caracteres especiais e substitui espaços por hífens
        $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
        $str = preg_replace('/[\s-]+/', '-', $str);
        $str = trim($str, '-');
        
        // Se após toda a limpeza o slug ficou vazio, gera um valor padrão
        if(empty($str)) {
            $str = 'pokemon-' . uniqid();
        }
        
        // Verifica se já existe um slug igual em qualquer uma das tabelas
        $sql1 = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE slug = ?");
        $sql2 = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE slug = ?");
        
        $sql1->execute(array($str));
        $sql2->execute(array($str));
        
        if($sql1->rowCount() > 0 || $sql2->rowCount() > 0){
            // Adiciona um número incremental ao final do slug
            $counter = 1;
            $baseSlug = $str;
            do {
                $str = $baseSlug . '-' . $counter;
                $sql1->execute(array($str));
                $sql2->execute(array($str));
                $counter++;
            } while($sql1->rowCount() > 0 || $sql2->rowCount() > 0);
        }
        
        return $str;
    }


    public static function logado()
    {
        //Operador ternário
        return isset($_SESSION['login']) ? true : false;
    }

    public static function logout()
    {
        setcookie('lembrar', true, time() - 3600, '/');
        session_destroy();
        header('Location: ' . INCLUDE_PATH_PAINEL);
    }

    public static function loadPage()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
            if (file_exists('pages/' . $url[0] . '.php')) {
                include('pages/' . $url[0] . '.php');
            } else {
                header('Location: ' . INCLUDE_PATH_PAINEL);
            }
        } else {
            include('pages/home.php');
        }
    }

    public static function deleteUserOnline()
    {
        $date = date('Y-m-d H:i:s');
        MySql::conectar()->exec("DELETE FROM `tb_admin.online` 
                            WHERE ultima_acao < DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
    }

    public static function listUserOnline()
    {
        self::deleteUserOnline();
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online` 
                                      WHERE ultima_acao > DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function getUserTotal()
    {
        $sql = MySql::conectar()->prepare("SELECT ip FROM `tb_admin.visitas`");
        $sql->execute();
        return $sql->rowCount();
    }

    public static function getUserTotalToday()
    {
        try {
            $hoje = date('Y-m-d');
            $sql = MySql::conectar()->prepare("SELECT ip FROM `tb_admin.visitas` 
                                             WHERE dia = ?");
            $sql->execute(array($hoje));
            return $sql->rowCount();
        } catch(Exception $e) {
            return 0;
        }
    }
    public static function messageToUser($type, $message)
    {
        if ($type == 'sucesso') {
            echo '<div class="box-alert sucesso"><i class="fa-solid fa-check"></i> ' . $message . '</div>';
        } else {
            echo '<div class="box-alert erro"<i class="fa-solid fa-times"></i> ' . $message . '</div>';
        }
    }
    public static function validImage($image)
    {
        if (
            $image['type'] == 'image/jpeg' ||
            $image['type'] == 'image/jpg' ||
            $image['type'] == 'image/png'
        ) {
            $size = intval($image['size'] / 1024);
            if ($size < 2048) {
                return true;
            } else {
                Painel::messageToUser('erro', 'O tamanho precisa ser menor do que 2MB');
            }
        }
        return false;
    }

    public static function uploadFile($file)
    {
        $formatoArquivo = explode('.', $file['name']);
        $nomeImagem = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL . 'uploads/' . $nomeImagem))
            return $nomeImagem;
        return false;
    }

    public static function deleteFile($file)
    {
        @unlink('uploads/' . $file);
    }
    public static function painelUsers()
    {
        $sql = MySql::conectar()->prepare("SELECT * FROM  `tb_admin.usuarios`");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    public static function insert($arr)
    {
        try {
            $certo = true;
            $nomeTabela = $arr['nomeTabela'];
            $query = "INSERT INTO `$nomeTabela` VALUES (null";
            $parametros = array();
            
            // Debug
            echo "<!--";
            echo "Iniciando insert na tabela: " . $nomeTabela . "\n";
            echo "-->";
            
            // Primeiro vamos verificar se todos os campos necessários existem
            $campos_necessarios = array('categoria_id', 'titulo', 'conteudo', 'capa', 'slug');
            foreach($campos_necessarios as $campo) {
                if(!isset($arr[$campo]) || empty($arr[$campo])) {
                    echo "<!--";
                    echo "Campo faltando ou vazio: " . $campo . "\n";
                    echo "-->";
                    return false;
                }
            }
            
            foreach ($arr as $key => $value) {
                $nome = $key;
                if ($nome == 'acao' || $nome == 'nomeTabela')
                    continue;
                    
                // Debug
                echo "<!--";
                echo "Campo: " . $nome . " = " . $value . "\n";
                echo "-->";
                
                if ($value === '') {
                    $certo = false;
                    break;
                }
                $query .= ",?";
                $parametros[] = $value;
            }
            
            $query .= ")";
            
            // Debug
            echo "<!--";
            echo "Query: " . $query . "\n";
            echo "Parâmetros: ";
            var_dump($parametros);
            echo "-->";
            
            if ($certo) {
                $sql = MySql::conectar()->prepare($query);
                $resultado = $sql->execute($parametros);
                
                if(!$resultado) {
                    echo "<!--";
                    echo "Erro na execução da query: ";
                    var_dump($sql->errorInfo());
                    echo "-->";
                    return false;
                }
                
                $lastId = MySql::conectar()->lastInsertId();
                
                if($lastId) {
                    $sql = MySql::conectar()->prepare("UPDATE `$nomeTabela` SET order_id = ? WHERE id = ?");
                    $sql->execute(array($lastId, $lastId));
                }
                return true;
            }
            return false;
        } catch(Exception $e) {
            echo "<!--";
            echo "Exceção: " . $e->getMessage() . "\n";
            echo "-->";
            return false;
        }
    }
    public static function getAll($tabela, $start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC");
            $sql->execute();
        } else {
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC LIMIT $start, $end");
            $sql->execute();
        }

        return $sql->fetchAll();
    }
    public static function delete($tabela, $id = false)
    {
        if ($id == false) {
            $sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
            $sql->execute();
        } else {
            $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = ?");
            $sql->execute(array($id));
        }
    }

    public static function redirect($url)
    {
        echo '<script>location.href="' . $url . '"</script>';
        die();
    }
    public static function get($tabela, $query = '', $arr = '')
    {
        if ($query != false) {
            $sql = MySql::conectar()->prepare("SELECT * FROM  `$tabela` WHERE $query");
            $sql->execute($arr);
        } else {
            $sql = MySql::conectar()->prepare("SELECT * FROM  `$tabela`");
            $sql->execute();
        }
        return $sql->fetch();
    }
    public static function update($arr, $single = false)
    {
        $certo  = true;
        $first = false;
        $nomeTabela = $arr['nomeTabela'];
        $query = "UPDATE `$nomeTabela` SET ";
        foreach ($arr as $key => $value) {
            $nome = $key;
            if ($nome == 'acao' || $nome == 'nomeTabela' || $nome == 'id')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }
            if ($first == false) {
                $first = true;
                $query .= "$nome=?";
            } else {
                $query .= ",$nome=?";
            }
            $parametros[] = $value;
        }
        if ($certo) {
            if ($single == false) {
                $parametros[] = $arr['id'];
                $sql = MySql::conectar()->prepare($query . ' WHERE id = ?');
                $sql->execute($parametros);
            } else {
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
            }
        }
        return $certo;
    }
    public static function orderItem($tabela, $orderType, $id)
    {
        if ($orderType == 'up') {
            $infoItemAtual = Painel::get($tabela, 'id=?', array($id));
            $order_id = $infoItemAtual['order_id'];
            $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
            $itemBefore->execute();
            if ($itemBefore->rowCount() == 0)
                return;
            $itemBefore = $itemBefore->fetch();
            Painel::update(array(
                'nomeTabela' => $tabela,
                'id' => $itemBefore['id'],
                'order_id' => $infoItemAtual['order_id']
            ));
            Painel::update(array(
                'nomeTabela' => $tabela,
                'id' => $infoItemAtual['id'],
                'order_id' => $itemBefore['order_id']
            ));
        } else if ($orderType == 'down') {
            $infoItemAtual = Painel::get($tabela, 'id=?', array($id));
            $order_id = $infoItemAtual['order_id'];
            $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
            $itemBefore->execute();
            if ($itemBefore->rowCount() == 0)
                return;
            $itemBefore = $itemBefore->fetch();
            Painel::update(array(
                'nomeTabela' => $tabela,
                'id' => $itemBefore['id'],
                'order_id' => $infoItemAtual['order_id']
            ));
            Painel::update(array(
                'nomeTabela' => $tabela,
                'id' => $infoItemAtual['id'],
                'order_id' => $itemBefore['order_id']
            ));
        }
    }
}
