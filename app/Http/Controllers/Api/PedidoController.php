<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAddon;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        return Order::with('orderItems.addons')->latest()->get();
    }

    public function store(StorePedidoRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $data['user_id'],
                'total_price' => $data['total_price'],
                'payment_method' => $data['payment_method'],
                'status' => $data['status'] ?? 'pendente',
                'order_type' => $data['order_type'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);

                if (!empty($item['addons'])) {
                    foreach ($item['addons'] as $addonId) {
                        OrderItemAddon::create([
                            'order_item_id' => $orderItem->id,
                            'addon_id' => $addonId,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json($order->load('orderItems.addons'), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao criar pedido.'], 500);
        }
    }

    public function show(Order $order)
    {
        return $order->load('orderItems.addons');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Pedido excluído.']);
    }
}


