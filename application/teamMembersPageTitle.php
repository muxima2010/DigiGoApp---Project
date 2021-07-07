<?php
# http://localhost/digiGoApp/application/teamMembersPageTitle.php

?>
<section class="services ml-3 pb-0 mt-4">
                <div class="container-fluid p-0 m-0">
                    <?php if($totalTeam > 0){
                        $f = mysqli_fetch_assoc($queryTeam);?>
                        <h4><?php echo $f['team_name'];?></h4>
                        <p>Team Members Board</p>
                    <?php } ?>
                 </div>
            </section>