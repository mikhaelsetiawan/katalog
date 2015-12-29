
 <div id="popup" class="popupforportfolio" style="width: 100%; color: rgb(255, 255, 255); color:black;display:none;">
    <div id="titledetail">Popup #1</div><br>
    <p style="color:black;">
        <div class="row">
          <div class="col-sm-7">
              <div class="owl-demo" class="owl-carousel owl-theme" id="imagedetail">
               
                <div class="item"><img src="img/fullimage1.jpg" alt="The Last of us"></div>
                <div class="item"><img src="img/fullimage2.jpg" alt="GTA V"></div>
                <div class="item"><img src="img/fullimage3.jpg" alt="Mirror Edge"></div>
               
              </div>
              <br><br>
          </div>
          <div class="col-sm-5" style="text-align:justify">
              <div id="contentdetail">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi 
                architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione 
                voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore 
                et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? 
                Quis autem vel eum iure reprehenderit qui in ea voluptate elit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
              </div>
              
              <div class="buttonhexagon">
                VIEW WEBSITE
              </div>
          </div>
        </div>
    </p>
  </div>

<?php 
  $forlength = 0;
  $ctr = 0; 
  $check = 4;

  if ($forlength % 2 == 0) {
    $check = 3;
  }

  for($i = 0; $i < $forlength; $i++){
?>
   <div class="conhexagon open-popup" data-popup="#popup" id="<?php echo $i;?>" onclick="detailpopup(this.id)">
    <svg viewbox="0 0 100 100">
      <defs>
        <pattern id="img" patternUnits="userSpaceOnUse" width="100" height="100">
          <image xlink:href="img/s8.png" x="-25" width="150" height="100" />
        </pattern>
      </defs>
      <polygon points="50 1 95 25 95 75 50 99 6 75 6 25" fill="url(#img)"/>  
      <div class="titlehexagon">
        Title for portfolio
      </div>
      <div class="texthexagon">
        Hello World Hello World sd sd as
        
        Hello World Hello World sd sd as
      </div>
    </svg>
    <!-- <span class="buttonhexagon" onclick="tes()">
        Details
    </span> -->
  </div>
<?php 
    $ctr++; 
    if($ctr == $check){ 
      echo '<br>';
      if ($check == 4){
        $check = 3;
      }else{
        $check = 4;
      }
      $ctr = 0;
    }
  } 
?>



