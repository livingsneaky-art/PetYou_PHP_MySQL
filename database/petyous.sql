 
        CREATE DATABASE petyous;

       
        CREATE TABLE user(
            userID INT NOT NULL AUTO_INCREMENT,
            fName VARCHAR(100) NOT NULL,
            lName VARCHAR(100) NOT NULL,
            uName VARCHAR(100) NOT NULL,
            customer_contact_no VARCHAR(100) NOT NULL,
            customer_email VARCHAR(100) NOT NULL,
            deliveryAddress VARCHAR(100) NOT NULL,
            startTime VARCHAR(200) NOT NULL,
            endTime VARCHAR(200) NOT NULL,
            password VARCHAR(100) NOT NULL,
            user_type enum('Admin', 'Customer'),
            CONSTRAINT pk_user PRIMARY KEY(userID)
        );

        

        CREATE TABLE type_delivery(    
            id INT NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) NOT NULL,
            image_name VARCHAR(255) NOT NULL,
            CONSTRAINT pk_type_delivery PRIMARY KEY(id)
        );


        CREATE TABLE product(
            productID INT NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) NOT NULL,
            description VARCHAR(255) NOT NULL,
            price DECIMAL(11, 2) NOT NULL,
            image VARCHAR(255) NOT NULL,
            CONSTRAINT pk_product PRIMARY KEY(productID)
        );

        CREATE TABLE payment_details(
             id INT NOT NULL AUTO_INCREMENT,
            products_total DECIMAL(11, 2),
            total DECIMAL(11, 2) NOT NULL,
            minPayment DECIMAL(11, 2) NOT NULL,
            paid DECIMAL(11, 2) NOT NULL,
            balance DECIMAL(11, 2) NOT NULL,
            pay_method INT NOT NULL,
            status enum('Confirmed', 'Cancelled'),
            CONSTRAINT pk_payment_details PRIMARY KEY(id)
        );

        CREATE TABLE cart(
            id INT NOT NULL,
            deliveryID INT,
            customer_name VARCHAR(200) NOT NULL,
            customer_contact_no VARCHAR(11) NOT NULL,
            customer_email VARCHAR(200) NOT NULL,
            status enum('Confirmed', 'Cancelled'),
            delivery_status enum('To Be Held', 'Finished'),
            transaction_status enum('Processing', 'Successful', 'Failed'),
            receiptID INT,
            CONSTRAINT pk_cart PRIMARY KEY(id)
        );

        CREATE TABLE product_carts(
            type INT NOT NULL,
            cartID INT NOT NULL,
            quantity INT NOT NULL,
            CONSTRAINT fk_cart_product FOREIGN KEY(cartID) REFERENCES cart(id),
            CONSTRAINT fk_type_product FOREIGN KEY(type) REFERENCES product(productID)
        );            
        
        CREATE TABLE bridge(    
            bridge_id INT NOT NULL AUTO_INCREMENT,
            userID INT NOT NULL,
            productID INT NOT NULL,
            CONSTRAINT fk_user_bridge FOREIGN KEY(userID) REFERENCES user(userID),
            CONSTRAINT fk_product_bridge FOREIGN KEY(productID) REFERENCES product(productID),
            CONSTRAINT pk_bridge PRIMARY KEY(bridge_id)
        );    

      CREATE TABLE delivery_details(
            id INT NOT NULL,
            deliveryID INT,
            startTime VARCHAR(200) NOT NULL,
            endTime VARCHAR(200) NOT NULL,
            deliveryAddress VARCHAR(200) NOT NULL,
            delivery_type INT NOT NULL,
            CONSTRAINT fk_delivery_details FOREIGN KEY(delivery_type) REFERENCES type_delivery(id),
            CONSTRAINT pk_delivery_details PRIMARY KEY(id)
        );

    CREATE TABLE pet(
            petID INT NOT NULL AUTO_INCREMENT,
            petname VARCHAR(100) NOT NULL,
            petdescription VARCHAR(255) NOT NULL,
            price DECIMAL(11, 2) NOT NULL,
            image VARCHAR(255) NOT NULL,
            CONSTRAINT pk_pet PRIMARY KEY(petID)
        );

        CREATE TABLE discount(
            discountID INT NOT NULL,
            discountA INT NOT NULL,
            discountB INT NOT NULL,
            discountC INT NOT NULL,
            discountD INT NOT NULL,
            CONSTRAINT pk_discount PRIMARY KEY(discountID)
        );