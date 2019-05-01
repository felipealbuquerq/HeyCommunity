<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'         =>  'required|string',
            'intro'         =>  'required|string',
            'content'       =>  'required|string',
            'category_id'   =>  'required|integer',
            'area_id'       =>  'required|integer',
            'start_time'    =>  'required|string|date_format:"Y-m-d"|before:end_time',
            'end_time'      =>  'required|string|date_format:"Y-m-d"|after:start_time',
            'local'         =>  'required|string',
            'redirect_url'  =>  'nullable|string',
        ];

        if (request()->routeIs('*.update')) $rules['avatar'] = 'nullable|image';
        if (request()->routeIs('*.store')) $rules['avatar'] = 'required|image';

        return $rules;
    }

    /**
     * messages
     */
    public function messages()
    {
        return [
            'start_time.request'        =>  '开始时间不能为空',
            'start_time.before'         =>  '开始时间必须在结束时间之前',
            'end_time.request'          =>  '结束时间不能为空',
            'end_time.after'            =>  '结束时间必须在开始时间之后',

            'category_id.integer'       =>  '请选择活动分类',
            'area_id.integer'           =>  '请选择活动地区',
            'avatar.required'           =>  '请上传活动封面',
            'local.required'            =>  '请填写活动详情地址',
            'intro.required'            =>  '活动介绍不能为空',
            'content.required'          =>  '活动详情不能为空',
        ];
    }
}
