<?php 

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller{
    public function home(Request $request){
        $query = Product::query();
        if($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        $products = $query->orderBy('id','desc')->paginate(10);
        // dd($products);
        return view('client.home', compact('products'));
    }
}