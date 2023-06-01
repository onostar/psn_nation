<?php include "../controller/connections.php"?>
<!-- Upload paid members -->
<div id="uploadMembers" class="displays">
    <div class="add_user_form">
        <h3>Upload fellows</h3>
        <form method="POST"  id="addCatForm" action="../controller/update_fellow.php" enctype="multipart/form-data">
            <div class="inputs">
                <div class="data">
                    <label for="fellow">Upload paid members</label>
                    <input type="file" name="fellow" id="fellow">
                </div>
                
                <button type="submit" id="upload_fellow" name="upload_fellow">Upload <i class="fas fa-upload"></i></button>
            </div>
        </form>
    </div>
</div>