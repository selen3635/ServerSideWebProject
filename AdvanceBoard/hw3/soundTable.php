<div class="sound">

  <?php
    if($_SESSION["public"]=="0")
    {
    $temp="/hw3/files/".$_SESSION["emailAddress"]."/".$_SESSION["title"]."/";}
    else
    {
      $temp="/hw3/files/xiz266@ucsd.edu/".$_SESSION["title"]."/";
    }
    $imgsrc = $temp."imgs/".urlencode(basename($row[2]));
    $soundsrc = $temp."sounds/".urlencode(basename($row[1]));
    echo "<div class='table' onClick='play(this)'
style=background-image:url('$imgsrc') onMouseOver='showPPPic(this)'
    onmouseout='hidePPPic(this)'>";
    echo "<img src='play.png' alt='playPic' class='pppic'>";
    echo "<audio controls "."boardid=".$row[4].">";
    echo "<source src=".$soundsrc." type='audio/mpeg'>";
    echo "<source src=".$soundsrc." type='audio/wav'>";
    echo "<source src=".$soundsrc." type='audio/ogg'>";
  ?>
  </audio>
</div>
<?php
  if(isset($_SESSION['allowed']))
  {
    if('0'==$_SESSION['public']||isset($_SESSION['admin']))
    {
?>
    <div class="delete">
      <img
  src="http://freevector.co/wp-content/uploads/2010/05/61848-delete-button.png"
    alt="deletePic" onClick="showdelS(this)">
     <!-- <img
  src="http://www.iconsfind.com/wp-content/uploads/2013/11/Editing-Edit-icon.png"
    alt="edit" onClick="showSedit(this)">-->
    </div>

<?php
    }
  }
?>

</div>
