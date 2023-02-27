<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang di PPIP Tracker</title>
</head>
<body>
    
    <?php
    # --------------------------------------
    #Awal syntag membuat koneksi ke Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ppiptracker";

    $koneksi = mysqli_connect($servername,$username,$password,$database);

    if (!$koneksi) {
        die("connection failed:" .mysqli_connect_error());
    }
    ?>

    <?php
// PROSES LOGIN
if($_POST['login']){
    $user   = $_POST['username'];
    $pass   = $_POST['password'];
 
    if($user && $pass){
        $cek_db = "SELECT * FROM user WHERE username='$user'";
        $query  = mysql_query($cek_db);
        if(mysql_num_rows($query) != 0){
            $row = mysql_fetch_assoc($query);
            $db_user = $row['username'];
            $db_pass = $row['password'];
 
            if($user == $db_user && $pass == $db_pass){
                echo '<p><b>Anda berhasil Login!</b></p>';
                // masukkan script lainnya disini
                // seperti Session atau redirect ke halaman admin
            }else{
                echo '<p>Username dan Password tidak cocok!</p>';
            }
        }else{
            echo '<p>Username tidak ada dalam Database!</p>';
        }
    }else{
        echo '<p>Username dan Password masih kosong!</p>';
    }
}
?>

     <!--/ FORM LOGIN /-->
	<form action="" method="post">
    <table>
    	<tr>
        	<td>Username</td><td>:</td><td><input type="text" name="username"/></td>
        </tr>
        <tr>
        	<td>Password</td><td>:</td><td><input type="password" name="password"/></td>
        </tr>
        <tr>
        	<td></td><td></td><td><input type="submit" name="login" value="Login"/></td>
        </tr>
    </table>
    </form>
 
</body>
</html>

