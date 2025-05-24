<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Parity Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 5px;
            margin: 5px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #74b9ff;
            color: white;
            border: none;
            border-radius: 0;
            cursor: pointer;
            font-weight: bold;
        }

        #result {
            margin-top: 20px;
        }

        .nav-item a {
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body style="display: flex; align-items: center; justify-content: center;">
    <div style="width: 100%; max-width: 1100px; ">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #00b894">
            <div class="container">
                <a class="navbar-brand" href="#">DCE-Tool</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="bitstuffing.php">Bit Stuffing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="char.php">Character Stuffing and De-Stuffing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Hamming Distance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="parity.php">Parity Bit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ip.php">IPv4 Convert</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="in.php">Line Coding</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container p-2 m-3">
        <div class="row justify-content-center"">
        <div class="card" style="width: 100%; max-width: 600px;">
                    <h5 class="card-header"
                        style="text-transform: uppercase; margin-top:10px;background: white; padding: 10px;border: none;">
                        Parity Bit Check</h5>
                    <hr>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="decimalInput">Enter Decimal Number:</label>
                            <br>
                            <input type="number" name="decimalInput" id="decimalInput" required>
                            <br>
                            <br>

                            <button type="submit" >Check Parity</button>
                        </form>
                    </div>
                    <?php
            function decimalToBinary($decimal) {
                return decbin($decimal);
            }

            function checkParity($binary) {
                // Count the number of '1' bits in the binary representation
                $countOnes = substr_count($binary, '1');

                // Check if the number of '1' bits is even or odd
                $parity = ($countOnes % 2 == 0) ? 'even' : 'odd';

                return $parity;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $decimalInput = $_POST['decimalInput'];

                // Convert decimal to binary
                $binaryInput = decimalToBinary($decimalInput);

                // Check parity
                $parityResult = checkParity($binaryInput);

                echo "<div id='result'>Parity of $binaryInput is $parityResult.</div>";
            }
            ?>
                    <br>
                    <br><br>
                    <br><br>
                </div>
                <br>
            </div>
        </div>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap" /></svg>
                    </a>
                    <span class="mb-3 mb-md-0 text-body-secondary">&copy; Rokshanara & Faisal</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>