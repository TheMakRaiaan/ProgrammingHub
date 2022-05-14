<?php include('db_conn.php'); 
$conn = mysqli_connect('localhost', 'root', '', 'userdata');

 
// check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])  && !empty($_POST['email']) && !empty($_POST['password'])){
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO user (name,email,password)  VALUES ('$username','$email','$password')";
    //save to db and check
    if (mysqli_query($conn, $sql)){
        // success
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }


}



mysqli_close($conn);

// write query for all pizzas


// make query & get result

 // fetch the resulting rows as an array
 //$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

 // free result from memory
 //mysqli_free_result($result);

 // close connection

 //explode(',', $pizzas[0]['ingredients']);

  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reg</title>
</head>
<body><br>
      <br>
      <br>

    <div class="container">
    <div class="card">
  <div class="card-header">
      
            <form  action="" method="post">
            <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="password" class="form-control" name="passowrd">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    </div>
</div>

    
</body>
</html>