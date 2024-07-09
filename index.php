<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="app/assets/styles/style.css">
        <link rel="icon" href="app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Apresentação</title>
    </head>

    <body class="Y-theme">
        <?php include_once __DIR__.'/app/includes/headerLanding.php'; ?>

        <main class="La-landing">
            <img src="app/assets/imagens/figuras/cells_standart_first_yellow.png" class="backCells">
            
            <section class="La-landingSections">
                <h1 class="La-quote">Mães ajudando mães a cuidar da vida materna</h1>

                <article class="La-articleConectaMaes">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-amigos-90.png" alt="" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    
                    <p>O <span class="La-focus">ConectaMães</span> é uma plataforma online onde mães podem se conectar, compartilhar experiências e oferecer apoio mútuo por meio de postagens e comentários. O objetivo é criar uma comunidade virtual inclusiva e solidária, proporcionando um espaço seguro para as mães compartilharem suas histórias e buscarem conselhos.</p>
                    <img src="app/assets/imagens/figuras/mom_boy.png" class="La-momBoy La-momImageRight">
                </article>

                <article class="La-Sharing">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-pessoas-trabalhando-juntas-90.png" alt="" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <img src="app/assets/imagens/figuras/mom_style.png" class="La-momStyle La-momImageLeft">
                    <p><span class="La-focus">Compartilhe</span> experiências na seção de <span class="La-focus">Relatos</span> para criar sua rede de apoio virtual e contribuir para a comunidade de mães. A plataforma oferece um espaço acolhedor para compartilhar, oferecer conselhos e encontrar conforto nas histórias compartilhadas. A conexão e interação com essa rede promovem um senso de comunidade solidária.</p> 
                </article>

                <article class="La-articleFollowing">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-adicionar-grupo-de-usuários-mulher-homem-90.png" alt="Icone Adicionar Grupo de Usuarios Mulher Homem azul" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <p>Ao <span class="La-focus">seguir</span> outros usuários, você amplia sua rede de apoio virtual e cria novas conexões. Interagindo, você fortalece esses laços, compartilha experiências e recebe suporte mútuo, contribuindo para uma comunidade mais inclusiva e solidária.</p> 
                    <img src="app/assets/imagens/figuras/mom_group.png" class="La-momGroup La-momImageRight">
                </article>

                <article class="La-articleHelping">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-confiança-90.png" alt="Icone Confiança azul" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <p>Na seção de <span class="La-focus">Pedidos</span>, você pode solicitar e oferecer apoio às outras mães. É um espaço para compartilhar necessidades, experiências e colaborar mutuamente. Participando dessa seção, você busca orientação e suporte, ao mesmo tempo em que contribui com seu conhecimento e solidariedade para ajudar outras mães.</p>
                </article>

                <article class="La-articleRating">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-estrela-90.png" alt="Icone de Estrela rosa" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <p>Avalie os <span class="La-focus">Relatos</span> e <span class="La-focus">Pedidos</span> para identificar conteúdos relevantes e contribuir para a comunidade. Sua participação é essencial para promover interações significativas e oferecer suporte mútuo entre os membros.</p>
                    <img src="app/assets/imagens/figuras/mom_opinion.png" class="La-momOpinion La-momImageRight">
                </article>
            </section>

            <section class="La-landingSections">
                <article class="La-createAccountSign">
                    <p>Seja parte desta comunidade, conecte-se com outras mães!</p>
                    <a href="register.php" class="La-createAccountButton">Crie sua conta</a>
                </article>  
            </section>

            <section class="La-landingSections" id="La-articleEquip">
                <article class="La-articleEquip">
                    <div class="La-articleHighlight">
                        <span class="La-articleBar La-focus"></span>
                        <h2>Equipe</h2>
                    </div>

                    <div class="La-equipContainer">
                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img src="app/assets/imagens/fotos/Image-livia.png" alt="Foto da Lívia Braga">
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Lívia</p>
                                <p class="La-memberFamilyName"> Braga</p>
                                <p class="La-memberFunction"> Desenvolvedora </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img src="app/assets/imagens/fotos/Image-nath.png" alt="Foto da Nathália Lessa">
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Nathália</p>
                                <p class="La-memberFamilyName"> Lessa</p>
                                <p class="La-memberFunction"> Desenvolvedora </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img src="app/assets/imagens/fotos/Image-renan.png" alt="Foto o Renan Moura">
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Renan</p>
                                <p class="La-memberFamilyName"> Moura</p>
                                <p class="La-memberFunction"> Desenvolvedor </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img src="app/assets/imagens/fotos/Image-luis.png" alt="Foto do Luís Mendes">
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Luís</p>
                                <p class="La-memberFamilyName"> Mendes</p>
                                <p class="La-memberFunction"> Orientador </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img src="app/assets/imagens/fotos/Image-tati.png" alt="Foto da Tatiana Azevedo">
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Tatiana</p>
                                <p class="La-memberFamilyName"> Azevedo</p>
                                <p class="La-memberFunction"> Coorientadora </p>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </main>
        
        <?php 
            include_once 'app/includes/footer.php';
            include_once 'app/includes/modais.php';
        ?>

        <script src="app/assets/js/system.js"></script>
    </body>
</html>
