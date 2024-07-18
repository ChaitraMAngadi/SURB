<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
             <div class="ibox-title">
                    <h5 class="shop_title"><?=$products->name;?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>admin/products">
                            <button class="btn btn-primary">BACK</button>
                        </a>
                    </div>
                    
        <div class="col-lg-6">
            
                
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Product ID</th>
                                    <th>Cart User Details</th>
                                    <th>Is in Whistlist</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php
                                $i = 1;
                                foreach ($result as $value) {
                                    $session_id = $value->session_id;
                                    $user = $this->db->query("select * from users where id='".$value->user_id."'"); 
                                    $user_data =$this->data['user_data']= $user->row();
                                    
                                    $table = "whish_list";
                                    $this->db->select("*");
                                    $count = $this->db->where(array("product_id"=>$product_id,"user_id"=>$user_data->id))->get($table)->num_rows();
                                    
                                    if($count>0){
                                        $whist = "yes";
                                    }else{
                                        $whist = "no";
                                    }
                                    
                                    $order_count = $this->db->where(array("session_id"=>$session_id))->get("orders")->num_rows();
                                    if($order_count>0){
                                        //echo "data";  
                                      }else{
                                ?>
                                    <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?=$products->id;?></td>
                                    <td>First name : <?=$user_data->first_name;?><br/>
                                        Last name : <?=$user_data->last_name;?><br/>
                                        Email : <?=$user_data->email;?><br/>
                                        Phone number : <?=$user_data->phone;?><br/>
                                        Login time : <?=$user_data->login_time;?><br/>
                                    
                                    </td>
                                    <td><?php echo $whist;?></td>
                                 </tr>
                                 <?php
                                 
                                }
                                  $i++;
                                 }
                                   
                               
                                ?>
                            </tbody>
                            
                        </table>
                    </div>
            
        </div>
   

        
        
        <div class="col-lg-6">
            
                
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Product ID</th>
                                    <th>Whistlist User Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php
                                $j = 1;
                               
                                foreach ($whistlist as $wl) {
                                    
                                    $wl_user = $this->db->query("select * from users where id='".$wl->user_id."'"); 
                                    $wl_user_data = $wl_user->row();
                                    
                                    ?>
                                 <tr class="gradeX">
                                    <td><?= $j ?></td>
                                    <td><?=$products->id;?></td>
                                    <td>First name : <?=$wl_user_data->first_name;?><br/>
                                        Last name : <?=$wl_user_data->last_name;?><br/>
                                        Email : <?=$wl_user_data->email;?><br/>
                                        Phone number : <?=$wl_user_data->phone;?><br/>
                                        Login time : <?=$wl_user_data->login_time;?><br/>
                                    
                                    </td>
                                    
                                 </tr>
                                 <?php
                                  $j++;
                                 }
                                ?>
                            </tbody>
                            
                        </table>
                    </div>
            
        </div>

        </div>
            </div>
        </div>
    </div>
</div>















