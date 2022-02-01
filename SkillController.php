<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller {

    /**
     * Add a new Skill's
     */
    public function addSkill(Request $request) {
       
        try {
            $name = $request->name;
            $explode_names = explode(',', $name);
            foreach ($explode_names as $explode_name) {
                Skill::create(['name' => $explode_name]);
            }
            return $this->success('Skills saved successfully.');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Listing of Skills
     */
    public function skillList(Request $request) {
        try {
            $model = Skill::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            return $this->success(['list' => $model]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Listing of Skills with pagination
     */
    public function skillPagination($offset) {

        try {
            $limit = 15;
            $count = Skill::count();
            $model = Skill::orderBy('id', 'DESC')
                ->offset($offset * $limit - $limit)
                ->limit($limit)
                ->get();
            $list = ['current_page' => $offset, 'per_page' => $limit, 'total' => $count, 'data' => $model];
            return $this->success($list);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Delete a Skill
     */
    public function deleteSkill($id) {

        try {
            $model = Skill::FindOrFail($id);
            $model->delete();
            return $this->success([], 'Skill deleted successfully.');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update Skill status
     */
    public function skillStatus($id) {

        try {
            $model = Skill::FindOrFail($id);
            $status = $model->status == 1 ? 0: 1;
            $model->update(['status' => $status]);
            return $this->success($model, 'Status changed successfully.');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
