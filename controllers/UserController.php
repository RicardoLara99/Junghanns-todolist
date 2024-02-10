<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\LoginForm;
use app\models\Todos;
use app\models\Users;
use app\models\UserSearch;
/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->id != $id) {
            return $this->goHome();
        }
        $userModel = $this->findModel($id);
        
        // Crear un DataProvider para los registros de 'todos' asociados al usuario
        $todosDataProvider = new ActiveDataProvider([
            'query' => Todos::find()->where(['id_user' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);
        
        return $this->render('view', [
            'model' => $userModel,
            'todosDataProvider' => $todosDataProvider,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) ) {
                $model->auth_key = $this->generateUniqueRandomString('auth_key');
                $model->access_token = $this->generateUniqueRandomString('access_token');
                $model->password_hash=Yii::$app->security->generatePasswordHash($model->password_hash);
                if ($model->save()) {
                    // El modelo se guardó correctamente
                    Yii::$app->session->setFlash('success', 'Thank you for registration. Please, log in.');
                    return $this->redirect(['login']);
                } else {
                    // Hubo un error al guardar el modelo
                    Yii::$app->session->setFlash('error', 'There was a problem with your registration. Please try again.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->password_hash){
                $model->password_hash=Yii::$app->security->generatePasswordHash($model->password_hash);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->password_hash = '';
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

        /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $model = new LoginForm(); 
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
    
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Generate a unique string for use in the database.
     * Trying to make the function not to return repeats
     * @param str $attribute auth_key/access_token
     * @return str random string
     */

    protected function generateUniqueRandomString($attribute, $length = 32) {
        $unique = false;
        $randomString = '';
        while (!$unique) {
            $randomString = Yii::$app->security->generateRandomString($length);
            $count = Users::find()->where([$attribute => $randomString])->count();
            if ($count == 0) $unique = true;
        }
        return $randomString;
    }
}
