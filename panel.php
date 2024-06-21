<!DOCTYPE html>
<html>
<head>
<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="stils.css">
   
    <link rel="preconnect"href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap"rel="stylesheet">
   
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>

    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.min.css">
<style>
#customers
 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 3px solid black;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: green;
  color: blue;
}
</style>
</head>
<body>
  
<br></br>
<h1>Panel</h1>

<table id="customers">
  <tr>
    <th>Ad Soyad</th>
    <th>Telefon</th>
    <th>E-Mail</th>
    <th>Konu</th>
    <th>Mesaj</th>
    <th>Sil</th>
  </tr>
  <?php

session_start();
if($_SESSION["user"]=="")
{
  echo"<script> window.location.href='cikis.php'</script>";
}
else
{


echo"<a href='cikis.php'>ÇIKIŞ YAP</a> <br><br>";
 


include("baglan.php");

  $sec="Select * From iletisim";
  $sonuc=$baglan->query($sec);
  if($sonuc->num_rows>0)
  {
   while($cek=$sonuc->fetch_assoc())
   {
     echo"
     <form action='#' method='POST'>
     <tr>
    <input type='hidden' name='id' value=".$cek['id'].">
     <td>".$cek['adsoyad']."</td>
     <td>".$cek['telefon']."</td>
     <td>".$cek['email']."</td>
     <td>".$cek['konu']."</td>
     <td>".$cek['mesaj']."</td>
     <td>
         <input type='submit' value='Sil'>
     </td>
     
     </tr>
     </form>
    ";
   }
  }
  
  else
  {
  echo"Veritabanında Kayıtlı Hiçbir Veri Bulunamamıştır.";
  echo"<br></br>";
  }
  
  
}

if(isset($_POST["id"]))
{
$id=$_POST["id"];
$sil = "DELETE FROM iletisim WHERE id = $id";

if($baglan->query($sil)===TRUE)
{
   
echo"<script>alert('Mesajınız Başarı İle Silinmistir.');
</script>";
header("refresh:1;");
}
else
{
   echo"<script>alert('Mesajınız Silinirken Bir Hata Oluştu.');
   </script>";
}


}




?>

 

</table>

</body>
</html>