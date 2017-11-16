
<?php 
if( isset($_SESSION["allowed"]))
{
if($row[1]==0)
{?>
<div class="bBoard" name="private">
<?php } else { ?>
<div class="bBoard" name="public">
<?php } } else { ?>
<div class="bBoard" name="public">
<?php } ?>
  <div class="board" onClick="displaySounds(this.children[0])">
    <?php
      echo "<p class='boardName'>".
      urldecode($row[0])."</p>";
    ?> 
  </div>
  <?php
  if( isset($_SESSION['allowed']))  
  {
    if( isset($_SESSION['admin']) || ($row[1] == 0))
    {
  ?>
    <div class="delete">
      <img
  src="http://freevector.co/wp-content/uploads/2010/05/61848-delete-button.png"
    alt="deletePic" onClick="showdelSB(this)">
      <img
  src="http://www.iconsfind.com/wp-content/uploads/2013/11/Editing-Edit-icon.png"
    alt="edit" onClick="showSBedit(this)">
    </div>
  <?php
  }}
?>
</div>

