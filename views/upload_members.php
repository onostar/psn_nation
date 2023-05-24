<?php include "../controller/connections.php"?>
<!-- Upload paid members -->
<div id="uploadMembers" class="displays">
    <div class="add_user_form">
        <h3>Upload Paid Members</h3>
        <form method="POST"  id="addCatForm" action="../controller/upload_members.php" enctype="multipart/form-data">
            <div class="inputs">
                <div class="data">
                    <label for="uploadPaid">Upload paid members</label>
                    <input type="file" name="upLoadPaid" id="uploadPaid" accept=".xls, .xlsx">
                </div>
                
                <button type="submit" id="upload" name="upload">Upload <i class="fas fa-upload"></i></button>
            </div>
        </form>
    </div>
</div>