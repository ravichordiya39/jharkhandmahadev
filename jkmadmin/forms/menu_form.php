<fieldset>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="page_id">Menu *</label>
                <select name="page_id" class="form-control" required>
                    <?php foreach ($pages as $key => $row) { ?>
                        <option value="<?= $row['id'] ?>" <?= ($edit && $customer['page_id']==$row['id']) ? 'selected' : '' ?>><?= $row['title'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">    
            <div class="form-group">
                <label for="location">Location *</label>
                <select name="location" class="form-control" required>
                    <option value="top" <?= ($edit && $customer['location']=='top') ? 'selected' : '' ?>>Top</option>
                    <option value="bottom" <?= ($edit && $customer['location']=='bottom') ? 'selected' : '' ?>>Bottom</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="position">Position *</label>
                <select name="position" class="form-control" required>
                    <?php foreach (range(0, 10) as $key => $value) { ?>
                        <option value="<?= $value ?>" <?= ($edit && $customer['position']==$value) ? 'selected' : '' ?>><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>  
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="position">Menu Type</label>
                <select name="type" class="form-control" required>
                  <option value="page" <?= ($edit && $customer['type']=='page') ? 'selected' : '' ?>>Page</option>
                  <option value="link" <?= ($edit && $customer['type']=='link') ? 'selected' : '' ?>> Link</option>
                  <option value="menu" <?= ($edit && $customer['type']=='menu') ? 'selected' : '' ?>> Menu</option>
                </select>
            </div> 
        </div>
          
       <div class="col-sm-12">
         <div class="form-group">
           <label>Custom Page Link</label>
           <input type="text" name="custom_link" class="form-control" 
           placeholder="Enter custom page url" value="<?php if($edit){echo $customer['custom_link'];}?>">
         </div>
       </div>
     </div>
     <div class="form-group text-center">
        <button type="submit" class="btn btn-success">Save <span class="glyphicon glyphicon-send"></span></button>
     </div>            
</fieldset>