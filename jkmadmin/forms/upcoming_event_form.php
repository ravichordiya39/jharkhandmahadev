<fieldset>
    <div class="form-group">
        <label for="title">Title *</label>
          <input type="text" name="title" value="<?php echo $edit ? $customer['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "title" >
    </div> 
    <div class="form-group">
        <label for="title">Tagline *</label>
          <input type="text" name="tagline" value="<?php echo $edit ? $customer['tagline'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "tagline" >
    </div> 
    <div class="form-group">
        <label>Event Date</label>
        <input type="text" name="event_date" class="form-control event-date" value="<?php echo $edit ? $customer['event_date'] : ''; ?>">
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
<script type="text/javascript">
    $('.event-date').datepicker({dateFormat: 'yy-mm-dd'});
</script>