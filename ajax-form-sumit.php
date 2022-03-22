<script>
            jQuery('#classicform').submit(function(){
                //alert("test submit");
                event.preventDefault();
                //alert("test ajax");
                var link ="<?php echo admin_url('admin-ajax.php');?>";
                //alert(link);
                var form=jQuery("#classicform").serialize();
                var formData=new FormData;
                formData.append('action','contact_us');
                formData.append('contact_us',form);
                jQuery.ajax({
                    url:link,
                    data:formData,
                    type:'post',
                    processData:false,
                    contentType:false,
                    success:function(result){
                        jQuery('#classicform')[0].reset();
                        jQuery('#result_msg').html('<span class="'+result.success+'">'+result.data+'</span>')
                        //alert(result);
                    }
                });
            });

        </script>


//ajax form data submit
add_action('wp_ajax_contact_us','ajax_contact_us');
function ajax_contact_us(){
    //wp_send_json_success('test');
    $arr = [];
    wp_parse_str($_POST['contact_us'],$arr);
   // echo '<pre>';
   // print_r($arr);
   global $wpdb;
   global $table_prefix;
   $table_name = $table_prefix.'contact_us';
   //echo $table_name;
   $result=$wpdb->insert($table_name,[
    "fname"=>$arr['fname'],
    "lname"=>$arr['lname'],
    "email"=>$arr['email'],
    "subj"=>$arr['subj']
   ]);
   if($result>0){
    wp_send_json_success("data Inserted");
   }else{
    wp_send_json_error("data not inserted");
   }
   
}



        <form id="classicform">
            <input type="text" name="fname" placeholder="fname" class="form-control">
            <input type="text" name="lname" placeholder="lname" class="form-control">
            <input type="email" name="email" placeholder="email" class="form-control">
            <input type="text" name="subj" placeholder="subj" class="form-control">
            <button type="submit" class="btn btn-primary">Submit</button>
            
        <div id="result_msg"></div>
        </form>
