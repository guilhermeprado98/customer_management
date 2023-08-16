<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function searchByName(Request $request)
    {
        $name = $request->input('name');

        $customers = Customer::where('name', 'like', '%' . $name . '%')->get();

        return response()->json(['data' => $customers]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
            'telefone' => 'required',
            'tipo_cliente' => 'required',
            'vendedores' => 'nullable|array', // Certifique-se de que a validação está correta
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = $image->hashName();
            $data['image_path'] = $imageName;
        }

        $sellerIds = Seller::whereIn('name', $data['vendedores'])->pluck('id')->toArray();
        $sellerIdsString = implode(',', $sellerIds);

        $customer = new Customer();
        $customer->fill($data);
        $customer->vendedores = $sellerIdsString;
        $customer->save();
        $customer->updateVendedores();

        return redirect()->route('customers.index')->with('success', 'Cliente criado com sucesso!');
    }

}
