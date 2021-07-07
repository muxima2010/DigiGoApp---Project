<?php
# http://localhost/digiGoApp/application/userLevelOne.php
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
                    <a href="teamPipeline.php?idTeam=<?php echo $idTeam;?>"><div class="service-item fourth-item">
                      <div class="icon"></div>
                      <h4>TEAM PIPELINE</h4>
                    </div></a>
                </div>
                <div class="col-md-4">
                    <a href="teamMembers.php?idTeam=<?php echo $idTeam;?>"><div class="service-item fivth-item">
                      <div class="icon"></div>
                      <h4>TEAM MEMBERS</h4>
                    </div></a>
                </div>
                <!--<div class="col-md-4">
                    <a href="teamSettings.php?idTeam=<?php echo $idTeam;?>"><div class="service-item second-item">
                      <div class="icon"></div>
                      <h4>MY TEAM SETTINGS</h4>
                    </div></a>
                  </div>-->
                <!--<div class="col-md-4">
                    <a href="contactTeam.php?idTeam=<?php echo $idTeam;?>"><div class="service-item sixth-item">
                      <div class="icon"></div>
                      <h4>CONTACT TEAM</h4>
                    </div></a>
                </div>-->
            </div>
        </div>