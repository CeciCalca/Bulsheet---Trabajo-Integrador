<?php
include_once("controladores/funciones.php");
if ($_POST){
  $errores=validar($_POST,"registro");
  if(count($errores)==0){
    $avatar = armarAvatar($_FILES);
    $registro = armarRegistro($_POST,$avatar);
    guardar($registro);
    header("location:#login");
    exit;
  }
}

if($_POST){
  
  $errores= validar($_POST,"login");
  if(count($errores)==0){
    $usuario = buscarEmail($_POST["email"]);
    if($usuario == null){
      $errores["email"]="Usuario no existe";
    }else{
      if(password_verify($_POST["password"],$usuario["password"])===false){
        $errores["password"]="Error en los datos verifique";
      }else{
        seteoUsuario($usuario,$_POST);
        if(validarUsuario()){
          header("location: perfil.php");
          exit;
        }else{
          header("location: #btn-abrir-popup");
          exit;
        }
      }      
    }    
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Playball" rel="stylesheet">
  <link rel="stylesheet" href="css/master.css">
  <title>BullSheet</title>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png">
</head>
<body>

<!--Header y NavBar-->
  <header>
    <nav id="nav" class="navbar navbar-expand-lg navbar-dark _bgdegree">
      <a class="navbar-brand _logo" href="#">BullSheet</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-md-auto">
          <li class="nav-item active">
            <a class="nav-link " href="#home">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#faq">PREGUNTAS FRECUENTES</a>
          </li>
          <li class="nav-item ">
            <a  id="btn-abrir-popup"class="nav-link btn-abrir-popup" href="#reg">REGISTRARSE</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#login">LOGIN</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid p-0">
      <div class="jumbotron jumbotron-fluid _bghome m-0">
      <div class="container _jumbotext">
        <h1 class="display-4 _jumbotitle">Bullsheet Fake News</h1>
        <p class="lead _jumbop">Pongamos las noticias sobre la mesa</p>
      </div>
    </div>
    </div>

  </header>
  <!--Termina el Header y NavBar-->

  <!--Sección de presentación-->

  <div class="container-fluid p-0">
    <section class="_seccion-titulo">
      <article class="d-none d-md-block col-md-6 _articulo-titulo-imagen">
        <div class=" _contenedorImagen">
          <img src="img/img2.jpg" alt="imagen" class="_imagenTitulo">
        </div>
      </article>
      <article class="col-12 col-md-6 _articulo-titulo-texto">
        <h2>Bullsheet</h2>
        <p class="_textoArticulo">Somos una comunidad para opinar sobre la calidad de las noticias.<br> Calificamos la información que circula a partir de criterios que ayudan a darnos cuenta si estamos frente a una fake news o no. Favorecemos el periodismo de calidad y denunciamos las malas prácticas que contribuyen con la desinformación. </p>
      </article>
    </section>
  </div>

<!--Termina la Sección de presentación-->

<!--Sección de LogIn-->

  <section id="login" class="_login">
    <div class="_contenedor-login" id="_contenedor-login">
    <?php
      if(isset($errores)):?>
        <ul class="alert alert-danger">
          <?php
          foreach ($errores as $key => $value) :?>
            <li> <?=$value;?> </li>
            <?php endforeach;?>
        </ul>        
      <?php endif;?>

      <h3>Login</h3>
      <form action="" method="POST">
        <div class="contenedor-inputs-login">
          <input name="email" type="text" id="email"   value="<?=isset($errores["email"])? "":inputUsuario("email") ;?>" placeholder="Correo">
          <input name="password" type="password" id="password"  value="" placeholder="Contraseña">
        </div>
        <div class="contenedor-pass">
          <div class="recordar">
          <input name="recordar-pass" type="checkbox" id="recordarme" value="recordar-pass">
          <label for="recordarme">Recordarme</label>
         </div>
          <a href="">Olvide mi Contraseña</a>
        </div>
        <br>
        <input type="submit" name="login" class="btn-submit-login" value="Login">
        <p>Si no tenés cuenta registrate <a id="abrir-popup"class="linkpopup abrir-Popup" href="#reg"> Acá!</a></p>
      </form>
    </div>
  </section>

  <!--Termina la Sección de LogIn-->

    <!--Sección previa al FAQs-->

    <div class="container-fluid p-0">
      <section class="_seccion-titulo" id="faq">
        <article class="col-12 col-lg-6 _articulo-titulo-texto">
          <h2>Preguntas frecuentes</h2>
          <p class="_textoArticulo">Para que te saques todas las dudas. </p>
        </article>

        <article class="d-none d-lg-block col-md-6 _articulo-titulo-imagen">
          <div class=" _contenedorImagen">
            <img src="img/img3.jpg" alt="imagen" class="_imagenTitulo">
          </div>
        </article>

      </section>
    </div>

  <!--Termina la Sección previa al FAQs-->

    <!--Seccion de FAQs-->

<section class="_seccion-FAQS">
  <div class="container">
  	<div class="row">
  		<div class="col-lg-12">

  			<div class="accordion" id="accordionExample">

          <div class="card">
  					<div class="card-header" id="headingOne">
  						<h2 class="clearfix mb-0">
  							<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-chevron-circle-down"></i> ¿De que se trata BullSheet?</a>
  						</h2>
  					</div>
  					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
  						<div class="card-body">Calificamos la información que circula a partir de criterios que ayudan a darnos cuenta si estamos frente a una fake news o no. Favorecemos el periodismo de calidad y denunciamos las malas prácticas que contribuyen con la desinformación. .</div>
  					</div>
  				</div>

  				<div class="card">
  					<div class="card-header" id="headingTwo">
  						<h2 class="mb-0">
  							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-chevron-circle-down"></i> ¿Cómo funciona?</a>
  						</h2>
  					</div>
  					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
  						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
  					</div>
  				</div>

  				<div class="card">
  					<div class="card-header" id="headingThree">
  						<h2 class="mb-0">
  							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-chevron-circle-down"></i> ¿Para qué tengo que registrarme? ¿Como lo hago?</a>
  						</h2>
  					</div>
  					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
  						<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum.</div>
  					</div>
  				</div>

  				<div class="card">
  					<div class="card-header" id="headingFour">
  						<h2 class="mb-0">
  							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-chevron-circle-down"></i> Ya me registré. ¿Y ahora?</a>
  						</h2>
  					</div>
  					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
  						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
  					</div>
  				</div>

  				<div class="card">
  					<div class="card-header" id="headingFive">
  						<h2 class="mb-0">
  							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><i class="fa fa-chevron-circle-down"></i> Quiero colaborar con el proyecto. ¿Como hago?</a>
  						</h2>
  					</div>
  					<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
  						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
  					</div>
  				</div>

          <div class="card">
  					<div class="card-header" id="headingSix">
  						<h2 class="mb-0">
  							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><i class="fa fa-chevron-circle-down"></i> Quiero colaborar con noticias. ¿Como hago?</a>
  						</h2>
  					</div>
  					<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
  						<div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
  					</div>
  				</div>

          <div class="card">
            <div class="card-header" id="headingSeven">
              <h2 class="mb-0">
                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"><i class="fa fa-chevron-circle-down"></i> Quiero colaborar con noticias. ¿Como hago?</a>
              </h2>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
              <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingEight">
              <h2 class="mb-0">
                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"><i class="fa fa-chevron-circle-down"></i> Quiero colaborar con el proyecto. ¿Como hago?</a>
              </h2>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
              <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</div>
            </div>
          </div>

  			</div>
  		</div>
  	</div>
  </div>

</section>
<!--Termina la Sección de FAQs-->

<a href="#nav" class="gotop"><span><i class="fas fa-angle-double-up"></i></span></a>

<!--Footer-->

<footer class="page-footer  pt-4">
  <div class="container-fluid text-center text-md-center">
    <div class="row">
      <div class="col-md-6 mt-md-0 mt-3">
        <h5 class="pie2">BullSheet</h5>
        <p>todos los derechos reservados</p>
      </div>
      <div class="col-md-3 mb-md-0 mb-3">
          <ul class="list-styled text-white text-md-left">
            <li>
              <a href="#home">Home</a>
            </li>
            <li>
              <a href="#faq">Preguntas Frecuentes</a>
            </li>
            <li>
              <a href="#login">Login</a>
            </li>
            <li>
              <a id="abrir-popup-footer" href="#reg">Registrarse</a>
            </li>
          </ul>

        </div>
        <div class="col-md-3 mb-md-0 mb-3">
          <h5 class="pie3"><a href="mailto: bullsheet@gmail.com ">bullsheet@gmail.com</a></h5>
          <ul class="list-unstyled">
            <li>
              <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
              <a href="https://twitter.com"><i class="fab fa-twitter-square"></i></a>
            </li>
          </ul>
        </div>
    </div>
  </div>
</footer>

<!--Termina el Footer-->



  <!--Sección del formulario de registro-->
  <div class="overlay" id="overlay">
    <div class="popup" id="popup">
    <?php
      if(isset($errores)):?>
        <ul class="alert alert-danger">
          <?php
          foreach ($errores as $key => $value) :?>
            <li> <?=$value;?> </li>
            <?php endforeach;?>
        </ul>        
      <?php endif;?>

      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times-circle"></i></a>
      <h3>Registrate!</h3>
      <h4>Y forma parte de nuestra comunidad!</h4>
      <form action="" method="POST" enctype= "multipart/form-data" >
        <div class="contenedor-inputs">
          <input name="nombre" type="text" id="nombre"  value="<?=(isset($errores["nombre"]) )? "" : inputUsuario("nombre");?>" placeholder="Nombre">
          <input name="apellido" type="text" id="apellido"  value="<?=(isset($errores["apellido"]) )? "" : inputUsuario("apellido");?>" placeholder="Apellido">
          <input name="email" type="text" id="email" value="<?=isset($errores["email"])? "":inputUsuario("email") ;?>" placeholder="Correo">
          <input name="password" type="password" id="password" value="" placeholder="Contraseña">
          <input name="repassword" type="password" id="repassword" value="" placeholder="Confirmar Contraseña">
          <input  type="file" name="avatar" value=""/>
        </div>
        <input type="submit" name="registro" class="btn-submit" value="Enviar">
      </form>
    </div>
  </div>
<!--Termina la Sección del formulario de registro-->




</body>
<script src="popup.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
