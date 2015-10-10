<?php

class RocketComponent extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'rocket_components';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at', 'myRocketComponentModelMms');

	protected $fillable = array('rocket_id', 'selectedRocketComponentModelMm');

	public function rocket()
  {
      return $this->belongsTo('Rocket');
  }

  public function selectedRocketComponentModelMm()
  {
      return $this->hasOne('RocketComponentModelMm');
  }

	public function myRocketComponentModelMms()
	{
			return $this->hasMany('RocketComponentModelMm', 'rocketComponent_id');
	}

	public function scopeCannons($query)
  {
			return $query->where('type', '=', 'cannon');
  }

  public function scopeShields($query)
  {
			return $query->where('type', '=', 'shield');
  }

  public function scopeEngines($query)
  {
			return $query->where('type', '=', 'engine');
  }

	public static function convertToArray($row)
  {
      $data = $row instanceof Arrayable ? $row->toArray() : (array) $row;
      foreach (array_keys($data) as $key) {
          if (is_object($data[$key])) {
              $data[$key] = $row->$key;
          } else if (is_array($data[$key])) {
              $data[$key] = static::convertToArray($data[$key]);
          }
      }

      return $data;
  }
}
