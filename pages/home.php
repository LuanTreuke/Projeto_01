<?php
    $slides = MySql::conectar()->prepare("SELECT * FROM `tb_admin.slides`");
    $slides->execute();
    $slides = $slides->fetchAll();

    if(isset($_POST['acao'])){
        //Enviei o formulário
    }
?>

<section id="section-home">
    <article>
        <div class="container-home">
            <h1>Mundo Pokémon: o que é, sua história e como funciona </h1>

            <section id="section-slider" class="slider-principal">
                <?php foreach ($slides as $key => $value) { ?>
                    <div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $value['slide']; ?>')"
                        class="slider-single"></div>
                <?php } ?>
                <div class="bullets"></div>
            </section>

            <div class="Texto">
                <p>
                    <strong class="sub-titulo">Você sabe o que é e como funciona o Mundo Pokémon?</strong>
                    <br>
                    <div class="txt1">Esse universo surgiu graças à popular franquia de games criada pela Nintendo e é muito maior e
                    complexo do que você pode imaginar.</div>
                    <br><br>
                    <div><strong class="sub-titulo">A Geografia do Mundo Pokémon</strong></div>
                    <br>
                    <div class="txt2">Como muitos já sabem desde a época dos jogos da franquia, o Mundo Pokémon é dividido em regiões que
                    são inspiradas em locais do mundo real. Kanto, Johto, Hoenn e Sinnoh são inspiradas em áreas geográficas do Japão.
                    Já Unova é inspirada em Nova York, Kalos é baseada na França, Alola é uma cópia das ilhas do Havaí e
                    Galar, que ainda fará sua estreia na franquia, é semelhante às Ilhas Britânicas. Em muitos casos, os Pokémons acabam
                    afetados pelo clima e características desses locais. Isso é mais evidente da região de Alola, em que muitos Pokémons são
                    diferentes de suas contrapartes normais.
                    A geografia do Mundo Pokémon foi criada após um duelo entre os lendários Groudon e Kyogre, que
                    tentaram modificar o planeta, cada um a seu favor.
                    Depois, os continentes foram modificados novamente graças à interferência de Regigigas, que com sua
                    força, criou as regiões que nós conhecemos dentro do Mundo Pokémon. Mas antes que o Pokémon causasse mais mudanças,
                    ele foi selado pelo Regis (que, até onde se sabe, podem ter sido criados pelos humanos) na região de Sinnoh.
                    E muitas das cavernas existentes dentro do Mundo Pokémon foram uma obra dos Pokémon do tipo
                    terrestre. Um bom exemplo é a caverna dos Digletts, que fica na região de Kanto.</div>
                    
                    <br><br>
                </p>
                <img class="imagem" src="<?php echo INCLUDE_PATH; ?>assets/img/mundo pokemon.png" alt="mundos pokémon">
                <p>
                    <div><strong class="sub-titulo">História</strong></div>
                    <br>
                    <div class="txt3">Como muitos já sabem desde a época dos jogos da franquia, o Mundo Pokémon é dividido em regiões que
                    são inspiradas em locais do mundo real. Kanto, Johto, Hoenn e Sinnoh são inspiradas em áreas geográficas do Japão.
                    Já Unova é inspirada em Nova York, Kalos é baseada na França, Alola é uma cópia das ilhas do Havaí e
                    Galar, que ainda fará sua estreia na franquia, é semelhante às Ilhas Britânicas. Em muitos casos, os Pokémons acabam
                    afetados pelo clima e características desses locais. Isso é mais evidente da região de Alola, em que muitos Pokémons são
                    diferentes de suas contrapartes normais.
                    A geografia do Mundo Pokémon foi criada após um duelo entre os lendários Groudon e Kyogre, que
                    tentaram modificar o planeta, cada um a seu favor.
                    Depois, os continentes foram modificados novamente graças à interferência de Regigigas, que com sua
                    força, criou as regiões que nós conhecemos dentro do Mundo Pokémon. Mas antes que o Pokémon causasse mais mudanças,
                    ele foi selado pelo Regis (que, até onde se sabe, podem ter sido criados pelos humanos) na região de Sinnoh.
                    E muitas das cavernas existentes dentro do Mundo Pokémon foram uma obra dos Pokémon do tipo
                    terrestre. Um bom exemplo é a caverna dos Digletts, que fica na região de Kanto.</div>
                    
                    <br><br>
                    <div><strong class="sub-titulo">A cultura humana</strong></div>
                    <br>
                    <div class="txt4">Sim, a sociedade humana do Mundo Pokémon teve de aprender a coexistir com os poderosos monstrinhos.
                    Um foco importante desta sociedade é a caça e o treinamento dos Pokémon para duelos e competições, mas sabemos que vai
                    muito além disso.

                    Por exemplo, os monstros do tipo elétrico ajudam a abastecer casas e prédios com energia elétrica;
                    os que voam levam pessoas de um lado para outro (mesmo com a existência de carros, barcos e aviões), alguns ajudam em
                    construções e outros são fundamentais para manter alguns ecossistemas.

                    Também é importante lembrar que em algumas culturas de determinadas regiões, alguns Pokémon são
                    venerados pela população. Em Johto, na cidade de Ecruteak, existiam as Torres Tin e Brass, onde viviam os lendários
                    Lugia e Ho-oh. Mas quando a segunda foi destruída em um incêndio, eles deixaram o local.

                    Três monstrinhos morreram nessa tragédia, mas eles foram revividos por Ho-oh e se tornaram Raikou,
                    Entei e Suicune.

                    Além disso, outro ponto que afeta a cultura humana é que existem evidências de vida pós-morte no
                    Mundo Pokémon. Não apenas por conta da existência dos monstrinhos do tipo fantasma, mas todos os espíritos que já
                    apareceram nos games da franquia, como é o caso do da mãe do Pokémon Marowak na cidade de Lavender.

                    No entanto, não sabemos se esses espíritos são reais ou uma mera brincadeira dos Pokémon fantasma
                    para assustar os humanos.

                    E, claro, não podemos nos esquecer que a própria humanidade acabou criando alguns monstinhos. Esse é
                    o caso de Grimer e Muk, produtos de poluição, por exemplo.</div>
                    
                </p>
                <img class="imagem" src="<?php echo INCLUDE_PATH; ?>assets/img/Ash e amigos.jpg" alt="Ash com seu grupo">
            </div>
        </div>
    </article>
</section>


    <div class="clear"></div>
    <!--clear float-->
    </div>
    <!--center-->
<!--Extras-->