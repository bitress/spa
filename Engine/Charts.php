<?php

class Charts {
    
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // 1. Top 10 customers with highest ordered products.
    public function highestOrderedProducts()
    {
        $sql = "SELECT c.CustomerName, SUM(od.Quantity) AS TotalOrderedProducts
                FROM customers c
                INNER JOIN orders o ON c.CustomerID = o.CustomerID
                INNER JOIN order_details od ON o.OrderID = od.OrderID
                GROUP BY c.CustomerName
                ORDER BY TotalOrderedProducts DESC
                LIMIT 10";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Top 10 products which have the most orders.
    public function mostOrderedProducts()
    {
        $sql = "SELECT p.ProductName, SUM(od.Quantity) AS TotalOrders
                FROM products p
                INNER JOIN order_details od ON p.ProductID = od.ProductID
                GROUP BY p.ProductName
                ORDER BY TotalOrders DESC
                LIMIT 10";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Percentage of orders per year.
    public function ordersPercentageByYear()
    {
        $sql = "SELECT YEAR(o.OrderDate) AS OrderYear, 
                       COUNT(o.OrderID) * 100.0 / (SELECT COUNT(*) FROM orders) AS OrderPercentage
                FROM orders o
                GROUP BY OrderYear
                ORDER BY OrderYear";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
