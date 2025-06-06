<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NRZ-I & NRZ-L</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <div class="row">
                <div class="card">
                    <h5 class="card-header"
                        style="text-transform: uppercase; margin-top:10px;background: white; padding: 10px;border: none;">
                        NRZ-I and NRZ-L Line Coding</h5>
                    <hr>

                    <div class="card-body">
                        <!-- Input Form -->
                        <div class="input-group mb-4">
                            <input type="text" id="binaryInput" class="form-control" placeholder="Enter a binary sequence (e.g., 1100101) to generate the NRZ-I and NRZ-L line coding graphs."
                                aria-label="Binary Sequence" pattern="[01]+" required>
                            <button class="btn-success" onclick="generateGraphs()">Generate Graphs</button>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-center">NRZ-L Line Coding</div>
                                <div class="card-body">
                                    <canvas id="nrzlChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header text-center">NRZ-I Line Coding</div>
                                <div class="card-body">
                                    <canvas id="nrziChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap" />
                        </svg>
                    </a>
                    <span class="mb-3 mb-md-0 text-body-secondary">&copy; Rokshanara & Faisal</span>
                </div>
            </footer>
        </div>
        
<!-- JavaScript to Generate Graphs -->
<script>
        function generateGraphs() {
            const binaryInput = document.getElementById("binaryInput").value;
            if (!/^[01]+$/.test(binaryInput)) {
                alert("Please enter a valid binary sequence (only 0s and 1s).");
                return;
            }

            const nrzLData = [];
            binaryInput.split('').forEach(bit => {
                nrzLData.push(bit === '1' ? 1 : -1);
            });
            nrzLData.push(nrzLData[nrzLData.length - 1]);

            const nrzIData = [];
            let currentLevel = 1;
            binaryInput.split('').forEach(bit => {
                if (bit === '1') {
                    currentLevel *= -1;
                }
                nrzIData.push(currentLevel);
            });
            nrzIData.push(nrzIData[nrzIData.length - 1]);

            const chartOptions = {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Bit Position'
                        }
                    },
                    y: {
                        ticks: {
                            stepSize: 1,
                            callback: function (value) {
                                return value === 1 ? 'High' : 'Low';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            };

            new Chart(document.getElementById('nrzlChart'), {
                type: 'line',
                data: {
                    labels: Array.from({
                        length: nrzLData.length
                    }, (_, i) => i + 1),
                    datasets: [{
                        label: 'NRZ-L',
                        data: nrzLData,
                        borderColor: 'blue',
                        borderWidth: 2,
                        stepped: true,
                        fill: false
                    }]
                },
                options: chartOptions
            });

            new Chart(document.getElementById('nrziChart'), {
                type: 'line',
                data: {
                    labels: Array.from({
                        length: nrzIData.length
                    }, (_, i) => i + 1),
                    datasets: [{
                        label: 'NRZ-I',
                        data: nrzIData,
                        borderColor: 'red',
                        borderWidth: 2,
                        stepped: true,
                        fill: false
                    }]
                },
                options: chartOptions
            });
        }
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>