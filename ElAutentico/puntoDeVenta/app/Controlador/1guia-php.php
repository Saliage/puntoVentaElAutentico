<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tabla con Filas Colapsables</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Formato</th>
                    <th>Perecible</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <tr data-toggle="collapse" data-target="#detalles1" class="accordion-toggle">
                    <td>8</td>
                    <td>
                        <img src="" id="imagen8" width="40" height="40">
                    </td>
                    <td>
                        <span id="nombreSpan8">coca-cola</span>
                    </td>
                    <td>
                        <span id="stockSpan8">220</span>
                    </td>
                    <td>
                        <span id="categoriaSpan8">bebidas</span>
                    </td>
                    <td>
                        <span id="formatoSpan8">1 litro</span>
                    </td>
                    <td>
                        <span id="perecibleSpan8"><ion-icon name="checkmark-outline" role="img" class="md hydrated" aria-label="checkmark outline"></ion-icon></span>
                    </td>
                    <td>
                        <button class="btn btn-link" title="Desplegar">
                            abrir<ion-icon name="chevron-down-circle-outline" role="img" class="md hydrated" aria-label="chevron down circle outline"></ion-icon>
                        </button>
                    </td>
                </tr>

                <tr id="detalles1" class="collapse in">
                    <td colspan="7">
                        columna1
                    </td>
                </tr>
                <tr id="detalles1" class="collapse in">
                    <td colspan="7">
                        columna2
                    </td>
                </tr>

                <tr data-toggle="collapse" data-target="#detalles2" class="accordion-toggle">
                    <td>8</td>
                    <td>
                        <img src="" id="imagen8" width="40" height="40">
                    </td>
                    <td>
                        <span id="nombreSpan8">fanta</span>
                    </td>
                    <td>
                        <span id="stockSpan8">220</span>
                    </td>
                    <td>
                        <span id="categoriaSpan8">bebidas</span>
                    </td>
                    <td>
                        <span id="formatoSpan8">1 litro</span>
                    </td>
                    <td>
                        <span id="perecibleSpan8"><ion-icon name="checkmark-outline" role="img" class="md hydrated" aria-label="checkmark outline"></ion-icon></span>
                    </td>
                    <td>
                        <button class="btn btn-link" title="Desplegar">
                            <ion-icon name="chevron-down-circle-outline" role="img" class="md hydrated" aria-label="chevron down circle outline"></ion-icon>
                        </button>
                    </td>
                </tr>

                <tr id="detalles2" class="collapse in">
                    <td colspan="7">
                        columna1
                    </td>
                </tr>
                <tr id="detalles2" class="collapse in">
                    <td colspan="7">
                        columna2
                    </td>
                </tr>

                <!-- Agrega más filas según sea necesario -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
