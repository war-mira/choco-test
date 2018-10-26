<?php
/**
 * Created by PhpStorm.
 * User: Mamyraimov Asset
 * Date: 24.01.2018
 * Time: 11:42
 */

namespace App\Observers;


use App\Doctor;
use App\Skill;
use App\Traits\Observers\Slug;

class SkillObserver
{
    use Slug;

    public function created(Skill $skill)
    {
        $this->makeSlug($skill);
        $this->invalidateCache();
    }
    public function updated(Skill $skill)
    {
        $this->invalidateCache();
    }
    public function saved(Skill $skill)
    {
        $this->invalidateCache();
    }
    public function invalidateCache()
    {
        \Cache::tags(['skills'])->flush();
    }

}