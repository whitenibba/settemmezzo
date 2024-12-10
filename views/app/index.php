
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    
    
    <script src="https://kit.fontawesome.com/7c740873a0.js" crossorigin="anonymous"></script>
    <script>
      //DA CAMBIARE A DEPLOY
      //const hostAddr = "<?php //echo "http://".gethostbyname(trim(`hostname`)); ?>";
      const hostAddr = "http://192.168.1.12";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="views/app/css/style.css">
  </head>
  <body>
  <a href="#" id="go-top" onclick="toggleFullscreen()" style="position: fixed;bottom: 1em;right: 0.5em;text-decoration: none;font-size: 40px"> <i class="fa-solid fa-expand"></i> </a>

    <div class="overall loginModal" id="loginModal">
      <div class="card text-center">
        <div class="card-header">
          <i class="fa-solid fa-user"></i> Esegui l'accesso
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-auto">
              <label for="inputUser" class="visually-hidden">Username</label>
              <input type="text" class="form-control" id="inputUser" name="user" placeholder="Username">
            </div>
            <div class="col-auto">
              <label for="inputPassword" class="visually-hidden">Password</label>
              <input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Password">
            </div>
            <div class="col-auto">
              <button class="btn btn-primary mb-3" onclick="sendLoginForm()">Invia</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <nav class="navbar bg-body-tertiary">
    
      <div class="container-fluid">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-plus"></i>Aggiungi</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-barcode"></i>Scansiona</a></li>
            <li><a class="dropdown-item" href="#"></li><i class="fa-solid fa-icons"></i>Categorie</li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
          </ul>
        </div>
        

        <div class="d-flex" role="search">
          <input class="form-control me-2" id="searchInput" type="search" placeholder="Cerca..." aria-label="Search">
          <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fa-solid fa-sliders"></i></button>
          
        </div>
        
        
      </div>
      
    </nav>
    <div class="pagination-bar">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
        </div>
      </div>
    </div>
    
    <div class="body-container">
      <div class="row row-cols-auto">
        
          
      </div>
      <div id="no-found-alert">Nessun prodotto...</div>
      

      <!-- Modals -->
      <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-location-dot"></i>Posizione</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">FILTRA RISULTATI</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <h2>Categoria</h2>

            <select id="categorySelect"class="form-select" aria-label="Default select example">
              <option value="-1"selected>Tutti</option>
              <option value="0">Senza Categoria</option>
            <?php
            if(isset($_SESSION["id"])&&$_SESSION['id']>0){
              include(dirname(dirname(__DIR__)).'\\lib\\db.php');
              $query = "SELECT * FROM categories_".$_SESSION['id']." ORDER BY id";
              $res = mysqli_query($conn,$query);
              while($row=$res->fetch_assoc()){
                echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
              }
              $conn->close();
            }
              

            ?>
            </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
              <button type="button" id="filterButton" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa-solid fa-check"></i> Filtra</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Button trigger modal -->

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica quantità</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <center>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                  <button id="decrease-quantity-button" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-minus"></i></button>
                  <span id="qty-label-modal"></span>        
                  <button id="increase-quantity-button" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></button>
                </div>
                <div id="qty-btn-group"style="display:flex;justify-content:space-around;">
                  <div class="input-group m-2" style="min-width: 150px;">
                    <button id="aggiungiButton" class="btn btn-outline-primary" type="button">Aggiungi</button>
                    <input id="aggiungiInput" type="number" min="0" class="form-control" placeholder="Num. pezzi" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  </div>
                  <div class="input-group m-2" style="min-width: 150px;">
                    <button id="rimuoviButton" class="btn btn-outline-primary" type="button">Rimuovi</button>
                    <input id="rimuoviInput" type="number" min="0" class="form-control" placeholder="Num. pezzi" aria-label="Example text with button addon" aria-describedby="button-addon1">
                  </div>
                </div>
              </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    

    
  </body>
  
  <script src="views/app/js/apiConnector.js"></script>
    
  <script src="views/app/js/pageAnimations.js"></script>
  </html>


