<?php
# http://localhost/digiGoApp/application/servicesMenu.php
require_once("../php/restrictAccess.php");

?>
<section class="services p-0 m-0 mt-4">
  <div class="container-fluid p-0 m-0">
    <h2>MAIN MENU</h2>
  </div>
</section>
<section class="services  mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
               <a href="createNewTeam.php"><div class="service-item first-item">
                    <div class="icon"></div>
                        <h4>NEW TEAM</h4>
                    </div>
                </div></a>
            <div class="col-md-4">
                <a href="findTeam.php"><div class="service-item third-item">
                    <div class="icon"></div>
                      <h4>FIND TEAM</h4>
                    </div>
              </div></a>
                <div class="col-md-4">
                    <a href="userSettings.php"><div class="service-item second-item">
                      <div class="icon"></div>
                      <h4>MY SETTINGS</h4>
                    </div></a>
                  </div>
                <!--<div class="col-md-4">
                    <a href="#"><div class="service-item fourth-item">
                      <div class="icon"></div>
                      <h4>MY PIPELINE</h4>
                    </div></a>
                </div>-->
                <div class="col-md-4">
                    <a href="invitePeople.php"><div class="service-item fivth-item">
                      <div class="icon"></div>
                      <h4>INVITE PEOPLE</h4>
                    </div></a>
                </div>
                <div class="col-md-4">
                    <a href="contactFormDigigo.php"><div class="service-item sixth-item">
                      <div class="icon"></div>
                      <h4>CONTACT US</h4>
                    </div></a>
                </div>
            </div>
        </div>
</section>