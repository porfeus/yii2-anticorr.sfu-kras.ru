<?php

namespace app\modules\admin\models;

use app\models\Faq;
use app\models\Theme;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form about `app\modules\admin\models\User`.
 */
class FaqSearch extends Faq
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['question', 'answer', 'subject', 'user_id'], 'string'],
			[['theme_id'], 'integer'],
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


	public function filterTheme()
	{
		return ArrayHelper::map(Theme::find()->all(), 'id', 'title');
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
		$query = Faq::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => ['id' => SORT_DESC]
			]
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->joinWith('author');

		$query
			->andFilterWhere(['like', 'id', $this->id])
			->andFilterWhere(['like', 'user.fio', $this->user_id])
			->andFilterWhere(['theme_id' => $this->theme_id])
			->andFilterWhere(['like', 'question', $this->question]);

		return $dataProvider;
	}
}
