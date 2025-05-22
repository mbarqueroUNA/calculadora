<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header, footer {
            background-color: #0d6efd;
            color: white;
        }

        footer {
            margin-top: auto;
        }

        .calculator-form {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="text-center py-3 shadow-sm">
        <h2><i class="fas fa-calculator"></i> Calculadora Laravel</h2>
    </header>

    <!-- Main -->
    <main class="container py-5">
        <div class="calculator-form card mx-auto shadow-sm p-4" style="max-width: 450px;">
            <form method="POST" action="{{ url('/calcular') }}" id="calc-form">
                @csrf

                <div class="mb-3">
                    <label for="a" class="form-label">Número A</label>
                    <input type="number" class="form-control" id="a" name="a" required value="{{ old('a') }}">
                </div>

                <div class="mb-3">
                    <label for="op" class="form-label">Operación</label>
                    <select name="op" id="op" class="form-select">
                        <option value="sumar" {{ old('op') == 'sumar' ? 'selected' : '' }}>+</option>
                        <option value="restar" {{ old('op') == 'restar' ? 'selected' : '' }}>−</option>
                        <option value="multiplicar" {{ old('op') == 'multiplicar' ? 'selected' : '' }}>*</option>
                        <option value="dividir" {{ old('op') == 'dividir' ? 'selected' : '' }}>/</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="b" class="form-label">Número B</label>
                    <input type="number" class="form-control" id="b" name="b" required value="{{ old('b') }}">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-equals"></i> Calcular
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-broom"></i> Limpiar
                    </button>
                </div>
            </form>

            @if(isset($resultado))
                <div class="alert alert-info mt-4" id="resultado">
                    <strong>Resultado:</strong> {{ $resultado }}
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Calculadora Laravel - Desarrollado con ❤️ y PHP</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS personalizado -->
    <script>
        function resetForm() {
            const form = document.getElementById('calc-form');
            form.querySelectorAll('input[type="number"]').forEach(input => input.value = '');
            form.querySelector('select[name="op"]').selectedIndex = 0;

            const resultado = document.getElementById('resultado');
            if (resultado) {
                resultado.remove();
            }
        }
    </script>

</body>
</html>
