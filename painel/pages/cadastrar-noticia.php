<div class="box-content">
    <h2><i class="fas fa-plus"></i> Adicionar Pokémon</h2>
    
    <?php
        if(isset($_GET['sucesso'])){
            Painel::messageToUser('sucesso','Pokémon cadastrado com sucesso!');
        }
    ?>
    
    <div class="mensagem"></div>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            $categoria_id = $_POST['categoria_id'];
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $imagem = $_FILES['capa'];

            if($titulo == '' || $conteudo == ''){
                Painel::messageToUser('erro', 'Campos vazios não são permitidos!');
            }else if ($imagem['tmp_name'] == ''){
                Painel::messageToUser('erro', 'Imagem precisa ser selecionada!');
            }else if(!Painel::validImage($imagem)){
                Painel::messageToUser('erro', 'Formatos de imagem permitidos (jpeg, jpg ou png)');
            }else{
                $verificaNoticia = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE titulo = ? AND categoria_id = ?");
                $verificaNoticia->execute(array($titulo, $categoria_id));
                if($verificaNoticia->rowCount() == 0){
                    // Primeiro vamos gerar o slug
                    $slug = Painel::generateSlug($titulo);
                    
                    // Verificar se o slug foi gerado corretamente
                    if(empty($slug)){
                        Painel::messageToUser('erro', 'Erro ao gerar o slug para o título');
                        return;
                    }
                    
                    // Agora vamos fazer o upload da imagem
                    $imagem = Painel::uploadFile($imagem);
                    if($imagem === false){
                        Painel::messageToUser('erro', 'Erro ao fazer upload da imagem');
                        return;
                    }
                    
                    // Debug
                    echo "<!--";
                    echo "Slug gerado: " . $slug . "\n";
                    echo "Categoria ID: " . $categoria_id . "\n";
                    echo "-->";
                    
                    $arr = [
                        'categoria_id'=>$categoria_id,
                        'titulo'=>$titulo, 
                        'conteudo'=>$conteudo,
                        'capa'=>$imagem,
                        'order_id'=>0,
                        'slug'=>$slug,
                        'nomeTabela'=>'tb_admin.noticias'
                    ];
                    
                    // Debug
                    echo "<!--";
                    echo "Array para inserção: ";
                    var_dump($arr);
                    echo "-->";
                    
                    if(Painel::insert($arr)){
                        Painel::redirect(INCLUDE_PATH_PAINEL . 'cadastrar-noticia?sucesso');
                    }else{
                        Painel::messageToUser('erro', 'Erro ao cadastrar o Pokémon no banco de dados');
                    }
                }else{
                    Painel::messageToUser('erro', 'Já existe um Pokémon com esse nome!');
                }
            }
        }
        ?>

        <div class="form-group">
            <label for="categoria_id">Tipo:</label>
            <select name="categoria_id" id="">
                <?php
                    $categorias = Painel::getAll('tb_admin.categorias');
                    foreach ($categorias as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> 
                        value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Nome: </label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo');?>" required>
        </div>

        <div class="form-group">
            <label for="conteudo">Descrição: </label>
            <textarea class="tinymce" name="conteudo" id=""><?php recoverPost('conteudo');?></textarea>
        </div>
        
        <div class="form-group">
            <label for="imagem">Imagem: </label>
            <input type="file" name="capa">
        </div>

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nomeTabela" value="tb_admin.noticias">
            <input type="submit" name="acao" value="Adicionar">
        </div>
    </form>
</div>
