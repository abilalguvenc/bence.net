<?php 

$rightMenu = '';

if(isset($_SESSION['login'] )) {
  // Giriş yapılmış
  if($_SESSION['login'] == 1)
    // ŞAHIS giriş yaptı
    $rightMenu .= '<a id="username"><b>Kullanıcı: </b>'.$_SESSION['username'].'</a>';
  else
  if($_SESSION['login'] == 2)
    // FİRMA giriş yaptı
    $rightMenu .= '<a id="username"><b>Firma: </b>'.$_SESSION['username'].'</a>';

  $rightMenu .= '<a href="anket_olustur.php">Anket Oluştur</a>'; 
  $rightMenu .= '<a href="anketlerim.php">Anketlerim</a>'; 
  $rightMenu .= '<a href="logOut.php">Çıkış</a>';
}
else
  // Giriş yapılmamış
  $rightMenu .= '<button class="loginButton" onclick="'.  "document.getElementById('id01').style.display='block'"  .'"style="width:auto;">Kayıt / Giriş</button>' ;

include 'pageHeader.html'
?>



<script>
    // Get the modal
    var modal = document.getElementById('id01');
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</head>


