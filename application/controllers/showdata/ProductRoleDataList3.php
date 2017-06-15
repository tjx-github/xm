<?php
#3代理商  喵的继承不了CI_Controller
//class ProductRoleDataList3  implements InterfaceProductListShow {
class ProductRoleDataList3  extends ProductAbstract {
    use Trait_;
    public  function x() {
        
    }
    public function GetSearchBlock() {
//        parent::GetSearchBlock($TableName);
        echo "覆盖";
    }

    public  function showviewdata() {
        $this->GetSearchBlock();
//       $d=new model\model();
//       print_r($d->i());
       return $this->ci->load->view("product_list/t");
        
        
        
        
    }

}
