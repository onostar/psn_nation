<?php include "../controller/connections.php"?>
<!-- Upload paid members -->
<div id="uploadMembers" class="displays">
    <div class="add_user_form">
        <h3>Upload paid members</h3>
        <form method="POST"  id="addCatForm" action="../controller/upload_members.php" enctype="multipart/form-data">
            <div class="inputs">
                <div class="data">
                    <label for="paid_member">Upload paid members</label>
                    <input type="file" name="paid_members" id="paid_members" style="background:var(--primaryColor); color:#fff">
                </div>
                
                <button type="submit" id="upload_paid" name="upload_paid">Upload <i class="fas fa-upload"></i></button>
            </div>
        </form>
    </div>
</div>