
<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP con POO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script>
        function toggleNumero2Field() {
            var operacion = document.getElementById("operacion").value;
            var numero2Field = document.getElementById("numero2Field");

            if (operacion === "concatenar" || operacion === "reemplazar" || operacion === "factorial") {
                numero2Field.style.display = "none";
            } else {
                numero2Field.style.display = "block";
            }
        }
    </script>
 <style>
         .container {
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .alert {
            margin-top: 20px;
        }

        #historial {
            margin-top: 20px;
        }
    </style>
   
</head>
<body class="container mt-5">
    
    <h1 class="text-center mb-3">Calculadora con POO en PHP</h1>
    <form method="POST" onsubmit="toggleNumero2Field()">
    <div class="form-group">
    <input type="text" name="numero1" class="form-control" placeholder="Number 1" required>
    </div>
    <div class="form-group">
    <select name="operacion" class="btn btn-primary id="operacion>
            <option value="suma">Add</option>
            <option value="resta">Subtract</option>
            <option value="multiplicacion">Multiplication</option>
            <option value="division">Division</option>
            <option value="concatenar">Concatenate</option>
            <option value="factorial">Factorial</option>
            <option value="reemplazar">Replace</option>
        </select>
        </div>
        <div id="numero2Field" class="form-group">
            <input type="text" name="numero2" class="form-control" placeholder="Number 2">
        </div>
        <div class="form-group">
            <input type="text" name="buscar" class="form-control" placeholder="Search (Replace only)">
        </div>
        <div class="form-group">
        <input type="text" name="reemplazar" class="form-control" placeholder="Replace (only for Replace)">
        </div>
        <div class="form-group">
        <input type="submit" name="calcular" class="btn btn-warning" value="Calculate">
        </div>
    
    </form>
       
    <div class="mt-4">
        <!-- Utiliza clases de Bootstrap para el resultado -->
        <div class="alert alert-primary" role="alert">
             <span id="resultado"></span>
        
    
      
       

<?php
class Calculadora {
    private $numero1;
    private $numero2;
    
    public function __construct($num1, $num2) {
        $this->numero1 = $num1;
        $this->numero2 = $num2;
    }
    
    public function suma() {
        return $this->numero1 + $this->numero2;
    }
    
    public function resta() {
        return $this->numero1 - $this->numero2;
    }
    
    public function multiplicacion() {
        return $this->numero1 * $this->numero2;
    }
    
    public function division() {
        if ($this->numero2 != 0) {
            return $this->numero1 / $this->numero2;
        } else {
            return "Error: Division by zero";
        }
    }

    public function concatenar() {
        return $this->numero1 . $this->numero2;
    }

    public function factorial($numero) {
        if ($numero < 0) {
            return "Error: Factorial of a negative number is not defined.";
        } elseif ($numero == 0 || $numero == 1) {
            return 1;
        } else {
            return $numero * $this->factorial($numero - 1);
        }
    }

    public function reemplazar($buscar, $reemplazar) {
        return str_replace($buscar, $reemplazar, $this->numero1);
    }
}

session_start();

// Inicializar el historial si no existe.
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = array();
}

if (isset($_POST['calcular'])){
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];
    
    $calculadora = new Calculadora($numero1, $numero2);
if(isset($_POST['calcular'])){
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];
    
    $calculadora = new Calculadora($numero1, $numero2);
}
    
    switch($operacion){
        case 'suma':
            $resultado = $calculadora->suma();
            break;
        case 'resta':
            $resultado = $calculadora->resta();
            break;
        case 'multiplicacion':
            $resultado = $calculadora->multiplicacion();
            break;
        case 'division':
            $resultado = $calculadora->division();
            break;
        case 'concatenar':
            $resultado = $calculadora->concatenar();
            break;
        case 'factorial':
            $resultado = $calculadora->factorial($numero1);
            break;
        case 'reemplazar':
            $buscar = $_POST['buscar'];
            $reemplazar = $_POST['reemplazar'];
            $resultado = $calculadora->reemplazar($buscar, $reemplazar);
            break;
        default:
            $resultado = "Invalid operation";
            break;
        }
    
    $operacionRealizada = $numero1 . ' ' . $operacion . ' ' . $numero2;
    $_SESSION['historial'][] = array('operacion' => $operacion, 'resultado' => $resultado);
    echo "Result: $resultado";
      
    }
    if (isset($_POST['clear_historial'])) {
        $_SESSION['historial'] = array();
    }
?>
 </div>  

<div id="historial"class="mb-3">
    <h2>Results History</h2>
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Operation</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar el historial de resultados.
            foreach ($_SESSION['historial'] as $registro) {
                echo '<tr>';
                echo '<td>' . $registro['operacion'] . '</td>';
                echo '<td>' . $registro['resultado'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <form method="POST">
            <input type="submit" name="clear_historial" value="Clear Historial">
        </form>
</div>




</div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>

</body>
</html>