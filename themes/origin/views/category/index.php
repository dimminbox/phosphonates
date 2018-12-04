 <div class="container sectionContent">
 <div class="row">
 <? foreach($categories as $category) :?>
 <span><a href="<?=$category["url"]?>"><?=$category["name"]?></a></span><br>
 <? endforeach ; ?>
 </div>
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title"><?=$cur_category->name; ?></h1>
            <div class="flex-center">
            <?=$cur_category->bottom; ?>
            </div>
            <table class="table table-hover">

                <thead>
                <tr>
                    <th scope="row">PLEVREN®</th>
                    <?php foreach ($products as $product):?>
                        <th scope="col"><?php echo CHtml::link("$product->name",array("/phosphonate/".$product->product->url),["style"=>"color: white; font-size: 20px;"]); ?></th>
                    <? endforeach;?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($attrs as $name=>$values):?>
                <tr>
                  <th scope="row"><?=$name?></th>
                    <?php foreach ($values as $value):?>
                        <td><?=$value?></td>
                    <? endforeach;?>
                    </tr>  
                <? endforeach;?>
                
              </tbody>
            </table>
            <?=$cur_category->description?>
          </div>
        </div>
      </div>


</div>

