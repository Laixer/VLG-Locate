<?php

namespace App;

use App\Location;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
	public static function available() {
		$used = array();
		foreach (Location::whereNull('removed_at')->orWhere('removed_at', '>', date('Y-m-d'))->get() as $key) {
			array_push($used, $key->source_id);
		}

		return self::whereNotIn('id', $used)->get();
	}

	public function isAvailable() {
		$used = array();
		foreach (Location::whereNull('removed_at')->orWhere('removed_at', '>', date('Y-m-d'))->get() as $key) {
			array_push($used, $key->source_id);
		}

		if (in_array($this->id, $used)) {
			return false;
		}

		return true;
	}

    /**
     * Get the phone record associated with the user.
     */
    public function location()
    {
        return $this->hasMany('App\Location');
    }

}
