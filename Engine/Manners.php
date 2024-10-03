<?php

class Manners
{
    /**
     * @var Database
     */
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // 1. Retrieve customer names and contact information of all customers who have placed an order.
    public function getCustomersWithOrders()
    {
        $sql = "SELECT customers.*
                FROM customers
                JOIN orders ON customers.CustomerID = orders.CustomerID";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. List all customers and their ordered products with price and quantity from Sweden.
    public function getSwedenCustomersAndOrders()
    {
        $sql = "SELECT customers.CustomerName, customers.ContactName, 
        customers.Country, products.ProductName, products.Price, order_details.Quantity
        FROM customers
        JOIN orders ON customers.CustomerID = orders.CustomerID
        JOIN order_details ON orders.OrderID = order_details.OrderID
        JOIN products ON order_details.ProductID = products.ProductID
        WHERE customers.Country = 'Sweden';";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. List all customers that have ordered "Tofu" product.
    public function getCustomersWhoOrderedTofu()
    {
        $sql = "SELECT DISTINCT 
        customers.CustomerName, products.ProductName, orders.OrderDate FROM customers 
    JOIN orders ON customers.CustomerID = orders.CustomerID 
    JOIN order_details ON orders.OrderID = order_details.OrderID 
    JOIN products ON order_details.ProductID = products.ProductID 
    WHERE products.ProductName = 'Tofu';";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 4. List all products ordered by customers from Switzerland.
    public function getProductsOrderedBySwissCustomers()
    {
        $sql = "SELECT DISTINCT customers.CustomerName, products.*, customers.Country
FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN order_details ON orders.OrderID = order_details.OrderID
JOIN products ON order_details.ProductID = products.ProductID
WHERE customers.Country = 'Switzerland';";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // 5. Identify customers who have not placed any orders.
    public function getCustomersWithoutOrders()
    {
        $sql = "SELECT customers.CustomerID, customers.CustomerName, customers.Country, customers.Address
            FROM customers
            LEFT JOIN orders ON customers.CustomerID = orders.CustomerID
            WHERE orders.OrderID IS NULL;";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll();       }
}
