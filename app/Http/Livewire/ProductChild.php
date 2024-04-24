<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Products;

class ProductChild extends Component
{
    public $product;

    public $productName;

    public $productPrice;

    public $delete = [];

    public function mount(Products $product)
    {
        $this->product = $product;
        $this->productName = $product->name;
        $this->productPrice = $product->price;
    }

    public function render()
    {
        return view('livewire.product-child');
    }

    public function deleteProduct()
    {
        $this->delete["delete"] = "delete";
        //return view('livewire.dialog-window');
    }

    public function delete(){
        $this->product->delete();
        //Products::whereId($this->product->id)->first()->delete();
        $this->emitRefreshPage();
    }

    public function cancelDelete(){
        $this->delete["delete"] = null;
    }

    public function updateProduct()
    {
        Products::whereId($this->product->id)->update(['name' => $this->productName]);
        $this->emitRefreshPage();
    }

    // Um Seite bei Änderungen zu aktualisieren
    public function emitRefreshPage()
    {
        $this->emit("refreshPage");
    }
}
