<?php
// Interface này định nghĩa hợp đồng cho các class dịch thông báo đa ngôn ngữ
namespace App\Contracts;

interface TranslatorInterface
{
    // Trả về thông báo chào quản trị viên theo ngôn ngữ
    public function greeting(): string;
}
