<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Article; // Importa il modello Article
use Livewire\Attributes\Validate;
use Livewire\Component;


class OrderComponent extends Component
{
    public $cart;
    public $address, $city, $zip, $country, $card_number, $expiry_month, $expiry_year, $cvv;

    // Usa la validazione con la proprietà $rules
    protected $rules = [
        'address' => 'required|min:5',
        'city' => 'required|min:2',
        'zip' => 'required|regex:/^[A-Za-z0-9]{4,10}$/',
        'country' => 'required|min:2',
        // 'card_number' => 'required|digits:16',
        // 'expiry_month' => 'required|digits:2',
        // 'expiry_year' => 'required|digits:2',
        // 'cvv' => 'required|digits_between:3,4',
    ];

    protected $messages = [
        'address.required' => 'L\'indirizzo è obbligatorio.',
        'address.min' => 'L\'indirizzo deve contenere almeno 5 caratteri.',
        'city.required' => 'La città è obbligatoria.',
        'city.min' => 'Il nome della città deve contenere almeno 2 caratteri.',
        'zip.required' => 'Il CAP è obbligatorio.',
        'zip.regex' => 'Il CAP deve essere alfanumerico e contenere tra 4 e 10 caratteri.',
        'country.required' => 'Il paese è obbligatorio.',
        'country.min' => 'Il nome del paese deve contenere almeno 2 caratteri.',
        // 'card_number.required' => 'Il numero di carta è obbligatorio.',
        // 'card_number.digits' => 'Il numero di carta deve essere composto da 16 cifre.',
        // 'expiry_month.required' => 'La data di scadenza è obbligatoria.',
        // 'expiry_year.required' => 'La data di scadenza è obbligatoria.',
        // 'cvv.required' => 'Il CVV è obbligatorio.',
        // 'cvv.digits_between' => 'Il CVV deve essere di 3 o 4 cifre.',
    ];

    public function mount()
    {
        // Load the authenticated user's cart
        $this->cart = auth()->user()->cart;
    }
    public function storeOrder()
    {
        $this->validate();
        if (!$this->cart || empty($this->cart->items)) {
            return;
        }
        // Crea l'ordine
        $order = Order::create([
            'user_id' => auth()->user()->id,
            // 'address_id' => $address->id,
            'total' => collect($this->cart->items)->sum(fn($item) => $item['quantity'] * $item['price']),
        ]);
        Address::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'address' => $this->address,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
        ]);


        // Aggiungi gli articoli all'ordine
        foreach ($this->cart->items as $item) {
            $article = $item->article;
            OrderItem::create([
                'order_id' => $order->id,
                'article_id' => $article->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            // Rimuovi la quantità ordinata dallo stock dell'articolo
            $article->stock -= $item['quantity']; // Decrementa la quantità disponibile
            if ($article->stock < 0) {
                $article->stock = 0; // Assicurati che lo stock non vada sotto zero
            }
            $article->save(); // Salva l'aggiornamento dello stock
        }

        // Salva il pagamento
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => 'card', // Per ora fisso
        ]);

        // Svuota il carrello
        auth()->user()->cart()->delete(); // Se il carrello è un modello Eloquent
        session()->forget('cart');

        // Reset delle variabili
        $this->reset(['cart', 'address', 'city', 'zip', 'country', 'card_number', 'expiry_month', 'expiry_year', 'cvv']);
        return redirect()->route('articles.index')->with('message', 'Ordine completato con successo!');
    }
    public function getCartTotal()
    {
        $total = 0;
        if ($this->cart) {
            foreach ($this->cart->items as $item) {
                $total += $item->price * $item->quantity;
            }
        }

        return $total;
    }
    public function removeItem($itemId)
    {
        // Rimuovi l'articolo dal carrello
        $item = $this->cart->items()->find($itemId);
        if ($item) {
            $item->delete();
        }

        // Ricarica il carrello
        $this->cart = auth()->user()->cart;
    }
    public function render()
    {
        return view('livewire.order-component', ['cart' => $this->cart, 'getCartTotal' => $this->getCartTotal()]);
    }
}
