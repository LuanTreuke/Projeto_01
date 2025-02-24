<?php
//Obtendo a categoria
$url = explode('/', $_GET['url']);

if(!isset($url[1]) || !isset($url[2])){
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

$verificaCategoria = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE slug = ?");
$verificaCategoria->execute(array($url[1]));
if($verificaCategoria->rowCount() == 0){
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

$categoriaInfo = $verificaCategoria->fetch();

$post = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE slug = ? AND categoria_id = ?");
$post->execute(array($url[2], $categoriaInfo['id']));
if($post->rowCount() == 0){
    Painel::redirect(INCLUDE_PATH . 'noticias');
}

//Minha noticia existe
$post = $post->fetch();
?>

<section id="noticia-single-section">
    <div class="center">
        <div id="noticia-single-container">
            <header id="noticia-single-header">
                <h1 id="noticia-single-titulo"><?php echo $post['titulo']; ?></h1>
            </header>
            <article id="noticia-single-article">
                <div id="noticia-single-img">
                    <img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $post['capa'];?>">
                </div>
                <div id="noticia-single-content">
                    <?php echo $post['conteudo']; ?>
                </div>
                <div id="noticia-single-voltar">
                    <a href="<?php echo INCLUDE_PATH; ?>noticias">Voltar</a>
                </div>
                <div class="clear"></div>
            </article>
        </div><!--noticia-single-container-->
    </div><!--center-->
</section><!--noticia-single-section-->

