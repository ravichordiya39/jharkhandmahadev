<fieldset>
    <div class="form-group">
        <label for="title">Tagline *</label>
          <input type="text" name="tagline" value="<?php echo $edit ? $customer['tagline'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "tagline" >
    </div> 
    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>