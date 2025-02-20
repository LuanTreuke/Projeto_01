<div class="box-content">
    <h2><i class="fas fa-plus"></i> Adicionar Notícia</h2>
    <form method="post" enctype="multipart/form-data">
        <?php 
        if (isset($_POST['acao'])){
            $categoria_id = $_POST['categoria_id'];
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $imagem = $_FILES['capa'];

            if($titulo == '' || $conteudo == ''){
                Painel::messageToUser('erro', 'Campos vazios não são permitidos!');
            }else if ($capa['tmp_name'] == ''){
                Painel::messageToUser('erro', 'Imagem de capa precisa ser selecionada!');
            }else{
                if(Painel::validImage($capa)){
                    $verificaNoticia = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE titulo = ?");
                    $verificaNoticia->execute(array($titulo));
                    if($verificaNoticia->rowCount() == 0){
                        $imagem = Painel::uploadFile($capa);
                        $slug = Painel::generateSlug($titulo);
                        $arr = [
                            'categoria_id'=>$categoria_id,
                            'titulo'=>$titulo, 
                            'conteudo'=>$conteudo,
                            'imagem'=>$imagem,
                            'slug'=>$slug,
                            'order_id'=>'0',
                            'nomeTabela'=>'tb_admin.noticias'
                        ];

                    $imagem = Painel::uploadFile($imagem);
                    $slug = Painel::generateSlug($titulo);
                    $arr = [
                        'categoria_id'=>$categoria_id,
                        'titulo'=>$titulo, 
                        'conteudo'=>$conteudo,
                        'imagem'=>$imagem,
                        'slug'=>$slug,
                        'order_id'=>'0',
                        'nomeTabela'=>'tb_admin.noticias'
                    ];
                    Painel::insert($arr);
                    Painel::messageToUser('sucesso', 'A notícia foi cadastrada com sucesso!');
                }
            }
        }
        ?>

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php
                    $categorias = Painel::getAll('tb_admin.categorias');
                    foreach ($categorias as $key => $value) {
                ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo">
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="conteudo"></textarea>
        </div>
        
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem">
        </div>

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>
