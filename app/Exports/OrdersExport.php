<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array
    {
        return [
            "id",
            "Ism va familiya",
            "Telefon raqami",
            "Shahar/Tuman",
            "Holati",
            "Konteyner turi",
            "Общивка наружнях стен",
            "Фортук наружная верхняя",
            "Цвет",
            "Общивка внутренных стен",
            "Покрытия пола",
            "Дверной проём",
            "Каркас",
            "Заметка",
            "Kiritgan shaxs ismi",
            "Yaratilgan vaqti",
            "Yangilangan vaqti",
            "Konteynerning umumiy summasi",
            "Pasport seriyasi va raqami",
            "Passport berilgan vaqti",
            "Kim tomonidan berilgan",
            "Yashash manzili"
        ];
    }

}
