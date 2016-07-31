<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewQuests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement( 'CREATE VIEW v_quests AS
			SELECT

				quests.id,
				quests.parent_id,
				ful_type.action,
				ful.fulfillment_amount,
				ful_type.object as fulfillment_object,
				group_concat(concat(rew.reward_amount, " ", rew_type.object)) as rewards

				from quests left join quest_fulfillments as ful
				on ful.quest_id = quests.id

				left join quest_fulfillment_types as ful_type
				on ful.fulfillment_type_id = ful_type.id

				left join quest_rewards as rew
				on rew.quest_id = quests.id

				left join quest_reward_types as rew_type
				on rew.reward_type_id = rew_type.id

				group by
					quests.id,
					quests.parent_id,
					ful_type.action,
					ful.fulfillment_amount,
					ful_type.object;
		' );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement( 'DROP VIEW IF EXISTS v_quests;' );
	}

}
