<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
        public $menu = array();
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
        
        public $title = '';
        public $meta_descr = '';
        public $meta_keywords = '';
	public $certificate;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $location = '';
        public function beforeRender($view){
            $this->setSeo(); 
            parent::beforeRender($view);
            return true;
        }
	public function init(){
	  $this->certificate = Yii::app()->params['file_path'].Certificate::model()->findbyPk(1)->name;
          
          $this->menu['main'] = '';
          $this->menu['news'] = '';
          $this->menu['advice'] = '';
          $this->menu['file'] = '';
          $this->menu['contact'] = '';
          
          switch(Yii::app()->request->requestUri) {
              
              case '': $this->menu['main'] = 'active'; break;
              case '/news': $this->menu['news'] = 'active'; break;
              case '/advice': $this->menu['advice'] = 'active'; break;
              case '/file': $this->menu['file'] = 'active'; break;
              case '/contact': $this->menu['contact'] = 'active'; break;
              default: $this->menu['main'] = 'active'; break;
              
          }
          
	  parent::init();
          
	}
        public function setSeo(){
            $this->pageTitle = $this->title;
            Yii::app()->clientScript->registerMetaTag($this->meta_keywords, 'keywords');
            Yii::app()->clientScript->registerMetaTag($this->meta_descr, 'description');
        }
}