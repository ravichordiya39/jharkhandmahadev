<fieldset>
    <div class="form-group">
        <label for="title">Title *</label>
          <input type="text" name="title" value="<?php echo $edit ? $customer['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "title" >
    </div> 
    <div class="form-group">
        <label for="title">Tagline *</label>
          <input type="text" name="tagline" value="<?php echo $edit ? $customer['tagline'] : ''; ?>" placeholder="Tagline" class="form-control" required="required" id = "tagline" >
    </div> 
    <div class="form-group">
        <label for="price">Price *</label>
          <input type="number" name="price" value="<?php echo $edit ? $customer['price'] : ''; ?>" placeholder="price" class="form-control" required="required" id = "price" >
    </div> 
    <div class="form-group">
        <label for="banner">Banner *</label>
          <input type="file" name="banner" class="form-control" id = "banner" >
    </div> 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>