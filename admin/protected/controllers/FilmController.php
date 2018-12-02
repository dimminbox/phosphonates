<?php

class FilmController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $image_path = "../images/film/";
    public $image_ozon = "../images/ozon/";
    public $image_path_lang = "../images/language/";

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin','create', 'update','ozon','index'),
                'users' => array('dimm'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        $lang = Language::model()->findAll();
        $full_array = array();
        foreach ($lang as $key => $value) {
            $cat_desc = $model->with('language')->findAllByPk($id, array('condition' => 'language.id=' . $value['id']));
            $cat_desc_o = $model->with('cat_desc')->findAllByPk($id, array('condition' => 'id_lang=' . $value['id']));
            if (!empty($cat_desc)) {
                $full_array[] = array(
                    'id' => $cat_desc_o[0]->cat_desc->id,
                    'name' => $cat_desc_o[0]->cat_desc->name,
                    'description' => substr($cat_desc_o[0]->cat_desc->description, 0, strpos($cat_desc_o[0]->cat_desc->description, '<p><a name="short"></a></p>')),
                    'image' => $this->image_path . $cat_desc_o[0]->image,
                    'language' => $this->image_path_lang . 'ru.gif',
                );
            }
        }
        $model->full_data = $full_array;
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($language=2) {
        $model = new Film();
        $lang = Language::model()->findAll();
        $relate = new FilmLanguage();

        $style = new Style();
        $filmstyle = new Filmtostyle();

        foreach ($lang as $key => $value) {
            $model->languages[$value->attributes['id']] = $value->attributes['name'];
            if ($value->attributes['id'] == $language)
                $model->lang_select = $language;
        }
        if (isset($_POST['Film'])) {
            if (isset($_POST['Filmtostyle'])) {
                $filmstyle->id_style = $_POST['Filmtostyle']['id_style'][0];
                //fake film id for validation
                $filmstyle->id_film = 1;
            }
            $model->attributes = $_POST['Film'];
            $model->attributes = $_FILES['Film']['name'];
            $relate->attributes = $_POST['FilmLanguage'];
            $relate->id_lang = 5;
            $relate->id = 1;
            $model->data_created = date("Y:m:d H:i:s");
            if (($model->validate()) && ($relate->validate() && ($filmstyle->validate()))) {
                $upload = CUploadedFile::getInstance($model, 'image');
                $upload->saveAs($this->image_path . $upload->name);
                $flag_save = $model->save();
                if ($flag_save)
                    $this->redirect(array('view', 'id' => $model->id));
                else
                    echo 'Что то пошло не так!';
            }
        }
        $this->render('create', array(
            'model' => $model,
            'relate' => $relate,
            'filmstyle' => $filmstyle,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $language=2) {
        $list_style = array();
        $model = $this->loadModel($id);

        $lang = Language::model()->findAll();
        $relate = new FilmLanguage();

        $style = new Style();
        $filmstyle = new Filmtostyle();
        $filmstyles = Filmtostyle::model()->findAllByAttributes(array('id_film' => $id));
        foreach ($filmstyles as $fs) {
            $list_style[] = $fs->id_style;
        }
        $filmstyle->id_style = $list_style;
        $validate = true;
        foreach ($lang as $key => $value) {
            $model->languages[$value->attributes['id']] = $value->attributes['name'];
            if ($value->attributes['id'] == $language)
                $model->lang_select = $language;
        }
        $cat_desc = $model->with('cat_desc')->findByPk($id, array('condition' => 'id_lang=' . $language));

        if (!empty($cat_desc)) {

            $country_desc = array(
                'name' => $cat_desc->cat_desc->name,
                'title' => $cat_desc->cat_desc->title,
                'style' => $cat_desc->cat_desc->style,
                'description' => $cat_desc->cat_desc->description,
                'year' => $cat_desc->cat_desc->year,
                'country' => $cat_desc->cat_desc->country,
                'director' => $cat_desc->cat_desc->director,
                'actor' => $cat_desc->cat_desc->actor,
                'video' => $cat_desc->cat_desc->video,
                'meta_description' => $cat_desc->cat_desc->meta_description,
            );
            $relate->setAttributes($country_desc);
            $model->flag_update = 0;
        }
        else
            $model->flag_update = 1;

        $cat = $model->findByPk($id);
        if (isset($_POST['Film'])) {
            if (isset($_POST['Filmtostyle'])) {
                $filmstyle->id_style = $_POST['Filmtostyle']['id_style'][0];
                //fake film id for validation
                $filmstyle->id_film = 1;
            }
            $model->attributes = $_POST['Film'];
            $relate->attributes = $_POST['FilmLanguage'];
            $relate->id_lang = 5;
            $relate->id = 1;
            if ((isset($cat->image)) && ($_POST['Film']['image'] == '')) {
                $model->setAttribute('image', $cat->image);
            }
            $model->data_modified = date("Y:m:d H:i:s");
            $relate->validate();
            if (($model->validate()) && ($relate->validate()) && ($filmstyle->validate())) {
                $upload = CUploadedFile::getInstance($model, 'image');
                if (isset($upload)) {
                    $upload->saveAs($this->image_path . $upload->name);
                    $model->attributes = $_FILES['Film']['name'];
                }
                $flag_save = $model->save($validate);
               /* if ($flag_save)
                    $this->redirect(array('view', 'id' => $model->id));*/
            }
        }
        $this->render('update', array(
            'model' => $model,
            'relate' => $relate,
            'filmstyle' => $filmstyle,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Film');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    public function actionOzon($id){
        
        $result = Film::model()->with('products')->find(array('condition'=>'t.id=8'));
        $selected = array();
        foreach($result->products as $product){
            $selected[] = $product->ozon_id;
        }
        
        $url = 'kino.xml';
        $xml= simplexml_load_file($url);
        $ozons = array();
        $search = ($_POST['FilmLanguage']['ozon_search']!='') ? $_POST['FilmLanguage']['ozon_search'] : $_POST['FilmLanguage']['name'];
        if ($search!=''){
            foreach ($xml->shop->offers->offer as $item) {
                if (substr_count(
                                 mb_strtolower($item->title, 'utf-8'), 
                                 mb_strtolower($search,'utf-8')
                                ) >0 ) {

                    $id = (string) $item->attributes()->id;
                    $picture = file_get_contents($item->picture);
                    $path = $this->image_ozon.$id.'.jpg';
                    file_put_contents($path, $picture);

                    $url = (string) $item->url;
                    preg_match('/(.+)\?from\=partner/', $url,$matches);
                    $url = $matches[1].'?from=dimspace';

                    $ozons[] = array('title' => (string) $item->title,'id' => $id,
                                     'picture' => $id,'url'=> $url,
                                     'price' => (string) $item->price);
                }
            }
             $this->renderPartial('ozon',array('products'=>$ozons,'selected' => $selected));
        }
        else 
            echo '<b>Введите название фильма</b>';
    }

    public function actionAdmin() {
        $model = new Film('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Film']))
            $model->attributes = $_GET['Film'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Film::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'country-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
