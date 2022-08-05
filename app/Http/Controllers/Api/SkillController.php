<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SkillsCollection;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of all skills.
     *
     * @return \App\Http\Resources\Api\SkillsCollection<Skill>
     */
    public function index()
    {
        return new SkillsCollection(Skill::all());
    }
}
