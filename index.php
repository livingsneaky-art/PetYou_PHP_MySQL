<?php

    $conn = new mysqli('localhost', 'root','');
    $select = $conn->select_db('petyous');
    if(!$select)
    {
        $conn->query("CREATE DATABASE petyous");

        $conn->select_db('petyous');
        $conn->query("CREATE TABLE user(
            id INT NOT NULL AUTO_INCREMENT,
            fName VARCHAR(100) NOT NULL,
            lName VARCHAR(100) NOT NULL,
            uName VARCHAR(100) NOT NULL,
            password VARCHAR(100) NOT NULL,
            CONSTRAINT pk_user PRIMARY KEY(id)
        )");

        
        $conn->query("CREATE TABLE product(
             id INT NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) NOT NULL,
            description VARCHAR(255) NOT NULL,
            price DECIMAL(11, 2) NOT NULL,
            image VARCHAR(255) NOT NULL,
            CONSTRAINT pk_product PRIMARY KEY(id)
        )");
       

        $conn->query("CREATE TABLE payment_details(
             id INT NOT NULL AUTO_INCREMENT,
            extras_total DECIMAL(11, 2),
            menus_total DECIMAL(11, 2),
            total DECIMAL(11, 2) NOT NULL,
            minPayment DECIMAL(11, 2) NOT NULL,
            paid DECIMAL(11, 2) NOT NULL,
            balance DECIMAL(11, 2) NOT NULL,
            pay_method INT NOT NULL,
            status enum('Confirmed', 'Cancelled'),
            CONSTRAINT pk_payment_details PRIMARY KEY(id)
        )");

        $conn->query("CREATE TABLE cart(
            id INT NOT NULL,
            cartID INT,
            customer_name VARCHAR(200) NOT NULL,
            customer_contact_no VARCHAR(11) NOT NULL,
            customer_email VARCHAR(200) NOT NULL,
            status enum('Confirmed', 'Cancelled'),
            event_status enum('To Be Held', 'Finished'),
            transaction_status enum('Processing', 'Successful', 'Failed'),
            receiptID INT,
            CONSTRAINT pk_bookings PRIMARY KEY(id)
        )");

        $conn->query("CREATE TABLE event_details(
            id INT NOT NULL,
            eventID INT,
            startTime VARCHAR(200) NOT NULL,
            endTime VARCHAR(200) NOT NULL,
            eventAddress VARCHAR(200) NOT NULL,
            event_type INT NOT NULL,
            CONSTRAINT fk_event_details FOREIGN KEY(event_type) REFERENCES events(id),
            CONSTRAINT pk_event_details PRIMARY KEY(id)
        )");

    }            
    ob_start();
    // include header.php file
    include ('header-outsider.php');
?>

<?php

    /*  include banner area  */
        include ('Template/_banner-area.php');
    /*  include banner area  */

    /*  include top sale section */
        include ('Template/_top-sale.php');
    /*  include top sale section */

    /*  include special price section  */
         include ('Template/_special-price.php');
    /*  include special price section  */

    /*  include banner ads  */
        include ('Template/_banner-ads.php');
    /*  include banner ads  */

    /*  include new products section  */
        include ('Template/_new-products.php');
    /*  include new phones section  */

    /*  include blog area  */
         include ('Template/_blogs.php');
    /*  include blog area  */

?>


<?php
// include footer.php file
include ('footer.php');
?>