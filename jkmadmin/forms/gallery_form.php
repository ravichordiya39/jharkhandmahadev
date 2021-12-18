<fieldset>
    <div class="form-group">
        <label for="title">Title *</label>
          <input type="text" name="title" value="<?php echo $edit ? $customer['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "title" >
    </div> 
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="banner">Banner *</label>
              <input type="file" name="banner" class="form-control" id = "banner" <?php echo $edit ? '' : 'required'; ?>><br>
             
          </div> 
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="banner">Home Page Image</label>
                <select name="homepage" class="form-control">
                    <option value="0">No</option>
                    <option <?php if($edit && $customer['homepage']==1){echo 'selected';}?> value="1">Yes</option>
                </select>                
            </div> 
        </div>
    </div>  
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                  <?php if($edit){?>
               <img src="<?php echo GALLERY_URL.$customer['banner'] ?>" alt="" width="150px" class="img-responsive"/> <?php } ?>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group text-right">
            <label></label>
            <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
        </div>    
       </div>         
</fieldset>