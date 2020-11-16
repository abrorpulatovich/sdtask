<?php

namespace app\controllers;

use Yii;
use app\models\Sell;
use app\models\Product;
use app\models\search_models\SellSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SellController implements the CRUD actions for Sell model.
 */
class SellController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sell models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SellSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $products = Product::_all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'products' => $products
        ]);
    }

    /**
     * Displays a single Sell model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sell model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sell();
        $model->sell_date = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {

            $product_id = $model->product_id;
            $product = Product::findOne($product_id);
            $product->quantity = ($product->quantity - $model->sell_quantity);
            $product->save();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Sell model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sell model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sell model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sell the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sell::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCheckCount($product_id, $sell_quantity)
    {
        $product = Product::findOne($product_id);

        if(!$product_id) {
            $result = [
                'success' => false,
                'message' => 'Maxsulot topilmadi'
            ];
        } else {
            if($product->quantity == 0 or $product->quantity < $sell_quantity) {
                $result = [
                    'success' => false,
                    'message' => 'Omborda ushbu maxsulotdan ' . $product->quantity . ' ta qolgan'
                ];
            } 
        }
        echo json_encode($result);
    }
}
