<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* MODEL */
use common\models\Media as MediaModel;


class Media extends MediaModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'media_author', 'media_post_id'], 'integer'],
            [['media_title', 'media_excerpt', 'media_content', 'media_date', 'media_modified', 'media_slug', 'media_mime_type','post_title'], 'safe'],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MediaModel::find()->from(['media' => $this->tableName()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'   => ArrayHelper::merge($dataProvider->sort->attributes, [
                'username' => [
                    'asc'   => ['username' => SORT_ASC],
                    'desc'  => ['username' => SORT_DESC],
                    'label' => 'Author',
                    'value' => 'username'
                ],
            ]),
            'defaultOrder' => ['id' => SORT_DESC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'                  => $this->id,
            'media_author'        => $this->media_author,
            'media_post_id'       => $this->media_post_id,
        ]);

        $query->andFilterWhere(['like', 'media_title', $this->media_title])
            ->andFilterWhere(['like', 'media_excerpt', $this->media_excerpt])
            ->andFilterWhere(['like', 'media_content', $this->media_content])
            ->andFilterWhere(['like', 'media_slug', $this->media_slug])
            ->andFilterWhere(['like', 'media_mime_type', $this->media_mime_type])
            ->andFilterWhere(['like', 'media_date', $this->media_date])
            ->andFilterWhere(['like', 'media_modified', $this->media_modified])
            ->andFilterWhere(['like', 'post.post_title', $this->post_title]);

        return $dataProvider;
    }
}