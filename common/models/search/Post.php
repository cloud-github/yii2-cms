<?php
/**
 * @file    Post.php.
 * @date      23/2/2016
 * @time      5:03 AM
 * @author  Mahesh Joshi <mahesh.connectnepal@gmail.com>
 * @copyright Copyright (c) 2015 Yii2-cms
 * @license   http://www.yii2-cms.com/license/
 */

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* MODEL */
use common\models\Post as PostModel;
/**
 * Post represents the model behind the search form about `common\models\cms\Post`.
 *
 * @package common\models\search
 * @author  Agiel K. Saputra <13nightevil@gmail.com>
 * @since   1.0
 */
class Post extends PostModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_author', 'post_type'], 'integer'],
            [['post_title', 'post_excerpt', 'post_content', 'post_date', 'post_modified', 'post_status', 'post_slug', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array       $params
     * @param int         $post_type
     * @param null|string $user
     *
     * @return ActiveDataProvider
     */
    public function search($params, $post_type, $user = null)
    {
        $query = PostModel::find();
        $query->innerJoinWith(['postAuthor']);
        $query->andWhere(['post_type' => $post_type]);

        if ($user) {
            $query->andWhere(['post_author' => $user]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => ArrayHelper::merge($dataProvider->sort->attributes, [
                'username' => [
                    'asc'   => ['username' => SORT_ASC],
                    'desc'  => ['username' => SORT_DESC],
                    'label' => 'Author',
                    'value' => 'username'
                ],
            ]),
            'defaultOrder' => [ 'id' => SORT_DESC ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'                 => $this->id,
            'post_author'        => $this->post_author,
            'post_type'          => $this->post_type,
        ]);

        $query->andFilterWhere(['like', 'post_title', $this->post_title])
            ->andFilterWhere(['like', 'post_excerpt', $this->post_excerpt])
            ->andFilterWhere(['like', 'post_content', $this->post_content])
            ->andFilterWhere(['like', 'post_status', $this->post_status])
            ->andFilterWhere(['like', 'post_slug', $this->post_slug])
            ->andFilterWhere(['like', 'post_date', $this->post_date])
            ->andFilterWhere(['like', 'post_modified', $this->post_modified])
            ->andFilterWhere(['like', 'username', $this->username]);


        return $dataProvider;
    }
}