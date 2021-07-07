<?php
# http://localhost/digiGoApp/application/formSearchTeam.php
require_once("../php/restrictAccess.php");

?>

<form id="contact" method="post">
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <input name="email" type="email" class="form-control" id="email" placeholder="Team email..." required="">
            </fieldset>
        </div>
        <div class="container pl-0">
            <div class="row">
                <div class="col">
                    <div class="col-md-6">
                        <a type="submit" class="btn btn-secondary" href="mainMenu.php">BACK</a>
                        <button type="submit" id="form-submit" name="teamEmail" class="btn btn-info">SEARCH</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>