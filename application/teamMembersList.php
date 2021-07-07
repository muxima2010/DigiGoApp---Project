<?php
# http://localhost/digiGoApp/application/teamMembersList.php



?>
    <div class="container p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-box clearfix">
                                <div class="table-responsive">
                                <?php if($total > 0) {?> 
                                    <table class="table user-list">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><span>Avatar</span></th>
                                                <th class="text-center"><span>Name</span></th>
                                                <th class="text-center"><span>Level</span></th>
                                                <th ><span>Created</span></th>
                                                <th class="text-center"><span>Status</span></th>
                                                <th><span>Email</span></th>
                                                <th class="text-center"><span>Edit</span></th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            while($f = mysqli_fetch_assoc($query)) { ?>
                                                <tr>
                                                    <form method="get" action="php/teamMemberSave.php">
                                                        <td class="text-center">
                                                            <img class="w-50" src="../application/assets/images/avatars/<?php echo $f['avatar'];?>" alt="User Avatar">
                                                        </td>
                                                        <td class="text-center">
                                                        <input name="idUser" value="<?php echo $f['id'];?>" hidden>
                                                        <input name="idTeam" value="<?php echo $f['idTeam'];?>" hidden>
                                                        <span ><?php echo $f['first_name'];?> <?php echo $f['last_name'];?></span>
                                                        </td>
                                                        <td class="text-center">
                                                        <select name="userLevel">
                                                        <?php 
                                                            $level = $f['level'];
                                                            $sqlLevel = "SELECT * FROM user_level WHERE level = '$level'";
                                                            $queryLevel = mysqli_query($conn, $sqlLevel)or die($sqlLevel);
                                                            $totalLevel = mysqli_num_rows($queryLevel);
                                                            $fL = mysqli_fetch_assoc($queryLevel);
                                                        ?>
                                                            <option value="<?php echo $fL ['id'];?>" selected>Set: <?php echo $f['level'];?></option>
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
                                                            <?php echo date("Y-m-d", strtotime($f['date_reg']));?>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="label label-default"><?php echo $f['status'];?></span>
                                                        </td>
                                                        <td> 
                                                            <span ><?php echo $f['email'];?></span>
                                                        </td>
                                                        <td class="text-center" style="width: 20%;">
                                                            <button class="btn btn-outline-light" type="submit" name="saveTeamMember">
                                                                <span class="fa-stack btn-outline-success">
                                                                    <i class="fa fa-square fa-stack-2x btn-outline-success"></i>
                                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                </span>
                                                            </button>
                                                            <button class="btn btn-outline-light" type="submit" id="deleteBt" name="deleteMember">
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