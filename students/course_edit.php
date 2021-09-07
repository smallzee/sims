<br><br>
<h3>Edit Courses</h3>
<form action="" method="post" role="form">

    <table class="table" id="tables">
        <thead>
        <tr>
            <th>Sn</th>
            <th>Code</th>
            <th>Level</th>
            <th>Title</th>
            <th>Unit</th>
            <th>Mark</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $sn = 0;

        while($rs = $course_list->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?php echo ++$sn;?></td>
                <td><?php echo course($rs['course'],"code");?></td>
                <td><?php echo $rs['level'];?></td>
                <td><?php echo course($rs['course'],"title");?></td>
                <td><?php echo course($rs['course'],"unit");?></td>
                <td>
                    <input type="checkbox" name="id[]" class="checkbox" value="<?php echo $rs['course'];?>">
                </td>
            </tr>
            <?php
        }

        ?>
        </tbody>
    </table>

    <div class="form-group">
        <input type="submit" name="ok-delete" class="btn btn-danger" value="Remove Selected">
    </div>
</form>