<div id="russianpost_block">
    <form>
        <div id="chunk">
            <label>Страна: </label><br>
            <select name="countryCode" id="countryCode">
                <option id="643">Россия</option>
                <option id="804">Украина</option>
                <option id="112">Белорусь</option>
                <option id="398">Казахстан</option>
            </select>
        </div>
        <div id="chunk">
            <label>Вид отправления: </label><br>
            <select name="viewPost" id="countryCode">
                <option id="44">EMS</option>
                <option id="23">Заказная бандероль</option>
                <option id="26">Ценная бандероль</option>
            </select>
        </div>
        <div id="chunk">
            <label>Индекс: </label><br>
            <input type="text" value="" name="index" id="index"/>
        </div>
        <div style="clear:both;">
            <?= CCHtml::ajaxSubmitButton("Рассчитать", array('russianpost/calc'),array("update"=>"#russianpost_block"),array('id'=>'calculate','name'=>'calculate','style'=>"clear:both;margin-left:5px;margin-top: 10px;font-size: 12px;width:auto;",
                            'class'=>'button button-blue',))?>
        </div>
        <br>
            
    </form>
</div>