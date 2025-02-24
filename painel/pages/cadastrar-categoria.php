<?php
    if(isset($_POST['acao'])){
        $nome = $_POST['nome'];
        $slug = Painel::generateSlug($nome);
        
        if($nome == ''){
            Painel::messageToUser('erro', 'O campo nome não pode ficar vazio!');
        }else{
            $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE nome = ?");
            $verificar->execute(array($nome));
            
            if($verificar->rowCount() == 0){
                $arr = [
                    'nome' => $nome,
                    'slug' => $slug,
                    'order_id' => 0,
                    'nomeTabela' => 'tb_admin.categorias'
                ];
                
                if(Painel::insert($arr)){
                    Painel::messageToUser('sucesso', 'Tipo cadastrado com sucesso!');
                    $nome = '';
                }else{
                    Painel::messageToUser('erro', 'Erro ao cadastrar tipo!');
                }
            }else{
                Painel::messageToUser('erro', 'Já existe um tipo com este nome!');
            }
        }
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Tipo</h2>
    
    <form method="post">
        <div class="form-group">
            <label>Nome do Tipo:</label>
            <input type="text" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>">
        </div>
        
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>
