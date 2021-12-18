<fieldset>
    <div class="form-group">
        <label for="title">Title *</label>
          <input type="text" name="title" value="<?php echo $edit ? $customer['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "title" >
    </div> 

    <div class="form-group">
        <label for="video">Video *</label>
          <input type="url" name="video" value="<?php echo $edit ? $customer['video'] : ''; ?>" class="form-control" id = "video" required>
    </div> 
    
    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>