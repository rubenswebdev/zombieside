<html>
    <head>
        <title>ZombieSide - TCC</title>
        <!-- Bootstrap -->
        <link href="https://bootswatch.com/cosmo/bootstrap.css" rel="stylesheet">
        <link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
           <nav class="navbar navbar-default">
              <div class="container">
                <div class="navbar-header">
                  <a class="navbar-brand" href="#">
                    ZombieSide
                  </a>
                </div>
                <form class="navbar-form navbar-right" role="search">
                    <a href="" class="btn btn-danger">Login</a>
                    <a href="" class="btn btn-danger">Cadastro</a>
                </form>
              </div>
            </nav>

            <div class="container">

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <form class="form-horizontal">
                          <div class="form-group">
                            <div class="col-md-11">
                              <input type="email" class="form-control" placeholder="Digite um Nome">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default pull-right">Procurar</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked">
                            <li role="presentation" class="active"><a href="#">Início</a></li>
                            <li role="presentation"><a href="#">Playstation 3</a></li>
                            <li role="presentation"><a href="#">Playstation 4</a></li>
                            <li role="presentation"><a href="#">XboX</a></li>
                            <li role="presentation"><a href="#">PC</a></li>
                            <li role="presentation"><a href="#">Fan Arts</a></li>
                        </ul>       
                    </div>
                    <div class="col-md-9">
                        <div id="carousel" class="carousel slide" data-ride="carousel">
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                            <li data-target="#carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel" data-slide-to="1"></li>
                            <li data-target="#carousel" data-slide-to="2"></li>
                          </ol>

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">
                            <div class="item active">
                              <img src="http://image.jeuxvideo.com/downloads/fonds-ecrans-wallpaper/00010962/crysis-2-28181-wp.jpg" alt="...">
                              <div class="carousel-caption">
                                ...
                              </div>
                            </div>
                            <div class="item">
                              <img src="http://torrentsgames.org/wp-content/uploads/2013/04/Crysis-PS3.jpg" alt="...">
                              <div class="carousel-caption">
                                ...
                              </div>
                            </div>
                            <div class="item">
                              <img src="http://media1.gameinformer.com/imagefeed/screenshots/Crysis3/02_fields_1_jungle.jpg" alt="...">
                              <div class="carousel-caption">
                                ...
                              </div>
                            </div>
                            ...
                          </div>

                          <!-- Controls -->
                          <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                    </div>
                </div> 
            </div>
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>