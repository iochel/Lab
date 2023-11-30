<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "user";
       
       $conn = new mysqli($servername, $username, $password, $dbname);
       
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
       }
       

        class FormInfoClass {
            private $lastName;
            private $firstName;
            private $middleInitial;
            private $age;
            private $contactNo;
            private $email;
            private $address;

            public function setLastName($lastName) {
                $this->lastName = $lastName;
            }

            public function setFirstName($firstName) {
                $this->firstName = $firstName;
            }

            public function setMiddleInitial($middleInitial) {
                $this->middleInitial = $middleInitial;
            }

            public function setAge($age) {
                $this->age = $age;
            }

            public function setContactNo($contactNo) {
                $this->contactNo = $contactNo;
            }

            public function setEmail($email) {
                $this->email = $email;
            }

            public function setAddress($address) {
                $this->address = $address;
            }

            public function getLastName() {
                return $this->lastName;
            }

            public function getFirstName() {
                return $this->firstName;
            }

            public function getMiddleInitial() {
                return $this->middleInitial;
            }

            public function getAge() {
                return $this->age;
            }

            public function getContactNo() {
                return $this->contactNo;
            }

            public function getEmail() {
                return $this->email;
            }

            public function getAddress() {
                return $this->address;
            }

            public function insertDataToDatabase() {
                global $conn;

                $sql = "INSERT INTO user_info (last_name, first_name, middle_initial, age, contact_no, email, address)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssiiss", $this->lastName, $this->firstName, $this->middleInitial, $this->age, $this->contactNo, $this->email, $this->address);

                if ($stmt->execute()) {
                    echo "<p>Data added to the database successfully.</p>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formInfo = new FormInfoClass();

            $formInfo->setLastName($_POST["last_name"]);
            $formInfo->setFirstName($_POST["first_name"]);
            $formInfo->setMiddleInitial($_POST["middle_initial"]);
            $formInfo->setAge($_POST["age"]);
            $formInfo->setContactNo($_POST["contact_no"]);
            $formInfo->setEmail($_POST["email"]);
            $formInfo->setAddress($_POST["address"]);

            $formInfo->insertDataToDatabase();

            echo "<h2>Form Data</h2>";
            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>Last Name</td><td>" . $formInfo->getLastName() . "</td></tr>";
            echo "<tr><td>First Name</td><td>" . $formInfo->getFirstName() . "</td></tr>";
            echo "<tr><td>Middle Initial</td><td>" . $formInfo->getMiddleInitial() . "</td></tr>";
            echo "<tr><td>Age</td><td>" . $formInfo->getAge() . "</td></tr>";
            echo "<tr><td>Contact No.</td><td>" . $formInfo->getContactNo() . "</td></tr>";
            echo "<tr><td>Email</td><td>" . $formInfo->getEmail() . "</td></tr>";
            echo "<tr><td>Address</td><td>" . $formInfo->getAddress() . "</td></tr>";
            echo "</table>";
        }

        $conn->close();
    ?>

   
    <form method="post" action="">
    <h1>Input Form</h1>
        <label for="last_name">Last Name *</label>
        <input type="text" name="last_name" required><br>

        <label for="first_name">First Name *</label>
        <input type="text" name="first_name" required><br>

        <label for="middle_initial">Middle Initial *</label>
        <input type="text" name="middle_initial" required><br>

        <label for="age">Age *</label>
        <input type="number" name="age" required><br>

        <label for="contact_no">Contact No. *</label>
        <input type="tel" name="contact_no" required><br>

        <label for="email">Email *</label>
        <input type="email" name="email" required><br>

        <label for="address">Address *</label>
        <textarea name="address" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>