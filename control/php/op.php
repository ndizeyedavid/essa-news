<?php

sleep(2);

$cont = $_GET['cont'];

if ($cont == "add") {
?>
    <h2>New Story</h2>

    <form action="php/new_story.php" method="POST" enctype="multipart/form-data">
        <div class="input-container">
            <center>
                <img src="images/profile-1.jpg" alt="dummy" class="preview" id="profilePreview">
                <br>
                <button type="button" onclick="document.querySelector('#fileUp').click()">Upload</button>
            </center>
            <input type="file" name="img" id="fileUp" onchange="upd(event)" hidden>
        </div>
        <div class="comb-2">
            <div class="input-container">
                <label>Title</label>
                <input type="text" name="title">
            </div>
            <div class="input-container">
                <label>Category</label>
                <select name="category">
                    <option value="Social">Social</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Sport">Sport</option>
                    <option value="Education">Education</option>
                </select>
            </div>
        </div>
        <div class="input-container"><label>Express Your mind: </label><textarea name="story"></textarea></div>

        <input type="submit" value="Post" name="submit">
    </form>
<?php
}
if ($cont == "update") {
    include "include.php";
?>
    <h2>Update Story</h2>

    <?php
    $id = $_GET['id'];
    $fetch = mysqli_query($con, "SELECT * FROM english WHERE id = '{$id}'");
    $data = mysqli_fetch_assoc($fetch);
    ?>
    <form action="php/update_story.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-container">
            <center>
                <img src="images/<?php echo $data['image']; ?>" alt="dummy" class="preview" id="profilePreview">
                <br>
                <button type="button" onclick="document.querySelector('#fileUp').click()">Upload</button>
            </center>
            <input type="file" name="img" id="fileUp" onchange="upd(event)" hidden>
        </div>
        <div class="comb-2">
            <div class="input-container">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $data['title']; ?>">
            </div>
            <div class="input-container">
                <label>Category</label>
                <select name="category">
                    <?php
                    echo "<option value='$data[subject]'>" . $data['subject'] . "</option>";
                    ?>
                    <option value="Social">Social</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Sport">Sport</option>
                    <option value="Education">Education</option>
                </select>
            </div>
        </div>
        <div class="input-container"><label>Express Your mind: </label><textarea name="story"><?php echo $data['Full_news']; ?></textarea></div>

        <input type="submit" value="Update" name="submit">
    </form>

<?php } ?>