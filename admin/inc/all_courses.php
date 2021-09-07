<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/13/2018
 * Time: 4:02 PM
 */
?>

<div class="table-responsive">
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete the selected courses?');">
    <table class="table" id="tables">
        <thead>
            <tr>
                <th>Sn</th>
                <th>Code</th>
                <th>Title</th>
                <th>Unit</th>
                <th>Level</th>
                <th>Semester</th>
                <th>Department</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Sn</th>
            <th>Code</th>
            <th>Title</th>
            <th>Unit</th>
            <th>Level</th>
            <th>Semester</th>
            <th>Department</th>
            <th>&nbsp;</th>
        </tr>
        </tfoot>

        <tbody>
        <?php
            $sn = 0;
            $sql = $db->query("SELECT * FROM course_pool ORDER BY department ASC, title ASC");
            while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td><?php echo ++$sn;?></td>
                        <td><?php echo $rs['code'];?></td>
                        <td><?php echo $rs['title'];?></td>
                        <td><?php echo $rs['unit'];?></td>
                        <td><?= $rs['level'] ?></td>
                        <td><?php echo $rs['semester'];?></td>
                        <td><?php echo dept($rs['department']);?></td>
                        <td>
                            <a href="course.php?act=edit&id=<?php echo $rs['id']; ?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
                            <input type="checkbox" name="id[]" value="<?php echo $rs['id'];?>">
                        </td>
                    </tr>
                <?php
            }
            $sql->closeCursor();
        ?>
        </tbody>
    </table>

        <div class="form-group">
            <input type="submit" class="btn btn-danger btn-block" name="ok-delete" value="Delete Selected Courses">
        </div>
    </form>
    </div>
</div>
