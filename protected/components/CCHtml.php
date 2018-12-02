<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CHtml
 *
 * @author dimm
 */
class CCHtml extends CHtml {
   public static function link($text,$url='#',$htmlOptions=array())
    {

        if (Yii::app()->params['lang']!='ru')
            $url['lang'] = Yii::app()->params['lang'];

        if($url!=='')
            $htmlOptions['href']=self::normalizeUrl($url);


        self::clientChange('click',$htmlOptions);
        return self::tag('a',$htmlOptions,$text);
    }
    public static function normalizeUrl($url)
    {
      if (Yii::app()->params['lang']!='ru')
	if (!isset($url['lang']))
            $url[0] = $url[0].'/lang/'. Yii::app()->params['lang'];
	if ($url[0]!='/')
	  return CHtml::normalizeUrl($url);
	else
	  return $url[0];
    }
    public static function ajaxSubmitButton($text,$url,$ajaxOptions=array(),$htmlOptions=array())
    {
        if (Yii::app()->params['lang']!='ru')
            $url['lang'] = Yii::app()->params['lang'];
        return CHtml::ajaxSubmitButton($text, $url, $ajaxOptions,$htmlOptions);
    }
}

?>
