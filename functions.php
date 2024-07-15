<?php
function check_login($conn){
    if(isset($_SESSION['Email'])){
        $id = $_SESSION['Email'];
        
        $query = "SELECT * FROM resztvevo WHERE Email = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_assoc($result);
            return $userdata;
        } else {
           
            $query = "SELECT * FROM eloado WHERE Email = '$id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $userdata = mysqli_fetch_assoc($result);
                return $userdata;
            }
        }
    }
    // Redirect to login if user session not found
    // header("Location: login.php");
    // exit; // Terminate script execution after redirection
}
// function check_login($conn){
//     if(isset($_SESSION['Email'])){
//         $id = $_SESSION['Email'];
//         $query = "SELECT * FROM eloado where Email = '$id' limit 1";
//         $query1 = "SELECT * FROM resztvevo where Email = '$id' limit 1";
//         $result = mysqli_query($conn,$query);
//         if($result && mysqli_num_rows($result)>0){
//             $userdata = mysqli_fetch_assoc($result);
//             return $userdata;
//         }
//         else{
//             $result = mysqli_query($conn,$query1);
//             if($result && mysqli_num_rows($result)>0){
//                 $userdata = mysqli_fetch_assoc($result);
//                 return $userdata;
//             }
//         }

//     }
//     //header("Location: login.php");
//     die;
// }
function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 
?>