<?php
# http://localhost/digiGoApp/application/teamMembersList.php

$sqlRequest = "SELECT * FROM v_members_request WHERE idRequestStatus = 1 AND idTeam = $idTeam";
$queryRequest = mysqli_query($conn, $sqlRequest)or die($sqlRequest);
$totalRequest = mysqli_num_rows($queryRequest);


?>
<section class="services ml-3 pb-0 mt-4">
                <div class="container-fluid p-0 m-0">
                   <p>Members Request Access</p>
                 </div>
            </section>
    <div class="container p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box clearfix">
                                <div class="table-responsive">
                                <?php if($totalRequest > 0) {?> 
                                    <table class="table user-list">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><span>Avatar</span></th>
                                                <th class="text-center"><span>Name</span></th>
                                                <th class="text-center"><span>Level</span></th>
                                                <th ><span>Request</span></th>
                                                <th class="text-center"><span>Status</span></th>
                                                <th><span>Email</span></th>
                                                <th class="text-center"><span>Edit</span></th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            while($fRequest = mysqli_fetch_assoc($queryRequest)) { ?>
                                                <tr>
                                                    <form method="get" action="php/teamMemberRequest.php">
                                                        <td class="text-center">
                                                            <img class="w-50" src="../application/assets/images/avatars/<?php echo $fRequest['avatar'];?>" alt="User Avatar">
                                                        </td>
                                                        <td class="text-center">
                                                        <input name="idUser" value="<?php echo $fRequest['idUser'];?>" hidden>
                                                        <input name="idTeam" value="<?php echo $fRequest['idTeam'];?>" hidden>
                                                        <input name="idRequest" value="<?php echo $fRequest['idRequest'];?>" hidden>
                                                        <span ><?php echo $fRequest['first_name'];?> <?php echo $fRequest['last_name'];?></span>
                                                        </td>
                                                        <td class="text-center">
                                                        <select name="userLevel">
                                                        <?php 
                                                            $sqlLevel = "SELECT * FROM user_level";
                                                            $queryLevel = mysqli_query($conn, $sqlLevel)or die($sqlLevel);
                                                            $totalLevel = mysqli_num_rows($queryLevel);
                                                            $fL = mysqli_fetch_assoc($queryLevel);
                                                        ?>
                                                            <option value="3" selected>Set: none<?php echo $f['level'];?></option>
                                                        <?php   
                                                            $sqlLevel = "SELECT * FROM user_level";
                                                            $queryLevel = mysqli_query($conn, $sqlLevel)or die($sqlLevel);
                                                            $totalLevel = mysqli_num_rows($queryLevel);
                                                            if($totalLevel > 0){
                                                                    while($fLevel = mysqli_fetch_assoc($queryLevel)){ ?>
                                                                        <option value="<?php echo $fLevel['id'];?>"><?php echo $fLevel['level'];?></option>
                                                            <?php } } ?>    
                                                        </select>
                                                        
                                                        </td>
                                                        <td>
                                                            <?php echo date("Y-m-d", strtotime($fRequest['dataReg']));?>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="label label-default"><?php echo $fRequest['Request'];?></span>
                                                        </td>
                                                        <td> 
                                                            <span ><?php echo $fRequest['email'];?></span>
                                                        </td>
                                                        <td class="text-center" style="width: 20%;">
                                                            <button class="btn btn-outline-light" type="submit" name="acceptMember">
                                                                <span class="fa-stack btn-outline-success">
                                                                    <i class="fa fa-square fa-stack-2x btn-outline-success"></i>
                                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                            </button>
                                                            <button class="btn btn-outline-light" type="submit" id="deleteBt" name="denyMember">
                                                                <span class="fa-stack btn-outline-danger">
                                                                    <i class="fa fa-square fa-stack-2x btn-outline-danger"></i>
                                                                    <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                            </button>    
                                                        </td>
                                                    </form>
                                                </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>