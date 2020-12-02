<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storesanpham extends FormRequest
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
        return [
            'MaSP'=>'required|max:5',
            'TenSP'=>'required|min:5|max:50',
            'urlHinh'=>'required',
            'MauSac'=>'required',
            'MoTa'=>'required',
            'GiaBan'=>'required|numeric|min:10000',
            'TinhTrang'=>'required',
            'NCN'=>'required|date',
            'MaPL'=>'required|max:3',
            'NCC'=>'required',
            'ThuTu'=>'required|max:3',
            'AnHien'=>'required|boolean',
        ];  
    }
    
    public function messages()
    {
        return [
            'MaSP.required' => 'Mã sản phẩm gồm 5 ký tự',
            'TenSP.required' => 'Tên sản phẩm từ 5 đến 50 ký tự',
            'urlHinh.required' => 'Đuôi hình bao gồm: png,jpg,jpeg,webp',
            'MauSac,required' => 'Màu sắc không được bỏ trống',
            'MoTa.required' => 'Mô tả không được bỏ trống',
            'GiaBan.required' => 'Giá bán có giá trị thấp nhất là 10.000 VND',
            'TinhTrang.required' => 'Tình trạng không được bỏ trống',
            'NCN.required' => 'Ngày cập nhật có dạng: d-y-m',
            'MaPL.required' => 'Mã phân loại gồm 3 ký tự',
            'NCC.required' => 'Mã nhà cung cấp không được bỏ trống',
            'ThuTu.required' => 'Thứ tự không được bỏ trống',
            'AnHien.required' => 'Bạn chưa chọn thuộc tính ẩn hiện',       
        ];
    }
}
