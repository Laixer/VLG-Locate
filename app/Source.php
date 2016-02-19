<?php

namespace App;

use App\Location;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
	public static function available() {
		$used = array();
		foreach (Location::where('active', true)->get() as $key) {
			array_push($used, $key->source_id);
		}

		return self::whereNotIn('id', $used)->get();
	}

	public function isAvailable() {
		if (\App\Location::where(['source_id' => $this->id, 'active' => true])->count() > 0) {
			return false;
		}

		return true;
	}

    /**
     * Get the phone record associated with the user.
     */
    public function location()
    {
        return $this->hasOne('App\Location');
    }

}
