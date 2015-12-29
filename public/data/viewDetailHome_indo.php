<?php
  $work = $_POST['work'];
  $result = "";

 if($work == "none"){
    $result .= "
                <p style='color:black;'' >The world is a dangerous place to live; not because of the people who are evil, but because of the people who don't do anything about it.</p>
                <small>by <cite>Albert Einstein</cite></small>
                ";
    echo $result;
  }


  if($work == "planner"){
    $result .= "
                <strong style='color:black;' >Planner</strong>
                <br>Bagikan ide dan rencana anda dengan kami.
                ";
    echo $result;
  }

  if($work == "product"){
    $result .= "<strong style='color:black;' >Produk</strong>
                <br>Produk yang kami tawarkan.
                ";
    echo $result;
  }

  if($work == "career"){
    $result .= "
                <strong style='color:black;' >Karir</strong>
                <br>Apakah anda adalah orang yang kami butuhkan?
                ";
    echo $result;
  }

  if($work == "maxel"){
     $result .= "
                <strong style='color:black;' >Maxel</strong>
               <br>Cari tahu lebih banyak tentang kami.
                ";
    echo $result;
  }

  if($work == "contact"){
     $result .= "
                <strong style='color:black;' >Kontak</strong>
                <br>Punya hal yang ingin disampaikan? beritahu kami.
                ";
    echo $result;
  }

  if($work == "client"){
     $result .= "
                <strong style='color:black;' >Klien</strong>
                <br>Klien kami
                ";
    echo $result;
  }


?>