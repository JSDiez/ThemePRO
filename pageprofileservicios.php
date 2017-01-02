<?php /* Template Name: Servicios Template Profile */

  get_header('pagedefault');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

   <div class="entry-content">
      <div class="header-page header-servicios">
         <h1> <?php echo the_title();?></h1>
      </div>
      <div class="post-wrap">
         <div class="bgcolorf4">
            <div class="container servicios">
               <div class="row">
                  <div class="col-md-8">
                     <h1 class="cprofile">Introducción</h1>
                     <h3>Texto entradilla que resulta lo que va contener la página, conclusión.</h3>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti dolorem ducimus, saepe aliquam, totam impedit veniam officiis est et aliquid in voluptas necessitatibus nulla non. Quibusdam reprehenderit, mollitia consequuntur totam.</p>

                  </div>
                  <div class="col-md-4">
                     <img class="img-servicios" src="<?= get_bloginfo('template_directory'); ?>/images/ico-40.png">
                  </div>
               </div>
            </div>
         </div>
         <div class="separator my-arrow-servicios ">
            <div class="home-container container">
               <h1 class="text-center negative">Big Data</h1>
               <div class="home-section-content">
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div class="container servicios">
            <div class="row">
               <div class="col-md-4 text-center">
                  <img class="img-servicios" src="<?= get_bloginfo('template_directory'); ?>/images/servicios/bigdata.png" alt="">
               </div>
                <div class="testimonial-servicios block clearfix col-md-8">
                  <div class="description">
                     La información es el petróleo del siglo XXI, y la analítica Big Data es el motor.
                  </div>
                  <div class="author">
                     Peter Sondergaard, Gartner Research
                  </div>
               </div>
            </div>
         </div>
         <div class="bgcolorf4">
            <div class="container servicios">
               <div class="row">
                  <div class="col-md-6 col-xs-6">
                     <div class="col-md-4 col-img"><img src="<?= get_bloginfo('template_directory'); ?>/images/ico-47.png" /></div>
                     <div class="col-md-8">
                        <h3>Big Data Open Source</h3>
                        <h5 class="servicios-apartado-entradilla">Hadoop, Spark, Storm, Kafka, Flume, Impala, Pig, Hive... en instalación local o en cloud.</h5>
                        <p>El ecosistema open source para análisis de datos es potente y flexible. Las arquitecturas big data basadas en open source permiten análisis de datos distribuido a cualquier escala.</p>
                     </div>
                  </div>
                  <div class="col-md-6 col-xs-6">
                     <div class="col-md-4 col-img"><img src="<?= get_bloginfo('template_directory'); ?>/images/ico-49.png" /></div>
                     <div class="col-md-8">
                        <h3>NoSQL</h3>
                        <h5 class="servicios-apartado-entradilla">Sistemas de almacenamiento.</h5>
                        <p>Las bases de datos NoSQL como MongoDB nos permiten gran agilidad durante el desarrollo y una mayor flexibilidad y potencia de explotación que las bases de datos tradicionales.</p>
                     </div>
                  </div>
               </div>
               <div class="row nomargintop">
                  <div class="col-md-6 col-xs-6">
                     <div class="col-md-4 col-img"><img src="<?= get_bloginfo('template_directory'); ?>/images/ico-48.png" /></div>
                     <div class="col-md-8">
                        <h3>Data-Driven Business Strategy</h3>
                        <h5 class="servicios-apartado-entradilla">Estrategia de datos, data exploration.</h5>
                        <p>Como paso inicial hacia convertirse en una compañía con orientación a los datos, es conveniente definir una estrategia alrededor de todo el ciclo de vida de los datos y realizar una exploración inicial para generar ideas alrededor de estos datos.</p>
                     </div>
                  </div>
                  <div class="col-md-6 col-xs-6">
                     <div class="col-md-4 col-img"><img src="<?= get_bloginfo('template_directory'); ?>/images/ico-50.png" /></div>
                     <div class="col-md-8">
                        <h3>Logtrust</h3>
                        <h5 class="servicios-apartado-entradilla">Análisis en tiempo real</h5>
                        <p>Logtrust nos permite dar soluciones para análisis de tiempo real bajo un modelo ágil y flexible, desde la ingesta de datos hasta la visualización del análisis y la toma de decisiones.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="separator my-arrow-servicios ">
            <div class="home-container container">
               <h1 class="text-center negative">Cloud Computing</h1>
               <div class="home-section-content">
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div class="container servicios">
            <div class="row">
               <div class="col-md-8">
                  <h1 class="cprofile">Lorem Ipsum</h1>
                  <h3>Texto entradilla que resulta lo que va contener la página, conclusión.</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti dolorem ducimus, saepe aliquam, totam impedit veniam officiis est et aliquid in voluptas necessitatibus nulla non. Quibusdam reprehenderit, mollitia consequuntur totam.</p>

               </div>
               <div class="col-md-4">
                  <img class="img-servicios" src="<?= get_bloginfo('template_directory'); ?>/images/servicios/default.jpg">
               </div>
            </div>
         </div>
         <div class="bgcolorf4">
            <div class="container">
               <div class="row">
                  <div class="col-md-4">
                     <div class="col-md-12">
                        <img class="img-servicios" src="http://placeimg.com/400/200/tech" />
                        <h3>LaaS</h3>
                        <label>Infraestructura como servicio</label>
                        <p class="service-separator">La nube nos ofrece una capacidad de proceso y almacenamiento que hata ahora estaba sólo al alcance de pocos.</p>
                        <p>Hoy, diseñamos una infraestructura y sólo con unos clicks, conseguimos materializarla y ponerla en funcionamiento.</p>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="col-md-12">
                        <img class="img-servicios" src="http://placeimg.com/400/201/tech" />
                        <h3>PaaS</h3>
                        <label>Plataformas tecnológicas ágiles</label>
                        <p class="service-separator">Gracias a los productos PaaS (Platform as a service) podemos centrarnos en lo que hacemos bien: escribir código de alta calidad y ponerlo en marcha.</p>
                        <p>Empezamos subiendo código al repositorio, creamos un entorno escalable y con alta disponibilidad en cloud, y ponemos la aplicación a correr en minutos.</p>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="col-md-12">
                        <img class="img-servicios" src="http://placeimg.com/401/200/tech" />
                        <h3>SaaS</h3>
                        <label>Soluciones software flexibles</label>
                        <p class="service-separator">No tratamos de reinventar la rueda. En ocasiones es mejor utilizar un servicio (Software as a service) que agilice nuestro desarrollo.</p>
                        <p>Conectamos servicios y construimos aplicaciones a partir de las mejores piezas.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="separator my-arrow-servicios ">
            <div class="home-container container">
               <h1 class="text-center negative">User experience</h1>
               <div class="home-section-content">
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div class="container servicios">
            <div class="row">
               <div class="col-md-8">
                  <h1 class="cprofile">Diseño centrado en el usuario</h1>
                  <h3>Una experiencia de usuario efectiva es la que consigue una interacción agradable, intuitiva y usable, sencilla pero completa.</h3>
                  <p>La perfección no consiste en poner, sino en quitar hasta dejar sólo lo imprescindible. Uno de los principios Lean es que lo que no aporta ningún valor al producto, sobra. El diseño de UX se alinea con los objetivos de la empresa para aportar el máximo valor en el menor tiempo posible.</p>
               </div>
               <div class="col-md-4">
                  <img class="img-servicios" src="http://localhost/web-profile/wp-content/themes/onetone/images/servicios/default.jpg">
               </div>
            </div>
         </div>
         <div class="bgcolorf4">
            <div class="container servicios">
               <div class="row">
                  <div class="col-md-7">
                     <div class="col-md-2">
                        <img src="http://placeimg.com/200/300/tech" />
                     </div>
                     <div class="col-md-10">
                        <h3>Patrones de diseño</h3>
                        <h5>Se facilita el uso siguiendo patrones universales y convenciones culturales.</h5>
                        <p>Se usan affordances para reducir la carga cognitiva y se establecen estrategias para influir en la percepción del usuario mediante la manipulación de los patrones de exploración, el flujo y la jerarquía visual.</p>
                     </div>
                     <div class="col-md-2">
                        <img src="http://placeimg.com/201/300/tech" />
                     </div>
                     <div class="col-md-10">
                        <h3>Tests de usuario</h3>
                        <h5>Si el producto se adecua al usuario final aumenta su probabilidad de éxito.</h5>
                        <p>A través de encuestas, entrevistas, focus group como con test A/B y tests de usabilidad. Los tests se realizan en las fases de conceptualización y durante el desarrollo, ya sea presenciales o a distáncia, cualitativos o cuantitativos.</p>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="col-md-3 col-img">
                        <img src="http://placeimg.com/200/301/tech" />
                     </div>
                     <div class="col-md-9">
                        <h3>Prototipado</h3>
                        <h5>Mediante la co-creación el quipo suma, a la vez que se consigue empatizar.</h5>
                        <p>Con la información extraída del análisis de requisitos el equipo puede realizar diferentes prototipos, variando cúales según fase y necesidades del proyecto.</p>
                        <ul class="list-unordered">
                           <li>Personas</li>
                           <li>Escenarios</li>
                           <li>Flujos de navegación</li>
                           <li>Storyboards</li>
                           <li>Paper prototypes</li>
                           <li>Whiteboards</li>
                           <li>Wireframes de baja resolución</li>
                           <li>Wireframes de alta resolución</li>
                           <li>Prototipos interactivos estáticos</li>
                           <li>Prototipos interactivos dinámicos</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</article>



<?php




 get_footer(); ?>

