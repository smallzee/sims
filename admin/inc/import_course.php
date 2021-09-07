<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Department</label>
        <select name="department" id="" class="select2_single form-control" required>
            <?php
                $sql = $db->query("SELECT * FROM department ORDER BY `name` ASC");
                while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $rs['id']; ?>"><?php echo $rs['name'];?></option>
                    <?php
                }

                $sql->closeCursor();
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">Semester</label>
        <select name="semester" id="" class="form-control" required>
            <option value="First">First Semester</option>
            <option value="Second">Second Semester</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Attach File</label>
        <input type="file" name="file" required accept=".xlsx">
        <p>
            <a href="sample.xlsx" target="_blank">View Sample</a>
        </p>
    </div>

    <div class="form-group">
        <input type="submit" name="ok-import" class="btn btn-success" value="Import!">
    </div>
</form>