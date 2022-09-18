<?php
/*
** Template Name: Add Post From Frontend
*/
get_header();
?>
<div class="container mt-5 mb-5">

<div class="row">

<div class="col-sm-12">
	<h3>Add New Post</h3>
	<form class="form-horizontal" name="form" method="post"  id="submitpost" enctype="multipart/form-data">
		<input type="hidden" name="ispost" value="1" />
		<input type="hidden" name="userid" value="" />
		<div class="col-md-12">
			<label class="control-label">Title</label>
			<input type="text" id="title" class="form-control" name="title" />
		</div>

		<div class="col-md-12">
			<label class="control-label">Sample Content</label>
			<textarea id="content" class="form-control" rows="8" name="sample_content"></textarea>
		</div>

		<div class="col-md-12">
			<label class="control-label">Choose model type</label>
			
			<select id="category" name="category" class="form-control">
				<?php
				
$taxonomy = 'model_type';
$catList = get_terms($taxonomy, array('hide_empty' => false));
				//$catList = get_categories();
				foreach($catList as $listval)
				{
					echo '<option value="'.$listval->term_id.'">'.$listval->name.'</option>';
				}
				?>
			</select>
		</div>

		
		<div class="col-md-12">
			<label class="control-label">Choose model category</label>
			
			<select id="model_category" name="model_category" class="form-control">
				<?php
				
$taxonomy1 = 'model_category';
$catList1 = get_terms($taxonomy1, array('hide_empty' => false));
				//$catList = get_categories();
				foreach($catList1 as $listval1)
				{
					echo '<option value="'.$listval1->term_id.'">'.$listval1->name.'</option>';
				}
				?>
			</select>
		</div>
		<div class="col-md-12">
			<label class="control-label">Upload Post Image</label>
			<input type="file" name="sample_image" class="form-control" />
			<!-- <input type="file" name="upload_attachment[]" class="form-control files" size="50" multiple="multiple" />
<?php //wp_nonce_field( 'upload_attachment', 'my_image_upload_nonce' ); ?> -->
		</div>

		<div class="col-md-12">
			<input type="submit" class="btn btn-primary" value="SUBMIT" name="submitpost"  />
		</div>
	</form>
	<div class="clearfix"></div>
</div>
</div>
</div>

<?php
$post_type = 'model';
if(is_user_logged_in())
{
	if(isset($_POST['title']))
	{
		global $current_user;
		//get_currentuserinfo();

		$user_login = $current_user->user_login;
		$user_email = $current_user->user_email;
		$user_firstname = $current_user->user_firstname;
		$user_lastname = $current_user->user_lastname;
		$user_id = $current_user->ID;

		$post_title = $_POST['title'];
		$sample_image = $_FILES['sample_image']['name'];
		$post_content = $_POST['sample_content'];
		$category = $_POST['category'];
		$model_category = $_POST['model_category'];
		
		$new_post = array(
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_status' => 'draft',
			//'post_name' => 'pending',
			'post_type' => $post_type
			//'post_category' => $category
		);

		//$categories = [ 'Some Category', 'Some other Category' ];
		$pid = wp_insert_post($new_post);
		

		wp_set_post_terms($pid, array($category),'model_type',true);
		wp_set_post_terms($pid, array($model_category),'model_category',true);
		
		add_post_meta($pid, 'meta_key', true);

		if (!function_exists('wp_generate_attachment_metadata'))
		{
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}
		if ($_FILES)
		{
			foreach ($_FILES as $file => $array)
			{
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK)
				{
					return "upload error : " . $_FILES[$file]['error'];
				}
				$attach_id = media_handle_upload( $file, $pid );
			}
		}
		if ($attach_id > 0)
		{
			//and if you want to set that image as Post then use:
			update_post_meta($pid, '_thumbnail_id', $attach_id);
		}

		$my_post1 = array(get_post($attach_id));
		$my_post2 = array(get_post($pid));
		$my_post = array_merge($my_post1, $my_post2);

	}
}
else
{
	echo "<h2 style='text-align:center;'>User must be login for add post!</h2>";
}
?>
<?php get_footer(); ?>
