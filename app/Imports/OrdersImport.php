<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class OrdersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $customer = Customer::firstOrCreate(
            ['customer_email' => $row['customer_email']],
            ['customer_name' => $row['customer_name']]
        );

        $order = Order::firstOrCreate(
            ['customer_id' => $customer->id, 'order_date' => $row['order_date']]
        );

        return new OrderItem([
            'order_id' => $order->id,
            'product_name' => $row['product_name'],
            'product_price' => $row['product_price'],
            'quantity' => $row['quantity'],
        ]);
    }
}
