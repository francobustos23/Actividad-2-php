<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
</head>
<body>
    <?php
    session_start(); 

    $User = 'Fran';
    $Pin = 1234;

    if (!isset($_SESSION['account'])) {
        $_SESSION['account'] = 20000; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $UserEnter = $_POST['user'];
        $PinEnter = intval($_POST['pin']);

        if ($User == $UserEnter && $Pin == $PinEnter) {
            echo "<p>Bienvenido " . htmlspecialchars($User) . "!</p>";
            echo "<p>Su saldo de cuenta es de $" . $_SESSION['account'] . "</p>";

            if (isset($_POST['select'])) {
                $select = intval($_POST['select']);
                $amount = intval($_POST['amount']);

                if ($select == 1) {
                    if ($amount > $_SESSION['account']) {
                        echo "<p>Fondos insuficientes</p>";
                    } else {
                        $_SESSION['account'] -= $amount;
                        echo "<p>Su saldo actual es de $" . $_SESSION['account'] . "</p>";
                    }
                } elseif ($select == 2) {
                    $_SESSION['account'] += $amount;
                    echo "<p>Su saldo actual es de $" . $_SESSION['account'] . "</p>";
                } else {
                    echo "<p>Operación no válida</p>";
                }
            } else {
                echo '<form action="app.php" method="post">
                        <label for="select">¿Qué operación desea realizar?</label>
                        <select id="select" name="select">
                            <option value="1">Retiro</option>
                            <option value="2">Depósito</option>
                        </select>
                        <br>
                        <label for="amount">Monto:</label>
                        <input type="number" id="amount" name="amount" required>
                        <br>
                        <input type="hidden" name="user" value="' . htmlspecialchars($User) . '">
                        <input type="hidden" name="pin" value="' . htmlspecialchars($Pin) . '">
                        <input type="submit" value="Realizar Operación">
                      </form>';
            }
        } else {
            echo "<p>Usuario o contraseña incorrectos</p>";
        }
    } else {
        echo '<form action="app.php" method="post">
                <label for="user">Nombre de Usuario:</label>
                <input type="text" id="user" name="user" required>
                <br>
                <label for="pin">PIN:</label>
                <input type="password" id="pin" name="pin" required>
                <br>
                <input type="submit" value="Acceder">
              </form>';
    }
    ?>
</body>
</html>
