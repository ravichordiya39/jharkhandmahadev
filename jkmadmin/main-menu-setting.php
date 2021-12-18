<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();

include_once 'includes/header.php';
?>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.mjs.nestedSortable.js"></script>    

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="page-header">Main Menu</h1>
        </div>
        <div class="col-sm-6">  
         <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="menu.php">Menu Manager</a></li>
          <li>Main Menu</li>
        </ul> 
      </div> 
      
    </div>
    <?php include('./includes/flash_messages.php') ?>

    <div class="panel panel-default">
        <div class="panel-heading">Main Menu</div>
        <div class="panel-body">
        <?php 
          $sql ="select m.*,p.title,p.slug from menu as m,pages as p where p.id=m.page_id and location='top' and parent_id='0' order by position asc";
          $res = $db->query($sql);         
          if($res && count($res)>0)
          {
             echo '<ol class="main-menu-ul sortable">';
             foreach ($res as $menuitem) 
             {
                echo '<li id="list_'.$menuitem['page_id'].'" data-id="'.$menuitem['page_id'].'">';
                echo '<div><i class="fa fa-arrows"></i> '.$menuitem['title'].'</div>';
                $parentId = $menuitem['page_id'];                
                //Get Submenu
                $sql1 ="select m.*,p.title,p.slug from menu as m,pages as p where p.id=m.page_id and location='top' and parent_id='$parentId' order by sp_position asc";
                $subres = $db->query($sql1);
                if($subres && count($subres)>0)
                {
                  echo '<ol>'; 
                  foreach ($subres as $submenu) 
                  {
                    echo '<li  id="list_'.$submenu['page_id'].'" data-id="'.$submenu['page_id'].'">';
                    echo '<div><i class="fa fa-arrows"></i> '.$submenu['title'].'</div>';
                    echo '</li>';   
                  }  
                  echo '</ol>';
                }
                echo '</li>';
              }
             echo '</ol>';
           }
          ?> 
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-success" id="save-menu">Save Setting</button>
        </div>
    </div>
    
</div>
<!--Main container end-->
<script type="text/javascript">
    $(document).ready(function()
    {
       $('.sortable').nestedSortable({
          handle: 'div',
          items: 'li',
          toleranceElement: '> div',
          maxLevels:2,
        });


        $('#save-menu').click(function(e)
        {
            arraied = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
            if(arraied)
            {
                $.ajax({
                    url:'menu-ajax.php',
                    dataType:'json',
                    type:'post',
                    data:{'dataj':arraied},
                    success:function(res)
                    {
                       if(res.status=='success')
                       {
                         alert('Menu Saved Successfully');
                         location.reload();
                       }
                    }
                })
            }
           
        });

    });
</script>
<?php include_once './includes/footer.php'; ?>