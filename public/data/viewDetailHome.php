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
                <br>Share your plan and idea with us
                ";
    echo $result;
  }

  if($work == "product"){
    $result .= "<strong style='color:black;' >Product</strong>
                <br>See our works that we have done
                ";
    echo $result;
  }

  if($work == "career"){
    $result .= "
                <strong style='color:black;' >Career</strong>
                <br>Are you the one that we need?
                ";
    echo $result;
  }

  if($work == "maxel"){
     $result .= "
                <strong style='color:black;' >Maxel</strong>
               <br>Get to know more about us
                ";
    echo $result;
  }

  if($work == "contact"){
     $result .= "
                <strong style='color:black;' >Contact</strong>
                <br>Have something in your mind, just tell us
                ";
    echo $result;
  }

  if($work == "client"){
     $result .= "
                <strong style='color:black;' >Client</strong>
                <br>Awesome people we worked with
                ";
    echo $result;
  }


?>