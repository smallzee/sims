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

    //var_dump($my_course_list);
?>

<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register New Course</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form">
                    <table class="table" id="tables">
                        <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Unit</th>
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $level = user('level');
                        $dept = user('department');
                        $dept_id = dept_id($dept);
                        $sql = $db->query("SELECT * FROM course_pool WHERE `level` = '$level' AND department = '$dept_id' AND semester = '$semester'");
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
                                <td><?php echo $rs['unit']; ?></td>
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

                <?php
                    //check if level is not ND 1, HND 1
                    /*
                     * <option value="ND 1 FT">ND 1 FT</option>
                                    <option value="ND 1 DPT">ND 1 DPT</option>
                                    <option value="PT YR 1">PT YR 1</option>
                                    <option value="PT YR 2">PT YR 2</option>
                                    <option value="ND 2 FT">ND 2 FT</option>
                                    <option value="ND 2 DPT">ND 2 DPT</option>
                                    <option value="PT YR 2">PT YR 3</option>
                                    <option value="HND 1">HND 1</option>
                                    <option value="HND 2">HND 2</option>
                     */
                    //echo $level;
                    //exit;
                    switch ($level){
                        case '100 Level':
                            break;
                        default:
                            echo '<a class="btn btn-default" data-toggle="modal" href="#modal-outstanding">Register Outstanding Courses</a>';
                            break;
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
