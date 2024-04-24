<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Products;

class Product extends Component
{
    public $greeting = ".";

    public $food = "Burger";

    public $products = [];

    public $searchbar = "";

    public $name = "";
    
    public $price = "";

    public $message = [];

    protected $rules = ["name" => "required", "price" => "required"];

    // Listener um Seite neu zu rendern, bei Aktualisierungen
    // refreshPage ist Schlüsselwort, es wird die Funktion refresh aufgerufen.
    protected $listeners = ['refreshPage' => 'refresh'];

    // refresh lädt die Produkte aus der Datenbank neu herunter
    public function refresh(){
        $this->products = Products::all();
    }

    // Suchleiste erstellen.
    public function updatedSearchbar()
    {
        
    }
    
    // wird beim Aufruf der Seite ausgeführt
    public function mount()
    {

    }

    // Wenn ein public Variable geupdated wird, wird diese Funktion automatisch ausgeführt
    public function updated(){
        $this->greeting = "updated";
    }

    // Wenn food-Variable geupdated wird, wird diese Funktion automatisch ausgeführt
    public function updatedfood(){
        $this->food = "nichts";
    }

    public function updatedproductName(){
        $this->productName = "nichts";
    }

    // Ruft die Datei auf die angezeigt bzw. gerendert wird auf.
    public function render(){
        $this->products = Products::query()
            ->when($this->searchbar, function($query){
                return $query->where("name", "like", '%' . $this->searchbar . '%');
            })->get();
        
        return view('livewire.product');
    }

    public function resetGreeting()
    {
        $this->greeting = "reseted";
    }

    /*public function deleteProduct(Products $product){
        Products::whereId($product->id)->first()->delete();
        $this->products = Products::all();
    }

    public function updateProduct(Products $product, $name){
        Products::whereId($product->Id)->update(['name' => $name]);
    }*/

    // In Datenbank etwas einfügen
    public function add(Request $request)
    {
        /*
        $product = new Products();
        $product->name = request("name");
        $product->price = request("price");

        $product->save();
        */

        $validatedData = $this->validate();

        // In Datenbank hinzufügen
        products::create($validatedData);

        // Leitet mit einer Nachricht weiter.
        // return redirect()->route('product.add')->with('success', 'Produkt wurde erfolgreich hinzugefügt.');
        $this->message["success"] = "Produkt wurde erfolgreich hinzugefügt.";
    }
}
