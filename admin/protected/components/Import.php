<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import
 *
 * @author dimm
 */
class Import {
    
    public $result = array();
    
    public function __construct() {
    
        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
              spl_autoload_unregister(array('YiiBase','autoload'));     
              include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
              include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/IOFactory.php');
               
              $objPHPExcel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT']."import/12.xls");
              spl_autoload_register(array('YiiBase','autoload'));
               
              $aSheet = $objPHPExcel->getActiveSheet();
              $rows = $aSheet->getRowIterator();
               
              $data = array();
               
              foreach($rows as $index=>$row){
                   
                   if ($index==1)                       
                       continue;
                   
                   $cellIterator = $row->getCellIterator();
                   foreach($cellIterator as $cindex=>$cell){
                         
                       $text_value = $cell->getCalculatedValue();
                         
                         if (is_object($text_value)) {
                             $text_value = $text_value->getPlainText();
                             $data[$index][$cindex] = $text_value;
                         }
                         else
                            $data[$index][$cindex]=$cell->getCalculatedValue();
                         
                   }
              }
              print '<pre>';
              //print_r($data);
              $attributes = array();
              $categories = array();
              $category = array();
              $product = array();
              $articul = '';
              foreach ($data as $iindex=>$row){
                  if (in_array('Articul', $row)){
                      $row_attr = array_slice($row, 6);
                      $attributes = array();
                      foreach ($row_attr as $index=>$col){
                          if ($col!='') $attributes[] = $col;
                      }
                      //print_r($attributes);
                  }
                  else{
                      $product = array();
                      if (($row[1]!='')||($row[2]!='')||($row[0]!='')){
                          //вычисляем номер столбца где название категории не пустое
                          if ($row[0]!='') $_cell = 0;
                          elseif ($row[1]!='') $_cell = 1;
                          elseif ($row[2]!='') $_cell = 2;
                          
                          //если строка нулевая, первая, четвёртая и т.д. из последовательности строк - то это русский 
                          $shift = $iindex;$ii = 1;$count = 0;
                          while ($data[$shift-$ii][$_cell]!=''){
                              $count++;
                              $ii++;
                          }
                          
                          $bottom  = ($data[$iindex+1][0]!='')||($data[$iindex+1][1]!='')||($data[$iindex+1][2]!='');
                          if ($iindex>=1){
                            $high = ($data[$iindex-1][0]=='')&&($data[$iindex-1][1]=='')&&($data[$iindex-1][2]=='');
                          }
                          else
                            $high = true;  
                          
                          if (fmod($count,2)==0){
                          //if ($bottom&&$high){
                              $categories[] = $category;
                              $last_cat = $categories[count($categories)-1];
                              $category = array();
                              
                              //$category['ru'] = array($row[0],$row[1],$row[2]);
                              //$category['en'] = array($data[$iindex+1][0],$data[$iindex+1][1],$data[$iindex+1][2]);
                              for ($i=0;$i<=2;$i++){
                                  $category['ru'][$i] = trim($row[$i]);
                                  $category['en'][$i] = trim($data[$iindex+1][$i]);
                              }
                              $i = 0;
                              while ($row[$i]==''){
                                      $category['ru'][$i] = $last_cat['ru'][$i];
                                      $category['en'][$i] = $last_cat['en'][$i];
                                      $i++;
                              }
                              
                          }
                      }
                      
                      if ($row[3]!=''){
                          $product['articul'] = trim($row[3]);
                          $articul = $product['articul'];
                          $__lang = 'ru';
                      }
                      else {
                          //$product['articul'] = $articul;
                          $__lang = 'en';
                      }
                      
                      if ($__lang=='en') {
                          $category['products'][count($category['products'])-1]['name'][$__lang] = trim($row[4]);
                          $attr_values = array_slice($row,6);
                          if ($row[5]!='')
                                $category['products'][count($category['products'])-1]['price'] = $row[5];
                          
                          foreach ($attributes as $aindex=>$attribute){
                            $category['products'][count($category['products'])-1]['attributes'][$__lang][$attribute] = trim($attr_values[$aindex]);
                          }
                      }
                      else {
                          $product['name'][$__lang] = trim($row[4]);
                          if ($row[5]!='')
                                $product['price'] = $row[5];
                          $attr_values = array_slice($row,6);
                          
                          foreach ($attributes as $aindex=>$attribute){
                            $product['attributes'][$__lang][$attribute] = trim($attr_values[$aindex]);
                          }
                      }
                      if (!empty($product))
                        $category['products'][] = $product;
                  }
              }
              
              $categories[] = $category;
              //print_r($categories);
              print '</pre>';
              $this->result = $categories;
    }
    public function ParserCategory($tree,$parent){
      //категории
      $parent = 0;
      $id = '';
      $tree1[0] = $tree[0];
      print_r($tree);
      foreach ($tree as $current){
          $id = '';
          //описание категорий
          foreach ($current as $lang=>$description){
            if ($description=='')
                return $parent;
            $cat = Category::model()->with('cat_language')->find(
                                "cat_language.name = '$description' and parent=$parent and cat_language.id_lang=$lang"); 
            if (!empty($cat)){
                 $id = $cat->id;
                 break;
            }

          }
          if ($id==''){
            $new_cat = new Category();
            $new_cat->image ='default.jpg';
            $new_cat->parent = $parent;
            $new_cat->active = 1;
            if ($new_cat->save()){
                $this->AddCategoryDesc($new_cat->id, $current);
                $parent = $new_cat->id;
            }
            else
                print_r($new_cat->getErrors());
         }
         else{
                $parent = $id;
                print "<p>Category $description exist - $id</p>";
                //$this->AddCategoryDesc($id, $current);
         }
    }
    return $parent;
  }
  public function AddCategoryDesc($id,$current){
      foreach ($current as $lang=>$description){
          $new_desc = new CategoryLang();
          $new_desc->id_lang = $lang;
          $new_desc->name = $description;
          $new_desc->title = $new_desc->name;
          $new_desc->id = $id;
          if (!$new_desc->save())
                print_r($new_desc->getErrors());
          
          print "<p><b>New category - $new_desc->name - $id</b></p>";
      } 
  }
  public function AddProduct($category,$data){
      
      foreach($data as $ii=>$chunk){
          
          //if ($ii>1) break;
          $pr = Product::model()->findByAttributes(array('articul'=>$chunk['articul']));
          
          //если такого продукта нет
          if (empty($pr)){
              //добавляет товар
              $product = new Product();
              $product->active = 1;
              $product->articul = $chunk['articul'];
              $product->price = $chunk['price'];
              $product->available = 20;
              if ($product->save()){
                  //добавляем его названия на разных языках
                  foreach ($chunk['name'] as $lang=>$description){
                    $new_desc = new ProductLang();
                    $new_desc->id_lang = $lang;
                    $new_desc->name = $description;
                    $new_desc->id_prod = $product->id;
                    if (!$new_desc->save())
                        print_r($new_desc->getErrors());
                  }
              }
              else
                 print_r($product->getErrors());
              
              //добавляем аттрибуты к этому товару
              foreach ($chunk['attributes'] as $lang=>$attributes){
                  foreach ($attributes as $attribute=>$value){
                      if ($value!='') {
                          $attr_value = new AttributeValue();
                          $attr_value->id_lang = $lang;
                          $attr_value->id_prod = $product->id; 
                          $attr_value->id_attr = $attribute;
                          $attr_value->value = $value;
                          if (!$attr_value->save())
                              print_r($attr_value->getErrors());     
                      }
                  }
              }
              
              //добавление товара в категорию
              $prod_cat = new ProductCategory();
              $prod_cat->id_cat = $category; 
              $prod_cat->id_prod = $product->id;
              if (!$prod_cat->save())
                  print_r($prod_cat->getErrors());     
              
              print "<p><b>New product - $new_desc->name -$product->articul - $product->id</b></p>";
          }
      }
  }
}

?>
