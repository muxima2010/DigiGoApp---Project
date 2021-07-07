<?php
# http://localhost/digiGoApp/application/userLevelTwo.php
require_once("../php/restrictAccess.php");

?>
<div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <a href="createNewTicket.php?idTeam=<?php echo $idTeam;?>"><div class="service-item first-item">
              <div class="icon"></div>
              <h4>NEW TEAM TICKET</h4>
              </div>
          </div></a>
          <div class="col-md-4">
            <a href="teamPipelineByUser.php?idTeam=<?php echo $idTeam;?>"><div class="service-item fourth-item">
              <div class="icon"></div>
              <h4>TEAM PIPELINE</h4>
            </div></a>
          </div>
  </div>
</div>