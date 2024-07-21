<?php

namespace Workbench\App\Models;

use Hexafuchs\Team\Team as Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Team extends Model
{
    public function ownedItems(): MorphToMany
    {
        return $this->morphedByMany(\Workbench\App\Models\SomeItem::class, 'ownable');
    }
}
