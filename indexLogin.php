<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">


    <style>
 body, html {
  height: 100%;
  margin: 0;
}

.bg-image {
  background-image: url('img/arq2.jpg'); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
  height: 100%;
  width: 100%;
  overflow: hidden;
  filter: blur(5px);
  -webkit-filter: blur(5px);
}
  

.bg-blur {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-image: url('img/arq1.jpg'); /* Cambia esto por la ruta a tu imagen */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px);
        -webkit-filter: blur(5px);
    }

    .content-container {
        position: relative;
        background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con un poco de transparencia */
        overflow: auto;
        height: 100%;
    }

</style>

</head>
<body>
  
<div class="bg-blur"></div>

<div class="content-container">

<form action="Model/MLogin.php" method="post">
<section class="vh-100" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Ingresar</h3>

            <div class="form-outline mb-4">
              <label class="form-label" name="email" for="typeEmailX-2">Cédula</label>
              <input type="cedula" id="typeEmailX-2" name="cedula" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" name="contraseña" for="typePasswordX-2">Password</label>
              <input type="password" id="typePasswordX-2" name="contraseña" class="form-control form-control-lg" />
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Ingresar</button>

            <hr class="my-4">



          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</div>

</body>
</html>