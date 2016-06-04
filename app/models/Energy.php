<?php

class Energy extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_energy';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at', 'user');

	protected $fillable = array('user_id');

	public function user() {
      return $this->belongsTo('User');
  }

	public function calculate($energy_input) {
		$old_values = DB::select('select
																current,
																max
														  from users_energy
														  where id='.$this->attributes['id'].';');

		$this->attributes['current'] = $energy_input;
		$this->save();

		if($old_values[0]->current == $old_values[0]->max) {
	 		$new_energy_recharge_start = time();
		}
		else {
			$results = DB::select('select
																	case when energy + new_energy < max_energy then energy + new_energy else max_energy end as new_energy,
																	energy as old_energy,
																	max_energy,
																	seconds_left
														 from users
														 inner join (
																select
																		id,
																		user_id,
																		current as energy,
																		max as max_energy,
																		floor(time_to_sec(timediff(NOW(), last_recharge)) / 300) as new_energy,
																		time_to_sec(timediff(NOW(), last_recharge)) - (floor(time_to_sec(timediff(NOW(), last_recharge)) / 300) * 300) seconds_left
																from users_energy
														 ) as energy
																	on users.id = energy.user_id
														 where energy.id='.$this->attributes['id'].';');

			$new_energy_recharge_start = time() - $results[0]->seconds_left;
			$this->attributes['current'] = $results[0]->new_energy;
		}

	  $this->attributes['last_recharge'] = date('Y-m-d H:i:s', $new_energy_recharge_start + 7200 /* two hours */);

		$this->save();

		return $this;
	}
}
