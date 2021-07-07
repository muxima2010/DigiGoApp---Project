<?php
# http://localhost/digiGoApp/application/userLevelThree.php
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
            <a href="myTeamTicketByUser.php?idTeam=<?php echo $idTeam;?>"><div class="service-item third-item">
                <div class="icon"></div>
                    <h4>MY TEAM TICKETS</h4>
                </div>
        </div></a>
    </div>
</div>