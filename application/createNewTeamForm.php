<?php
# http://localhost/digiGoApp/application/createNewTeamForm.php


?>
<!-- Forms -->
            <section class="forms mt-5">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-heading">
                      <h2>Create New Team</h2>
                    </div>

                    <form id="creat-team" method="post" action="php/registerNewTeam.php">
                      <div class="row">
                        <div class="col-md-6">
                          <fieldset>
                            <input name="teamName" type="text" class="form-control" id="team-name" placeholder="Team name..." required>
                          </fieldset>
                        </div>
                        <div class="col-md-6">
                          <fieldset>
                            <input name="teamEmail" type="email" class="form-control" id="team-email" placeholder="Team email..." required>
                          </fieldset>
                        </div>

                        <!-- Team Category -->
                        <div class="col-md-12">
                          <select name="category" id="category" required>
                            <option name="id" value="0" selected>Select team category</option>
                            <?php if($total>0){
                                while($f = mysqli_fetch_assoc($query)) {?>
                                    <option name="id" value="<?php echo $f['id'];?>"><?php echo $f['type'];?></option>
                            <?php } }?>
                          </select>
                        </div>
          
                        <div class="col-12">
                          <textarea name="teamDescription" id="team-description" placeholder="Team description..." rows="6"></textarea>
                        </div>
                        <div class="container pl-0">
                          <div class="row">
                            <div class="col">
                              <div class="col-md-6">
                                <a type="submit" class="btn btn-secondary" href="mainMenu.php">BACK</a>
                                <button type="submit" id="create-submit" name="teamSubmit" class="btn btn-info">CREATE TEAM</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>