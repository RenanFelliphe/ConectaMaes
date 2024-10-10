
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
            <h1 class="La-quote">Mães ajudando mães a cuidar da vida materna</h1>

            <section class="La-landingSections">
                <img src="app/assets/imagens/figuras/cells_standart_first_yellow.png" class="backCells">

                <article class="La-articleConectaMaes">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-amigos-90.png" alt="" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <div class = "La-seccaoDeTextoDireita">
                        <h1 class="La-tituloSeccao">Todos por uma maternidade mais fácil!</h1>
                        <h2 class ="La-subtituloSeccao"><span class="La-focus">Busque ajuda de semelhantes!</span></h2>
                        <p class = "La-paragrafo">O <span class="La-focus">
                        ConectaMães</span> permite  <span class="La-focus">oferecer e receber apoio</span></br>
                        de mães que já passaram por experiências</br>
                        semelhantes às suas.</p>
                    </div>
                    <img src="app/assets/imagens/figuras/maeLevantandoCrianca.png" class="La-maeLevantandoCrianca La-momImageRight">
                </article>

                <article class="La-Sharing">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-pessoas-trabalhando-juntas-90.png" alt="" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <img src="app/assets/imagens/figuras/maeConversando.png" class="La-momStyle La-momImageLeft">
                    <div class = "La-seccaoDeTextoEsquerda">
                    <h1 class="La-tituloSeccao">Uma  rede social colaborativa!</h1>
                        <h2 class ="La-subtituloSeccao"> <span class="La-focus">Crie uma rede de apoio virtual!</span></h2>
                        <p class = "La-paragrafo">A plataforma oferece um novo espaço para o</br>
                         compartilhamento, anônimo ou não, de <span class="La-focus"> Relatos</span>  e</br>
                         interação entre as mães. Um espaço para a formação
                         de uma nova <span class="La-focus">rede de apoio maternal</span> .  </p>
                    </div>
                </article>

                <article class="La-articleFollowing">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-adicionar-grupo-de-usuários-mulher-homem-90.png" alt="Icone Adicionar Grupo de Usuarios Mulher Homem azul" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <div class = "La-seccaoDeTextoDireita">
                        <h1 class="La-tituloSeccao">Conecte-se com outras mães! </h1>
                        <h2 class ="La-subtituloSeccao"><span class="La-focus">Compartilhe suas experiências!</span> </h2>
                        <p class = "La-paragrafo">Uma oportunidade para <span class="La-focus">relatar com outras mães os</span></br>
                         momentos mais felizes, tristes, engraçados e difíceis</br>
                         da sua vida como mãe.</p>
                    </div>
                    <img src="app/assets/imagens/figuras/maeCelular.png" class="La-maecelular La-momImageRight">
                </article>

                <article class="La-articleHelping">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-confiança-90.png" alt="Icone Confiança azul" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <div class = "La-seccaoDeTextoDireita">
                        <h1 class="La-tituloSeccao">Encontre ajuda anonimamente!</h1>
                        <h2 class ="La-subtituloSeccao"><span class="La-focus"> Ajude os outros sem se expor!</span></h2>
                        <p class = "La-paragrafo">No <span class="La-focus">ConectaMães</span> você consegue descrever as suas</br>
                         dificuldades e conseguir ajuda ou ajudar mesmo <span class="La-focus">sem</br> precisar se expor publicamente</span>. </p>
                    </div>
                    <img src="app/assets/imagens/figuras/maePresente.png" class="La-maePresente La-momImageRight">
                </article>

                <article class="La-articleRating">
                    <div class="La-articleHighlight">
                        <img src="app/assets/imagens/icons/icons8-estrela-90.png" alt="Icone de Estrela rosa" width="30px">
                        <span class="La-articleBar La-focus"></span>
                    </div>
                    <img src="app/assets/imagens/figuras/maeEstela.png" class="La-maeEstrela La-momImageLeft">
                    <div class = "La-seccaoDeTextoEsquerda">
                        <h1 class="La-tituloSeccao">Sua opinião é importante!</h1>
                        <h2 class ="La-subtituloSeccao"><span class="La-focus">Ajude a manter a comunidade ativa!</span></h2>
                        <p class = "La-paragrafo">Avalie e interaja com os <span class="La-focus">Relatos</span> e <span class="La-focus">Pedidos</span> e ajude na
                         identificação de conteúdos relevantes para a comunidade.</p>
                    </div>
                  </article>
            </section>

            <section class="La-landingSections">
                <article class="La-testSing">
                    <h1 class = "La-articleTitle"> Que tal fazer um teste?</h1>
                    <p>No <span class="La-focus">ConectaMães</span> você consegue experimentar o sistema sem criar uma conta!</p>
                    <a href="./public/registrar.php" class="La-landingButtons">Entre</a>
                </article>  
            </section>

            <section class="La-landingSections">
                <article class="La-frequentQuestions">
                    <h1 class = "La-articleTitle"> Perguntas Frequentes</h1>
                    <ul class="faqList">
                        <li class="La-faqQuestions">
                            <p>O que é o ConectaMães?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="La-faqAnswers">sadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfas</div>
                        </li>
                        <li class="La-faqQuestions">
                            <p>Mulheres grávidas também podem usar o site?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="La-faqAnswers">sadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfas</div>
                        </li>
                        <li class="La-faqQuestions">
                            <p>Homens ou pessoas sem filho também podem usar o site?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="La-faqAnswers">sadacscvdavfassadacscvdavfassadavdavfas</div>
                        </li>
                        <li class="La-faqQuestions">
                            <p>Que tipo de auxílios podem ser pedidos no site?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="La-faqAnswers">sadacscvdavfassadacscvdavfassadacsadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfasscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfas</div>
                        </li>
                        <li class="La-faqQuestions">
                            <p>Eu posso relatar algo sem precisar me expor?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="La-faqAnswers">sadacscvdavfassadacscvdavfassadacscvdavsadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfasfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfassadacscvdavfas</div>
                        </li>
                    </ul>
                </article>  
            </section>

            <section class="La-landingSections">
                <img class="La-contactSectionBackgroundImage" src="app/assets/imagens/figuras/icone.png" alt=" ">
                <article class="La-contactSection">
                    <h1 class = "La-articleTitle">Contato</h1>
                    <form class ="La-contactForm" method="POST">
                        <div class="La-contactInfos">
                            <div class="La-contactField">
                                <textarea class="La-contactDados" type="text" id="nomeContato" name="nomeContato" required></textarea>
                                <label class="La-contactfakePlaceHolder" for="nomeContato">Nome</label>
                            </div>
                            <div class="La-contactField">
                                <textarea class="La-contactDados" type="email" id="emailContato" name="emailContato" required></textarea>
                                <label class="La-contactfakePlaceHolder" for="emailContato">E-mail</label>
                            </div>
                        </div>

                        <div class="La-contactField fullField">
                            <textarea class="La-contactDados" type="text" id="assuntoContato" name="assuntoContato" required></textarea>
                            <label class="La-contactfakePlaceHolder" for="assuntoContato">Assunto</label>
                        </div>
                        
                        <div class="La-contactField fullField">
                            <textarea class="La-contactDados" id="mensagemContato" name="mensagemContato" required></textarea>
                            <label class="La-contactfakePlaceHolder" for="mensagemContato">Mensagem</label>
                        </div>
                        
                        <button type="submit" class="La-landingButtons" name="envioContato">Enviar</button>
                        <?php 
                            if(isset($_POST["envioContato"])){ 
                                require_once "app/services/helpers/mail.php";
                                sendEmail($mailServer);
                            }
                        ?>
                    </form>

                    <p class = "paragrafo">Você também pode nos contatar nas nossas <span class="La-focus">redes sociais oficiais!</span></p>
                    
                    <div class="La-cantactSectionIcon">
                        <a href="https://www.instagram.com/conectamaes2024?igsh=MXdnbW50bXNxNzdoMA==" target="_blank" class="La-cantactSectionIconLink">
                            <img src="app/assets/imagens/icons/icons8-instagram-grey.png" alt="img1" class="base">
                            <img src="app/assets/imagens/icons/instagram_pink_icon.png" alt="img2" class = "overlay">
                        </a>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=conectamaes2024@gmail.com" target="_blank" class="La-cantactSectionIconLink">
                            <img src="app/assets/imagens/icons/gmail_grey_icon.png" alt="img1" class="base">
                            <img src="app/assets/imagens/icons/icons8-envelope-pink.png" alt="img2" class="overlay">
                        </a>
                    </div>
                </article>  
            </section>

            <section class="La-landingSections">
                <article class="La-creatAccountSing">
                    <h1 class = "La-articleTitle"> NÃO PERCA ESSA CHANCE!</h1>
                    <p><span class="La-focus">Participe da nossa comunidade</span>, 
                    compartilhe suas experiências, conheça outras mães e encontre histórias 
                    semelhantes às suas. Facilite sua jornada materna ao se conectar com
                    uma <span class="La-focus">rede de apoio solidária</span>.</p>
                    <a href="./public/registrar.php" class="La-landingButtons">Criar conta</a>
                </article>  
            </section>

            <section class="La-landingSections">
                <article class="La-articleEquip">
                    <div class="La-articleHighlight">
                        <div class ="La-equipeSectionCollum">
                            <img class = "La-equipIcon" src = "app/assets/imagens/icons/people_icon.png" alt="">
                            <span class="La-articleBar La-focus"></span>
                        </div>
                        <h2 class="La-equipSectionTitle">Equipe</h2>
                    </div>
                    
                    <div class="La-equipContainer">
                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img class ="La-memberImageIcon" src="app/assets/imagens/fotos/image_livia_roundBorder.png" alt="Foto da Lívia Braga">
                                <div class = "La-memberSocialMidia">
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href="./notFound.php" target=_blank>
                                        <img  src = "app/assets/imagens/icons/lattes_icon.png" alt ="image 1">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.instagram.com/liviabrg/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/instagram_grey_icon.png" alt ="image 2">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.linkedin.com/in/livia-braga-0151a52b7/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/linkedIn_icon.png" alt ="image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Lívia</p>
                                <p class="La-memberFamilyName"> Braga</p>
                                <p class="La-memberFunction"> Desenvolvedora </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img class ="La-memberImageIcon" src="app/assets/imagens/fotos/image_nath_roundBorder.png" alt="Foto da Nathália Lessa">
                                <div class = "La-memberSocialMidia">
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "http://lattes.cnpq.br/1408213143619083" target=_blank>
                                        <img  src = "app/assets/imagens/icons/lattes_icon.png" alt ="image 1">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                    <a href = "https://www.instagram.com/mirror.nl2/" target=_blank>
                                    <img  src = "app/assets/imagens/icons/instagram_grey_icon.png" alt ="image 2">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.linkedin.com/in/nath%C3%A1lia-c-lessa-20878a236/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/linkedIn_icon.png" alt ="image 3">
                                        </a>
                                    </div>
                                </div>                           
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Nathália</p>
                                <p class="La-memberFamilyName"> Lessa</p>
                                <p class="La-memberFunction"> Desenvolvedora </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img class ="La-memberImageIcon" src="app/assets/imagens/fotos/image_renan_roundBorder.png" alt="Foto o Renan Moura">
                                <div class = "La-memberSocialMidia">
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "http://lattes.cnpq.br/1685057836344732" target=_blank>
                                        <img  src = "app/assets/imagens/icons/lattes_icon.png" alt ="image 1">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.instagram.com/renan_felliphe11/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/instagram_grey_icon.png" alt ="image 2">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.linkedin.com/in/renan-felliphe-34ab1126a/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/linkedIn_icon.png" alt ="image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Renan</p>
                                <p class="La-memberFamilyName"> Moura</p>
                                <p class="La-memberFunction"> Desenvolvedor </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img class ="La-memberImageIcon" src="app/assets/imagens/fotos/image_luis_roundBorder.png" alt="Foto do Luís Mendes">
                                <div class = "La-memberSocialMidia">
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "http://lattes.cnpq.br/6368472217617839" target=_blank>
                                        <img  src = "app/assets/imagens/icons/lattes_icon.png" alt ="image 1">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.instagram.com/laug_br/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/instagram_grey_icon.png" alt ="image 2">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.linkedin.com/in/luis-augusto-mendes-b010b7b4/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/linkedIn_icon.png" alt ="image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Luís</p>
                                <p class="La-memberFamilyName"> Mendes</p>
                                <p class="La-memberFunction"> Orientador </p>
                            </div>
                        </div>

                        <div class="La-equipMember">
                            <div class="La-memberImage">
                                <img class ="La-memberImageIcon" src="app/assets/imagens/fotos/image_tati_roundBorder.png" alt="Foto da Tatiana Azevedo">
                                <div class = "La-memberSocialMidia">
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "http://lattes.cnpq.br/6949976948195196" target=_blank>
                                        <img  src = "app/assets/imagens/icons/lattes_icon.png" alt ="image 1">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.instagram.com/tatianabazevedo/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/instagram_grey_icon.png" alt ="image 2">
                                        </a>
                                    </div>
                                    <div class = "La-memberSocialMidiaIcon">
                                        <a href = "https://www.linkedin.com/in/tatiana-barbosa-de-azevedo-55751331/" target=_blank>
                                        <img  src = "app/assets/imagens/icons/linkedIn_icon.png" alt ="image 3">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="La-memberInformation">
                                <p class="La-memberName"> Tatiana</p>
                                <p class="La-memberFamilyName"> Azevedo</p>
                                <p class="La-memberFunction"> Coorientadora </p>
                            </div>
                        </div>
                    </div>
                    <img src ="app/assets/imagens/figuras/cells_equipe.png" class ="La-equipCells">
                </article>
            </section>
        </main>
        
        <?php 
            include_once 'app/includes/footer.php';
            include_once 'app/includes/modais.php';
        ?>
    </body>

    <script>
        //FAQ Section

        document.querySelectorAll('.La-faqQuestions').forEach((question) => {
            question.addEventListener('click', () => {
                question.classList.toggle('active');
            });
        });

        //Contact Section

        document.querySelectorAll('.La-contactDados').forEach(textarea => {
            textarea.addEventListener('input', autoResize);
            autoResize.call(textarea);
        });

        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }

    </script>
</html>
