<?php
    $register_error = '';
    $register_success = '';

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        return;
    }

    
    // Check if all fields are filled
    if (
        ($_POST['username'] ?? '') === '' ||
        ($_POST['password'] ?? '') === '' ||
        ($_POST['passwordConfirm'] ?? '') === '' ||
        ($_POST['firstname'] ?? '') === '' ||
        ($_POST['surname'] ?? '') === '' ||
        ($_POST['addressLine'] ?? '') === '' ||
        ($_POST['addressLineOther'] ?? '') === '' ||
        ($_POST['city'] ?? '') === '' ||
        ($_POST['country'] ?? '') === '' ||
        ($_POST['telephone'] ?? '') === '' ||
        ($_POST['mobile'] ?? '') === ''
    ) {
        $register_error = "Please fill in all fields";
        return;
    }
    

    // Tidy up values
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $passwordConfirm = trim($_POST['passwordConfirm'] ?? '');
    $firstName = trim($_POST['firstname'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $addressLine = trim($_POST['addressLine'] ?? '');
    $addresslineOther = trim($_POST['addressLineOther'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');

    // Password 6 digit only
    if (strlen($password) != 6) {
        $register_error = "Password must be 6 digits";
        return;
    }

    
    // Mobile and Telephone 10 numeric digits only
    if (!preg_match('/^\d{10}$/', $mobile) || !preg_match('/^\d{10}$/', $telephone)) {
        $register_error = "Mobile and Telephone must be 10 digits";
        return;
    }

    // Username has to be unique (no duplicates)
    $sql = "SELECT * FROM UserDetails WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $register_error = "Username already exists";
        return;
    }

    // Passwords has to match
    if ($password  != $passwordConfirm) {
        $register_error = "Passwords do not match";
        return;
    }

    // Create new user in database
    $sql = "
        INSERT INTO UserDetails (Username, Password, FirstName, Surname, AddressLine, AddressLineOther, City, Country, Telephone, Mobile)
        VALUES ('$username', '$password', '$firstName', '$surname', '$addressLine', '$addresslineOther', '$city', '$country', '$telephone', '$mobile');
    ";

    $result = mysqli_query($conn, $sql);
    
    $register_success = "Registration successful! You can now log in.";
?>
