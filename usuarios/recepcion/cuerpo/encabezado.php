
    <header class="row">
      <div class="container-fluid ">
        <nav class="navbar navbar-static-top navbar-inverse">
          <div class="  navbar-right">
            <ul class="navbar-nav nav">
              <li ><a href="php/editaru.php" class="navbar-brand"><h6>Hola <?php echo $reg->nom_usuario;?></h6></a></li>
              <li>
                <form action='../../index.php' method='POST'>
                  <a href="#" class="navbar-brand">
                      <center>
                        <button id='salir' name='salir' class="btn btn-link" value='1' >
                          <span class="glyphicon glyphicon-remove"></span> 
                        </button>
                      </center>
                  </a>
                </form>
              </li>
            </ul>
          </div>
          <center>
            <?php require($url_logo.'nombre.php'); ?>
          </center>
        </nav>
      </div>
    </header>