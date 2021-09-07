<?php
    $c = $db->prepare("SELECT * FROM course_pool WHERE id = :id");
    $c->execute(array(
        'id' => $_GET['id']
    ));

    $c_rs = $c->fetch(PDO::FETCH_ASSOC);
    extract($c_rs);
    $c->closeCursor();
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Department</label>
        <select name="department" id="" class="select2_single form-control" required>
            <?php
                $sql = $db->query("SELECT * FROM department ORDER BY `name` ASC");
                while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $rs['id']; ?>" <?php if($department == $rs['id']) echo "selected";?>><?php echo $rs['name'];?></option>
                    <?php
                }

                $sql->closeCursor();
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">Semester</label>
        <select name="semester" id="" class="form-control" required>
            <option value="<?php echo $semester;?>"><?php echo $semester;?> Semester</option>
            <option value="First">First Semester</option>
            <option value="Second">Second Semester</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Level</label>
        <select name="level" id="" class="form-control select2_single" required>
            <option><?php echo $level; ?></option>
            <option value="ND 1 FT">ND 1 FT</option>
            <option value="ND 1 DPT">ND 1 DPT</option>
            <option value="ND 1 PT">PT YR 1</option>
            <option value="ND 2 PT">PT YR 2</option>
            <option value="ND 2 FT">ND 2 FT</option>
            <option value="ND 2 DPT">ND 2 DPT</option>
            <option value="ND 3 PT">PT YR 3</option>
            <option value="HND 1 FT">HND 1 FT</option>
            <option value="HND 1 DPT">HND 1 DPT</option>
            <option value="HND 2 FT">HND 1 FT</option>
            <option value="HND 2 DPT">HND 2 DPT</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Course Code</label>
        <input type="text" class="form-control" name="code" required placeholder="Course Code" value="<?php echo $code;?>">
    </div>

    <div class="form-group">
        <label for="">Course Title</label>
        <input type="text" class="form-control" name="name" required placeholder="Course Title" value="<?php echo $title;?>">
    </div>

    <div class="form-group">
        <label>Course Unit</label>
        <input type="text" name="unit" class="form-control" required="" placeholder="Course Unit" value="<?php echo $unit; ?>">
    </div>

    <div class="form-group">
        <input type="submit" name="ok-edit" class="btn btn-success" value="Update">
    </div>
</form>