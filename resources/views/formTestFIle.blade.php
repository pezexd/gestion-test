<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>


<div class="container-fluid">
    <div class="card">
        <div class="card-header">
          formulario
        </div>
        <div class="card-body">
            <form action="{{route('format-image')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="my-input">FOTOGRAFÍA DEL LUGAR</label>
                <input id="my-input" class="form-control" type="file" name="file">
            </div>

            <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>

    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


  </body>
</html>
