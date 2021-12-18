<?php
if(!session_start()){session_start();}
require_once './config/config.php';
require_once 'includes/auth_validate.php';
//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
//Get current page.
$page = filter_input(INPUT_GET, 'page');
//Per page limit for pagination.
$pagelimit = 20;
if (!$page) {   $page = 1; }
// If filter types are not selected we show latest created data first

if(!$filter_col){$filter_col = "created_at";}
if (!$order_by) {  $order_by = "ASC";}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id','title','slug','price','banner','booking_start_date','booking_end_date','created_at','is_addon_product','updated_at');

//Start building query according to input parameters.
// If search string
if($search_string)
{

   $db->where('title', '%' . $search_string . '%', 'like');
    //$db->orwhere('l_name', '%' . $search_string . '%', 'like');
}
//If order by option selected
if ($order_by)
{
  $db->orderBy($filter_col, $order_by);
}

//Set pagination limit
$db->pageLimit = $pagelimit;
//Get result of the query.
$products = $db->arraybuilder()->paginate("products", $page, $select);
$total_pages = $db->totalPages;
// get columns for order filter
foreach ($products as $value) 
{
    foreach ($value as $col_name => $col_value) 
    {
      $filter_options[$col_name] = $col_name;
    }
    //execute only once
    break;
}
include_once 'includes/header.php';
?>
<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Products Manager</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
	            <a href="add_product.php?operation=create">
	            	<button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add new </button>
	            </a>
            </div>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form hidden">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>">
            <label for ="input_order">Order By</label>
            <select name="filter_col" class="form-control">
            <?php
                 foreach ($filter_options as $option) 
                 {
                    ($filter_col === $option) ? $selected = "selected" : $selected = "";
                   echo ' <option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                 }
                ?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php if ($order_by == 'Asc') { echo "selected"; }?> >Asc</option>
                <option value="Desc" <?php if ($order_by == 'Desc') { echo "selected"; } ?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>

<!--   Filter section end-->
   <div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th width="80">Banner</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Booking Start Date</th>
                <th>Booking End Date</th>                
                <th>Addon Product</th>
                <th width="120">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row) :?>
                <tr>
	                <td><?php echo $row['id'] ?></td>
                    <td><?php if(!empty($row['banner'])){ ?><img src="uploads/puja/<?php echo htmlspecialchars($row['banner']); ?>" width="60"><?php } ?> </td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['slug']); ?></td>
                    <td>Rs. <?php echo htmlspecialchars($row['price']); ?></td>	                
                    <td><?php if($row['booking_start_date']>0){echo date('d-m-Y',strtotime($row['booking_start_date']));}?></td>
                    <td><?php if($row['booking_end_date']>0){echo date('d-m-Y',strtotime($row['booking_end_date']));} ?></td>
                    <td><?php echo $row['is_addon_product'];?></td>
	                <td>
					<a href="edit_product.php?product_id=<?php echo $row['id'] ?>&operation=edit" class="btn btn-primary btn-xs" style="margin-right: 8px;"><span class="glyphicon glyphicon-edit"></span></a>
					<a href="" class="btn btn-danger btn-xs delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>" style="margin-right: 8px;"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="<?php echo SITE_URL.'/product.php?slug='.$row['slug'];?>" target="_blank" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-eye-open"></span></a>
                </td>
				</tr>
                  <!-- Delete Confirmation Modal-->
					 <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
					    <div class="modal-dialog">
					      <form action="delete_product.php" method="POST">
					      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Confirm</h4>
						        </div>
						        <div class="modal-body">
						        		<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['id'] ?>">
						          <p>Are you sure you want to delete this banner?</p>
						        </div>
						        <div class="modal-footer">
						        	<button type="submit" class="btn btn-default pull-left">Yes</button>
						         	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						        </div>
						      </div>
					      </form>
					    </div>
  					</div>
            <?php endforeach; ?>      
        </tbody>
    </table>  
 </div><!--Close responsive table-->


<!--    Pagination links-->
    <div class="text-center">
        <?php
        if (!empty($_GET)) {
            //we must unset $_GET[page] if previously built by http_build_query function
            unset($_GET['page']);
            //to keep the query sting parameters intact while navigating to next/prev page,
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        //Show pagination links
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="puja.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!-- Pagination links end-->
</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>