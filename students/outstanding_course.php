<?php
    //get list my courses and save it into an array
    $my_course_list = array();
    $me = $_SESSION['matric'];
    $session = settings("session");
    $semester = settings("semester");
    $course_list_sql = $db->query("SELECT course FROM course_reg WHERE matric = '$me' AND `session`  ='$session' AND semester = '$semester' AND `level` = '".user('level')."'");
    while($course_list_rs = $course_list_sql->fetch(PDO::FETCH_ASSOC)){
        $my_course_list[] = $course_list_rs['course'];
    }
    $course_list_sql->closeCursor();

    //get the list of outstanding courses

    $level = user("level");
    $dept = user('department');
    $dept_id = dept_id($dept);

    switch ($level){
        case 'ND 1 FT':
            $level_1 = "ND 11 FT";
            $sql = $db->query("SELECT * FROM course_pool WHERE `level` = '$level_1' AND department = '$dept_id' AND semester = '$semester'");
            break;
        
        case 'ND 2 FT':
            $level_1 = "ND 1 FT";
            $level_2 = "ND 1 FTs";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
            break;

        case 'HND 2 FT':
            $level_1 = "HND 1 FT";
            $level_2 = "ND 1 FTs";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
            break;

        case 'HND 2 DPT':
            $level_1 = "HND 1 DPT";
            $level_2 = "ND 111 FT";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
        break;


        case 'ND 2 PT':
            $level_1 = "ND 1 PT";
            $level_2 = "ND 1 PT";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
            break;

        case 'ND 2 DPT':
            $level_1 = "ND 1 DPT";
            $level_2 = "ND 1 DPT";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
            break;

        case 'ND 3 PT':
            $level_1 = "ND 1 PT";
            $level_2 = "ND 2 PT";
            $level_3 = "ND 3 PT";
            $sql = $db->query("SELECT * FROM course_pool WHERE (`level` = '$level_1' OR `level` = '$level_2' OR `level` = '$level_3') AND department = '$dept_id' AND semester = '$semester' ORDER BY `level` ASC");
            break;


        
        default:
            break;
    }

    //var_dump($my_course_list);
?>

<div class="modal fade" id="modal-outstanding">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register Outstanding Courses</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form">
                    <table class="table" id="tables">
                        <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $level = user('level');
                        $dept = user('department');
                        $sn = 0;

                        while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                            $course_id = $rs['id'];
                            if(in_array($course_id,$my_course_list))
                                continue;
                            ?>
                            <tr>
                                <td><?php echo ++$sn;?></td>
                                <td><?php echo $rs['code'];?></td>
                                <td><?php echo $rs['title'];?></td>
                                <td><?php echo $rs['level'];?></td>
                                <td>
                                    <input type="checkbox" name="id[]" class="checkbox" value="<?php echo $rs['id'];?>">
                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <input type="submit" name="ok-reg" class="btn btn-info" value="Register Selected">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
