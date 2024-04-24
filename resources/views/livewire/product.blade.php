<div>
    <p>hallo</p>
    <!-- Wenn etwas erfolgreich hinzugefügt wurde, wird die Nachricht mit dem Key "success" angezeigt -->
    @if(isset($message["success"]))
        <div class="alert alert-success">
            {{ $message["success"] }}
        </div>
    @endif

    <!-- Formular um in die Datenbank ein Produkt hinzuzufügen -->
    <form method="POST" wire:submit.prevent="add">
        <!-- Sicherheitsmaßnahme um vor csrf-Angriffen zu schützen -->
        @csrf
        <div>
            <div>
                <label for="name">Name:</label>
                <input type="text" wire:model="name" required>
                @error("name") <p>gib etwas ein</p> @enderror
            </div>
            <div>
                <label for="price">Preis:</label>
                <input type="number" wire:model="price" required>
                @error("price") {{"$message"}} @enderror
            </div>
            <div>
                <button type="submit">Produkt hinzufügen</button>
            </div>
        </div>
    </form>
    
    <br><br><br><br><br><br>
    <div class="w-full">
        
    <!--
        <input wire:model="greeting" type="text">
        <h2>Hallo {{$greeting}}</h2>

        <button wire:click="resetGreeting">reset button</button>

        <br><br><br><br>
        <input wire:model="food" type="text">
        <h2>Ich will {{$food}}.</h2>
    -->

        <div>
            <div class="mt-6">
                <div>
                    <!-- Verknüpft $searchbar-Variable mit dem Input Feld -->
                    <input wire:model="searchbar" type="text" name="searchbar" placeholder="Suche...">
                </div>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="tx-4 ty-2">
                                <div class="flex items-center">
                                    Name
                                </div>
                            </th>
                            <th class="tx-4 ty-2">
                                <div class="flex items-center">
                                    Price
                                </div>
                            </th>
                            <th class="tx-4 ty-2">
                                <div class="flex items-center">
                                    Actions
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <!-- Ruf product-child auf, gibt Parameter $product über, mit einem Key für Identifizierung -->
                            @livewire("product-child", ["product" => $product], key($product->id))
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
