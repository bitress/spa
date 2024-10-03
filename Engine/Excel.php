<?php

class Excel {

    private Manners $manners;


    public function __construct(){
        $this->manners = new Manners();
    }

    public function exportGetCustomersWithOrders() {

        $data = $this->manners->getCustomersWithOrders();

        $filename = "CustomersWithOrders"; 
        header("Content-Type: application/vnd.ms-excel");    
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo "<table border='1'>";
        echo "<tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
              </tr>";
    
        foreach ($data as $customer) {
            echo "<tr>
            <td>{$customer['CustomerID']}</td>
            <td>{$customer['CustomerName']}</td>
            <td>{$customer['ContactName']}</td>
            <td>{$customer['Address']}</td>
            <td>{$customer['City']}</td>
            <td>{$customer['PostalCode']}</td>
            <td>{$customer['Country']}</td>
          </tr>";
        }

        echo "</table>";
        exit; 
    

    }

    public function exportGetSwedenCustomersAndOrders() {

        $data = $this->manners->getSwedenCustomersAndOrders();

        $filename = "SwedenCustomersAndOrders"; 
        header("Content-Type: application/vnd.ms-excel");    
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo "<table border='1'>";
        echo "<tr>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>Country</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>";
    
        foreach ($data as $customer) {
            echo "<tr>
            <td>{$customer['CustomerName']}</td>
            <td>{$customer['ContactName']}</td>
            <td>{$customer['Country']}</td>
            <td>{$customer['ProductName']}</td>
            <td>{$customer['Price']}</td>
            <td>{$customer['Quantity']}</td>
          </tr>";
        }

        echo "</table>";
        exit; 


    }
    public function exportGetCustomersWhoOrderedTofu() {

        $data = $this->manners->getCustomersWhoOrderedTofu();

        $filename = "CustomersWhoOrderedTofu"; 
        header("Content-Type: application/vnd.ms-excel");    
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo "<table border='1'>";
        echo "<tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Order Date</th>
            </tr>";
    
        foreach ($data as $customer) {
            echo "<tr>
            <td>{$customer['CustomerName']}</td>
            <td>{$customer['ProductName']}</td>
            <td>{$customer['OrderDate']}</td>
          </tr>";
        }

        echo "</table>";
        exit; 


    }

    public function exportGetProductsOrderedBySwissCustomers() {

        $data = $this->manners->getProductsOrderedBySwissCustomers();

        $filename = "ProductsOrderedBySwissCustomers"; 
        header("Content-Type: application/vnd.ms-excel");    
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo "<table border='1'>";
        echo "<tr>
                <th>Customer Name</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Supplier ID</th>
                <th>Category ID</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Country</th>
            </tr>";
    
        foreach ($data as $customer) {
            echo "<tr>
            <td>{$customer['CustomerName'] }</td>
            <td>{$customer['ProductID'] }</td>
            <td>{$customer['ProductName'] }</td>
            <td>{$customer['SupplierID'] }</td>
            <td>{$customer['CategoryID'] }</td>
            <td>{$customer['Unit'] }</td>
            <td>{$customer['Price'] }</td>
            <td>{$customer['Country'] }</td>
          </tr>";
        }

        echo "</table>";
        exit; 


    }
    public function exportGetCustomersWithoutOrders() {

        $data = $this->manners->getCustomersWithoutOrders();

        $filename = "CustomersWithoutOrders"; 
        header("Content-Type: application/vnd.ms-excel");    
        header("Content-Disposition: attachment; filename=" . $filename . ".xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0"); 

        echo "<table border='1'>";
        echo "<tr>
                 <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Country</th>
                <th>Address</th>
            </tr>";
    
        foreach ($data as $customer) {
            echo "<tr>
            <td>{$customer['CustomerID'] }</td>
            <td>{$customer['CustomerName'] }</td>
            <td>{$customer['Country'] }</td>
            <td>{$customer['Address'] }</td>
          </tr>";
        }

        echo "</table>";
        exit; 


    }


}