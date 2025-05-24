<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>IPv6 Convert</title>
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
    <div style="width: 100%; max-width: 1100px;">
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
                        style="margin-top:10px; background: white; padding: 10px; border: none;">
                        IPv4 to IPv6</h5>
                    <div class="card-body">
                        <form action="" method="post">
                            <label for="ipv4">Enter IPv4 Address:</label>
                            <input type="text" name="ipv4" id="ipv4" required class="form-control"
                                placeholder="e.g., 192.168.10.1">
                            <button type="submit" name="convert" >Convert to IPv6</button>
                            
                        </form>
                    </div>
                    <?php
                    function ipv4ToIpv6($ipv4) {
                        // Convert IPv4 to packed binary format
                        $ipv4Bin = inet_pton($ipv4);

                        // Prefix with IPv6-mapped IPv4 address format
                        $ipv6Full = '::ffff:' . bin2hex($ipv4Bin);
                        $ipv6Long = '0000:0000:0000:0000:0000:ffff:' . bin2hex($ipv4Bin);

                        return array($ipv6Full, $ipv6Long);
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['convert'])) {
                        $ipv4 = $_POST['ipv4'];

                        // Validate the IPv4 address format
                        if (filter_var($ipv4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                            list($ipv6Short, $ipv6Long) = ipv4ToIpv6($ipv4);
                            echo "<div id='result' class='p-3 text-center'>";
                            echo "<p>IPv6 (Short): <strong>$ipv6Short</strong></p>";
                            echo "<p>IPv6 (Long): <strong>$ipv6Long</strong></p>";
                            echo "</div>";
                        } else {
                            echo "<div id='result' class='text-danger p-3 text-center'>Invalid IPv4 address. Please try again.</div>";
                        }
                    }
                    ?>
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