<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de RUT</title>
    <script>
        function validarRut(rut) {
            // Eliminar puntos y guiones del RUT
            rut = rut.replace(/[.-]/g, '');

            // Verificar si el RUT tiene el formato correcto
            if (!/^[0-9]{1,9}[0-9Kk]$/.test(rut)) {
                return false;
            }

            // Obtener el dígito verificador actual
            var dv = rut.slice(-1);
            rut = rut.slice(0, -1);

            // Calcular el dígito verificador esperado
            var suma = 0;
            var multiplo = 2;

            for (var i = rut.length - 1; i >= 0; i--) {
                suma += rut[i] * multiplo;

                if (multiplo < 7) {
                    multiplo++;
                } else {
                    multiplo = 2;
                }
            }

            var digitoVerificadorCalculado = 11 - (suma % 11);

            // Convertir el dígito calculado a texto
            digitoVerificadorCalculado = (digitoVerificadorCalculado === 10) ? 'K' : String(digitoVerificadorCalculado);

            // Comparar el dígito verificador actual con el calculado
            return dv.toUpperCase() === digitoVerificadorCalculado.toUpperCase();
        }

        function validarFormulario() {
            var rutInput = document.getElementById('rut');
            var rut = rutInput.value;

            if (validarRut(rut)) {
                alert('El RUT es válido. Puedes enviar el formulario al servidor.');
                // Aquí puedes agregar lógica adicional para enviar el formulario al servidor
            } else {
                alert('El RUT no es válido. Por favor, corrige el RUT.');
            }
        }
    </script>
</head>
<body>
    <form>
        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" placeholder="12345678-9">
        <button type="button" onclick="validarFormulario()">Enviar</button>
    </form>
</body>
</html>
