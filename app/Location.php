<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Get the phone record associated with the user.
     */
    public function source() {
        return $this->hasOne('App\Source', 'id', 'source_id');
    }

	public function isAvailable() {
		if (!$this->removed_at) {
			return true;
		}

		if ($this->removed_at > date('Y-m-d')) {
			return true;
		}

		return false;
	}
}
