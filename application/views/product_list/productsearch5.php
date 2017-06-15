<form method="get" action="">
    <div class="form-group input-group col-lg-12  ">
            <p>
                <input type="text" class="form-control" name="title" id="title" value="<?php // echo $search['title']?>" placeholder="关键词" style="width:100px;">
                <input type="text" class="form-control" name="pid" id="pid" value="<?php // echo $search['pid']?>" placeholder="货号" style="width:100px;">
                <input type="text" class="form-control" name="size" id="size" value="<?php // echo $search['size']?>" placeholder="规格" style="width:100px;">
            <select name="saletype" id="saletype" class="form-control" style="width:120px;">
                <option value="">入库类别</option>
                <option value="回收" <?php // if($search['saletype']=='回收'){echo 'selected';} ?>>回收</option>
                <option value="寄售" <?php // if($search['saletype']=='寄售'){echo 'selected';} ?>>寄售</option>
            </select> 
            <select name="category" id="category"  class="form-control" style="width:120px;">
                <option value="">产品类别</option>
                <?php 
                    foreach($sea['category'] as $value){
                        if(isset($_GET['category']) && $_GET['category'] == $value['id']  ){
                            echo "<option value='{$value['id']}'  selected>{$value['name']}</option>";
                        } else {
                            echo "<option value='{$value['id']}'>{$value['name']}</option>";
                        }
                    } 
                ?>

            </select>
                <select name="storeid" id="storeid" class="form-control" style="width:120px;">
                    <option value="">所属仓库</option>
                        <?php 
                            foreach ($sea['store'] as $key => $value) {
                                if(isset($_GET['storeid']) && $_GET['storeid'] == $value['id']  ){
                                    echo "<option value='{$value['id']}'  selected>{$value['name']}</option>";
                                } else {
                                    echo "<option value='{$value['id']}'>{$value['name']}</option>";
                                }
                            }
                        ?> 
                </select>
                <select name="status" id="status" class="form-control" style="width:120px;">
                    <option value="">库存状态</option>
                        <?php 
                            foreach ($sea['product_status'] as  $value) {
                                if(isset($_GET['status']) && $_GET['status'] == $value['id']  ){
                                    echo "<option value='{$value['id']}'  selected>{$value['name']}</option>";
                                } else {
                                    echo "<option value='{$value['id']}'>{$value['name']}</option>";
                                }
                            }
                        ?> 
                </select>
                <select name="cityid" id="cityid" class="form-control" style="width:120px;">
                    <option value="">所在城市</option>
                        <?php 
                            foreach ($sea['city'] as $key => $value) {
                                if(isset($_GET['cityid']) && $_GET['cityid'] == $value['id']  ){
                                    echo "<option value='{$value['id']}'  selected>{$value['name']}</option>";
                                } else {
                                    echo "<option value='{$value['id']}'>{$value['name']}</option>";
                                }
                            }
                        ?> 
                </select>

    </div>
    <div class="form-group input-group col-lg-12  ">
        <input type="text" class="form-control" name="receiver" id="receiver" value="<?php // echo $search['receiver']?>" placeholder="收货人" style="width:100px;">                                   
            <select class="form-control" name="agentid" id="agentid" style="width:120px;">
                <option value="">代理商</option>
                    <?php 
                        foreach ($sea['user'] as $key => $value) {
                            if(isset($_GET['agentid']) && $_GET['agentid'] == $value['id']  ){
                                echo "<option value='{$value['id']}' selected>{$value['fullname']}</option>";
                            } else {
                                echo "<option value='{$value['id']}'>{$value['fullname']}</option>";
                            }
                        }
                    ?> 
            </select>


       <input type="text" class="form-control" name="owner" id="owner" value="<?php // echo $search['owner']?>" placeholder="客户来源" style="width:100px;">
       <input type="text" class="form-control" name="startday" id="startday" value="<?php // echo $search['startday']?>" placeholder="开始日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
       <input type="text" class="form-control" name="endday" id="endday" value="<?php // echo $search['endday']?>" placeholder="结束日期 如：<?php echo date('Y-m-d',time())?>" style="width:200px;">
        <select name="havephoto" id="havephoto" class="form-control" style="width:120px;">
                <option value="">是否拍照</option>
                 <option value="">全部</option>
                <option value="1" <?php // if($search['havephoto']=='1'){echo 'selected';} ?>>是</option>
                <option value="0" <?php // if($search['havephoto']=='0'){echo 'selected';} ?>>否</option>
        </select> 
      </div>

     <div class="form-group input-group col-lg-12  ">
        <select name="payment" id="payment" class="form-control" style="width:120px;">
            <option value="">付款方式</option>
                <?php 
                    foreach ($sea['sale_payment'] as $key => $value) {
                        if(isset($_GET['payment']) && $_GET['payment'] == $value['id']  ){
                            echo "<option value='{$value['id']}' selected>{$value['name']}</option>";
                        } else {
                           echo "<option value='{$value['id']}'>{$value['name']}</option>";
                        }
                    }
                ?> 
                                      </select> 
        <!--===================-->
        <select name="datetime_sort" id="datetime_sort" class="form-control" style="width:150px;">
                    <option value="">按入库日期排序</option>
                    <option value="1">逆序</option>
                    <option value="2">正序</option>
        </select>
        <select name="costprice_sort" id="costprice_sort" class="form-control" style="width:150px;">
                    <option value="">按成本价排序</option>
                    <option value="1">逆序</option>
                    <option value="2">正序</option>
        </select>
         <!--==================-->
                <input  class="btn btn-success " type="submit" id="searchbtn">搜索 </input>

    </div>
</form>