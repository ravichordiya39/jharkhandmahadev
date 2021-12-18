<fieldset>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="title">Title *</label>
                  <input type="text" name="title" value="<?php echo $edit ? $customer['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id = "title" >
            </div> 
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="title">Slug *</label>
                  <input type="text" name="slug" value="<?php echo $edit ? $customer['slug'] : ''; ?>" placeholder="Slug" class="form-control" required="required" id = "slug" >
            </div> 
        </div>
     </div>    

    <div class="form-group">
        <label for="content">Content *</label>
        <textarea id="ckeditor" name="content" placeholder="Content" class="form-control ckeditor"><?php echo ($edit)? $customer['content'] : ''; ?></textarea>
    </div> 
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="banner">Header Banner * (1200 X 400)</label>
                <input type="file" name="banner" class="form-control" id = "banner" >
            </div> 
        </div>
        <div class="col-sm-4">
            <?php 
            if($edit && !empty($customer['banner']))
            {
                echo '<a href="'.SITE_URL.'/jkmadmin/uploads/banner/'.$customer['banner'].'" target="_blank"><img src="./uploads/banner/'.$customer['banner'].'" width="200px"></a>';
            }
            ?>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Page Type</label>
            <select name="page_type" class="form-control">
              <option <?php if(isset($customer['page_type']) && $customer['page_type']=='sidebar'){echo 'selected';}?> value="sidebar">Sidebar</option>
              <option <?php if(isset($customer['page_type']) && $customer['page_type']=='fullwidth'){echo 'selected';}?> value="fullwidth">Full Width</option>
            </select>
          </div>
        </div>
    </div>        

    <div class="form-group">
        <label for="title">Meta Title *</label>
          <input type="text" name="meta_title" value="<?php echo $edit ? $customer['meta_title'] : ''; ?>" placeholder="Meta Title" class="form-control" required="required" id = "meta_title" >
    </div> 

    <div class="form-group">
        <label for="content">Meta Description *</label>
          <textarea name="meta_description" placeholder="Meta description" class="form-control" id="meta_description"><?php echo ($edit)? $customer['meta_description'] : ''; ?></textarea>
    </div> 
   

  <div class="panel panel-default">
    <div class="panel-heading"><h4 style="margin:0px;">Upload Sidebar Banner</h4></div>
    <div class="panel-body">
        <p><b>Note:</b> Sidebar banner size less then 1MB and width less then 500px</p>
       <div class="row">
          
          <div class="col-md-6">
            <div class="row">
              <div class="col-sm-6">
                 <div class="form-group">
                    <label>Banner 1</label>
                    <input type="file" name="side_banner1" class="form-control">                     
                  </div>
               </div> 
               <div class="col-sm-6">
                <?php 
                    if($edit && !empty($customer['side_banner1']))
                    {
                      echo '<a href="./uploads/banner/'.$customer['side_banner1'].'" target="_blank"><img src="./uploads/banner/'.$customer['side_banner1'].'" height="60px"></a>';
                    }
                    ?>
                </div>
             </div>
          </div> 

          <div class="col-md-6">
            <div class="row">
              <div class="col-sm-6">
                 <div class="form-group">
                    <label>Banner 2</label>
                    <input type="file" name="side_banner2" class="form-control">
                </div>
               </div> 
               <div class="col-sm-6">
                <?php 
                    if($edit && !empty($customer['side_banner2']))
                    {
                      echo '<a href="./uploads/banner/'.$customer['side_banner2'].'" target="_blank"><img src="./uploads/banner/'.$customer['side_banner2'].'" height="60px"></a>';
                    }
                    ?>
                </div>
             </div>
          </div> 

          <div class="col-md-6">
            <div class="row">
              <div class="col-sm-6">
                 <div class="form-group">
                    <label>Banner 3</label>
                    <input type="file" name="side_banner3" class="form-control">
                </div>
               </div> 
               <div class="col-sm-6">
                <?php 
                    if($edit && !empty($customer['side_banner3']))
                    {
                      echo '<a href="./uploads/banner/'.$customer['side_banner3'].'" target="_blank"><img src="./uploads/banner/'.$customer['side_banner3'].'" height="60px"></a>';
                    }
                    ?>
                </div>
             </div>
          </div> 
       </div>
     </div>
    </div>  

    <div class="form-group text-right">      
        <button type="submit" class="btn btn-success" >Save 
        <span class="glyphicon glyphicon-send"></span></button>
    </div>
    <br><br>            
</fieldset>
<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>