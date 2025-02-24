<?php
//Obtendo a categoria
$url = explode('/', $_GET['url']);
$categoria = array('nome' => '', 'slug' => '', 'id' => ''); // Inicialização padrão

if(isset($url[1]) && !empty($url[1])){
    $verificaCategoria = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE slug = ?");
    $verificaCategoria->execute(array($url[1]));
    
    if($verificaCategoria->rowCount() == 0){
        // Apenas define a categoria padrão, sem redirecionar
        $categoria = array('nome' => '', 'slug' => '', 'id' => '');
    } else {
        $categoria = $verificaCategoria->fetch();
    }
}

$porPagina = 6;

// Modificar a condição do if para incluir verificação de notícia single
if(!isset($url[1]) || (isset($url[1]) && !isset($url[2]))){

?>



<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3><i class="fas fa-search"></i> Pesquisar: </h3>
                <form method="post" action="">
                    <input type="text" name="parametro" placeholder="Digite..." required>
                    <input type="submit" name="buscar" value="Pesquisar">
                </form>
            </div><!--box-content-sidebar-->

            <div class="box-content-sidebar">
                <h3><i class="fas fa-list"></i> Selecione o tipo: </h3>
                <form>
                    <select name="categoria" id="categoria-select">
                        <option value="">Todos os tipos</option>
                        <?php
                            $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` ORDER BY order_id DESC");
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $key => $value) {
                        ?>
                        <option <?php if(isset($url[1]) && $url[1] == $value['slug']) echo 'selected'; ?> 
                                value="<?php echo $value['slug']; ?>">
                            <?php echo $value['nome']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </form>
            </div><!--box-content-sidebar-->

            <div class="box-content-sidebar">
                <h3><i class="fas fa-user"></i> Sobre o autor: </h3>
                <div class="text-center">
                    <div>
                        <img src="<?php echo INCLUDE_PATH; ?>assets/img/local-trabalho.png">
                    </div>
                    <?php echo $infoSite['nome_autor']; ?>
                    <?php echo $infoSite['descricao']; ?>
                </div><!--text-center-->
            </div><!--box-content-sidebar-->

        </div><!--sidebar-->

        <div class="conteudo-portal">
                <div class="header-conteudo-portal">
                    <?php
                        if(!isset($_POST['parametro'])) {
                            if (@$categoria['nome'] == '') {
                                echo '<h2>Visualizando Todos os Pokémons</h2>';
                            } else {
                                echo '<h2>Visualizando Pokémon em <span>' . $categoria['nome'] . '</span></h2>';
                            }
                        }else{
                            echo '<h2><i class="fa fa-check"></i> '.$_POST['parametro'].'</h2>';
                        }

                        $query = "SELECT * FROM `tb_admin.noticias` ";
                        if($categoria['nome'] != ''){
                            $query.="WHERE categoria_id = $categoria[id]";
                        }

                        if(isset($_POST['parametro'])) {
                            $parametro = $_POST['parametro'];
                            if(strstr($query, 'WHERE') !== false){
                                $query.=" AND titulo LIKE '%$parametro%'";
                            }else{
                                $query.=" WHERE titulo LIKE '%$parametro%'";
                            }
                        }
                        
                        if(!isset($_POST['parametro'])) {
                            if(isset($_GET['pagina'])){
                                $pagina = (int)$_GET['pagina'];
                                $queryPagina = ($pagina - 1) * $porPagina;
                                $query .=" ORDER BY order_id DESC LIMIT $queryPagina, $porPagina";
                            }else{
                                $pagina = 1;
                                $query .=" ORDER BY order_id DESC LIMIT 0, $porPagina";
                            }
                        } else {
                            $query.=" ORDER BY order_id DESC LIMIT 0, $porPagina";
                        }

                        $noticias = MySql::conectar()->prepare($query);
                        $noticias->execute();
                        $noticias = $noticias->fetchAll();
                    ?>
                </div><!--header-conteudo-portal-->
                <?php foreach ($noticias as $key => $value) {
                    // Debug para verificar os valores
                    echo "<!--";
                    echo "Categoria ID: " . $value['categoria_id'] . "\n";
                    echo "-->";
                    
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE id = ?");
                    $sql->execute(array($value['categoria_id']));
                    $categoriaResult = $sql->fetch();
                    
                    // Debug para verificar o resultado
                    echo "<!--";
                    echo "Categoria Result: ";
                    var_dump($categoriaResult);
                    echo "-->";
                    
                    if($categoriaResult && isset($categoriaResult['slug'])) {
                        $categoriaNome = $categoriaResult['slug'];
                ?>
                    <div class="box-single-conteudo">
                        <h2><?php echo $value['titulo']; ?></h2>
                        <p><?php echo substr(strip_tags($value['conteudo']),0,400).'...'; ?></p>
                        <a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">Leia mais</a>
                    </div><!--box-single-conteudo-->
                <?php 
                    }
                } 
                ?>

            <?php
                $query = "SELECT * FROM `tb_admin.noticias` ";
                if(@$categoria['nome'] != ''){
                    $query.="WHERE categoria_id = $categoria[id]";
                }
                
                $totalPaginas = MySql::conectar()->prepare($query);
                $totalPaginas->execute();
                $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
            ?>

        </div><!--conteudo-portal-->
        <div class="clear"></div><!--clear-->
        <div class="conteudo-portal">
            <div class="paginator">
                <?php
                if (!isset($_POST['parametro'])) {
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        @$categoriaStr = ($categoria['nome'] != '') ? '/' . $categoria['slug'] : '';
                        if (@$pagina == $i)
                            echo '<a class="active-page" href="'.INCLUDE_PATH.'noticias'.$categoriaStr.'?pagina='.$i.'">'.$i.'</a>';
                        else {
                            echo '<a href="'.INCLUDE_PATH.'noticias'.$categoriaStr.'?pagina='.$i.'">'.$i.'</a>';
                        }
                    }
                }
                ?>
            </div><!--paginator-->
        </div><!--conteudo-portal-->
        <div class="clear"></div><!--clear-->
    </div><!--center-->
</section><!--container-portal-->

<script>
document.getElementById('categoria-select').addEventListener('change', function() {
    let categoria = this.value;
    if(categoria) {
        window.location.replace('<?php echo INCLUDE_PATH; ?>noticias/' + categoria);
    } else {
        window.location.replace('<?php echo INCLUDE_PATH; ?>noticias');
    }
});
</script>

<?php } else {
    include('noticias-single.php');
} ?>