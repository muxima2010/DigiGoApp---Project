<?php
# http://localhost/digiGoApp/application/teamTicket.php


?>
<div class="card card-kanban mt-2 mb-2">
  <div class="progress">
    <div class="pl-1 text-left progress-bar <?php echo $fTicket['priorityClass'];?>" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Priority: <?php echo $fTicket['priority'];?></div>
  </div>
  <div class="card-body justify-content-between p-2">
    <div class="main-box clearfix">
      <div class="table-responsive">                              
        <table class="table user-list mb-0 pb-0">
          <thead>
            <tr class="mb-0">
            <th class=""><span class="mr-5">N.º</span></th>
              <th class=""><span class="mr-5">Subject</span></th>
              <th class=""><span class="mr-5">Category</span></th>
              <th class=""><span class="mr-5">Owner</span></th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr class="m-0">
              <td class=""><span><p><?php echo $fTicket['idTicket'];?></p></span></td>
              <td class=""><span><p><?php echo $fTicket['subject'];?></p></span></td>
              <td class=""><span><p><?php echo $fTicket['category'];?></p></span></td>
              <td class=""><span><p><?php echo $fetchName['first_name'];?> <?php echo $fetchName['last_name'];?></p></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-meta d-flex justify-content-between">
      <div class="d-flex">
        <ul class="list-group">
          <li class="list-group"><span class="ml-2">Created by: <?php echo $fTicket['email'];?></span></li>
        </ul>
      </div>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Options
        </button>
        <div class="dropdown-menu">
        <?php
          $idStatus = $fidTicket['idStatus'];
          if($idStatus == 1){?>
            <a class="dropdown-item" href="ticketCard.php?idTicket=<?php echo $fTicket['idTicket'];?>">Edit Card</a>
            <a class="dropdown-item" href="php/moveCard.php?idTicket=<?php echo $fTicket['idTicket'];?>&moveToWP&idTeam=<?php echo $idTeam;?>">Move to Working Progress</a>
            <a class="dropdown-item" href="php/moveCard.php?idTicket=<?php echo $fTicket['idTicket'];?>&closeTicket&idTeam=<?php echo $idTeam;?>">Move to Closed</a>
          <?php } else if ($idStatus == 2){?>
            <a class="dropdown-item" href="ticketCard.php?idTicket=<?php echo $fTicket['idTicket'];?>">Edit Card</a>
            <a class="dropdown-item" href="php/moveCard.php?idTicket=<?php echo $fTicket['idTicket'];?>&moveToBC&idTeam=<?php echo $idTeam;?>">Move to Backlog</a>
            <a class="dropdown-item" href="php/moveCard.php?idTicket=<?php echo $fTicket['idTicket'];?>&closeTicket&idTeam=<?php echo $idTeam;?>">Move to Closed</a>
          <?php } else if ($idStatus == 3){?>
            <a class="dropdown-item text-danger" href="ticketCard.php?idTicket=<?php echo $fTicket['idTicket'];?>&idTeam=<?php echo $idTeam;?>">Closed Ticket</a>
          <?php } ?>
            
            
            
        </div>
    </div>
    </div>
  </div>
</div>
