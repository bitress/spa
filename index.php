<?php
include_once 'init.php';

$manners = new Manners();
$charts = new Charts();

$highestOrderedProducts_obj = $charts->highestOrderedProducts();


$highestOrderedProducts_label = [];
$highestOrderedProducts_data = [];
foreach($highestOrderedProducts_obj as $row){

    $highestOrderedProducts_label[] = $row['CustomerName'];
    $highestOrderedProducts_data[] = $row['TotalOrderedProducts'];

}

$mostOrderedProducts_obj = $charts->mostOrderedProducts();


$mostOrderedProducts_label = [];
$mostOrderedProducts_data = [];
foreach($mostOrderedProducts_obj as $row){

    $mostOrderedProducts_label[] = $row['ProductName'];
    $mostOrderedProducts_data[] = $row['TotalOrders'];

}

$ordersPercentageByYear_obj = $charts->ordersPercentageByYear();


$ordersPercentageByYear_label = [];
$ordersPercentageByYear_data = [];
foreach($ordersPercentageByYear_obj as $row){

    $ordersPercentageByYear_label[] = (string)$row['OrderYear'];
    $ordersPercentageByYear_data[] = (string)intval($row['OrderPercentage']);

}

if(isset($_GET['export'])){

    $table = $_GET['export'];

    switch($table){
        case '1':
            $excel = new Excel();
            $excel->exportGetCustomersWithOrders();
        case '2':
            $excel = new Excel();
            $excel->exportGetSwedenCustomersAndOrders();
        case '3':
            $excel = new Excel();
            $excel->exportGetCustomersWhoOrderedTofu();
        case '4':
            $excel = new Excel();
            $excel->exportGetProductsOrderedBySwissCustomers();
        case '5':
            $excel = new Excel();
            $excel->exportGetCustomersWithoutOrders();
            break;
        default:
    }

}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VEGA WORKSHEETS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom styling for the header */
        .header {
            background-color: #f8f9fa; /* Light background color */
            padding: 20px; /* Spacing around the header */
            text-align: center; /* Centering text */
            border-bottom: 1px solid #dee2e6; /* Optional bottom border */
        }
        .header h1 {
            font-size: 2.5rem; /* Large font size for the title */
            margin-bottom: 0.5rem; /* Spacing below the title */
        }
        .header h2 {
            font-size: 1.5rem; /* Medium font size for the subtitle */
            color: #6c757d; /* Secondary text color */
        }

        .footer {
            background-color: #f8f9fa; /* Light background color */
            padding: 20px; /* Spacing around the footer */
            text-align: center; /* Centering text */
            border-top: 1px solid #dee2e6; /* Optional top border */
            position: relative; /* Allows for positioning elements if needed */
            bottom: 0; /* Position at the bottom */
            width: 100%; /* Full width */
        }
        .footer p {
            margin: 0; /* Remove default margins */
            color: #6c757d; /* Secondary text color */
        }

    </style>
</head>

<body>
<header class="header">
        <h1>Prof Elective 5</h1>
        <h2>BSIT 4</h2>
        <p>Submitted by: Cyanne Justin Vega</p>
    </header>


    <div class="container py-5">

        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link lmao" onclick="window.open('https://ispsctagudin.info/home/', '_blank')">Worksheet
                        1.1</button>
                    <button class="nav-link lmao" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Worksheet
                        1.3</button>

                    <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">Worksheet 1.4</button>
                    <button class="nav-link balls" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Worksheet
                        1.5</button>
                </div>
            </div>
            <div class="col-10">
                <div class="d-flex align-items-start">

                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane  fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"
                            tabindex="0">


                            <div class="dropdown exportToExcel mb-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Export to Excel
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?export=1">Table 1</a></li>
                                    <li><a class="dropdown-item" href="index.php?export=2">Table 2</a></li>
                                    <li><a class="dropdown-item" href="index.php?export=3">Table 3</a></li>
                                    <li><a class="dropdown-item" href="index.php?export=4">Table 4</a></li>
                                    <li><a class="dropdown-item" href="index.php?export=5">Table 5</a></li>
                                </ul>
                            </div>


                            <div class="card mb-3">
                                <div class="card-header">
                                    Retrieve the customer names and contact information of all customers who have placed
                                    an order.
                                </div>
                                <div class="card-body">
                                    <table id="customerTable" class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal Code</th>
                                                <th>Country</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
 
                 $res = $manners->getCustomersWithOrders();
                 foreach ($res as $customer):
                 ?>
                                            <tr>
                                                <td><?= $customer['CustomerID'] ?></td>
                                                <td><?= $customer['CustomerName'] ?></td>
                                                <td><?= $customer['ContactName'] ?></td>
                                                <td><?= $customer['Address'] ?></td>
                                                <td><?= $customer['City'] ?></td>
                                                <td><?= $customer['PostalCode'] ?></td>
                                                <td><?= $customer['Country'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    List all customers and its ordered products with its price and quantity from the
                                    country Sweden.
                                </div>
                                <div class="card-body">
                                    <table id="customerTable2" class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Country</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
 
                 $res = $manners->getSwedenCustomersAndOrders();
                 foreach ($res as $customer):
                     ?>
                                            <tr>
                                                <td><?= $customer['CustomerName'] ?></td>
                                                <td><?= $customer['ContactName'] ?></td>
                                                <td><?= $customer['Country'] ?></td>
                                                <td><?= $customer['ProductName'] ?></td>
                                                <td><?= $customer['Price'] ?></td>
                                                <td><?= $customer['Quantity'] ?></td>

                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    List all customers that have ordered "Tofu" product.
                                </div>
                                <div class="card-body">
                                    <table id="customerTable3" class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Order Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
 
                 $res = $manners->getCustomersWhoOrderedTofu();
                 foreach ($res as $customer):
                     ?>
                                            <tr>
                                                <td><?= $customer['CustomerName'] ?></td>
                                                <td><?= $customer['ProductName'] ?></td>
                                                <td><?= $customer['OrderDate'] ?></td>

                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    List all products ordered by customers from Switzerland.

                                </div>
                                <div class="card-body">
                                    <table id="customerTable4" class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Supplier ID</th>
                                                <th>Category ID</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Country</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
            
                            $res = $manners->getProductsOrderedBySwissCustomers();
                            foreach ($res as $customer):
                                ?>
                                            <tr>
                                                <td><?= $customer['CustomerName'] ?></td>
                                                <td><?= $customer['ProductID'] ?></td>
                                                <td><?= $customer['ProductName'] ?></td>
                                                <td><?= $customer['SupplierID'] ?></td>
                                                <td><?= $customer['CategoryID'] ?></td>
                                                <td><?= $customer['Unit'] ?></td>
                                                <td><?= $customer['Price'] ?></td>
                                                <td><?= $customer['Country'] ?></td>

                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    Identify the customers who have not placed any orders
                                </div>
                                <div class="card-body">
                                    <table id="customerTable5" class="table table-bordered table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Country</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
 
                 $res = $manners->getCustomersWithoutOrders();
                 foreach ($res as $customer):
                     ?>
                                            <tr>
                                                <td><?= $customer['CustomerID'] ?></td>
                                                <td><?= $customer['CustomerName'] ?></td>
                                                <td><?= $customer['Country'] ?></td>
                                                <td><?= $customer['Address'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane show active fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" tabindex="0">


                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Top 10 Customers Table -->
                                    <h3>Top 10 Customers with Highest Ordered Products</h3>
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Customer Name</th>
                                                <th>Total Products Ordered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($highestOrderedProducts_obj as $row):
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $row['CustomerName'] ?></td>
                                                <td><?= $row['TotalOrderedProducts'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Top 10 Products Table -->
                                    <h3>Top 10 Products with Most Orders</h3>
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Product Name</th>
                                                <th>Total Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                foreach($mostOrderedProducts_obj as $row):
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $row['ProductName'] ?></td>
                                                <td><?= $row['TotalOrders'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- Percentage of Orders Per Year Table -->
                                    <h3>Percentage of Orders Per Year</h3>
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Year</th>
                                                <th>Total Orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                foreach($ordersPercentageByYear_obj as $row):
                                            ?>
                                            <tr class="text-center">
                                                <td><?= $row['OrderYear'] ?></td>
                                                <td><?= $row['OrderPercentage'] ?>%</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="container-fluid" style="height: 100vh; padding: 0;">
                                        <!-- Set to full height of viewport and no padding -->
                                        <div class="card mb-0" style="height: 100%; border: none;">
                                            <!-- Remove margin and border -->
                                            <div class="card-body p-0" style="height: 100%;">
                                                <!-- Remove padding -->
                                                <canvas id="highestOrderedProducts"
                                                    style="width: 100%; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <div class="card mb-0" style="height: 100%; border: none;">
                                            <!-- Remove margin and border -->
                                            <div class="card-body p-0" style="height: 100%;">
                                                <canvas id="mostOrderedProducts"
                                                    style="width: 100%; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                        <div class="card mb-0" style="height: 100%; border: none;">
                                            <!-- Remove margin and border -->
                                            <div class="card-body p-0" style="height: 100%;">
                                                <canvas id="what" style="width: 100%; height: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="tab-pane show fade" id="v-pills-three" role="tabpanel"
                            aria-labelledby="v-pills-three-tab" tabindex="0">
                            <div class="container-fluid" style="height: 100vh; padding: 0;">
                                <!-- Set to full height of viewport and no padding -->
                                ....
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Submitted to: Mr. Jim-mar delos Reyes</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="index.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const dataTable = new simpleDatatables.DataTable("#customerTable");
        const dataTable2 = new simpleDatatables.DataTable("#customerTable2");
        const dataTable3 = new simpleDatatables.DataTable("#customerTable3");
        const dataTable4 = new simpleDatatables.DataTable("#customerTable4");
        const dataTable5 = new simpleDatatables.DataTable("#customerTable5");

        // Highest Ordered Products Chart
        const highestOrderedProducts = document.getElementById('highestOrderedProducts');
        new Chart(highestOrderedProducts, {
            type: 'bar',
            data: {
                labels: <?= json_encode($highestOrderedProducts_label) ?>,
                datasets: [{
                    label: 'Top 10 Customers with Highest Ordered Products',
                    data: <?= json_encode($highestOrderedProducts_data) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', // Light Teal
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Top 10 Customers with Highest Ordered Products'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Ordered Products'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Customers'
                        }
                    }
                }
            }
        });

        // Most Ordered Products Chart
        const mostOrderedProducts = document.getElementById('mostOrderedProducts');
        new Chart(mostOrderedProducts, {
            type: 'bar',
            data: {
                labels: <?= json_encode($mostOrderedProducts_label) ?>,
                datasets: [{
                    label: 'Top 10 Most Ordered Products',
                    data: <?= json_encode($mostOrderedProducts_data) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)', // Light Purple
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Top 10 Most Ordered Products'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Orders'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Products'
                        }
                    }
                }
            }
        });

        // Orders Percentage By Year Chart
        const ordersPercentageByYear = document.getElementById('what');
        new Chart(ordersPercentageByYear, {
            type: 'line',
            data: {
                labels: <?= json_encode($ordersPercentageByYear_label) ?>,
                datasets: [{
                    label: 'Orders Percentage by Year',
                    data: <?= json_encode($ordersPercentageByYear_data) ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Orders Percentage by Year'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    }
                }
            }
        });
    });
    </script>

</body>

</html>